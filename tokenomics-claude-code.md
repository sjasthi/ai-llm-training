# Claude Code Tokenomics Best Practices

## Overview

This document summarizes high-impact strategies for reducing token usage and improving cost efficiency while using Claude Code. The focus is on reducing unnecessary context growth, improving prompt structure, and maximizing reuse of persistent knowledge.

---

## 1. Front-load thinking in Plan Mode

Use Plan Mode to define:

* Architecture
* Execution steps
* Constraints
* File boundaries

**Why it saves cost:**
Early planning reduces expensive mid-execution corrections and avoids re-deriving decisions multiple times.

---

## 2. Treat Agent Mode as a burst execution tool

Use Agent Mode only when the plan is stable and execution is deterministic.

Avoid using Agent Mode for:

* Open-ended exploration
* Iterative brainstorming

**Principle:** Agent Mode = execution, not discovery.

---

## 3. Externalize persistent knowledge into CLAUDE.md

Store stable project knowledge such as:

* Architecture decisions
* Coding standards
* System constraints
* Reusable rules

**Impact:** Reduces repeated prompting and context rehydration costs.

---

## 4. Keep context minimal and focused

Avoid cluttering context with:

* Full logs
* Redundant explanations
* Large pasted files (unless necessary)

**Goal:** Maintain the smallest context sufficient for correctness.

---

## 5. Use /compact proactively

Do not wait for context overflow.

Compact when:

* Context exceeds ~60–70%
* Noise exceeds signal

**Benefit:** Removes redundant history while preserving semantic intent.

---

## 6. Replace repeated instructions with SKILLS or templates

If you repeatedly specify behavior:

* Convert into reusable SKILLS
* Or store in CLAUDE.md

**Result:** One-time token cost → long-term reuse.

---

## 7. Avoid debugging loops

Inefficient pattern:

* Fix → error → fix → error cycles

Efficient pattern:

* Diagnose root cause first
* Apply batched fix strategy

**Cost impact:** Reduces exponential token growth.

---

## 8. Use /context for system visibility

Monitor:

* Context size
* Tool output accumulation
* Loaded artifacts

**Rule of thumb:**

* > 70% context → optimize or compact
* > 85% context → risk of degradation

---

## 9. Use /usage as a cost feedback loop

Track token usage to understand:

* Cost per task
* Cost per feature
* Cost per bug fix

**Goal:** Identify high-value, low-token workflows.

---

## 10. Minimize ambiguity in prompts

Ambiguity increases token usage exponentially.

Avoid:

* "fix this"
* "improve this"
* "make it better"

Prefer:

* explicit objectives
* constraints
* expected outputs
* acceptance criteria

---

## Core Principle

> Token cost is driven by entropy, not just size.

High cost comes from:

* uncertainty
* repetition
* uncontrolled exploration
* missing structure

---

## Summary

Efficient Claude Code usage is not about writing fewer words, but about:

* structuring intent early
* minimizing rework
* externalizing memory
* controlling context growth
* reducing ambiguity
