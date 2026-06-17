# Building AI Agent-Friendly Repositories for GitHub Copilot (GHCP)

## Best Practices for GitHub Copilot Agent Mode and AI Coding Assistants

Version 1.0

---

# Executive Summary

GitHub Copilot has evolved from an autocomplete tool into an AI software engineering agent capable of understanding large repositories, planning changes, generating code, writing tests, and assisting with refactoring.

Like all frontier coding agents, Copilot performs dramatically better when the repository contains high-quality contextual documentation.

Unlike Claude Code, GitHub Copilot does not rely on a single `CLAUDE.md` file. Instead, it leverages a combination of:

* Repository documentation
* Workspace instructions
* Prompt files
* Architecture documentation
* Existing code patterns

The goal is identical:

> Reduce rediscovery and maximize productive token usage.

---

# AI-Friendly Repository

```text
/

README.md
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

.github/
    copilot-instructions.md
    prompts/

src/
tests/
docs/
```

---

# README.md

Purpose:

Human-readable project overview.

Contents:

* Installation
* Build
* Run
* Technologies
* High-level architecture

Useful for:

Humans
Claude
GitHub Copilot
Cursor
Gemini CLI
Windsurf

This file should always exist.

---

# copilot-instructions.md

Purpose:

Repository-wide instructions specifically for GitHub Copilot.

Location:

```text
.github/copilot-instructions.md
```

Think of it as:

The closest GitHub Copilot equivalent to `CLAUDE.md`.

Typical contents:

* Coding standards
* Naming conventions
* Testing requirements
* Folder organization
* API conventions
* Framework preferences
* Dependency injection rules
* Code review expectations

Example:

```text
Always use constructor injection.

Never use static services.

Write xUnit tests.

Use nullable reference types.

Use async APIs.

Never modify generated files.
```

GitHub Copilot automatically considers these instructions during agent interactions.

---

# Prompt Files

Location:

```text
.github/prompts/
```

Purpose:

Reusable prompts for common engineering tasks.

Examples:

```text
create-api.prompt.md

fix-unit-tests.prompt.md

generate-documentation.prompt.md

create-migration.prompt.md
```

These help standardize AI behavior across engineering teams.

Example:

```text
Generate a REST API endpoint.

Requirements:
- Use dependency injection
- Add unit tests
- Add OpenAPI annotations
- Return ProblemDetails
```

Prompt files reduce prompt engineering effort.

---

# ARCHITECTURE.md

Describes:

* System layers
* Components
* Microservices
* Event flow
* Data flow
* Dependencies

This file dramatically improves AI architectural reasoning.

---

# PROJECT_STRUCTURE.md

Documents folder organization.

Example:

```text
src/api

REST endpoints

src/domain

Business logic

src/application

Application services

src/infrastructure

Persistence
```

Without this documentation, AI agents spend unnecessary tokens exploring folders.

---

# DOMAIN_KNOWLEDGE.md

Contains business rules.

Example:

```text
Customer != Member

Premium accounts expire after 365 days.

Invoices cannot be deleted.

Orders become immutable after shipping.
```

This prevents AI hallucinations about business logic.

---

# API_GUIDELINES.md

Defines:

* Response format
* Versioning
* Naming
* Error handling
* Pagination
* Authentication

Helps maintain API consistency.

---

# DATABASE.md

Documents:

* Relationships
* Naming conventions
* Migration strategy
* Soft delete policy
* Index strategy

Useful for AI-generated migrations and queries.

---

# SECURITY.md

Contains:

* Authentication
* Authorization
* JWT
* OAuth
* Encryption
* Secret management

Prevents insecure code generation.

---

# TESTING.md

Documents:

* Framework
* Coverage expectations
* Mock strategy
* Naming conventions

Example:

```text
Minimum 80% coverage.

Mock external services.

Never call production APIs.

Prefer Arrange-Act-Assert.
```

---

# DEPLOYMENT.md

Documents:

* CI/CD
* Docker
* Kubernetes
* Helm
* Azure
* AWS
* Release pipeline

Useful for AI-generated deployment changes.

---

# DECISIONS.md (Architecture Decision Records)

Records major decisions.

Example:

```text
2026-02-14

Migrated from RabbitMQ to Kafka.

Reason:

Higher throughput.

Rejected:

Azure Service Bus
```

Prevents AI from proposing abandoned architectures.

---

# CONTRIBUTING.md

Documents:

* Branching
* Pull requests
* Reviews
* Style
* Build verification

Useful for humans and AI alike.

---

# Comparison: Claude Code vs GitHub Copilot

| Repository File                 | Claude Code | GitHub Copilot          |
| ------------------------------- | ----------- | ----------------------- |
| README.md                       | ✓           | ✓                       |
| ARCHITECTURE.md                 | ✓           | ✓                       |
| DOMAIN_KNOWLEDGE.md             | ✓           | ✓                       |
| PROJECT_STRUCTURE.md            | ✓           | ✓                       |
| API_GUIDELINES.md               | ✓           | ✓                       |
| DATABASE.md                     | ✓           | ✓                       |
| SECURITY.md                     | ✓           | ✓                       |
| TESTING.md                      | ✓           | ✓                       |
| DEPLOYMENT.md                   | ✓           | ✓                       |
| CONTRIBUTING.md                 | ✓           | ✓                       |
| DECISIONS.md                    | ✓           | ✓                       |
| CLAUDE.md                       | ✓ Native    | Optional reference only |
| MEMORY.md                       | ✓ Supported | Not a native concept    |
| .github/copilot-instructions.md | Not used    | ✓ Native                |
| .github/prompts/                | Optional    | ✓ Native                |

---

# Which Files Are Common?

The following files are beneficial regardless of the AI coding assistant:

* README.md
* ARCHITECTURE.md
* DOMAIN_KNOWLEDGE.md
* PROJECT_STRUCTURE.md
* API_GUIDELINES.md
* DATABASE.md
* SECURITY.md
* TESTING.md
* DEPLOYMENT.md
* CONTRIBUTING.md
* DECISIONS.md

These should be considered AI-agnostic repository documentation.

---

# Claude-Specific Files

* CLAUDE.md
* MEMORY.md

These provide Claude Code with persistent project instructions and learned project knowledge.

---

# GitHub Copilot-Specific Files

* .github/copilot-instructions.md
* .github/prompts/*.prompt.md

These influence Copilot Agent Mode and provide reusable engineering prompts for teams.

---

# Cost Savings

Repositories with good AI documentation require dramatically less rediscovery.

Instead of repeatedly scanning thousands of files, the AI reads a small set of documentation files and begins productive work immediately.

Benefits include:

* Lower token consumption
* Lower GitHub Copilot Premium Request usage
* Faster responses
* Better architectural consistency
* Fewer hallucinations
* Better onboarding for developers
* More deterministic AI behavior

For large enterprise repositories, documentation-first repositories can reduce AI context consumption by 70–90% across repeated engineering tasks.

---

# Recommended Repository Layout

```text
/

README.md

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

.github/

    copilot-instructions.md

    prompts/

src/

tests/

docs/
```

---

# Final Recommendation

For organizations using multiple AI coding assistants (Claude Code, GitHub Copilot, Cursor, Gemini CLI, Windsurf, etc.), maintain a common set of AI-agnostic documentation files and add agent-specific instruction files only where supported.

A well-documented repository becomes an "AI-native repository" that minimizes token consumption, accelerates development, improves code quality, and enables AI agents to spend their context budget generating business value instead of rediscovering repository knowledge.
