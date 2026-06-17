# Building AI Agent-Friendly Code Repositories

## Best Practices for Claude Code and Other AI Coding Agents

Version 1.0

---

# Executive Summary

AI coding agents such as Claude Code, GitHub Copilot Agent Mode, Gemini CLI, Cursor, Windsurf, and future software engineering agents spend a significant amount of time trying to understand your repository.

If your repository lacks structure and documentation, the AI must repeatedly scan hundreds or thousands of files every session, increasing:

* Context window usage
* Token consumption
* Latency
* Cost
* Hallucinations
* Wrong architectural decisions

An AI-friendly repository dramatically improves productivity while reducing token costs.

The goal is simple:

> Spend tokens writing code, not rediscovering the architecture.

---

# Traditional Repository

```
myproject/

    src/
    tests/
    scripts/
    package.json
    README.md
```

Human developers understand this after weeks of work.

An AI agent does not.

Every new session requires rediscovering:

* Architecture
* Build process
* Coding conventions
* Folder purposes
* Common commands
* Project philosophy

This wastes tokens.

---

# AI-Friendly Repository

```
myproject/

    README.md
    CLAUDE.md
    MEMORY.md
    ARCHITECTURE.md
    CONTRIBUTING.md
    API_GUIDELINES.md
    DOMAIN_KNOWLEDGE.md

    src/
    tests/
    docs/
```

The AI reads these files first and understands the project almost immediately.

---

# Key Repository Files

## README.md

Purpose:

General project documentation for humans.

Typical contents:

* Project overview
* Installation
* Build instructions
* Deployment
* Basic architecture
* Getting started

Audience:

Humans

Persistence:

Long-term

Example:

```
# Inventory System

This system manages warehouse inventory.

## Install

npm install

## Run

npm start
```

---

## CLAUDE.md

Purpose:

Persistent instructions specifically for Claude Code.

Think of this as:

> "Operating manual for the AI."

Contains:

* Coding standards
* Folder conventions
* Testing expectations
* Naming conventions
* Build commands
* Common workflows
* Architectural rules
* Things Claude should always remember

Example:

```
Always use pnpm.

Never modify generated files.

All REST APIs belong in src/api.

Run unit tests before committing.

Use dependency injection.

Never introduce circular dependencies.
```

Claude automatically loads this context.

This eliminates repeating instructions every session.

---

## MEMORY.md

Purpose:

Persistent evolving memory.

Unlike CLAUDE.md, which contains project policy, MEMORY.md contains learned project knowledge.

Examples:

```
Payment service migrated to Stripe.

Customer IDs are UUIDs.

Reporting service uses Redis cache.

Do not use old Invoice API.

Legacy AuthService removed.
```

Think of MEMORY.md as:

Project journal for the AI.

Many teams update MEMORY.md after major architectural changes.

---

# Difference Between CLAUDE.md and MEMORY.md

| CLAUDE.md        | MEMORY.md              |
| ---------------- | ---------------------- |
| Project rules    | Learned knowledge      |
| Stable           | Changes often          |
| Team conventions | Historical decisions   |
| Coding standards | Architecture evolution |
| Instructions     | Facts                  |
| Human curated    | AI or human updated    |

Think of it this way:

CLAUDE.md = Constitution

MEMORY.md = Diary

---

# ARCHITECTURE.md

Purpose:

Explain system design.

Contents:

* Components
* Layers
* Data flow
* Microservices
* Event flow
* Database interactions

Example:

```
UI

↓

Gateway

↓

Customer Service

↓

Inventory Service

↓

Database
```

AI agents become dramatically better when architecture is explicitly documented.

---

# CONTRIBUTING.md

Purpose:

Explain how to contribute.

Contains:

* Branch strategy
* Pull requests
* Testing
* Reviews
* Coding style

Useful for both humans and AI agents.

---

# API_GUIDELINES.md

Purpose:

API standards.

Example:

```
Always return:

{
    success,
    data,
    errors
}

Use camelCase.

Version all endpoints.
```

Prevents inconsistent API generation.

---

# DOMAIN_KNOWLEDGE.md

Purpose:

Business knowledge.

Example:

```
Member != Customer

Premium member can have multiple subscriptions.

Guest checkout expires after 24 hours.

Invoices cannot be deleted.
```

This is often the single most valuable AI context file.

Without it, AI invents business rules.

---

# DATABASE.md

Useful for:

* Naming standards
* Relationships
* Migrations
* Soft delete policy
* Index strategy

Example:

```
Use UUID PKs.

Never cascade delete.

Always soft delete customers.

CreatedAt and UpdatedAt required.
```

---

# SECURITY.md

Contains:

* Authentication
* Authorization
* Secret handling
* JWT rules
* Encryption
* OAuth
* RBAC

Prevents AI from introducing insecure code.

---

# TESTING.md

Contains:

* Unit testing framework
* Integration testing
* Mock strategy
* Coverage requirements
* Naming standards

Example:

```
Minimum 80% coverage.

Mock external APIs.

Never hit production endpoints.
```

---

# DEPLOYMENT.md

Contains:

* CI/CD
* Docker
* Kubernetes
* AWS
* Azure
* Release process

AI can generate deployment changes consistently.

---

# DECISIONS.md (Architecture Decision Record)

Stores historical decisions.

Example:

```
2025-05-10

Moved from MongoDB to PostgreSQL.

Reason:
Need ACID transactions.

Alternative rejected:
Cassandra
```

AI agents avoid suggesting previously rejected ideas.

---

# PROJECT_STRUCTURE.md

Explains folders.

Example:

```
src/api

REST endpoints

src/domain

Business logic

src/infrastructure

Persistence

src/shared

Utilities
```

Reduces navigation cost significantly.

---

# Why These Files Save Tokens

Suppose the repository has:

* 5,000 files
* 600,000 lines of code

Without documentation:

Claude scans dozens or hundreds of files before understanding:

* architecture
* naming
* testing
* dependencies
* business rules

Each scan consumes tokens.

With AI-friendly documentation:

Claude reads:

```
README
CLAUDE
MEMORY
ARCHITECTURE
DOMAIN
```

Perhaps 20 pages total.

Understanding is achieved with a tiny fraction of the context.

Token usage drops substantially.

---

# Cost Savings

Without AI-friendly documentation:

Session 1:

"Understand this repository."

250k tokens

Session 2:

"Add login"

Another 200k tokens rediscovering architecture

Session 3:

"Fix bug"

Another 180k tokens

Total:

630k tokens

---

With AI-friendly documentation:

Session 1:

Read documentation

40k tokens

Session 2:

Implement login

25k tokens

Session 3:

Fix bug

20k tokens

Total:

85k tokens

Savings can exceed 70–90% for many engineering workflows.

---

# Best Practices

Keep documentation concise.

Avoid duplicating code.

Update CLAUDE.md whenever coding conventions change.

Update MEMORY.md whenever architecture changes.

Keep architecture diagrams current.

Document business rules.

Document naming conventions.

Document testing strategy.

Document deployment strategy.

Document security expectations.

---

# Recommended Repository Layout

```
/

README.md

CLAUDE.md

MEMORY.md

ARCHITECTURE.md

PROJECT_STRUCTURE.md

DOMAIN_KNOWLEDGE.md

API_GUIDELINES.md

DATABASE.md

SECURITY.md

TESTING.md

DEPLOYMENT.md

DECISIONS.md

CONTRIBUTING.md

src/

tests/

docs/
```

---

# Final Thought

The future of software engineering is increasingly AI-assisted. Repositories should be optimized not only for human developers but also for AI agents.

Well-structured AI context files reduce token consumption, improve architectural consistency, lower hallucination rates, speed onboarding, and enable AI coding assistants to spend more time generating high-quality code instead of rediscovering project knowledge.

A useful principle is:

> "Document once. Save tokens forever."
