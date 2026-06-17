# System Prompts, User Prompts, Instructions & Skills
### A Field Guide for Engineers Moving into AI-Assisted Development

---

> **The mental model shift:** In traditional development, you configure software through config files, environment variables, and code. In AI-assisted development, you configure *behavior* through language. These four constructs — system prompts, user prompts, instructions, and skills — are your new config layer.

---

## The 30-Second Summary

| Construct | Scope | Set by | Analogy |
|---|---|---|---|
| **System Prompt** | Entire session / application | Developer / Platform | `app.config` or environment variables |
| **User Prompt** | Single request | End user | A function call with arguments |
| **Instructions** | Specific task or context | Developer or user | A function's docstring + parameter constraints |
| **Skills** | Reusable capability module | Developer / Platform | An importable library or plugin |

---

## 1. System Prompt

### What it is

The **system prompt** is configuration that runs *before* any user interaction. It defines the AI's persona, constraints, knowledge context, and behavioral rules for the entire session. The user typically never sees it.

It's the equivalent of your `application.yml`, your `.env`, your middleware stack — except written in natural language.

### Key characteristics

- Set once per session (or per deployment)
- Invisible to the end user in most implementations
- Highest authority — overrides or constrains everything that comes after
- Persistent across the entire conversation

### Claude example

When Anthropic deploys Claude on claude.ai, a system prompt is active behind the scenes. It establishes Claude's identity, its ethical guardrails, its tone, its knowledge cutoff awareness, and how it should handle edge cases — before you type a single character.

When *you* build an app on top of Claude via the API, you write your own system prompt:

```
You are a senior backend engineer assistant for Acme Corp.
You have access to our internal API documentation.
You only answer questions about our Java Spring Boot codebase.
Never suggest third-party libraries not on our approved list.
Always format code examples using our internal style guide.
```

That system prompt shapes every response Claude gives in your app — regardless of what the user asks.

### GitHub Copilot example

Copilot's system prompt is set by GitHub/Microsoft and baked into the product. It instructs the model to act as a code completion assistant, to prioritize code over prose, to respect the active file's language and style, and to avoid generating license-encumbered code. You don't write or see it — but it's always running.

### The engineering parallel

```
# Traditional config
APP_ENV=production
LOG_LEVEL=warn
MAX_RETRIES=3

# System prompt equivalent
"You are a production-grade assistant. Keep responses concise.
Retry ambiguous requests with clarifying questions, up to 3 times."
```

---

## 2. User Prompt

### What it is

The **user prompt** is the runtime input — what the user actually types or sends to the AI in the moment. It's ephemeral, per-request, and drives the immediate output.

If the system prompt is your app config, the user prompt is a **function invocation** — passing arguments to a function that's already been configured.

### Key characteristics

- Happens at runtime, per request
- Written by the end user (or programmatically generated)
- Operates *within* the constraints set by the system prompt
- Has the least authority in the hierarchy

### Claude example

You open claude.ai and type:

```
Explain the difference between an inner join and a left join,
with a SQL example using a users and orders table.
```

That's a user prompt. Claude's underlying system prompt has already established its persona and rules. Your message is the specific task you're delegating within that context.

In an API integration, user prompts can also be **programmatically constructed** — your application builds the prompt string at runtime based on user input, selected files, application state, etc.

```javascript
const userPrompt = `
  Review this pull request diff and identify any potential
  null pointer exceptions:

  ${prDiff}
`;
```

### GitHub Copilot example

In Copilot Chat, when you write:

```
/explain why this function might be causing a memory leak
```

...that's a user prompt. Copilot's system-level config already knows you're in VS Code, what language you're using, and what the selected code block is. Your message is the specific question layered on top.

In inline Copilot (autocomplete), the "user prompt" is implicit — it's the code you've written so far, your cursor position, and the surrounding file context. You didn't type a sentence; your *code* is the prompt.

### The engineering parallel

```python
# Traditional function call
result = query_database(
    table="users",
    filter="active=true",
    limit=50
)

# User prompt equivalent
"Show me all active users, limit to 50 results."
```

---

## 3. Instructions

### What it is

**Instructions** are explicit, targeted directives that shape how the AI should behave for a *specific task or context* — more granular than a system prompt, more persistent than a one-off user prompt.

Instructions sit in the middle of the hierarchy. They say: "for *this* type of task, follow *these* rules." They can live inside a system prompt, be injected at the start of a conversation, or accompany a specific user message.

Think of them as **function-level documentation combined with input validation rules**.

### Key characteristics

- More specific and scoped than a system prompt
- Can be reinjected or referenced mid-conversation
- Often written by developers, but sometimes by power users
- Declarative — they describe *what* to do, not *how* the model works

### Claude example

You're building a Claude-powered code review tool. Inside your system prompt, you embed task-specific instructions for the code review function:

```
## Code Review Instructions
When reviewing code, always:
1. Check for security vulnerabilities first (SQL injection, XSS, auth issues)
2. Flag any deviation from SOLID principles
3. Suggest a refactor only if it reduces cyclomatic complexity by 20% or more
4. Output findings as JSON with keys: severity, location, description, suggestion
5. Do not comment on style unless ESLint rules are violated
```

These aren't general persona rules (system prompt) — they're a precise specification for one task. You might have different instructions blocks for "writing tests", "writing docs", "explaining architecture", etc.

### GitHub Copilot example

In Copilot, you can add a `.github/copilot-instructions.md` file to your repository. This file contains repo-specific instructions that Copilot will follow when working in that codebase:

```markdown
# Copilot Instructions

- This project uses TypeScript strict mode. Never use `any`.
- All async functions must handle errors with try/catch.
- Use the internal `Logger` class, not `console.log`.
- Tests use Vitest, not Jest. Do not import from 'jest'.
- API responses must always conform to the `ApiResponse<T>` generic type.
```

Every suggestion Copilot makes in this repo is now filtered through these constraints. That's instructions working at the project scope.

### The engineering parallel

```typescript
/**
 * Processes a payment transaction.
 * @param amount - Must be positive, max $10,000
 * @param currency - ISO 4217 format only (e.g. "USD", "INR")
 * @returns Receipt object — never null
 * @throws PaymentError if gateway is unreachable
 */
function processPayment(amount: number, currency: string): Receipt { ... }

// Instructions equivalent:
"When processing payments: validate amount is positive and under $10,000,
accept only ISO 4217 currency codes, always return a receipt object,
throw a descriptive error if the gateway is unreachable."
```

---

## 4. Skills

### What it is

A **skill** is a reusable, self-contained capability module — a packaged combination of instructions, context, and sometimes tools that can be loaded on demand to give the AI a specific competency.

If instructions are function-level specs, **skills are importable libraries**. You define a skill once, then invoke it across different prompts, sessions, or applications.

### Key characteristics

- Modular and reusable across projects
- Encapsulate domain knowledge + behavioral rules
- Can include examples (few-shot demonstrations), tools, and sub-instructions
- Composable — you can stack multiple skills

### Claude example

Anthropic's own Claude deployment uses a skill system internally. When Claude encounters a task (say, writing a DOCX file or reading a PDF), it loads the relevant SKILL.md — a file containing domain-specific instructions, constraints, library preferences, and known pitfalls for that task.

For example, a `code-review` skill might contain:

```markdown
# Code Review Skill

## Trigger
Use when asked to review, audit, or analyze code.

## Behavior
- Parse code structure before commenting
- Prioritize correctness > security > performance > style
- Group findings by file, then by severity
- Use diff format for suggested changes

## Output format
Return findings as structured JSON.
Never return prose-only feedback.

## Known pitfalls
Do not flag TODO comments as bugs.
Do not suggest framework migrations unless explicitly asked.
```

This skill gets loaded dynamically when needed. It's not always active — it's invoked when the context calls for it.

As a developer building on Claude's API, you can create your own skill library:

```
/skills
  /code-review.md
  /write-tests.md
  /explain-architecture.md
  /api-docs.md
```

Load the right skill into the system prompt dynamically based on what the user is trying to do.

### GitHub Copilot example

GitHub is rolling out **Copilot Extensions** and **Copilot Agents** — these are effectively skills. The `@terminal` agent is a skill that makes Copilot competent in command-line tasks. The `@workspace` agent loads awareness of your entire codebase. `@github` gives it access to PRs, issues, and Actions.

Each agent/extension is a packaged capability module you invoke on demand:

```
@workspace /explain the data flow from the API controller to the database layer
@terminal how do I run only the failing tests in this suite?
@github summarize the open PRs assigned to me this week
```

You're not rewriting the system prompt each time. You're **loading a skill** scoped to a domain.

### The engineering parallel

```python
# Traditional import
from mylib.security import run_security_audit
from mylib.testing import generate_test_cases

# Skills equivalent
load_skill("security-audit")   # Now Claude knows your audit checklist
load_skill("test-generation")  # Now Claude knows your testing conventions
```

---

## How They Work Together

Here's a complete picture of how all four interact in a real AI-assisted development workflow:

```
┌─────────────────────────────────────────────────────────┐
│                    SYSTEM PROMPT                        │
│  "You are a senior engineer assistant for Acme Corp.    │
│   Always use our internal style guide. Be concise."     │
│                                                         │
│  ┌───────────────────────────────────────────────────┐  │
│  │                   SKILL (loaded)                  │  │
│  │  code-review.md — rules, format, output schema   │  │
│  │                                                   │  │
│  │  ┌─────────────────────────────────────────────┐ │  │
│  │  │              INSTRUCTIONS                   │ │  │
│  │  │  "Check for null safety first.              │ │  │
│  │  │   Output JSON. Flag severity 1-3."          │ │  │
│  │  │                                             │ │  │
│  │  │  ┌───────────────────────────────────────┐ │ │  │
│  │  │  │           USER PROMPT                 │ │ │  │
│  │  │  │  "Review this PR diff: [diff text]"   │ │ │  │
│  │  │  └───────────────────────────────────────┘ │ │  │
│  │  └─────────────────────────────────────────────┘ │  │
│  └───────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

Each layer narrows and refines the AI's behavior. The system prompt sets the universe. The skill provides domain competency. Instructions specify the task rules. The user prompt triggers the actual work.

---

## Common Mistakes Engineers Make

**Putting everything in the user prompt.**
This is like passing all your config as function arguments on every call. Fragile, verbose, and inconsistent. Move persistent rules up to instructions or the system prompt.

**Writing instructions that are too vague.**
`"Write clean code"` is not an instruction — it's a wish. `"Functions must be under 20 lines. Use early returns. No nested ternaries."` is an instruction.

**Ignoring skills as a design pattern.**
Engineers often rewrite the same instructions in every prompt. Modularize them. Build a skill library. Treat it like you'd treat shared utilities.

**Treating the system prompt as immutable.**
You can and should inject dynamic content into your system prompt at runtime — current date, user role, active project context, feature flags. It's not a static file; it's a template.

---

## Quick Reference

```
SYSTEM PROMPT  →  app.config / .env           →  Session-wide, dev-controlled, invisible to user
USER PROMPT    →  function call / HTTP request →  Per-request, user-driven, drives immediate output
INSTRUCTIONS   →  docstring + validation rules →  Task-scoped, explicit behavioral constraints
SKILLS         →  importable library / plugin  →  Reusable capability module, loaded on demand
```

---

## Further Reading

- [Anthropic Prompt Engineering Guide](https://docs.anthropic.com/en/docs/build-with-claude/prompt-engineering/overview)
- [GitHub Copilot Instructions Docs](https://docs.github.com/en/copilot/customizing-copilot/adding-repository-custom-instructions-for-github-copilot)
- [GitHub Copilot Extensions](https://github.com/features/copilot/extensions)
- [Anthropic System Prompts API Reference](https://docs.anthropic.com/en/api/getting-started)
