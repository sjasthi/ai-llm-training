# GitHub Copilot in VS Code — Training Session
### Leveraging the Full Power of AI-Assisted Development

---

## 📋 Agenda

1. [What is GitHub Copilot?](#1-what-is-github-copilot)
2. [Setup & Configuration](#2-setup--configuration)
3. [VS Code Extensions that Enhance Copilot](#3-vs-code-extensions-that-enhance-copilot)
4. [Understanding Context — How Copilot "Sees" Your Code](#4-understanding-context--how-copilot-sees-your-code)
5. [Inline Completions](#5-inline-completions)
6. [Copilot Chat — Your AI Pair Programmer](#6-copilot-chat--your-ai-pair-programmer)
7. [Agent Mode](#7-agent-mode)
8. [AI Taxonomy in GHCP — Prompts, Instructions, Context & Skills](#8-ai-taxonomy-in-ghcp--prompts-instructions-context--skills)
9. [Prompt Crafting & Best Practices](#9-prompt-crafting--best-practices)
10. [Copilot Instructions — Teaching Copilot Your Rules](#10-copilot-instructions--teaching-copilot-your-rules)
11. [Copilot Prompts — Reusable Task Shortcuts](#11-copilot-prompts--reusable-task-shortcuts)
12. [Copilot Skills — Automating Entire Workflows](#12-copilot-skills--automating-entire-workflows)
13. [Skills Marketplace — Discovering and Installing Community Skills](#13-skills-marketplace--discovering-and-installing-community-skills)
14. [Terminal Access — The Universal Adapter](#14-terminal-access--the-universal-adapter)
15. [GitHub Copilot CLI — Terminal-Native Copilot Agent](#15-github-copilot-cli--terminal-native-copilot-agent)
16. [MCP Servers — Extending Copilot's Reach](#16-mcp-servers--extending-copilots-reach)
17. [Real-World Workflows](#17-real-world-workflows)
18. [Tips, Limitations & Responsible Use](#18-tips-limitations--responsible-use)

---

## 1. What is GitHub Copilot?

GitHub Copilot is an **AI-powered coding assistant** built into VS Code (and other IDEs), developed by GitHub and OpenAI. It uses large language models trained on billions of lines of public code to:

- **Autocomplete** code as you type
- **Chat** about code, bugs, architecture
- **Generate** entire files, tests, and documentation
- **Refactor** and explain existing code
- **Run agentic workflows** across your entire project

### Copilot Tiers
| Plan | Features |
|---|---|
| **Copilot Free** | 2,000 completions/month, 50 chat messages/month |
| **Copilot Pro** | Unlimited completions & chat, agent mode, MCP |
| **Copilot Business/Enterprise** | Team management, org policies, enterprise context |

---

## 2. Setup & Configuration

### Installation
1. Open VS Code → Extensions (`Ctrl+Shift+X`)
2. Search **"GitHub Copilot"** → Install both:
   - `GitHub Copilot` (completions)
   - `GitHub Copilot Chat` (chat & agent)
3. Sign in with your GitHub account when prompted

### Key Settings (`settings.json`)
```json
{
  "github.copilot.enable": {
    "*": true,
    "plaintext": false,
    "markdown": true
  },
  "github.copilot.chat.localeOverride": "en",
  "github.copilot.editor.enableCodeActions": true,
  "chat.editor.fontSize": 14
}
```

### Keyboard Shortcuts
| Action | Shortcut |
|---|---|
| Accept inline suggestion | `Tab` |
| Dismiss suggestion | `Esc` |
| Next/Previous suggestion | `Alt + ]` / `Alt + [` |
| Open Copilot Chat | `Ctrl + Alt + I` |
| Inline chat | `Ctrl + I` |
| Open completions panel | `Ctrl + Enter` |

---

## 3. VS Code Extensions that Enhance Copilot

These extensions are best installed alongside Copilot from the start — they give Copilot richer context and more useful targets to work with.

### Productivity Multipliers
| Extension | ID | Benefit with Copilot |
|---|---|---|
| **GitLens** | `eamodio.gitlens` | Copilot can reference git blame/history as context |
| **Error Lens** | `usernamehw.errorlens` | Inline errors give Copilot better fix targets |
| **REST Client** | `humao.rest-client` | Test APIs and feed responses back to Copilot |
| **Thunder Client** | `rangav.vscode-thunder-client` | API testing within VS Code |
| **Docker** | `ms-azuretools.vscode-docker` | Copilot Agent can manage containers |
| **Prettier** | `esbenp.prettier-vscode` | Auto-format Copilot's output |
| **Python** | `ms-python.python` | Richer Python context for completions |
| **Jupyter** | `ms-toolsai.jupyter` | Copilot in notebooks |

### Enabling Copilot in Jupyter Notebooks
- Install the Jupyter extension
- Open a `.ipynb` file
- Copilot works in **cell completions** and **chat** (`/newNotebook` to scaffold)

---

## 4. Understanding Context — How Copilot "Sees" Your Code

This is the **most important concept** for getting quality output from Copilot.

### What Copilot Uses as Context

```
┌─────────────────────────────────────────────────────────┐
│                  COPILOT CONTEXT WINDOW                  │
│                                                         │
│  📄 Current File        → Always included               │
│  📂 Open Tabs           → Nearby files in editor        │
│  🔍 @workspace          → Indexed project files         │
│  📝 Chat History        → Previous turns in session     │
│  📌 #file / #selection  → Explicitly pinned content     │
│  📖 .github/copilot-instructions.md → Custom rules      │
└─────────────────────────────────────────────────────────┘
```

### Context Variables (use in Chat)
| Variable | What it includes |
|---|---|
| `#file` | A specific file you choose |
| `#selection` | Currently highlighted code |
| `#codebase` | Semantic search across the whole project |
| `#editor` | The entire active editor content |
| `#terminalLastCommand` | Last terminal output |
| `#terminalSelection` | Selected text in the terminal |

### 🔑 Pro Tip: Keep Relevant Files Open
Copilot reads your **open tabs** as implicit context. If you're working on `api.py`, also open `models.py` and `routes.py` so Copilot understands your data structures.

### How Copilot Indexes Your Codebase (`@workspace`)
- Copilot uses **semantic embeddings** to index your entire repo
- It retrieves the most relevant snippets when you use `@workspace`
- Works best with **clean folder structures** and **descriptive file names**
- Respects `.gitignore` — ignored files won't be indexed

---

## 5. Inline Completions

The foundational feature — Copilot suggests code as you type.

### How It Works
- Copilot reads the code **above and below** your cursor
- It infers your **intent from function names, comments, and patterns**
- Suggestions appear in **ghost text** (grayed out)

### Triggering Better Completions

**Use descriptive function names:**
```python
# Weak signal → generic suggestion
def process(data):

# Strong signal → targeted suggestion
def calculate_monthly_revenue_by_region(sales_df: pd.DataFrame) -> dict:
```

**Write a comment first, then let Copilot generate the code:**
```python
# Parse the JWT token, extract the user_id and roles, 
# and raise ValueError if the token is expired
def parse_token(token: str):
    # Copilot will fill this in
```

**Use type hints** — they dramatically improve suggestion quality:
```python
def merge_user_records(
    primary: dict[str, Any], 
    secondary: dict[str, Any],
    conflict_strategy: Literal["primary", "secondary", "merge"]
) -> dict[str, Any]:
```

---

## 6. Copilot Chat — Your AI Pair Programmer

Open with `Ctrl + Alt + I` or the chat icon in the sidebar.

### Chat Participants (@ commands)
| Participant | Purpose |
|---|---|
| `@workspace` | Ask questions about your entire codebase |
| `@vscode` | VS Code settings, commands, extensions |
| `@terminal` | Help with shell commands |
| `@github` | Search GitHub issues, PRs, repos |

### Slash Commands
| Command | Use Case |
|---|---|
| `/explain` | Explain selected code |
| `/fix` | Fix a bug in selection |
| `/tests` | Generate unit tests |
| `/doc` | Generate documentation/comments |
| `/simplify` | Refactor for readability |
| `/new` | Scaffold a new project/file |
| `/newNotebook` | Create a Jupyter Notebook |

### Inline Chat (`Ctrl + I`)
Trigger a chat window **directly in your code editor**. Perfect for:
- "Refactor this function to use async/await"
- "Add error handling here"
- "Convert this loop to a list comprehension"

### Example Chat Prompts
```
@workspace What does the authentication flow look like in this project?

@workspace Find all places where we're making direct SQL queries instead of using the ORM

/explain #selection

Generate a REST API endpoint for creating a user using the same pattern as #file:routes/products.py

@workspace I'm getting a KeyError on line 42 of app.py — what might be causing it?
```

---

## 7. Agent Mode

> 🚀 **Agent Mode is where Copilot goes from assistant to autonomous developer.**

### What Is Agent Mode?
Agent Mode allows Copilot to:
- **Plan** a multi-step task
- **Read and write files** across your project
- **Run terminal commands**
- **Iterate** based on errors until the task is complete
- **Ask for clarification** when needed

### Enabling Agent Mode
1. Open Copilot Chat
2. Click the dropdown next to the **Ask/Edit** toggle → Select **Agent**
3. Or use the mode picker at the top of the chat panel

### What Agents Can Do
```
You: "Add a Redis caching layer to the existing user profile API endpoint"

Copilot Agent will:
  ✅ Read your existing API code
  ✅ Identify the user profile endpoint
  ✅ Check your requirements.txt / package.json
  ✅ Add redis dependency
  ✅ Modify the endpoint to check cache first
  ✅ Write cache invalidation logic
  ✅ Update tests
  ✅ Run the tests and fix failures
```

### Agent Mode Tools
Copilot Agent has access to built-in tools:
| Tool | Capability |
|---|---|
| `read_file` | Read any file in the workspace |
| `write_file` | Create or modify files |
| `run_command` | Execute terminal commands |
| `search_workspace` | Semantic search across the codebase |
| `list_directory` | Explore folder structure |

### Ask vs. Agent vs. Plan Mode
| Mode | What It Does |
|---|---|
| **Ask** | Answers questions, explains code — no changes made |
| **Agent** | Autonomously plans, explores, edits files, and runs terminal commands |
| **Plan** | Generates a detailed step-by-step plan for a task *before* making any changes — you review and approve the plan, then Agent executes it |

> 💡 **Plan mode** is ideal for large or risky tasks. Use it to sanity-check Copilot's approach before it touches your code. Think of it as "show me your work first."

### ⚠️ Agent Mode Best Practices
- **Be specific** about scope: "Only modify files in `/src/api/`"
- **Checkpoint often**: Review diffs before accepting large changes
- **Use source control**: Always have a clean git state before running agents
- **Set guardrails**: Describe what NOT to change

---

### Managing Agent Mode Permissions — Allow Prompts

#### The Problem
Every time Copilot Agent wants to run a terminal command, read a file, or call a tool, VS Code shows a permission popup asking you to **Allow** or **Deny**. For complex multi-step tasks this means:

```
Copilot: "May I run mysql -e 'SHOW TABLES'?"  → You: Allow
Copilot: "May I read config/database.php?"    → You: Allow
Copilot: "May I write to models/User.php?"    → You: Allow
Copilot: "May I run the test suite?"          → You: Allow
... (repeat 10-20 more times)
```

> ☕ **You cannot give a prompt and go for a coffee.** You're stuck babysitting the terminal pressing Allow repeatedly — unless you configure one of the three options below.

---

#### Option 1: Auto-Approve All Tools for This Workspace
Tells Copilot Agent to proceed with **all tool calls** in this workspace without asking for permission each time.

**How to enable:**
1. Open Copilot Chat in Agent Mode
2. Click the **🔧 Tools** icon at the bottom of the chat input
3. Select **"Auto-approve all tools"** for this workspace

**Or via `settings.json`:**
```json
{
  "github.copilot.chat.agent.autoApprove": true
}
```

**Best for:**
- Your personal dev machine with a project you fully control
- Solo developers who trust their own workflows
- When running long autonomous tasks (refactors, bulk test generation)

**Trade-off:** ⚠️ Copilot can run *any* command without asking — including destructive ones. Always have a clean git state before enabling this.

---

#### Option 2: Auto-Approve Specific Tools Only
The **safest middle ground** — whitelist only the tools you trust, keep everything else gated.

**How to enable:**
1. Open Copilot Chat in Agent Mode
2. Click the **🔧 Tools** icon
3. Toggle individual tools on/off for auto-approval

**Or via `settings.json` — approve only specific tools:**
```json
{
  "github.copilot.chat.agent.approvedTools": [
    "read_file",
    "search_workspace",
    "list_directory",
    "run_command"
  ]
}
```

**Common selective trust configurations:**

| Scenario | Auto-Approve These | Keep Gated |
|---|---|---|
| Read-only exploration | `read_file`, `search_workspace`, `list_directory` | `write_file`, `run_command` |
| DB queries OK, no writes | `read_file`, `run_command` (SELECT only) | `write_file` |
| Full dev trust | All tools | Nothing |
| Code review only | `read_file`, `search_workspace` | Everything else |

**Best for:**
- Team environments where you want Copilot to read freely but ask before writing
- When you're comfortable with reads but cautious about file modifications
- Shared or sensitive codebases

---

#### Option 3: Trust the Workspace
VS Code has a **Workspace Trust** system that controls what extensions (including Copilot) can do automatically in a given folder. Trusting a workspace grants Copilot broader permissions to operate without repeated prompts.

**How to enable:**
1. `Ctrl + Shift + P` → **"Manage Workspace Trust"**
2. Click **"Trust"** for the current workspace folder
3. Or when prompted by VS Code on folder open, select **"Yes, I trust the authors"**

**Or add to your workspace settings (`.vscode/settings.json`):**
```json
{
  "security.workspace.trust.enabled": false
}
```
> ⚠️ Disabling workspace trust globally is not recommended. Trust specific folders instead.

**Best for:**
- Projects you own and have fully vetted
- Local dev environments (not shared/cloud workspaces)
- When you keep hitting trust prompts on a repo you work in daily

---

#### Comparing the Three Options

| Option | Effort | Control | Safety | Best For |
|---|---|---|---|---|
| **Auto-approve all tools** | One toggle | ❌ No gates | ⚠️ Lower | Solo dev, trusted personal project |
| **Auto-approve specific tools** | Configure once | ✅ Granular | ✅ Higher | Team projects, selective trust |
| **Trust the workspace** | One-time per folder | Medium | Medium | Daily-use repos you own |

---

#### ☕ The "Go Get Coffee" Configuration
If you want to truly walk away and let Agent Mode run unattended on a trusted project:

```json
// .vscode/settings.json
{
  "github.copilot.chat.agent.autoApprove": true,
  "security.workspace.trust.enabled": true
}
```

**Prerequisites before walking away:**
```
✅ Clean git commit (so you can revert anything)
✅ You've reviewed the Agent's Plan Mode output first
✅ You're on a branch, not main
✅ No production credentials in scope
```

> 🎯 **Recommended workflow:** Use **Plan Mode** first to review what Copilot intends to do → approve the plan → switch to **Agent Mode** with auto-approve → go get your coffee ☕

> 💡 When you get to Section 14, you'll see that GitHub Copilot CLI's **Autopilot mode** achieves this same unattended behavior out of the box in the terminal — no JSON config needed.

---

## 8. AI Taxonomy in GHCP — Prompts, Instructions, Context & Skills

Understanding the difference between a **prompt**, an **instruction**, a **project context file**, and a **skill** is the single most important mental model for getting consistent, high-quality output from GitHub Copilot. Each layer serves a different purpose and operates at a different scope.

This section maps the full landscape. Sections 10, 11, and 12 then dive into each layer with full examples and practical guidance.

---

### The Six-Layer Hierarchy

```
┌──────────────────────────────────────────────────────────────┐
│              SKILLS  (.github/skills/*/SKILL.md)             │
│         Multi-step workflow playbooks for Agent Mode         │
├──────────────────────────────────────────────────────────────┤
│        PROMPT TEMPLATES  (.github/prompts/*.prompt.md)       │
│            Single-task reusable shortcuts via /name          │
├──────────────────────────────────────────────────────────────┤
│       SCOPED CONTEXT  (.github/instructions/*.md)            │
│          Path-specific rules applied to matching files       │
├──────────────────────────────────────────────────────────────┤
│  PROJECT CONTEXT FILE  (.github/copilot-instructions.md)     │
│       What this project IS — stack, patterns, gotchas        │
├──────────────────────────────────────────────────────────────┤
│            INSTRUCTIONS  (user / org settings)               │
│       Persistent behavioral rules applied across all repos   │
├──────────────────────────────────────────────────────────────┤
│                  PROMPT  (chat input)                        │
│              What you type in this session, right now        │
└──────────────────────────────────────────────────────────────┘
```

Each layer **wraps the one below it** — your prompt is always evaluated through the lens of all layers above it.

---

### Full Map for GHCP in VS Code

#### Tree Format

```
.github/
├── copilot-instructions.md              ← Project Context File
│                                           Always-on, repo-wide, auto-loaded
│
├── instructions/                        ← Scoped Context
│   ├── react.instructions.md               Applied only to *.tsx / *.jsx files
│   ├── api.instructions.md                 Applied only to /src/api/** files
│   └── tests.instructions.md               Applied only to /tests/** files
│
├── prompts/                             ← Prompt Templates (single-task)
│   ├── add-api-endpoint.prompt.md          Invoked with /add-api-endpoint
│   ├── debug-error.prompt.md               Invoked with /debug-error
│   ├── query-db.prompt.md                  Invoked with /query-db
│   └── test-api.prompt.md                  Invoked with /test-api
│
├── skills/                              ← Skills (multi-step workflows)
│   ├── register-app/
│   │   └── SKILL.md                        Invoked with /register-app
│   └── deploy-feature/
│       └── SKILL.md                        Invoked with /deploy-feature
│
├── agents/                              ← Custom Agent Definitions
│   └── reviewer.agent.md                   Specialized agent persona + tools
│
└── chatmodes/                           ← Custom Chat Personalities
    └── planner.chatmode.md                 Restrict tools, set response format
```

#### Tabular Format

| Layer | What It Is | File / Location | Scope | Applied When |
|---|---|---|---|---|
| **Prompt** | One-time chat input | Copilot Chat panel / inline chat | Single interaction only | Only when you type it |
| **Instructions** | Persistent behavioral rules | VS Code user settings or org admin settings | Every interaction, all repos | Always, automatically |
| **Project Context File** | Project knowledge — stack, patterns, conventions, gotchas | `.github/copilot-instructions.md` | Every interaction in this repo | Always, auto-loaded by Copilot |
| **Scoped Context** | Path-specific rules layered on top of project context | `.github/instructions/*.instructions.md` | Only when working on matching file paths | Automatically, when the active file matches |
| **Prompt Template** | Reusable single-task shortcut | `.github/prompts/*.prompt.md` | One specific task, on-demand | Only when invoked with `/name` |
| **Skill** | Multi-step workflow playbook for Agent Mode | `.github/skills/*/SKILL.md` | A complete end-to-end workflow | Only when invoked with `/name` in Agent Mode |

---

### Key Distinctions at a Glance

| Question | Answer |
|---|---|
| _"What should I type right now?"_ | **Prompt** |
| _"How should Copilot always behave for me, everywhere?"_ | **Instructions** (user settings) |
| _"What does Copilot need to know about this codebase?"_ | **Project Context File** |
| _"What rules apply only to my React components?"_ | **Scoped Context** |
| _"How do I save a task I do repeatedly?"_ | **Prompt Template** |
| _"How do I automate a whole multi-step workflow?"_ | **Skill** |

> 📖 **Sections 10, 11, and 12** cover each of these layers in depth with full worked examples — Instructions, Prompt Templates, and Skills respectively.

---

## 9. Prompt Crafting & Best Practices

The quality of Copilot's output is **directly proportional to your prompt quality**. Now that the taxonomy is clear, this section focuses on how to craft the best possible prompt for any given interaction.

### The CLEAR Framework
| Letter | Meaning | Example |
|---|---|---|
| **C** | Context | "I'm building a Flask REST API with SQLAlchemy..." |
| **L** | Language/Stack | "...using Python 3.11, Flask 3.0, PostgreSQL..." |
| **E** | Expected Output | "...generate a CRUD endpoint for a `Product` model..." |
| **A** | Avoid/Constraints | "...do not use raw SQL, use ORM only..." |
| **R** | Reference | "...following the same pattern as #file:routes/users.py" |

### The CO-STAR Framework
A general-purpose prompt engineering framework — great for nuanced or documentation-heavy tasks where *how* the output is written matters as much as *what* it contains.

| Letter | Meaning | Example |
|---|---|---|
| **C** | **Context** | "I'm building a multi-tenant SaaS app with Flask..." |
| **O** | **Objective** | "...I need to generate a rate-limiting middleware..." |
| **S** | **Style** | "...write it in a functional style, no classes..." |
| **T** | **Tone** | "...keep comments concise and technical, not beginner-friendly..." |
| **A** | **Audience** | "...this will be reviewed by senior backend engineers..." |
| **R** | **Response Format** | "...return only the code block, no explanation needed" |

> 💡 **CLEAR vs CO-STAR:** Use **CLEAR** for quick day-to-day coding prompts. Use **CO-STAR** when you need finer control over the *style, tone, and format* of the output — especially for documentation, code reviews, or team-facing content.

**CO-STAR Example Prompt:**
```
Context: I'm working on a Flask REST API used by mobile clients.
Objective: Write a middleware function that rate-limits requests to 100/min per user.
Style: Functional style, no classes, using Redis for storage.
Tone: Comments should be concise and technical.
Audience: Senior backend engineers doing a code review.
Response Format: Code only, with inline comments. No prose explanation.
```

---

### Prompting Techniques

**Chain of Thought** — Ask Copilot to reason before coding:
```
Before writing the code, explain your approach to implementing 
pagination for this endpoint, then write the implementation.
```

**Persona Assignment:**
```
Act as a senior backend engineer doing a code review. 
Identify potential security vulnerabilities in #selection.
```

**Iterative Refinement:**
```
Step 1: "Generate a database schema for an e-commerce app"
Step 2: "Now add indexes for the most common query patterns"
Step 3: "Write the SQLAlchemy models for this schema"
Step 4: "Generate Alembic migration files"
```

**Few-shot Examples:**
```
Here is how we handle errors in this project:
[paste example]

Now write error handling for the payment processing function using the same pattern.
```

---

## 10. Copilot Instructions — Teaching Copilot Your Rules

> 📖 **In the taxonomy (Section 8)**, Instructions sit at the persistent layer — always-on rules that apply before your prompt is ever evaluated. This section shows you how to write them, where to put them, and what they look like in practice.

### What Are Copilot Instructions?
Copilot Instructions are **persistent, always-on rules** you write once that Copilot automatically applies to every suggestion and chat response — without you having to repeat yourself in every prompt.

Think of it as **onboarding Copilot to your project** the same way you'd onboard a new developer: here's our stack, here's how we do things, here's what we never do.

---

### Why Should You Use Copilot Instructions?

**Without instructions**, Copilot makes generic assumptions:
```
→ Copilot generates raw SQL in a route handler (you use a service layer)
→ Copilot uses os.environ directly (you have a config.py)
→ Copilot writes Python without type hints (your team requires them)
→ Copilot generates Jest tests (you use pytest)
→ You spend time correcting the same mistakes every session
```

**With instructions**, Copilot already knows your rules:
```
→ Every suggestion respects your architecture patterns
→ Generated code matches your team's style guide automatically
→ No more "don't do it that way" corrections
→ New team members get Copilot that already understands the project
```

> 💡 **The ROI:** Spend 20 minutes writing instructions once → save hours of corrections across every future session.

---

### Who Should Use Copilot Instructions?

| Level | Use Case | Value |
|---|---|---|
| **Personal** | Your own coding preferences across all projects | Copilot writes the way *you* like — your preferred style, verbosity, patterns |
| **Project/Team** | Rules specific to one repo shared by the team | Every developer on the team gets consistent, project-aware suggestions |
| **Org/Enterprise** | Company-wide standards enforced across all repos | Security policies, compliance rules, architectural standards applied universally |

> ✅ **Yes, you can use it right now as a solo developer.** Even without a team, instructions stop Copilot from making the same generic mistakes repeatedly on your personal projects.

---

### Types of Copilot Instructions

#### 1. User-Level Instructions (Personal)
Applies to **all your projects**, across all repos.

`Ctrl + Shift + P` → **"GitHub Copilot: Open User Instructions"**

```markdown
- Always use type hints in Python
- Prefer functional style over class-based where possible
- Keep comments concise — I'm a senior developer, skip obvious explanations
- When generating tests, always include one edge case
- Default to async/await for any I/O operations
```

#### 2. Repository Instructions (Project/Team)
Create `.github/copilot-instructions.md` in your repo root. Automatically applied to everyone working on that repo.

```markdown
# Copilot Instructions for MyApp

## Tech Stack
- Backend: Python 3.11, Flask, SQLAlchemy, PostgreSQL
- Frontend: React 18, TypeScript, TailwindCSS
- Testing: pytest for backend, Jest for frontend

## Coding Standards
- Always use type hints in Python functions
- Use async/await for all I/O operations
- Follow PEP 8 strictly
- Write docstrings for all public functions

## Architecture Rules
- Never query the database from route handlers — always use the service layer
- All API responses must use the `ApiResponse` wrapper class
- Environment variables must be accessed through `config.py`, never os.environ directly

## Testing Requirements
- Every new function must have at least one happy path and one error path test
- Use factories (factory_boy) for test data, never hardcoded fixtures
```

#### 3. Org-Level Instructions (Enterprise)
Available on **Copilot Enterprise** — admins define instructions that apply to all repos in the organization. Used for:
- Security and compliance rules ("never log PII", "always sanitize SQL inputs")
- Architectural standards ("all services must implement health check endpoints")
- Approved library lists ("use only approved internal packages")

---

### Instructions vs. Prompting Every Time

| Approach | Effort | Consistency | Scales to Team? |
|---|---|---|---|
| Repeat rules in every prompt | High — every session | Low — easy to forget | ❌ No |
| Copilot Instructions file | One-time setup | ✅ Always applied | ✅ Yes — committed to repo |

---

## 11. Copilot Prompts — Reusable Task Shortcuts

> 📖 **In the taxonomy (Section 8)**, Prompt Templates sit above Instructions — they're on-demand task shortcuts you invoke explicitly. This section shows you what they look like in practice and how to build your own.

### What Are Copilot Prompt Files?
Prompt files are **saved, reusable prompts** stored as `.prompt.md` files in your `.github/prompts/` folder. Instead of retyping complex prompts, you invoke them by name — like calling a function instead of rewriting the logic every time.

**Your actual prompt files (from your repo):**
```
.github/
  prompts/
    add-api-endpoint.prompt.md    → Add an endpoint following your patterns
    add-tracker-page.prompt.md    → Scaffold a tracker page consistently
    debug-error.prompt.md         → Debug errors using your specific approach
    query-db.prompt.md            → Query the DB your way
    test-api.prompt.md            → Generate API tests in your style
    update-schema.prompt.md       → Update DB schema following your conventions
```

Each is **narrow and single-task** — "do this one specific thing, the way we always do it."

---

### Why Use Prompt Files?

**Without prompt files**, every task starts from scratch:
```
→ You retype a 10-line debug prompt every time you hit an error
→ Your teammate writes a slightly different prompt → inconsistent results
→ A great prompt you crafted last month is lost in chat history
→ New developers don't know what prompts work well for this project
```

**With prompt files**, your best prompts are saved and shared:
```
→ /query-db always queries the database your way
→ /test-api always produces tests in your project's exact style
→ /debug-error follows your team's structured debugging process
→ New developers instantly access battle-tested prompts on day one
```

> 💡 **Think of prompt files as your team's "prompt library"** — institutional knowledge about how to get the best results from Copilot, committed to your repo alongside your code.

---

### Who Should Use Prompt Files?

| Level | Use Case | Value |
|---|---|---|
| **Personal** | Save prompts you use repeatedly | Never retype a complex prompt again; build your personal toolkit |
| **Project/Team** | Standardize how the team interacts with Copilot | Consistent output; shared best practices; faster onboarding |
| **Org/Enterprise** | Org-wide prompts for audits, reviews, compliance | Every team follows the same process; prompts enforce policies |

> ✅ **Even as a solo developer**, prompt files pay off fast. If you've typed the same prompt more than twice — it should be a prompt file.

---

### Example Prompt Files

**`query-db.prompt.md`:**
```markdown
Query the database for the data needed to support #selection.
- Use the existing DB connection pattern in #file:config/database.php
- Always use prepared statements — no raw string interpolation
- Return results as an associative array
- Add a comment explaining what the query retrieves and why
```

**`test-api.prompt.md`:**
```markdown
Generate API tests for #selection using our test framework.
- Test happy path with valid input
- Test missing required fields
- Test unauthorized access (no token)
- Test invalid data types
- Follow the existing test structure in #file:tests/api/test_users.php
```

**`debug-error.prompt.md`:**
```markdown
Debug the error in #terminalLastCommand output.
- Identify the root cause, not just the symptom
- Trace the execution path that leads to the error
- Suggest a fix with explanation
- Suggest a test that would catch this error in the future
```

**`add-api-endpoint.prompt.md`:**
```markdown
Add a new REST API endpoint following our existing patterns.
- Use the same structure as #file:api/users.php as a reference
- Include input validation, error handling, and response formatting
- Use the ApiResponse wrapper for all responses
- Add the route to the router file
- Generate a matching test in /tests/api/
```

**Invoking in chat — just type `/`:**
```
/query-db          ← runs on current context
/test-api          ← generates tests for active file
/debug-error       ← uses #terminalLastCommand automatically
/add-api-endpoint  ← scaffolds a new endpoint
```

---

### Prompts vs. Instructions — Quick Distinction

| | Copilot Instructions | Copilot Prompts |
|---|---|---|
| **What it is** | Persistent background rules | On-demand task shortcuts |
| **When applied** | Always, automatically | Only when you invoke them |
| **Analogy** | Employee handbook | Standard operating procedures |
| **Best for** | "Always do X this way" | "When I ask for Y, run this workflow" |

---

## 12. Copilot Skills — Automating Entire Workflows

> 📖 **In the taxonomy (Section 8)**, Skills sit at the top of the hierarchy — they're multi-step Agent Mode playbooks that orchestrate entire workflows. This section shows you how they work and how to write them, building on the Instructions and Prompts you've now seen.

### How Invocation Works — The `/` Command
Copilot automatically scans `.github/prompts/` and `.github/skills/` and **registers every file as a slash command** using its name. You don't reference the file path — just type `/`:

```
/query-db                   ← runs query-db.prompt.md
/test-api                   ← runs test-api.prompt.md
/debug-error                ← runs debug-error.prompt.md
/register-app               ← runs skills/register-app/SKILL.md
/register-app Expense Tracker  ← skill + inline context
```

> 💡 There's no difference in *how* you invoke a prompt vs. a skill — both use `/name`. The difference is in *what they do*: prompts handle one task, skills orchestrate an entire workflow.

**Your actual skill (from your repo):**
```
.github/
  skills/
    register-app/
      SKILL.md    ← Full playbook for registering an app
```

A `SKILL.md` is not "do this one thing" — it's **"here is everything you need to know to complete this entire workflow"**: which files to create, in what order, what patterns to follow, what validations to run, what to check when done.

---

### Prompt vs. Skill — The Core Difference

| | Prompt (`.prompt.md`) | Skill (`SKILL.md`) |
|---|---|---|
| **Scope** | One task | One complete capability / workflow |
| **Complexity** | Simple → medium | Medium → complex, multi-step |
| **Analogy** | A specific recipe | A chef's training manual for a cuisine |
| **Agent involvement** | Usually a single exchange | Agent Mode reads & executes autonomously |
| **Your example** | `query-db`, `debug-error`, `test-api` | `register-app` (entire registration flow) |
| **Output** | Code snippet, test, query | Multiple files created/modified end-to-end |

---

### What a SKILL.md Looks Like

**Skill 1 — `/register-app`:**
```markdown
# Skill: Register App

## Overview
This skill registers a new application in the platform. It covers 
creating the app record, setting up routing, configuring DB tables, 
and scaffolding the initial pages.

## Steps
1. Create the app entry in `apps/` directory following the naming convention
2. Register the route in `config/routes.php`
3. Create the DB migration using `update-schema` prompt
4. Scaffold the tracker page using `add-tracker-page` prompt
5. Add the app to the navigation config in `config/nav.php`
6. Run the test suite to verify nothing is broken

## Patterns to Follow
- Reference #file:apps/sample-app/ as the canonical example
- All apps must implement the BaseApp interface
- Every app needs a corresponding test in /tests/apps/

## Done Criteria
- App appears in navigation
- All routes return 200
- DB migration runs cleanly
- Tests pass
```

**Skill 2 — `/deploy-feature`:**
```markdown
# Skill: Deploy Feature

## Overview
Prepares a feature branch for deployment: final review, changelog, PR creation.

## Steps
1. Run the test suite; fix any failing tests before proceeding
2. Run the linter and auto-fix any lint errors
3. Update CHANGELOG.md with a summary of changes under the Unreleased section
4. Verify no .env values or secrets appear in the diff
5. Create a pull request against main with a descriptive title and body
6. Link the PR to any GitHub Issues mentioned in the branch commit history

## Done Criteria
- All tests pass
- Lint is clean
- CHANGELOG is updated
- PR is open and linked to relevant issues
```

**Skill 3 — `/generate-module`:**
```markdown
# Skill: Generate Module

## Overview
Scaffolds a complete new backend module: model, service, repository, route, and tests.

## Steps
1. Create the SQLAlchemy model in /src/models/ following #file:src/models/user.py as reference
2. Create the repository class in /src/repositories/ with standard CRUD methods
3. Create the service class in /src/services/ — business logic lives here, not in the repository
4. Create the route handler in /src/routes/ using the ApiResponse wrapper for all responses
5. Register the route in src/app.py
6. Generate tests in /tests/ covering happy path and error cases for each endpoint

## Patterns to Follow
- All models must extend BaseModel and include created_at / updated_at fields
- All services must be injectable (accept repository as constructor argument)
- Input validation happens in the route handler using Pydantic schemas

## Done Criteria
- Module is reachable via its API endpoints
- All unit and integration tests pass
- No raw SQL anywhere in the new files
```

**Invoking skills in Agent Mode:**
```
/register-app     ← Copilot Agent reads SKILL.md and executes all steps autonomously
/register-app add a new app called "Expense Tracker"
/deploy-feature   ← runs full pre-deployment checklist and opens the PR
/generate-module  ← scaffolds an entire backend module end-to-end
```

---

### Why Use Skills?

**Without a skill**, a complex workflow requires constant guidance:
```
You: "Create a new app"
Copilot: creates one file
You: "Now add the route"
Copilot: adds the route
You: "Now create the DB table"
Copilot: creates the table
You: "Now scaffold the tracker page"
... (5 more back-and-forth exchanges)
```

**With a skill**, one prompt does it all:
```
You: "Use the register-app skill to add Expense Tracker"
Copilot Agent: reads SKILL.md → executes all 6 steps → done ✅
```

---

### Who Should Use Skills?

| Level | Use Case | Value |
|---|---|---|
| **Personal** | Automate your own multi-step workflows | Run complex personal workflows with one prompt |
| **Project/Team** | Encode your team's repeatable processes | Consistency, speed, and less tribal knowledge dependency |
| **Org/Enterprise** | Standardize complex org-wide workflows | Enforce process compliance; scale best practices across teams |

---

### Instructions + Prompts + Skills — The Full Picture

```
┌─────────────────────────────────────────────────────────────┐
│                    copilot-instructions.md                   │
│         (Always-on rules: stack, standards, patterns)        │
├──────────────────────────┬──────────────────────────────────┤
│     Prompts              │     Skills                        │
│  .github/prompts/        │  .github/skills/                  │
│                          │                                   │
│  Single-task shortcuts   │  Multi-step workflow playbooks    │
│  query-db.prompt.md      │  register-app/SKILL.md            │
│  test-api.prompt.md      │  deploy-feature/SKILL.md          │
│  debug-error.prompt.md   │  generate-module/SKILL.md         │
└──────────────────────────┴──────────────────────────────────┘
         Instructions = Environment
         Prompts = Task shortcuts
         Skills = Workflow automation
```

> 🎯 **Your current `.github/` setup is already well-structured.** Adding `SKILL.md` files for your most complex repeated workflows is the natural next step to full workflow automation.

---

### When to Use Which

| Signal | Action |
|---|---|
| Correcting the same Copilot mistake repeatedly | Write a `copilot-instructions.md` |
| A rule only applies to one file type or folder | Add a `.instructions.md` file with `applyTo` scoping |
| Retyping the same prompt more than twice | Create a `.prompt.md` file |
| A workflow takes 5+ back-and-forth exchanges | Write a `SKILL.md` |
| New teammate needs to learn your workflow | Point them to your skills + prompts in `.github/` |
| Copilot gives inconsistent results across your team | Commit instructions + prompts to the repo |

---

## 13. Skills Marketplace — Discovering and Installing Community Skills

> 🛒 You don't have to write every skill from scratch. The community has built a growing library of ready-made skills, agents, and plugins you can install directly into Copilot.

### The Marketplace → Plugin → Skill Hierarchy

The ecosystem uses a three-level model — think of it like an app store:

| Level | What It Is | Analogy |
|---|---|---|
| **Marketplace** | A GitHub repo that acts as a registry of available plugins | The app store itself |
| **Plugin** | A bundled, installable package of related skills, agents, and commands for a domain | A category of apps (e.g. "Azure", "Python", "DevOps") |
| **Skill** | The individual capability inside a plugin | A single app |

### Awesome Copilot — The Primary Community Marketplace

The official community marketplace is maintained at:

> 🔗 **https://awesome-copilot.github.com**

It currently hosts 175+ agents, 208+ skills, 176+ instructions, and 48+ plugins — all community-contributed. The site has a Learning Hub, browsable categories (Agents, Skills, Instructions, Hooks, Plugins, Tools), and one-click install buttons for VS Code.

For most users, the Awesome Copilot marketplace is already registered in Copilot CLI and VS Code. Install a plugin with:

```bash
copilot plugin install <plugin-name>@awesome-copilot
```

If you see an error that the marketplace is unknown, register it once first:

```bash
copilot plugin marketplace add github/awesome-copilot
copilot plugin install <plugin-name>@awesome-copilot
```

### Managing Marketplaces and Plugins

```bash
# Browse and discover
copilot plugin marketplace list
copilot plugin marketplace browse awesome-copilot

# Add a custom or internal marketplace
copilot plugin marketplace add my-org/internal-plugins

# Install
copilot plugin install dev-toolkit@awesome-copilot
copilot plugin install user/repo                    # directly from a repo

# Manage installed plugins
copilot plugin list
copilot plugin update my-plugin
copilot plugin uninstall my-plugin
```

### Auto-Detection of Skills

Skills no longer require an explicit `/skill-name` invocation. When Copilot determines a skill is relevant to your current task, it loads and applies it automatically. This also means:

- Skills in `.github/skills/` (VS Code / Copilot CLI) are auto-detected
- Skills in `.claude/skills/` (Claude Code) are picked up by Copilot automatically — they share the same format

---

### ⚠️ Treat Community Skills Like Any Open Source Dependency

A skill is not just a markdown file — it can include **executable scripts, shell commands, and resource files** that Copilot Agent will run autonomously in your environment. Before installing any community skill or plugin, apply the same due diligence you would for any open source component:

#### Review Before You Run

| What to Check | Why It Matters |
|---|---|
| **Read the `SKILL.md` and all scripts before installing** | Skills can execute arbitrary CLI commands — know exactly what will run |
| **Check the source repository's trust signals** | Stars, contributors, recent activity, maintainer identity |
| **Review the license** | Skills are code — check for MIT, Apache, or other compatible licenses before using in commercial projects |
| **Look for pinned versions or commit hashes** | Unpinned installs can silently pull in updated scripts |
| **Audit any shell scripts bundled in the skill folder** | A skill directory can include `.sh`, `.py`, or `.js` files that Agent Mode will execute |

#### Org/Team Policies

- **Don't install community plugins on shared or production-adjacent environments** without a team review
- **Prefer your org's internal marketplace** for team use — set one up at a private GitHub repo and register it with `copilot plugin marketplace add my-org/internal-plugins`
- **Pin to a specific commit** when referencing external skills in team workflows, the same way you'd pin a dependency version in `package.json` or `requirements.txt`
- **Add an allowlist** — document which external skills and marketplaces are approved for use in your team's `copilot-instructions.md`

> 🔒 **The rule of thumb:** If you wouldn't `pip install` or `npm install` a package without reviewing it, don't `/plugin install` a skill without doing the same. Agent Mode will execute what the skill tells it to — review first.

---

## 14. Terminal Access — The Universal Adapter

> 🔌 **You don't always need MCP. Agent Mode + your terminal is already a remarkably powerful universal adapter.**

### How It Works
Copilot Agent has a built-in `run_command` tool that lets it execute **any CLI command** in the VS Code integrated terminal — and read the output back as context to reason about.

```
Copilot Agent reads your project config (.env, config files, README)
         ↓
Constructs and runs a CLI command in the VS Code terminal
         ↓
Reads the terminal output back as context
         ↓
Reasons about the result to help you code, debug, or test
```

### Real Examples — No MCP, No Extensions Needed

**Querying a MySQL database:**
```bash
# Copilot Agent runs this in your terminal
mysql -u root -p mydb -e "DESCRIBE users;"
mysql -u root -p mydb -e "SELECT * FROM orders WHERE status='pending' LIMIT 10;"
```

**Calling a REST API:**
```bash
# Copilot Agent constructs and runs curl commands
curl -X GET https://api.yourapp.com/users \
     -H "Authorization: Bearer $API_TOKEN" \
     -H "Content-Type: application/json"

curl -X POST https://api.yourapp.com/products \
     -H "Authorization: Bearer $API_TOKEN" \
     -d '{"name": "Widget", "price": 9.99}'
```

**Copilot reads the JSON response, reasons about the structure, and uses it to write code, generate tests, or debug issues — all in the same session.**

### The Universal Adapter — What Copilot Can Reach via CLI

| What You Want to Access | CLI Tool Copilot Uses | MCP Equivalent |
|---|---|---|
| MySQL / PostgreSQL | `mysql`, `psql` | MCP Database Server |
| REST APIs | `curl`, `httpie` | MCP HTTP Server |
| File system (extended) | `ls`, `cat`, `find`, `grep` | MCP Filesystem Server |
| Git history & diffs | `git log`, `git diff`, `git blame` | MCP Git Server |
| Docker containers | `docker ps`, `docker logs`, `docker exec` | MCP Docker Server |
| AWS infrastructure | `aws` CLI | MCP AWS Server |
| Azure resources | `az` CLI | MCP Azure Server |
| Kubernetes | `kubectl` | MCP K8s Server |
| Python environments | `pip`, `python` | — |
| Node/npm packages | `npm`, `npx` | — |

> 💡 **The rule of thumb:** If there's a CLI for it, Copilot Agent can use it — with **zero setup**.

### Why This Matters for Your Team

```
Without knowing this → developers think Copilot is limited to code files

Knowing this → developers realize Copilot Agent can:
  ✅ Query live databases to understand real data
  ✅ Test API endpoints and reason about responses
  ✅ Inspect running containers and infrastructure
  ✅ Run migrations and verify results
  ✅ Grep across logs to debug production issues
  ✅ Chain multiple CLI tools together in one task
```

### Agent Mode + Terminal: A Practical Example
```
You: "The /orders endpoint is returning 500 errors in production. 
      Investigate and suggest a fix."

Copilot Agent will:
  1. Run: curl -X GET https://api.yourapp.com/orders (check the error)
  2. Run: mysql -e "SHOW PROCESSLIST;" (check DB connections)
  3. Run: mysql -e "DESCRIBE orders;" (inspect schema)
  4. Search @workspace for the orders route handler
  5. Identify the mismatch between code and live schema
  6. Suggest a fix with a migration script
```

### Terminal Access vs. MCP — When to Use Each

| Scenario | Terminal Access | MCP Server |
|---|---|---|
| Solo developer, local environment | ✅ Perfect | Overkill |
| Quick ad-hoc DB queries | ✅ Zero setup | Needs config |
| Team with shared, controlled DB access | Limited | ✅ Better |
| CI/CD pipelines (no interactive terminal) | ❌ | ✅ |
| Structured, repeatable tool calls | Less reliable | ✅ |
| Air-gapped or locked-down environments | Depends on CLI | ✅ More portable |

> **Bottom line:** Terminal access makes Agent Mode a universal adapter out of the box. MCP (Section 16) is the upgrade you reach for when you need **structure, security, portability, or team-level control.**

---

## 15. GitHub Copilot CLI — Terminal-Native Copilot Agent

### A Brief History — Two Different Things
Before diving in, it's important to know there were **two different tools** with similar names:

| | Old: `gh-copilot` extension | New: GitHub Copilot CLI |
|---|---|---|
| **Status** | ❌ Retired October 25, 2025 | ✅ Active (Public Preview, 2025) |
| **What it did/does** | Basic `suggest` and `explain` commands | Full agentic AI coding assistant |
| **Capability** | Simple command suggestions | Plan, code, debug, create PRs autonomously |

> ⚠️ If you see tutorials referencing `gh copilot suggest` or `gh copilot explain` — that's the **old, retired** extension. The new Copilot CLI is a completely different and far more powerful tool.

---

### What Is GitHub Copilot CLI?
GitHub Copilot CLI is a **terminal-native, fully agentic AI coding assistant** — essentially Copilot Agent Mode, but living in your terminal instead of VS Code. It is now bundled into **GitHub CLI (`gh`)** — so `gh` is the single entry point for everything.

---

### Installation — GitHub CLI is All You Need

**Step 1 — Install GitHub CLI (`gh`)**

| Platform | Command |
|---|---|
| **Windows** | `winget install --id GitHub.cli` |
| **macOS** | `brew install gh` |
| **Linux (apt)** | `sudo apt install gh` |
| **MSI Installer** | Download from https://cli.github.com/ |

GitHub CLI installs system-wide and adds itself to PATH automatically.

**Step 2 — Authenticate**
```bash
gh auth login
# Walks you through browser-based GitHub authentication
# Works on Windows CMD, PowerShell, macOS Terminal, Linux bash
```

**Step 3 — Launch Copilot CLI**
```bash
gh copilot
# First run: prompts to install Copilot CLI automatically
# Subsequent runs: launches directly into the agent session
```

That's it. **No separate npm install. No curl script. No standalone package.** `gh copilot` is the one command that handles everything.

> ✅ **Included in all Copilot plans** — Free, Pro, Business, and Enterprise. No additional cost.

---

### The Relationship Explained
```
GitHub CLI (gh)
    └── gh copilot        ← entry point for Copilot CLI
            └── Copilot Agent session (terminal-native)
                    ├── Ask mode
                    ├── Plan mode  (/plan)
                    └── Autopilot mode  (Shift+Tab)
```

---

### Key Features

#### Autopilot Mode — The Terminal "Go Get Coffee" Mode
Press `Shift+Tab` to cycle through modes:

| Mode | Behavior |
|---|---|
| **Ask** | Answers questions, no changes made |
| **Plan** | Outlines all steps before executing — you review first |
| **Autopilot** | Runs autonomously until task is complete — no step-by-step approvals |

> ☕ **Autopilot mode is purpose-built for unattended runs.** This is the terminal-native equivalent of the "Go Get Coffee Configuration" from Section 7 — but without any JSON config needed. Where VS Code requires `"autoApprove": true` in `settings.json`, Copilot CLI's Autopilot achieves the same unattended behavior out of the box with a single `Shift+Tab`.

> 💡 The **Ask / Plan / Autopilot** progression here mirrors the **Ask / Plan / Agent** modes from Section 7. The key difference: VS Code has "Agent" mode (which still prompts for permission); CLI has "Autopilot" mode (which carries the task forward without interruption).

#### `/plan` — Review Before Execution
```bash
/plan add a Redis caching layer to the user profile endpoint
```
Copilot outlines every step it intends to take. You review, then approve — same concept as VS Code's Plan Mode (Section 7) but in your terminal.

#### `/model` — Switch AI Models Per Task
```bash
/model         # see available models and switch
```
Defaults to **Claude Sonnet 4.5**. Switch to GPT-5, Claude Opus, or others depending on task complexity.

#### `/fleet` — Run Multiple Models in Parallel
```bash
/fleet         # delegates subtasks to multiple subagents simultaneously
```
Spins up parallel subagents working on different parts of the same task — a capability not available in VS Code Copilot.

#### Built-in GitHub MCP Server
Ships with **GitHub's MCP server built in by default** — no configuration needed:
```
→ Browse repos, issues, and pull requests
→ Create branches and PRs using natural language
→ Search issues and summarize scope before coding
→ Respects branch protections and org policies automatically
```

#### `AGENTS.md` — Equivalent to `copilot-instructions.md`
Place `AGENTS.md` in your repo root for persistent project instructions — the Copilot CLI equivalent of `.github/copilot-instructions.md` (see Section 10).

---

### Copilot CLI in Action — Example Workflows

**Fix a GitHub Issue end-to-end:**
```
gh copilot
> /plan fix issue #142, write a regression test, and open a pull request

Copilot (Autopilot):
  → Reads issue #142 via GitHub MCP
  → Searches the codebase for the relevant code
  → Implements the fix
  → Writes the regression test
  → Creates a branch
  → Opens a PR with a descriptive summary
  ✅ Done — no interruptions
```

**Bulk refactor:**
```
gh copilot
> Refactor all API endpoints in /src/api to use async/await instead of callbacks

Copilot (Autopilot):
  → Lists all files in /src/api
  → Refactors each file
  → Runs the test suite
  → Fixes any failures
  ✅ Done
```

---

### Copilot CLI vs. Copilot in VS Code

| Feature | Copilot in VS Code | Copilot CLI (`gh copilot`) |
|---|---|---|
| **Where it runs** | Inside VS Code | Any terminal — CMD, PowerShell, bash |
| **Agent Mode** | ✅ Yes | ✅ Autopilot mode |
| **Plan Mode** | ✅ Yes | ✅ `/plan` command |
| **MCP Support** | ✅ Configurable | ✅ GitHub MCP built-in |
| **Skills/Instructions** | `copilot-instructions.md` + `SKILL.md` | `AGENTS.md` |
| **Multi-model parallel** | ❌ | ✅ `/fleet` subagents |
| **Permission prompts** | Frequent (Allow/Deny) | Autopilot minimizes them |
| **Editor dependency** | VS Code required | ❌ Works standalone |
| **Install** | VS Code extension | `winget install GitHub.cli` → `gh copilot` |
| **Best for** | Active coding & review in editor | Autonomous tasks, CI/CD, editor-agnostic |

---

### When to Use Which

```
Use VS Code Copilot when:
  ✅ Actively writing and reviewing code in the editor
  ✅ You want inline completions as you type
  ✅ Doing file-by-file work with visual diffs

Use gh copilot (Copilot CLI) when:
  ✅ You want to run a long autonomous task and walk away
  ✅ Working outside VS Code (vim, JetBrains, etc.)
  ✅ You want multi-model parallel execution (/fleet)
  ✅ Automating tasks in CI/CD pipelines
  ✅ Deep GitHub integration (issues → code → PR) out of the box
```

> 🎯 **They complement each other.** A common workflow: start with `/plan` in `gh copilot` → switch to VS Code to refine code → come back to `gh copilot` to create the PR.

---

## 16. MCP Servers — Extending Copilot's Reach

> **MCP (Model Context Protocol)** allows Copilot to connect to external tools and data sources, turning it into a truly integrated development assistant.

### What MCP Enables
Without MCP, Copilot only knows about your local code.
With MCP, Copilot can:
- Query your **database** and reason about real schema and data
- Read **Jira/GitHub Issues** and write code to fix them
- Access **Figma designs** and generate matching components
- Read **Confluence docs** and follow your team's architecture patterns
- Execute **browser automation** for testing

### Configuring MCP Servers in VS Code

Add to your VS Code `settings.json` or `.vscode/mcp.json`:

```json
{
  "mcp": {
    "servers": {
      "postgres": {
        "command": "npx",
        "args": ["-y", "@modelcontextprotocol/server-postgres"],
        "env": {
          "POSTGRES_CONNECTION_STRING": "postgresql://user:pass@localhost/mydb"
        }
      },
      "github": {
        "command": "npx",
        "args": ["-y", "@modelcontextprotocol/server-github"],
        "env": {
          "GITHUB_PERSONAL_ACCESS_TOKEN": "${env:GITHUB_TOKEN}"
        }
      },
      "filesystem": {
        "command": "npx",
        "args": ["-y", "@modelcontextprotocol/server-filesystem", "/workspace"]
      }
    }
  }
}
```

### Popular MCP Servers
| MCP Server | What It Connects | Install |
|---|---|---|
| `@modelcontextprotocol/server-postgres` | PostgreSQL databases | npx |
| `@modelcontextprotocol/server-github` | GitHub repos, issues, PRs | npx |
| `@modelcontextprotocol/server-filesystem` | Extended file access | npx |
| `@modelcontextprotocol/server-brave-search` | Web search | npx |
| `@modelcontextprotocol/server-memory` | Persistent memory | npx |
| `mcp-atlassian` | Jira + Confluence | pip |
| `figma-mcp` | Figma designs | npx |
| `@playwright/mcp` | Browser automation | npx |

### MCP in Action — Example Workflows

**Database-Aware Development:**
```
@workspace I need to add a "last_login" column to the users table.
Use the postgres MCP to check the current schema, then:
1. Generate the SQL migration
2. Update the SQLAlchemy model
3. Update any queries that SELECT * from users
```

**Issue-Driven Development:**
```
@github Get issue #142 from repo myorg/myapp. 
Understand the bug described, find the relevant code in @workspace,
and generate a fix with a test case.
```

**Design-to-Code:**
```
Using the Figma MCP, fetch the "User Profile Card" component from 
our design system. Generate a matching React component using our 
existing TailwindCSS setup.
```

### Enabling/Disabling MCP Tools
In the Agent Mode chat, click the **🔧 Tools** icon to see which MCP tools are active and toggle them on/off per session.

---

## 17. Real-World Workflows

### Workflow 1: Onboarding to a New Codebase
```
1. Open the project in VS Code
2. Open Copilot Chat → Agent Mode
3. Ask: "@workspace Give me a high-level architecture overview of this project.
         What are the main modules, how do they interact, and what are the 
         entry points?"
4. Follow up: "@workspace Where is the authentication handled and 
               what libraries does it use?"
5. Ask: "@workspace If I want to add a new API endpoint, which files 
         would I need to modify and in what order?"
```

### Workflow 2: Test-Driven Development with Copilot
```
1. Write a failing test with your intent:
   "Test that create_user() raises ValueError when email is missing"

2. Ask Copilot: "/fix Make this test pass by implementing the correct 
                 validation in #file:services/user_service.py"

3. Run tests in terminal — Copilot Agent watches the output and iterates
```

### Workflow 3: Debugging with Copilot
```
1. Paste error traceback in chat
2. Ask: "@workspace I'm getting this error: [paste]. 
         Trace the execution path and identify the root cause."
3. Select the problematic code → Inline Chat → "/fix"
4. Ask for a regression test: "/tests Write a test that would have 
   caught this bug"
```

### Workflow 4: Full Feature Development (Agent Mode)
```
Prompt: "Add a password reset feature to this application.
         Requirements:
         - User enters email, receives a reset link
         - Link expires in 1 hour
         - Use the existing email service in services/email.py
         - Follow our existing auth patterns in routes/auth.py
         - Add tests
         - Update the API documentation"

→ Copilot Agent will plan and execute all steps autonomously
```

---

## 18. Tips, Limitations & Responsible Use

### ✅ What Copilot Excels At
- Boilerplate and scaffolding code
- Writing tests for existing functions
- Explaining unfamiliar code
- Converting code between languages/paradigms
- Generating documentation
- Debugging with full context

### ⚠️ Limitations to Know
| Limitation | Mitigation |
|---|---|
| Context window size | Use `#file` to pin the right files |
| May hallucinate APIs | Always verify generated library calls |
| Stale knowledge cutoff | Use MCP for live data |
| May introduce security issues | Run security linters on generated code |
| Doesn't know your team's intent | Use `copilot-instructions.md` |

### 🔒 Security & Privacy
- **Org-managed settings**: Admins can exclude files (e.g., `.env`, secrets) from Copilot context
- **Telemetry**: Code suggestions are not stored for training on Copilot Business/Enterprise
- **Sensitive files**: Add patterns to `.copilotignore` (like `.gitignore`) to exclude secrets and PII

```
# .copilotignore
.env
.env.*
secrets/
**/*.key
config/production.yml
```

### 🎯 The 3-Second Rule
> If you spend more than 3 seconds writing a prompt, you're probably not being specific enough — or you need to break the task into smaller steps.

### Golden Rules
1. **Context is everything** — the better the context, the better the output
2. **Iterate, don't expect perfection** — treat Copilot like a junior dev whose work you review
3. **Commit before Agent Mode** — always have a clean git state
4. **Review every suggestion** — Copilot is fast, but you are responsible
5. **Use instructions files** — invest 20 minutes to write `copilot-instructions.md` and save hours

---

## 📚 Resources

| Resource | Link |
|---|---|
| Official Docs | https://docs.github.com/en/copilot |
| VS Code Copilot Guide | https://code.visualstudio.com/docs/copilot/overview |
| MCP Protocol Spec | https://modelcontextprotocol.io |
| Prompt Engineering Guide | https://docs.github.com/en/copilot/using-github-copilot/prompt-engineering-for-copilot-chat |
| Copilot Extensions Marketplace | https://github.com/marketplace?type=apps&copilot_app=true |

---

*Training prepared for: GitHub Copilot in VS Code — Advanced Usage*
*Topics: Context, Agent Mode, Codebase Awareness, AI Taxonomy, Prompts, Instructions, Project Context, Skills, Extensions, MCP*
