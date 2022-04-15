---
layout: post
title: "The coding problem that ruined my Friday"
date: 2022-04-15
tags: [coding, problem, algorithms, software]
---

Today, I decided to spend some time coding[^coding] and I came across the following problem:

<br/>

-------------------------------------------------------

<br/>

You are playing the following game[^nim] with your friend:

* Initially, there is a heap of stones on the table.
* You and your friend will alternate taking turns, and you go first.
* On each turn, the person whose turn it is will remove 1 to 3 stones from the heap.
* The one who removes the last stone is the winner.

Given `n`, the number of stones in the heap, return `true` if you can win the game assuming both you and your friend play optimally, otherwise return `false`.

<br/>

-------------------------------------------------------

<br/>

Looks a bit tricky at the beginning, doesn't it? If you start playing with some examples with small number of stones, you slowly realise what's going on. If there's 1, 2 or 3 stones, you clearly win. What if there are 4 stones? There's no way you can win, since no matter how many stones you select, your opponent will then select the remaining number of stones and win. 

Ok, but we have to figure out a generic algorithm... Well, this problem seems a bit recursive, right? The only way to win if there are `n` remaining stones in the table and it's your turn is if the opponent cannot win in any of the scenarios where there are `n-1`, `n-2` or `n-3` stones in the tables and it's their turn. Let's make an attempt and code the algorithm[^kotlin]:

```
fun canWin(n: Int): Boolean {
    return canWin(n) == Result.Win
}

fun canWinRecursive(remainingStones: Int): Result {
    if (remainingStones == 1 || remainingStones == 2 || remainingStones == 3) {
        return Result.Win
    }

    if (canWinRecursive(remainingStones - 1) == Result.Win &&
        canWinRecursive(remainingStones - 2) == Result.Win &&
        canWinRecursive(remainingStones - 3) == Result.Win ) {
        return Result.Lose
    } else {
        return Result.Win
    }
}

enum class Result {
    Win,
    Lose
}
```

Pretty good, but when you start running it with large inputs, it seems that your program either takes too long to run or blows up due to stack overflows. You quickly realise that stack overflows can be solved by switching the algorithm from a recursive one to an iterative one. How about the running time? It seems that we end up calculating the solution to the same problem multiple times. We can optimise that using memoisation and dynamic programming. We can have a table containing the result of each possible number of stones up to the one we want and start calculating the results bottom up.

This is what you end up with:

```
fun canWin(n: Int): Boolean {
    if (n == 1 || n == 2 || n == 3) {
        return true
    }
    
    val results = Array<Result>(n) { Result.Win }

    results[0] = Result.Win
    results[1] = Result.Win
    results[2] = Result.Win
    
    for (i in 3..(n-1)) {
        if (results[i-1] == Result.Win &&
            results[i-2] == Result.Win &&
            results[i-3] == Result.Win) {
            results[i] = Result.Lose
        } else {
            results[i] = Result.Win
        }
    }
    
    return results[n-1] == Result.Win
}

enum class Result {
    Win,
    Lose
}
```

Much better, but your program ends up running out of memory when you run it for larger values. Hold on, you think... I see a pattern there. We only use the last 3 results on every iteration. So, maybe we can keep an array of only 3 elements, instead of one that grows relative to the size of the problem. We can use that array in a circular way and maintain the solutions to the last 3 problems at a time. Something like this:

```
fun canWin(n: Int): Boolean {
    if (n == 1 || n == 2 || n == 3) {
        return true
    }

    val results = Array<Result>(3) { Result.Win }

    results[0] = Result.Win
    results[1] = Result.Win
    results[2] = Result.Win

    var latestResult = results[2]
    for (i in 3..(n-1)) {
        if (results[0] == Result.Win &&
            results[1] == Result.Win &&
            results[2] == Result.Win) {
            latestResult = Result.Lose
        } else {
            latestResult = Result.Win
        }

        results[0] = results[1]
        results[1] = results[2]
        results[2] = latestResult
    }

    return latestResult == Result.Win
}

enum class Result {
    Win,
    Lose
}
```

You tap yourself on the shoulder with a sigh of relief: "nice one buddy, it wasn't that hard after all". Full of pride, you go and boast to your significant other about it, only for them to come back and tell you that this is not the optimal solution[^optimal]. What? Better than linear time complexity and constant space complexity? Impossible. No, my friend it is possible.

And now here I am scratching my head for the next 20 minutes. In a moment of despair, I give in and start looking for the solution on the Internet. And indeed, I find it and it's a solution with constant time and space complexity. Even worse, it's a one liner!

```
fun canWin(n: Int): Boolean {
    return n % 4 != 0
}
```

Apparently, if you go through the numbers, you will notice that there is a recurring pattern, which repeats for multiples of 4.



<br/>

-------------------------------------------------------

<br/>

[^coding]: Unfortunately, I don't get to code much at work nowadays, so I enjoy writing some code at home when I get the time. Plus, it keeps my mind sharp.
[^nim]: This type of game is also known as a [Nim game](https://en.wikipedia.org/wiki/Nim).
[^kotlin]: I will do it in Kotlin, since this is the language I've been using at work for the last 4 years so it's my default mode of thinking.
[^optimal]: This is the only fictional element in this post. Fortunately for me, my wife would just roll her eyes if I started talking about dynamic programming and memoisation. If your significant other is also a coder and could plausibly do this to you, my most sincere condolences.