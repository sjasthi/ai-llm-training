# Getting Started with GitHub Copilot CLI
### Your Terminal-Native AI Coding Agent

---

## 📋 Table of Contents

1. [What Is GitHub Copilot CLI?](#1-what-is-github-copilot-cli)
2. [Installation — Step by Step](#2-installation--step-by-step)
3. [Launching Copilot CLI](#3-launching-copilot-cli)
4. [The Three Modes](#4-the-three-modes)
5. [Slash Commands — Complete Reference](#5-slash-commands--complete-reference)
   - [Session Management](#51-session-management)
   - [Context & Directory Scope](#52-context--directory-scope)
   - [Model & Configuration](#53-model--configuration)
   - [Agents & Workflows](#54-agents--workflows)
   - [MCP Server Management](#55-mcp-server-management)
   - [Collaboration & Sharing](#56-collaboration--sharing)
   - [Account & Auth](#57-account--auth)
   - [Experimental & Info](#58-experimental--info)
6. [Running Shell Commands Directly](#6-running-shell-commands-directly)
7. [Flags & CLI Options](#7-flags--cli-options)
8. [Configuration Files](#8-configuration-files)
9. [Practical Workflows — End to End](#9-practical-workflows--end-to-end)
10. [Tips & Best Practices](#10-tips--best-practices)

---

## 1. What Is GitHub Copilot CLI?

GitHub Copilot CLI is a **terminal-native, fully agentic AI coding assistant** that brings the full power of GitHub Copilot directly into your command line. It is:

- **Editor-agnostic** — works in CMD, PowerShell, bash, zsh, WSL2, regardless of which IDE you use
- **Agentic** — plans tasks, edits files, runs commands, and iterates autonomously
- **GitHub-native** — ships with GitHub's MCP server built in, so it can work with issues, PRs, and branches out of the box
- **Multi-model** — supports Claude Sonnet 4.5 (default), GPT-5, Gemini, and more

> ⚠️ **Important:** The old `gh copilot suggest` / `gh copilot explain` extension was **retired on October 25, 2025**. This guide covers the **new GitHub Copilot CLI** — a completely different, far more powerful tool.

---

## 2. Installation — Step by Step

### Prerequisites
- An active **GitHub Copilot subscription** (Free, Pro, Business, or Enterprise)
- **GitHub CLI (`gh`)** installed

### Step 1 — Install GitHub CLI

| Platform | Command |
|---|---|
| **Windows** | `winget install --id GitHub.cli` |
| **macOS** | `brew install gh` |
| **Linux (apt)** | `sudo apt install gh` |
| **MSI Installer** | https://cli.github.com/ |

GitHub CLI installs system-wide and adds itself to PATH automatically.

**Verify:**
```bash
gh --version
# gh version 2.x.x (2025-xx-xx)
```

### Step 2 — Authenticate with GitHub
```bash
gh auth login
```
Follow the prompts:
1. Select **GitHub.com**
2. Select **HTTPS**
3. Choose **Login with a web browser**
4. Copy the one-time code, open the URL, enter the code, approve access

**Verify authentication:**
```bash
gh auth status
# ✓ Logged in to github.com as <your-username>
```

### Step 3 — Launch Copilot CLI
```bash
gh copilot
```
On **first run**, it automatically prompts to install Copilot CLI. After that, it launches directly into the interactive agent session.

**That's it.** No separate npm install. No curl scripts. `gh copilot` handles everything.

---

## 3. Launching Copilot CLI

### Where Can You Run Copilot CLI?
Once installed, `gh copilot` is available in **any terminal on your machine** — it's on your system PATH:

```
✅ CMD (the black window)        → gh copilot
✅ VS Code Integrated Terminal   → gh copilot
✅ PowerShell                    → gh copilot
✅ Windows Terminal              → gh copilot
✅ Git Bash                      → gh copilot
✅ WSL2 (Ubuntu)                 → gh copilot
```

**CMD vs. VS Code Terminal — which should you use?**

| | CMD (black window) | VS Code Integrated Terminal |
|---|---|---|
| **Works?** | ✅ Yes | ✅ Yes |
| **Side by side with code** | ❌ Separate window | ✅ Same window as your editor |
| **See file changes instantly** | ❌ Have to open files manually | ✅ Files update in editor in real time |
| **Copy results to code** | Manual | ✅ Much easier |
| **`/IDE` command** | Opens VS Code separately | ✅ Already in VS Code |
| **Best for** | Quick one-off tasks | Day-to-day development |

> 🎯 **Recommendation:** Use the **VS Code integrated terminal** for day-to-day work. Run `gh copilot` there and watch file changes appear live in the editor above as Copilot works. The typical power workflow:
> ```
> VS Code Terminal → gh copilot → /plan → review in editor → Autopilot → watch changes live
> ```

---

### Basic Launch
```bash
# Navigate to your project first
cd /path/to/your/project

# Launch interactive session
gh copilot
```

### Launch with a Prompt Directly
```bash
gh copilot "add input validation to all API endpoints"
gh copilot -p "explain the authentication flow in this codebase"
```

### Launch with a Specific Mode
```bash
gh copilot          # starts in Ask mode (default)
# Then press Shift+Tab to cycle: Ask → Plan → Autopilot
```

### Launch with a Specific Model
```bash
gh copilot --model gpt-5
gh copilot --model claude-sonnet-4-5   # default
```

### Launch in Autopilot (Unattended) Mode
```bash
gh copilot --allow-all -p "refactor all API endpoints to use async/await"
# --allow-all skips permission prompts — use with caution
```

### What You See on First Launch
```
   ██████╗ ██████╗ ██████╗ ██╗██╗      ██████╗ ████████╗
  ██╔════╝██╔═══██╗██╔══██╗██║██║     ██╔═══██╗╚══██╔══╝
  ██║     ██║   ██║██████╔╝██║██║     ██║   ██║   ██║
  ...

> (Ask mode) Type your prompt or / for commands
```

The `>` prompt indicates you're in the interactive agent session.

---

## 4. The Three Modes

Press **`Shift+Tab`** to cycle through modes:

```
Ask Mode  →  Plan Mode  →  Autopilot Mode  →  Ask Mode ...
```

| Mode | Indicator | Behavior | Best For |
|---|---|---|---|
| **Ask** | `> (Ask mode)` | Answers questions, explains code — no file changes | Exploration, understanding, Q&A |
| **Plan** | `> (Plan mode)` | Outlines every step before executing — you review and approve | Complex tasks, risky changes, learning |
| **Autopilot** | `> (Autopilot mode)` | Executes autonomously until task complete — no step-by-step approvals | Long tasks, unattended runs, ☕ coffee breaks |

### Mode Examples

**Ask Mode:**
```
> (Ask mode) What does the authentication flow look like in this project?
→ Copilot explains without touching any files
```

**Plan Mode:**
```
> (Plan mode) Add a Redis caching layer to the user profile endpoint
→ Copilot shows:
    Step 1: Add redis dependency to package.json
    Step 2: Create cache config in config/cache.js
    Step 3: Modify GET /api/users/:id to check cache first
    Step 4: Add cache invalidation on PUT /api/users/:id
    Step 5: Run tests and fix failures
    Proceed? [Y/n]
```

**Autopilot Mode:**
```
> (Autopilot mode) Fix issue #142 and open a pull request
→ Copilot reads the issue, finds the code, fixes it, writes a test,
  creates a branch, opens the PR — all without interrupting you
```

---

## 5. Slash Commands — Complete Reference

Type `/` at the prompt to see all available commands with autocomplete. Use `/help` for detailed descriptions.

> 💡 **Slash commands do NOT consume premium request quota** — they are processed locally by the CLI input router, not by the AI model.

---

### 5.1 Session Management

| Command | What It Does |
|---|---|
| `/clear` | Wipes conversation history and resets session context. Use this when switching between projects to prevent context bleed. |
| `/session` | Shows session details: Session ID, start time, duration, files modified, commands executed. |
| `/usage` | Shows session statistics: premium requests used, total prompts, code changes (lines added/removed), API duration. |
| `/resume` | Lists previous sessions and lets you pick up where you left off — context and history restored. |
| `/exit` or `/quit` | Ends the current session and exits Copilot CLI cleanly. |

**Examples:**
```bash
> /clear
# Session context cleared. Starting fresh conversation.

> /usage
# Session Statistics:
# Duration: 45 minutes
# Premium requests used: 12
# Total prompts: 28
# Code changes: 7 files modified

> /resume
# Select a session to resume:
# 1. 2026-03-04 10:30 — "Add Redis caching layer" (45 min)
# 2. 2026-03-03 14:15 — "Fix auth bug issue #142" (1h 20m)
```

---

### 5.2 Context & Directory Scope

| Command | What It Does |
|---|---|
| `/cwd` | Shows or changes the current working directory — the root of what Copilot can access. Always run this first to confirm scope. |
| `/cd <path>` | Switches working directory without restarting the session. |
| `/add-dir <path>` | Grants Copilot access to an additional directory outside the current working directory. |
| `/list-dirs` | Shows all directories Copilot currently has access to. Useful for security audits and compliance. |
| `/reset-allowed-tools` | Removes all previously granted tool permissions and reverts to default restrictions. |

**Examples:**
```bash
> /cwd
# Current working directory: /Users/siva/projects/myapp

> /cd /Users/siva/projects/myapp/backend
# Working directory changed.

> /add-dir /Users/siva/projects/shared-utils
# Added trusted directory: /Users/siva/projects/shared-utils

> /list-dirs
# Trusted directories:
# /Users/siva/projects/myapp (session root)
# /Users/siva/projects/shared-utils (added)
```

> 🔒 **Security tip:** Always confirm `/cwd` before starting a task. Copilot can only read/modify files within trusted directories — keeping sensitive files safe.

---

### 5.3 Model & Configuration

| Command | What It Does |
|---|---|
| `/model` | Opens an interactive model picker. Switch AI models mid-session without restarting. |
| `/theme` | Adjusts terminal display theme (light/dark/system). |
| `/terminal-setup` | Enables multiline input for complex, multi-paragraph prompts. |

**Available Models (as of 2026):**
```bash
> /model
# Select a model:
# ● Claude Sonnet 4.5 (default — balanced speed and quality)
#   Claude Opus 4.5   (best quality, higher cost)
#   GPT-5             (OpenAI flagship)
#   GPT-5 mini        (fast, free on paid plans)
#   GPT-4.1           (free on paid plans)
#   Gemini 3 Pro      (Google)
```

> 💡 **GPT-5 mini and GPT-4.1 are included in paid plans and do NOT consume premium request quota.** Use them for simple tasks and save premium requests for complex ones.

**Model switching strategy:**
```
Simple Q&A, explanations     → GPT-5 mini or GPT-4.1 (free)
Standard coding tasks        → Claude Sonnet 4.5 (default)
Complex architecture/refactor → Claude Opus 4.5 or GPT-5
```

---

### 5.4 Agents & Workflows

| Command | What It Does |
|---|---|
| `/plan` | Switches to Plan mode and immediately prompts for a task to plan. Equivalent to pressing Shift+Tab to Plan mode. |
| `/fleet` | Runs the same task across multiple AI models in parallel using subagents, then presents all results for you to choose from. |
| `/agent` | Lists available custom agents or invokes a specific agent. |
| `/delegate <prompt>` | Creates an AI-generated pull request on GitHub directly from the terminal without context switching. |
| `/IDE` | Opens the current work in VS Code to refine code in the editor while keeping the CLI session active. |

**Examples:**
```bash
> /plan add pagination to all list endpoints
# Copilot outlines the plan step by step for your review

> /fleet refactor the user service to use dependency injection
# Runs on Claude Sonnet 4.5 + GPT-5 simultaneously
# Presents both approaches side by side
# You choose which plan to execute

> /delegate "Fix the null pointer bug in the payment service"
# Copilot creates a PR on GitHub with:
# - Branch name generated from description
# - Commit message summarizing the fix
# - PR description explaining the change

> /IDE
# Opens the current working directory in VS Code
```

---

### 5.5 MCP Server Management

| Command | What It Does |
|---|---|
| `/mcp show` | Lists all configured MCP servers and their status (enabled/disabled). |
| `/mcp add` | Interactively adds a new MCP server configuration. |
| `/mcp edit` | Edits an existing MCP server configuration. |
| `/mcp delete` | Removes an MCP server configuration. |
| `/mcp enable` | Enables a previously disabled MCP server. |
| `/mcp disable` | Temporarily disables an MCP server without deleting it. |

**Examples:**
```bash
> /mcp show
# Configured MCP Servers:
# ✅ github (built-in) — repos, issues, PRs, branches
# ✅ postgres — connected to localhost:5432/mydb
# ❌ figma — disabled

> /mcp add
# Server name: postgres
# Command: npx
# Args: -y @modelcontextprotocol/server-postgres
# Env: POSTGRES_CONNECTION_STRING=postgresql://...
```

> 💡 **GitHub MCP is pre-configured by default** — you get repo, issue, and PR access with zero setup from day one. MCP config is stored in `~/.copilot/mcp-config.json`.

---

### 5.6 Collaboration & Sharing

| Command | What It Does |
|---|---|
| `/share markdown` | Exports the current session as a `.md` file to your desktop. |
| `/share gist` | Exports the current session as a GitHub Gist (shareable URL). |

**Examples:**
```bash
> /share markdown
# Session exported to: ~/Desktop/copilot-session-2026-03-04.md

> /share gist
# Creating Gist...
# ✅ Gist created: https://gist.github.com/yourusername/abc123
```

**Use cases:**
- Document what Copilot did for a code review or PR description
- Share a debugging session with a teammate asynchronously
- Keep a record of architectural decisions made with Copilot

---

### 5.7 Account & Auth

| Command | What It Does |
|---|---|
| `/login` | Authenticates with GitHub (browser-based OAuth). Prompted automatically on first launch if not logged in. |
| `/user` | Shows current authenticated user and account details. |
| `/user switch` | Switches between multiple GitHub accounts without logging out. Useful for personal vs. enterprise accounts. |

**Examples:**
```bash
> /login
# Opening browser for authentication...
# ✅ Authenticated as siva-jasthi

> /user
# Logged in as: siva-jasthi
# Plan: Copilot Pro
# Organization: MetroState (via org license)

> /user switch
# Select account:
# ● siva-jasthi (personal)
#   siva@siemens (enterprise)
```

---

### 5.8 Experimental & Info

| Command | What It Does |
|---|---|
| `/help` | Shows all available slash commands with descriptions. The most useful command when you're lost. |
| `/changelog` | Shows what's new in the current version of Copilot CLI. |
| `/experimental show` | Lists experimental/preview features available in your version. |
| `/experimental enable <feature>` | Enables a specific experimental feature. |

**Examples:**
```bash
> /help
# Shows complete list of all slash commands

> /changelog
# v0.x.x — January 2026
# - Added /fleet for parallel multi-model execution
# - Auto-compaction at 95% token limit
# - /share gist support added
# - GPT-5 mini available (free on paid plans)

> /experimental show
# Available experimental features:
# - multi-agent-parallel (beta)
# - web-fetch (preview)
```

---

## 6. Running Shell Commands Directly

Prefix any command with `!` to run it directly in your shell **without invoking the AI model**. This is instant and does not consume any quota.

```bash
> !git status
# On branch main, nothing to commit

> !mysql -u root -p mydb -e "SHOW TABLES;"
# +------------------+
# | Tables_in_mydb   |
# +------------------+
# | users            |
# | orders           |

> !npm test
# Running test suite...

> !ls -la src/api/
# total 48
# -rw-r--r-- users.php
# -rw-r--r-- orders.php
```

> 💡 Use `!` for quick checks and verifications. Then follow up with a natural language prompt to have Copilot act on what it sees.

---

## 7. Flags & CLI Options

These are passed when launching `gh copilot` from your terminal (not inside the session).

| Flag | What It Does |
|---|---|
| `-p "<prompt>"` | Pass a prompt directly without entering interactive mode. Great for scripting. |
| `--model <name>` | Start with a specific AI model. |
| `--allow-all` or `--yolo` | Auto-approve all tool calls — no permission prompts. |
| `--allow-tool <pattern>` | Whitelist specific tools. e.g. `--allow-tool 'shell(git:*)'` |
| `--deny-tool <pattern>` | Blacklist specific tools. e.g. `--deny-tool 'shell(git push)'` |
| `--resume` | Select a previous session to resume. |
| `--agent <name>` | Launch with a specific custom agent. |
| `--experimental` | Enable experimental features. |
| `--banner` | Show the animated banner on launch. |

**Tool Permission Pattern Examples:**
```bash
# Allow all git commands except git push
gh copilot --allow-tool 'shell(git:*)' --deny-tool 'shell(git push)'

# Allow a specific MCP server tool only
gh copilot --allow-tool 'MyMCP(create_issue)'

# Allow all tools from a specific MCP server
gh copilot --allow-tool 'MyMCP'

# Full autopilot — no permission prompts at all
gh copilot --allow-all -p "run the full test suite and fix any failures"
```

> 🔒 **Deny rules always override allow rules**, even when `--allow-all` is set. This lets you safely run autopilot while still blocking specific dangerous operations like `git push` to main.

---

## 8. Configuration Files

All Copilot CLI config lives in `~/.copilot/` on your machine:

```
~/.copilot/
  config.json          ← user settings (model preference, theme, etc.)
  mcp-config.json      ← MCP server configurations
  sessions/            ← saved session history (for /resume)
```

**`config.json` example:**
```json
{
  "version": 1,
  "defaultModel": "claude-sonnet-4-5",
  "theme": "dark",
  "hooks": {
    "preToolUse": [
      {
        "type": "command",
        "bash": "echo 'Tool about to run: $TOOL_NAME'",
        "timeoutSec": 5
      }
    ]
  }
}
```

**`mcp-config.json` example:**
```json
{
  "mcpServers": {
    "postgres": {
      "type": "local",
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-postgres"],
      "env": {
        "POSTGRES_CONNECTION_STRING": "postgresql://user:pass@localhost/mydb"
      }
    }
  }
}
```

### Project-Level Instructions — `AGENTS.md`
Place `AGENTS.md` in your repo root to give Copilot CLI persistent project context — the CLI equivalent of `.github/copilot-instructions.md` in VS Code:

```markdown
# AGENTS.md

## Stack
- PHP 8.2, MySQL 8, Bootstrap 5, jQuery

## Rules
- Always use prepared statements for DB queries
- Follow REST conventions for all API endpoints
- Run `php artisan test` after every change

## Architecture
- Routes → Controllers → Services → Models
- Never query DB from controllers directly
```

---

## 9. Practical Workflows — End to End

### Workflow 1: First Time on a New Codebase
```bash
cd /path/to/project
gh copilot

> /cwd                          # confirm you're in the right folder
> (Ask) Give me a high-level architecture overview of this project
> (Ask) Where is authentication handled?
> (Ask) How do I add a new API endpoint in this project?
> /clear                        # clean up before starting work
> (Plan) Add a GET /api/products endpoint following existing patterns
```

### Workflow 2: Fix a GitHub Issue Autonomously
```bash
gh copilot

> /user                         # confirm you're on the right account
> (Autopilot) Get issue #42 from GitHub, fix the bug, write a 
  regression test, and open a pull request on a new branch
```

### Workflow 3: Explore Without Polluting Context
```bash
gh copilot

> /agent explore                # use the lightweight Explore agent
> What are the most complex functions in this codebase?
> Which files have the most dependencies?
# Explore agent answers without cluttering your main session context
```

### Workflow 4: Safe Multi-Step Refactor
```bash
gh copilot

> /plan refactor all database queries to use the repository pattern
# Review the plan step by step
# Approve
# Switch to Autopilot: Shift+Tab
> Run the approved plan
> !git diff                     # verify changes with !
> /delegate "Refactor: Add repository pattern to DB layer"  # create PR
```

### Workflow 5: Compare Approaches with /fleet
```bash
gh copilot

> /fleet
> Design the caching strategy for the user profile API — 
  compare Redis vs in-memory approaches

# Copilot runs both models in parallel
# Presents Claude's approach vs GPT-5's approach side by side
# You pick the one that fits your constraints
```

### Workflow 6: Share a Session for Code Review
```bash
gh copilot

> (completed a debugging session)
> /share gist
# ✅ Gist: https://gist.github.com/siva/abc123
# Paste the link in your PR for reviewers to see exactly what Copilot did
```

---

## 10. Tips & Best Practices

### ✅ Starting a Session
```
1. cd into your project root first
2. Run /cwd to confirm the right directory
3. Use Ask mode to explore before making changes
4. Switch to Plan mode for complex tasks
5. Only use Autopilot when you've reviewed the plan
```

### ☕ The "Go Get Coffee" Checklist
Before running Autopilot unattended:
```
✅ git commit your current state (clean branch to revert to)
✅ Run /plan first and review the steps
✅ You're on a feature branch, not main
✅ No production credentials accessible in scope
✅ Use --allow-tool / --deny-tool to block risky operations
```

### 💡 Model Selection Strategy
```
Free quota models (GPT-5 mini, GPT-4.1):
  → Simple questions, quick explanations, small edits

Premium request models (Claude Sonnet 4.5, GPT-5):
  → Complex refactors, architectural decisions, multi-file changes
```

### 🔍 Context Management
```
/clear between projects          → prevents context bleed
/usage periodically              → track your premium request usage
/resume for long-running tasks   → pick up where you left off
Auto-compaction at 95%           → Copilot handles this automatically
```

### 🔒 Security Best Practices
```
/list-dirs                       → audit what Copilot can access
/add-dir only when needed        → don't grant broad access upfront
--deny-tool 'shell(rm:*)'        → block destructive shell commands
/reset-allowed-tools             → revoke permissions after a session
```

---

## Quick Reference Card

```
LAUNCH
  gh copilot                   Start interactive session
  gh copilot -p "..."          Start with a prompt
  gh copilot --allow-all -p    Autopilot, no permission prompts

MODES (Shift+Tab to cycle)
  Ask          → Q&A, no changes
  Plan         → Review steps before executing
  Autopilot    → Runs unattended until done

MUST-KNOW SLASH COMMANDS
  /help          See all commands
  /clear         Reset session context
  /cwd           Check/change working directory
  /model         Switch AI model
  /plan          Generate a task plan
  /fleet         Run multiple models in parallel
  /delegate      Create a PR from terminal
  /session       Session details
  /usage         Track premium requests used
  /resume        Restore a previous session
  /share gist    Export session as shareable Gist
  /mcp show      List MCP server connections
  /user switch   Switch GitHub accounts

SHELL COMMANDS (no AI, no quota)
  !git status    Run shell command directly
  !npm test
  !mysql -e "..."

CONFIG FILES
  ~/.copilot/config.json       User settings
  ~/.copilot/mcp-config.json   MCP servers
  AGENTS.md (repo root)        Project instructions
```

---

*Reference: GitHub Copilot CLI — Public Preview (2025–2026)*
*Docs: https://docs.github.com/en/copilot/how-tos/copilot-cli*
*Slash commands cheat sheet: https://github.blog/ai-and-ml/github-copilot/a-cheat-sheet-to-slash-commands-in-github-copilot-cli/*


# GitHub Copilot CLI Guide (Supplement)

## A. How GitHub Copilot CLI Works Internally

```text
User Prompt
      │
      ▼
GitHub Copilot CLI
      │
      ├── Reads current directory
      ├── Reads AGENTS.md
      ├── Reads git status
      ├── Reads files
      ├── Invokes MCP servers
      ├── Invokes shell tools
      ▼
Foundation Model
(Claude/GPT/Gemini)
      │
      ▼
Plans → Tool Calls → Edits → Verification
```

The CLI acts as an orchestration layer that gathers context, invokes AI models, calls tools, validates results, and iterates until completion.

---

## B. Copilot CLI vs VS Code Copilot

| VS Code Copilot | GitHub Copilot CLI |
|-----------------|--------------------|
| IDE-centric | Terminal-centric |
| Editor context | Filesystem context |
| Mostly file editing | Whole repository workflows |
| Editor tools | Shell + MCP tools |
| Interactive editing | Agentic automation |

Copilot CLI also works over SSH, inside containers, WSL, remote Linux machines, and CI environments.

---

## C. Understanding Tool Calling

```text
User Prompt
      │
      ▼
Planner
      │
      ▼
Tool Calls
(Read Files / GitHub / Shell / MCP)
      │
      ▼
Model Reasons Again
      │
      ▼
More Tool Calls
      │
      ▼
Final Answer or Code Changes
```

Modern coding agents repeatedly invoke external tools instead of relying solely on model memory.

---

## D. Prompt Engineering for Copilot CLI

Poor:

```
Fix this
```

Better:

```
Fix authentication bugs.
```

Excellent:

```
Find all authentication middleware,
identify race conditions,
add tests,
preserve backward compatibility,
update documentation.
```

Include constraints, acceptance criteria, output format, and testing expectations whenever possible.

---

## E. AGENTS.md Best Practices

A high-quality AGENTS.md should document:

- Technology stack
- Coding conventions
- Folder organization
- Build commands
- Test commands
- Security rules
- Naming conventions
- Architecture
- Things the AI should never do

Example rules:

```
Never use SELECT *
Always use prepared statements
Run tests before completion
Prefer Bootstrap 5
Never edit generated files
```

---

## F. Understanding MCP

```text
LLM
 │
 ├── Filesystem
 ├── GitHub MCP
 ├── Database MCP
 ├── Jira MCP
 ├── Slack MCP
 └── Figma MCP
```

Model Context Protocol (MCP) provides a standard mechanism for AI agents to communicate with external systems through structured tools.

---

## G. Internal Agent Lifecycle

```text
User Prompt
      ↓
Gather Context
      ↓
Read AGENTS.md
      ↓
Build Prompt
      ↓
Model Planning
      ↓
Tool Calls
      ↓
Validation
      ↓
More Reasoning
      ↓
Completion
```

Agentic systems repeatedly alternate between reasoning and acting.

---

## Version Note

GitHub Copilot CLI evolves rapidly. Commands, models, preview features, and subscription capabilities may change over time. Always verify features against the latest official documentation before relying on them in production workflows.

