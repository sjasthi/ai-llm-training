# AI Prompting Strategy for Large-Scale Software Development

## Executive Summary

To effectively leverage AI coding assistants (e.g., GitHub Copilot, Claude Code, ChatGPT, Gemini), organizations must adopt a structured, architecture-first, iterative development approach.

Recommendation:
Do NOT generate entire applications in a single prompt.
Instead:
- Design the system architecture upfront
- Store architecture and requirements as version-controlled documentation
- Implement the system incrementally using cohesive, module-based prompts
- Reuse documentation instead of repeating context
- Generate only incremental changes
- Continuously test, validate, and commit

This approach reduces token consumption, improves code quality, and enhances maintainability.

## Core Principles

- Architecture First
- Iterative Development
- Cohesion Over Prompt Size
- Minimize Context Repetition
- Incremental Code Generation
- Documentation as Source of Truth
- Stateless Prompting Discipline

## Approach Comparison

### Monolithic Prompt

Advantages:
- Quick start
- Suitable for prototypes

Limitations:
- High token usage
- Difficult debugging
- Poor maintainability

### Iterative Development (Recommended)

Phases:
1. Architecture
2. Database
3. Authentication
4. Core modules
5. Reports
6. Deployment

Advantages:
- Better quality
- Easier debugging
- Lower cost

## Cohesion-Based Prompting

Group related features such as authentication, CRUD operations, or reporting into a single prompt to improve consistency and reuse.

Avoid mixing unrelated tasks in one prompt.

## Repository Documentation

Maintain structured documentation in /docs:
- requirements.md
- architecture.md
- database.md
- api.md
- security.md
- coding-standards.md
- deployment.md
- testing.md

## Prompt Pattern

Example:
Read architecture.md
Implement Authentication module
Generate only modified files

## Token Optimization

- Avoid repetition
- Use diffs
- Group related tasks

## Workflow

Requirements → Architecture → Database → Modules → Testing → Deployment

## Final Recommendation

Adopt iterative, architecture-driven prompting with cohesive modules and strong documentation practices.
