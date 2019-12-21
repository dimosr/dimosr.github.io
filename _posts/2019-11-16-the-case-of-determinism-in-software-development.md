---
layout: post
title: "The case of determinism in software development"
date: 2019-11-16
excerpt: "Discussing why determinism can be useful in software development and various techniques that leverage determinism"
header-img: "assets/img/posts/pattern_tiles.jpg"
tags: [software, systems, design, determinism]
---

![Patterns](../assets/img/posts/pattern_tiles_small.jpg)

While working on [Corda](https://www.corda.net) for the last year or so, I came to see the value of determinism in software systems. For those of you unfamiliar with Corda, it's a distributed ledger platform that aspires to make it easier to build systems that can remain in sync with each other with less reconciliation with the ultimate goal of reaching the nirvana of ["what I see is what you see"](https://medium.com/corda/what-problem-are-we-trying-to-solve-with-corda-ec940b629792). This is achieved via a multitude of mechanisms, such as notaries, smart contracts and a deterministic form of the JVM. To be a bit less vague, notaries can provide a way to essentially execute transactions that span different datasets without the need of slow or error-prone distributed agreement protocols. In the financial world, a concrete realisation of this generic computer science problem is also known as [delivery-versus-payment (DvP)](https://en.wikipedia.org/wiki/Delivery_versus_payment). The notion of smart contracts along with a deterministic implementation of the JVM can provide a way to execute some code on different systems having the guarantee that these systems will reach the same conclusion when provided the same inputs.

I've been also doing some reading on distributed systems during the last months and I came across FaunaDB and the Calvin [1] paper which laid the foundations for this novel kind of datastore architecture. Following the breadcrumbs, I ended up reading another article on the Communications of the ACM Magazine titled "An Overview of Deterministic Database Systems"[2], unsurpsingly written by one the of authors in the Calvin paper. This paper talks about the fact that database systems were originally designed in a way that embraced the non-determinism that was present in the task of managing data. It then makes the case for a new generation of database systems that manage non-determinism in an arguably better way by identifying all of its sources and trying to manage them in a central place instead of allowing them to leak to all parts of the system. It finally demonstrates how this approach is feasible and can even result in better performance for some use-cases, while also allowing a more modular and simpler design of the system. One of the central ideas is to predetermine the order of execution for transactions via a preliminary consensus layer, so that all nodes of the system are free to proceed at their own pace while guaranteeing to execute the transactions in this order. This approach can have some very interesting benefits, such as eliminating the possibility of deadlocks or obviating the need for distributed agreement protocols (such as two-phase commit) even for transactions that span multiple partitions. 

Thinking about both of these examples, it seemed to me the former can be seen as a macroscopic version of the latter. I also tend to be a big fan of patterns, so this made me also think about determinism in general and how it can help us build and operate software systems in a better way. I started thinking how determinism is actually present in many approaches and methodologies I've been using while developing software:

* **Functional programming** along with its buddy referencial transparency are both another example of how creating software components that act deterministically can help us reason about them more easily. The fact that functional programming advocates relocating all side-effects in central places where they can be managed better is an interesting analogy to what I described above.
* In my opinion, **Test-driven development (TDD)** - and in general every testing methodology - is also a practice that tries to instill determinism in our systems by creating a framework where developers make a conscious effort to understand how their systems behave under different scenarios and also have a deterministic way to continuously prove this is the case.
* **Operational practices**, such as monitoring, logging and alarming on SLAs, are all techniques that help us create a mental model of how a system is supposed to behave under normal conditions and detect deviations from this normal behaviour. Thus, it's an attempt to create a determinitic view of our systems.
* **Event sourcing** is a technique, where all changes to application state are modelled as a sequence of events. As a result, the application state is just the result of applying all the events that have happened to the starting state. By keeping the transition functions deterministic through time, we can do powerful things like recalculating the state at some specific point in time one event at a time to understand how the system arrived there.

Of course, determinism is not a silver bullet and comes with trade-offs, usually in the form of constraints in terms of what we can express or achieve. As an example, in order for Calvin to preserve this determinism it  cannot support interactive transactions, where a client can keep a transaction open and perform other operations outside the scope of the datastore that might determine the final result of the transaction. Similar examples can be given for the other approaches too, but I'll leave that as an exercise for the reader :neckbeard: 

I still believe determinism can be a very useful tool in our software development arsenal. Feel free to add your comments below, I'd be happy to hear your thoughts or even more examples of methodologies that benefit from seeking determinism.

### References

[[1](http://cs.yale.edu/homes/thomson/publications/calvin-sigmod12.pdf)] "Calvin: fast distributed transactions for partitioned database systems", Thomson Alexander, Thaddeus Diamond, Shu-Chun Weng, Kun Ren, Philip Shao, Daniel J. Abadi, SIGMOD '12, 2012

[[2](http://www.jmfaleiro.com/pubs/overview-cacm2018.pdf)] "An overview of deterministic database systems", Daniel J. Abadi, Jose M. Faleiro, Communications of the ACM, Volume 61 Issue 9, 2018

