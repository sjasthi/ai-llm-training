# AI Prompting Best Practices for Large Software Projects

## Monolithic Prompt vs. Iterative Development

When building a software application with an AI coding assistant (GitHub Copilot, Claude Code, ChatGPT, Gemini, Cursor, etc.), one of the biggest decisions is whether to provide **one gigantic prompt** containing the entire project specification or to **develop the system iteratively with small focused prompts**.

This document compares both approaches and recommends best practices for minimizing token consumption while maximizing code quality.

---

# Executive Summary

**Recommendation:**

> Design the entire system once, then build it incrementally.

Do **not** ask the AI to generate the entire application in one enormous prompt.

Instead:

1. Design the architecture.
2. Save the architecture in project documentation.
3. Build one module at a time.
4. Commit working code frequently.
5. Iterate based on testing.

This approach is more maintainable, less expensive, and produces better results.

---

# Option 1: Monolithic Prompt

Example:

```
Build a complete Student Information System.

Features:
- Authentication
- Authorization
- Dashboard
- Student Management
- Teacher Management
- Attendance
- Grades
- Reports
- Notifications
- Email
- Admin
- Settings
- Analytics
- REST API
- Docker
- CI/CD
- Unit Tests
- Production Deployment
```

The AI attempts to generate everything in one session.

## Advantages

* Easy to start.
* Good for prototypes.
* Useful for very small projects.

## Disadvantages

* Extremely high token consumption.
* Large context windows.
* Difficult to debug.
* Regeneration wastes tokens.
* Changes require regenerating large sections.
* AI may become inconsistent across modules.

---

# Option 2: Iterative Development

Instead of generating everything, divide the project into modules.

Example roadmap:

```
Phase 1
--------
Architecture

Phase 2
--------
Database

Phase 3
--------
Authentication

Phase 4
--------
Authorization

Phase 5
--------
Dashboard

Phase 6
--------
Student Module

Phase 7
--------
Teacher Module

Phase 8
--------
Reports

Phase 9
--------
Deployment
```

Each prompt is small and focused.

Example:

```
Implement Student CRUD.

Use the existing architecture.

Generate only changed files.
```

Advantages:

* Lower token usage.
* Easier debugging.
* Better testing.
* Easier code review.
* Easier maintenance.
* Better consistency.

---

# The Best Practice: Architecture First

Spend time designing the application before generating code.

Create a document such as:

```
SYSTEM_DESIGN.md
```

Include:

* Vision
* Goals
* Users
* User Roles
* Features
* Use Cases
* Navigation
* Database Schema
* APIs
* Security
* Authentication
* Authorization
* Folder Structure
* Coding Standards
* Logging
* Deployment
* Testing Strategy
* Error Handling

This becomes the single source of truth.

---

# Repository Documentation

Keep documentation inside the repository.

Example:

```
docs/

requirements.md

architecture.md

database.md

api.md

coding-standards.md

security.md

deployment.md

testing.md

ui-guidelines.md
```

Every AI prompt can reference these documents instead of repeating requirements.

---

# Prompt Pattern

Instead of:

```
Build the complete system.
```

Use:

```
Read architecture.md.

Implement Authentication.

Generate only new or changed files.

Follow existing conventions.

Do not redesign the architecture.
```

Later:

```
Read architecture.md.

Implement Student Module.

Generate only changed files.
```

Then:

```
Implement Teacher Module.
```

Then:

```
Implement Reports.
```

---

# Save Tokens by Avoiding Repetition

Bad:

```
Authentication:
...

Database:
...

Architecture:
...

Coding Standards:
...

Folder Structure:
...

Repeat every prompt...
```

Good:

```
Read project documentation.

Implement Attendance Module.

Generate changed files only.
```

---

# Ask for Diffs Instead of Regeneration

Avoid:

```
Generate the entire project again.
```

Prefer:

```
Modify only these files:

- auth.js
- login.php

Leave everything else unchanged.
```

This significantly reduces token usage.

---

# Keep Prompts Focused

Good:

```
Add pagination to Student List.
```

Good:

```
Add export-to-CSV functionality.
```

Good:

```
Fix validation bug in registration.
```

Avoid:

```
Rewrite the entire application with improvements.
```

---

# Generate Documentation First

Before coding, generate:

* Requirements
* Database Design
* API Specification
* Folder Structure
* UI Navigation
* Deployment Plan
* Testing Plan

Then generate code.

The AI performs much better when design decisions are already documented.

---

# Recommended AI Workflow

```
Requirements
        ↓
Architecture
        ↓
Database
        ↓
Folder Structure
        ↓
Authentication
        ↓
Authorization
        ↓
Core Modules
        ↓
Reports
        ↓
Testing
        ↓
Deployment
        ↓
Optimization
```

Never jump directly from "idea" to "entire application."

---

# Estimated Token Consumption

## Monolithic

```
Requirements      20,000

Generated Code    40,000

Corrections       15,000

Regeneration      20,000

-------------------------

Total             95,000 tokens
```

---

## Iterative

```
Architecture       5,000

Database           2,000

Authentication     2,500

Users              2,000

Dashboard          2,000

Reports            2,000

Deployment         2,000

-------------------------

Total             ~18,000 tokens
```

Savings can exceed **70–80%** for medium and large projects.

---

# Additional Best Practices

## Use Version Control

Commit after every successful feature.

```
git commit -m "Completed Authentication"
```

Never rely on AI conversation history as the only source of truth.

---

## Keep AI Stateless

Treat every prompt as if the AI has forgotten everything.

Reference documentation instead of conversation history.

---

## Generate Small Chunks

Generate:

* One API
* One page
* One class
* One service
* One feature

Avoid generating hundreds of files at once.

---

## Review Before Continuing

Compile.

Run tests.

Fix bugs.

Commit.

Only then move to the next feature.

---

# Final Recommendation

For professional software development:

* ✅ Design the complete system first.
* ✅ Store architecture in Markdown documents.
* ✅ Build incrementally using small prompts.
* ✅ Generate only changed files.
* ✅ Reuse documentation instead of repeating requirements.
* ✅ Commit working code frequently.
* ✅ Test continuously.

This approach minimizes token consumption, improves maintainability, reduces AI hallucinations, and produces significantly higher-quality software than a single monolithic prompt.
