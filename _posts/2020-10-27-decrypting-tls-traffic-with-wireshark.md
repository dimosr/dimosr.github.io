---
layout: post
title: "Decrypting TLS traffic using ephemeral key exchange with Wireshark"
date: 2020-10-27
excerpt: "How to decrypt TLS traffic that makes use of an ephemeral key exchange algorithm using Wireshark"
header-img: "assets/img/posts/wireshark.jpg"
tags: [software, networking, decryption, tls, wireshark, java, ephemeral, key, exchange]
---

![Blog post introductory image](../assets/img/posts/wireshark.jpg)

TLS is one of the main protocols used to exchange data securely over an insecure network, such as the Internet. TLS relies on a set of cryptographic mechanisms that prevent any eavesdropper from being able to see the actual data that are transferred between the two sides. However, there are some benign cases where we are in control of one of the two sides of communication and we want to decrypt the encrypted traffic that is exchanged between them, e.g. for troubleshooting or better understanding of intricate details of the underlying protocols.

[Wireshark](https://www.wireshark.org/) is one of the main tools used for inspection of network traffic. Apart from being able to capture data transmitted through a network interface, it is able to understand the major protocols and thus provide additional facilities to the user, such as parsing low-level protocol details and presenting them in a more user-friendly way on its user interface or assembling multiple packets into a coherent stream. As a result, it can help someone understand deeply the data exchanged between two systems. However, when the underlying traffic is encrypted, then the capabilities of the tool become limited. For example, it is still capable of capturing some information that is not encrypted, such as the IP or TCP headers, but it is not capable of presenting the actual application data since they are transmitted in an encrypted form. Fortunately, it still provides some ways for us to decrypt that data.

## Ephemeral key-exchange algorithms

TLS makes use of a key exchange algorithm in order to secury agree on a symmetric key that will be used to subsequently encrypt the data that will be exchanged. Typically, the server has a key pair, consisting of a public and a private key. The public key is advertised to the clients, who are then using it to encrypt a piece of data and send it to the server that is then used to generate the symmetric key. In this way, observers of the traffic are unable to decrypt this data without the server's private key. Among the available algorithms, there is also a specific category of algorithms that perform what's known as **ephemeral** key exchange. These algorithms generate a different key pair for every connection, instead of using the same one. This provides a property known as **forward secrecy** , which means that even if the server's (static) private key becomes compromised, any past sessions that might have been intercepted will not be compromised. Even though this is very useful from a security perspective, the direct consequence is it makes it harder to decrypt the TLS traffic for the purposes explained previously, since it's not sufficient to provide the server's private key to Wireshark. One way to workaround this constraint is to dump this secret piece of data - known as the pre-master secret - from the application and import it into Wireshark, which will then be able to decrypt the TLS traffic.

## Logging & Importing the pre-master secret key

The first thing to do is to log the pre-master secret key from the TLS client. Of course, it goes without saying that this should only be done in testing environments and not in production, because if this piece of data gets leaked the whole TLS session can get compromised. Depending on the application, there are different ways to log this piece of data. For example, web browsers will log this data when a specific environment variable is populated (`SSLKEYLOGFILE`). I recently had to do the same for a Java application and it took me a while to figure it all out, so I decided to write this post to explain the whole process. 

First of all, I assume that your application is making use of Java's native capabilities for TLS, also known as [SunJSSE](https://docs.oracle.com/javase/8/docs/technotes/guides/security/jsse/JSSERefGuide.html). This is a reasonable assumption, since a lot of libraries out there (such as [Netty](https://netty.io/) in my case) make use of it. In this case, you can instruct the application to log all the required information by using the system property `javax.net.debug`. Specifically, we only need to see information around key generation, so the following should be enough:

```
java -Djavax.net.debug=ssl,keygen -jar ...
```

The log output will contain a lot of information, but the piece you are interested is the following:

```
SESSION KEYGEN:
PreMaster Secret:
0000: B2 EE D3 15 CC 05 83 A7   E6 A2 77 2F 0E 42 DC 87  ..........w/.B..
0010: 9E 82 76 A5 E4 77 6F 98   64 4F 1E F9 84 3D DE 58  ..v..wo.dO...=.X
CONNECTION KEYGEN:
Client Nonce:
0000: 5F 97 FB CD 1E FC 40 F1   33 3C 37 A2 F8 F9 49 7E  _.....@.3<7...I.
0010: 74 C1 E9 21 AE AF F9 00   FE 7C 6D 5D 7D A5 A5 C8  t..!......m]....
Server Nonce:
0000: 5F 97 FB CD 79 E5 EB E5   72 28 7C 60 5C F9 8C 2B  _...y...r(.`\..+
0010: 93 E0 7E AC 4C 48 FF 28   A1 BF B4 2E 65 E7 0D 68  ....LH.(....e..h
Master Secret:
0000: 16 7E D4 6C 5F 76 96 BC   C0 1E 36 7E 6C B3 F2 FD  ...l_v....6.l...
0010: 3F 99 4D 05 A7 F7 A6 40   58 1C D8 6B 76 7D 17 4C  ?.M....@X..kv..L
0020: 72 E2 44 AE 67 F1 B5 DE   E7 78 EB 74 9A 9A 99 68  r.D.g....x.t...h
```

From this, you will need to extract the client nonce and the master secret in the following format in a separate file:

```
CLIENT_RANDOM 5F97FBCD1EFC40F1333C37A2F8F9497E74C1E921AEAFF900FE7C6D5D7DA5A5C8 167ED46C5F7696BCC01E367E6CB3F2FD3F994D05A7F7A640581CD86B767D174C72E244AE67F1B5DEE778EB749A9A9968
```

Fortunately, there are some tools out there that can do this parsing for you, such as [this one](https://gist.github.com/tsaarni/14cc3341d0996e25671f5ca894842ec9).

Last, you need to import this file into Wireshark, by right-clicking on a packet and then selecting '_Protocol Preferences_' -> '_Open Transport Layer Security Preferences_' -> '_(Pre)-Master-Secret log filename_' and selecting the previous file. When you've done this, all the packets containing application data that were shown as `TLS` before will now be shown as `HTTP` and you will be able to see the data in plaintext form.

