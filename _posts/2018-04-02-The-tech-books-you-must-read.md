---
layout: post
title: "The tech books you MUST read (if you haven't yet)"
date: 2018-04-01
excerpt: "A collection of tech books I believe you must watch, if you haven't yet"
header-img: "assets/img/posts/book_shelf.jpg"
tags: [tech, books, personal, development, software]
---

![Blog post introductory image](../assets/img/posts/book_shelf.jpg "Photo by Engin Akyurt from Pexels")

This post is part of the ["Things you MUST do (if you haven't yet)" series]({{ site.baseurl }}{% post_url 2018-03-25-The-things-you-must-do %}), covering books about technology and software. If you want to read a bit more of my rambling on why I started doing this, feel free to read the original post, linked above.

This post contains some of the best technical books I've read so far. Disclaimer: some of these books might not be purely technical depending on your definition, but I believe they can still be useful to technologists (and more specifically, people involved in the process of software development) and this is why they are included in this list. Every suggestion comes with a brief summary of what I gained from each book and why I think it's worth investing the time to read it. Similar to all the posts belonging in this series, keep in mind this is a (constant) work-in-progress, so entries might be added without further notice.

<br/>

----

<br/>

### Designing Data-Intensive Applications

_As you can confirm by the reviews of the book, this is definitely a must-read for any professional who is involved in the design of large-scale systems. That said, this book is not an easy read, it's quite big and touches a lot of concepts. The author has selected a bottom-up approach, starting from a rather interesting analysis of the low-level parts of storage engines and then moving on to how these can be composed to build bigger systems, like the ones commonly used today (such as Cassandra, ElasticSearch etc.). Along the way, there's an ongoing, background analysis on trade-offs behing design decisions. The author manages to provide a nice explanation of almost all the basic building blocks of distributed algorithms, such as sharding, replication, consensus, transactions etc. However, he would not be able to go into full detail in a single book, so you will need to spend time on your own, studying each part. Fortunately, the author provides very useful resources and references to start with._

<br/>

### Domain-Driven Design: Tackling Complexity in the Heart of Software

_This is one of the few books that have shaped the way I develop and think about software. It's a quite old book, written in 2003, but it's still very applicable to the way software is developed nowadays. Eric Evans is the pioneer of the term Domain-Driven Design, which has ended up being quite a fad lately. As a result, there are much more recent books. However, I think that this book also provides insight into the early days of software development, which is extremely valuable and interesting. The language of the book can get quite abstract at times, the writing style is not the best and it has received a lot of criticism on that. Still, if you want to become an expert in data and domain modelling, this is the place to start from. Plus, you will be able to boast having read the whole "blue" book (for those who know)!_

<br/>

### The Lean Startup: How Constant Innovation Creates Radically Successful Businesses 

_If you work in the software industry, most likely you will already have heard of this book, since it's quite popular for shaping the way a lot of successful startups have been operating. What struck me though is the fact that the principles and concepts explained in the book are pretty generic and can be applied in many different settings both in your professional and personal life. One of the trigger points for this book was the amount of effort that goes to waste in the software industry. Software development teams invest months (or sometimes even years) working on a project only to find out that they were actually building the wrong thing after delivering it. This phenomenon is more prevalent and poses bigger risks for startups that have limited resources and more uncertainty, which is the main reason behind the title of the book. However, I've personally experienced this problem in bigger companies as well, so any takeaways from the book can be useful in general. The author makes the case for the virtuous cycle of build-measure-learn and gives ample real-life examples of companies in order to illustrate mistakes, successes and lessons learned. If you are a software developer, it will help you rethink how you approach software development. If you are a person not developing software, but leading people doing that, you will learn how to identify what your team should be working on. In any other case, I daresay this book will still have to offer useful insights._

<br/>

### Java Concurrency in Practice 

_If you are a software developer working in Java, this is one of the books that you must definitely read, especially if you are working on concurrent, multi-threaded systems. The authors of this book have made extremely valuable contributions to the Java programming language and this book gives you the chance to hear them explain what they built! The book starts from fundamental concepts, such as Java's memory model, and then gradually proceeds to higher-level tools, such as concurrent data structures and patterns. Depending on your experience, this book might make you realise some things that you would never imagine or you would have to discover yourself the hard way. Personally, I've read it twice, one in the early days of my programming journey and one after having worked extensively with concurrent systems, it was equally valuable both times. Highly recommended for any Java developer that wants to write efficient and robust software systems._

<br/>

### The Manager's Path: A Guide for Tech Leaders navigating growth and change

_As the title implies, this book covers the various stages of the software engineering career ladder. As a result, it can be useful to people of different backgrounds and roles. The chapter dedicates a separate chapter for every role starting from the bottom and working its way up, which can mean it can be beneficial in many different ways. If you are a relatively junior or mid-level software engineer, it can give you an idea of the responsibilities of roles you can evolve into later in your career. This can also make you more efficient in your day-to-day work by knowing what are common challenges the people you report to face and how you can help them and the overall organisation in general. I read this book cover to cover and it took me a few weeks, since it is relatively light reading. However, you can also read it piecemeal as you go through different phases of your career, since it can give you a quick overview of the challenges and some tips for a new role you might be embarking into._

<br/>

### The Phoenix Project

_This is one of the few books of its kind. It is a book about software development practices, which is not that unique. However, the interesting aspect is it's actually a novel. It is about Bill an IT manager at a company called Parts Unlimited. The story starts with Bill getting a promotion from the CEO of the company and becoming responsible for one of the critical IT projects of the company. As the story unfolds, Bill realises how inefficient the company is and gradually manages to turn the ship around. The book presents a lot of practices and methodologies that later became known as DevOps, but the reader gets a more practical illustration of them. Apart from DevOps, the book has various other gems. For example, I ended up finding about systems thinking after reading it. I enjoyed this book so much that I finished it within a week and I am not a big fan of novels, so that must be saying something about the book._

<br/>

### SQL Performance Explained

_I came across this book out of a coincidence, but I never regretted investing the time to read it. It can give you a great understanding of how to use a relational database efficiently. A great number of applications rely on relational databases nowadays, so it's highly likely you will be able to put what you learn into practice. It covers many different aspects, but even just the section about indexes is worth its money._

<br/>

### Computer Networking: A top-down approach

_This is the classical textbook about networking of computer systems. This is on its own a huge field, but a lot of effort has been put into the book so that information is presented in a linear fashion so that readers without a technical background can follow along. Fun fact: I was given this book during my undergraduate studies. Of course, I never got the time to read it. 10 years later, while working as a software engineer for almost a decade I came across it and decided to invest the time to read it. Needless to say I still got to learn a lot. The explanations were so clear, I ended up wondering how I could be so confused about BGP during my undergrad._

<br/>

### Test-Driven Development: by example

_This is a book about TDD written by the inventor of TDD. It's been several years, since I read this book. I remember it was during the first 2-3 years after I started writing software professionally. TDD was becoming quite trendy back then, but there was also a lot of noise making it easier for newcomers. I recall I liked this book a lot, because Kent explained the concept very simply and through practical code examples. The book is essentially him solving simple programming problems and explaining the process along the way. That said, I would say this book is a good fit for newcomers to TDD, but it might prove to be a bit boring for people with practical TDD experience._

<br/>

### Black Box Thinking: Why some people never learn from their mistakes, but some do

_The title of this book can be a bit misleading. At least, it was to me before I read it. Black box does not refer to treating a system as a black box without the need to understand how it works internally. On the contrary, it refers to the electronic devices used to record all the events happening in an airplane, which is used during investigation of incidents to understand better what went wrong. Fun fact: these boxes are actually orange, not black. This book creates a narrative on how the human species can evolve by studying carefully our mistakes and incrementally tuning our behaviour to course correct. You might think this is not such a big revelation, but the book provides great historical examples that illustrate the power behind this simple idea, such as the ["Scared Straight" program](https://en.wikipedia.org/wiki/Scared_Straight!) or the old practice of [bloodletting](https://en.wikipedia.org/wiki/Bloodletting). Of course, the impact of this idea can be immeasurable when applied in the technological field, but it is illuminating to see how widely it can be applied._

<br/>
