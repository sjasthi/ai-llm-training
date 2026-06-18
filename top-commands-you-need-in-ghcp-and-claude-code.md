# Claude Code & GitHub Copilot: Top Commands and Skill Integration Guide

This guide introduces the **top commands used in Claude Code and GitHub Copilot (GHCP)**, along with a comparison and guidance on how missing capabilities can be enabled using **skills and prompts**.

---

# 1. Top Claude Code Commands

Claude Code exposes command-style interactions (CLI or chat-driven) that map to built-in capabilities.

## Common Claude Commands

- /read-file → Read file contents
- /write-file → Create or update files
- /search → Search codebase
- /grep → Regex-based search
- /run → Execute command (build/test)
- /plan → Generate structured plan
- /review → Review code changes
- /commit → Create commit with message
- /diff → Show file differences
- /fix → Suggest fixes
- /explain → Explain code
- /test → Generate test cases
- /debug → Debug issue
- /refactor → Refactor code
- /docs → Generate documentation
- /analyze → Analyze architecture or repo
- /task → Break into tasks
- /research → Perform research task
- /memory → Store/retrieve context
- /agent → Spawn sub-agent
- /cron → Schedule tasks
- /logs → Analyze logs
- /deploy → Assist deployment
- /security → Security review
- /optimize → Performance optimization

👉 These commands represent **direct executable actions** mapped to model capabilities.

---

# 2. Top GitHub Copilot (GHCP) Commands / Patterns

Unlike Claude Code, GHCP is **prompt-driven inside IDE (VS Code)**.

## Common GHCP Patterns (Prompt Commands)

- "Explain this code"
- "Generate unit tests"
- "Fix this bug"
- "Refactor this function"
- "Optimize this code"
- "Generate API documentation"
- "Create React component"
- "Generate SQL query"
- "Write CI/CD pipeline"
- "Convert code to <language>"
- "Add logging and error handling"
- "Summarize this file"
- "Find performance issues"
- "Improve readability"
- "Generate design for feature"
- "Add validation"
- "Create test cases for edge cases"
- "Explain architecture"
- "Generate Terraform config"
- "Generate Kubernetes YAML"
- "Implement feature from spec"
- "Review this PR"
- "Add security checks"
- "Generate migration script"
- "Generate README"

👉 These are **prompt templates rather than formal commands**.

---

# 3. Claude Code vs GHCP Command Comparison

| Capability | Claude Code | GHCP | Notes |
|-----------|------------|------|------|
| File read/write | ✅ | ⚠️ | GHCP relies on editor context |
| Code search | ✅ | ⚠️ | GHCP limited vs Claude deep search |
| Command execution | ✅ | ❌ | Requires extensions/tools in GHCP |
| Planning | ✅ | ✅ | GHCP prompt-based |
| Code review | ✅ | ✅ | Both support |
| Multi-step tasks | ✅ | ⚠️ | Claude stronger agent workflows |
| Sub-agents | ✅ | ❌ | Not native in GHCP |
| Scheduling | ✅ | ❌ | Needs external tools in GHCP |
| Memory | ✅ | ❌ | GHCP stateless by default |
| Debugging | ✅ | ✅ | Both good |
| Deployment support | ✅ | ⚠️ | GHCP via prompts/plugins |
| Logs analysis | ✅ | ⚠️ | Requires manual context in GHCP |

👉 Summary:
- Claude Code = **command-driven, agentic system**
- GHCP = **prompt-driven assistant**

---

# 4. When a Command is Missing

If a capability is missing in your environment:

## Option 1: Use Skills

A **skill can emulate a command**.

Example:
- Missing: `/review-security`
- Create skill: `security-review`

Skill defines:
- Inputs
- Step-by-step behavior
- Output format

👉 Skill acts as a **custom command layer**

---

## Option 2: Use Scripts + Skills

Combine:
- Skill (intent)
- Script (execution)

Example:
- Skill calls:
  - static analyzer
  - dependency scanner

---

## Option 3: Use IDE Integrations

GHCP can be extended via:
- Extensions
- Tasks
- CLI tools

---

# 5. Prompts to Invoke Skills

Skills can be invoked through **structured prompts**.

## 5.1 Command-style prompt

```
/skill-name input=value
```

Example:
```
/security-review file=auth.js
```

---

## 5.2 Natural language invocation

```
Use the security-review skill on this file
```

---

## 5.3 System-driven activation

Prompt template:

```
You are executing the <skill-name> skill.
Follow the defined steps strictly.
Inputs: <parameters>
Begin task.
```

---

## 5.4 Prompt + Skill binding

Define in `.prompt.md`:

- Command alias
- Arguments
- Rules

---

# 6. Design Pattern: Commands via Skills

👉 Key idea:

**Command = Skill + Prompt Entry Point**

Example:

| Layer | Role |
|------|------|
| Skill | Defines logic |
| Prompt | Entry point |
| Script | Execution (optional) |

---

# 7. Practical Guidance

## For Claude Code
- Use built-in commands first
- Extend with skills for custom workflows

## For GHCP
- Convert repeated prompts into skills
- Use `.prompt.md` to standardize

---

# 8. Final Takeaway

- Claude Code = **command-native system**
- GHCP = **prompt-native system**
- Skills = **bridge between the two**


### One-line summary

👉 “Commands provide execution. Prompts provide intent. Skills provide structure.”

