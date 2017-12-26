---
layout: post
title:  "ServiceCall4j"
image: '../assets/img/projects/servicecall4j.png'
date:   2017-09-20
excerpt: "A Java library for RPC capabilities"
project: true
tag:
- software
- library
- framework
- java
- rpc
---

![ServiceCall4j Image](../assets/img/projects/servicecall4j.png)
{: .image-pull-right}

<center><b>ServiceCall4j</b> is a Java library for RPC calls.</center>

You want to enhance your RPC calls with resilience features ? ServiceCall4j can help you.

It provides the following fundamental capabilities in an easy declarative way:
* Caching
* Monitoring
* Retrying
* Timeouts
* Throttling
* Circuit Breakers

What it takes? A bunch of lines:
``` java
public class MyCall implements ServiceCall<String, String> {
	String call(String input) {
		return "Hello " + input;
	}
}

...

ServiceCall<String, String> enhancedHelloWorldCall = new ServiceCallBuilder<>(new MyCall())
		.withCircuitBreaker(15, 5, 3, 300)
		.withCache(cache)
		.withMonitoring((i, d) -> System.out.println("Duration: " + d.toMillis()))
		.withTimeouts(Duration.ofMillis(1), 
			TimeUnit.MILLISECONDS, 
			Executors.newFixedThreadPool(10))
		.withThrottling(100)
		.withRetrying(false, 2)
		.build();
```

You can find more info about the project [here](https://github.com/dimosr/service-call-4j).