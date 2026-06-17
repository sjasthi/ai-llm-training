# Plugging In Public MCP Servers from GitHub Copilot in VS Code

A hands-on learning guide for connecting external tools and data sources to GitHub Copilot through the Model Context Protocol (MCP).

---

## 1. What Is MCP and Why It Matters for Copilot

MCP (Model Context Protocol) is an open standard that defines how AI models communicate with external tools and data sources. Think of it as a universal adapter — like USB-C for AI — that lets Copilot reach beyond code suggestions and interact with the real world.

MCP follows a **client-server model**:

- **MCP Client** — VS Code acts as the client, sending requests on behalf of Copilot.
- **MCP Server** — A standalone process that exposes one or more **tools** (e.g., "create a GitHub issue," "take a browser screenshot," "query a database") through a standardized interface.

When you add an MCP server, VS Code automatically discovers its tools and makes them available inside Copilot Chat's **Agent mode**. This means Copilot can now do things like automate a browser, fetch live web content, manage GitHub workflows, query databases, and more — all from a natural language prompt.

**Key milestone:** MCP support in VS Code moved from preview to **generally available** with VS Code 1.102 (July 2025). It is production-ready.

---

## 2. Prerequisites Check

Before you begin, confirm you have the following in place:

- [ ] **VS Code 1.99 or later** (ideally the latest stable release). Check with `Help > About`.
- [ ] **Active GitHub Copilot subscription** — Free, Pro, Pro+, Business, or Enterprise all work.
- [ ] **For Business / Enterprise users:** Your org admin must enable the **"MCP servers in Copilot"** policy (it is disabled by default). Check with your admin if Agent mode doesn't show MCP tools.
- [ ] **Familiarity with Agent mode** in Copilot Chat. You should know how to open Chat (`Ctrl+Alt+I` / `⌃⌘I`), switch to **Agent** in the mode dropdown, and issue prompts.
- [ ] **Node.js installed** (v18+). Many MCP servers are distributed as npm packages and run via `npx`. Verify with `node -v` in your terminal.
- [ ] **Docker Desktop** (optional). Some servers (like the local GitHub MCP server) run inside a Docker container. Install it if you plan to use those servers.

---

## 3. Understanding the Two Ways to Add MCP Servers

There are two paths to adding an MCP server in VS Code. Both result in the same outcome — tools appearing in Agent mode — but they differ in how you get there.

### 3a. Via the MCP Gallery (One-Click Install)

1. Open the **Extensions** panel (`Ctrl+Shift+X` / `⇧⌘X`).
2. Type `@mcp` in the search field.
3. Browse the list of available MCP servers (powered by the GitHub MCP Registry).
4. Click **Install** on any server to add it to your user profile, or right-click and select **Install in Workspace** to add it to the current project.

This is the fastest way to get started and is great for discovering curated, vetted servers.

### 3b. Via Manual Configuration (`mcp.json`)

You can also add servers by hand by editing a JSON config file. There are **two scopes**:

| Scope | File Location | Use Case |
|---|---|---|
| **Workspace** | `.vscode/mcp.json` (in your project root) | Share server configs with your team via source control |
| **User** | Global user settings (open via Command Palette → `MCP: Open User Configuration`) | Personal servers available across all projects |

A basic `mcp.json` looks like this:

```json
{
  "servers": {
    "my-server-name": {
      "type": "http",
      "url": "https://some-remote-server.example.com/mcp"
    },
    "my-local-server": {
      "command": "npx",
      "args": ["-y", "some-mcp-package"]
    }
  }
}
```

**Key fields:**

- `type: "http"` + `url` → for **remote** servers (hosted elsewhere, you just point to the URL).
- `command` + `args` → for **local** servers (VS Code spawns the process on your machine).

VS Code provides **IntelliSense** inside `mcp.json`, so you get autocompletion and validation as you type.

### How Tool Discovery Works

Once a server is added and started, VS Code automatically queries it for its available tools and makes them selectable in Chat. You don't need to manually register individual tools.

---

## 4. Your First MCP Server: The Remote GitHub MCP Server

The GitHub MCP server is the best starting point because it requires **zero local installation** — it's hosted remotely by GitHub and uses OAuth for authentication (no Personal Access Token needed in VS Code).

### Step-by-Step Setup

1. **Open the MCP Gallery** (`Ctrl+Shift+X` → search `@mcp`) and find **GitHub**, then click **Install**.

   **Or add it manually** — open/create `.vscode/mcp.json` and add:

   ```json
   {
     "servers": {
       "github": {
         "type": "http",
         "url": "https://api.githubcopilot.com/mcp"
       }
     }
   }
   ```

2. **Start the server.** A **Start** button appears at the top of the `mcp.json` file — click it. (If you installed via the Gallery, it may start automatically.)

3. **Authorize via OAuth.** A popup will ask you to authenticate with GitHub. Click **Allow**. No PAT creation required.

4. **Verify tools are available.** Open Copilot Chat (`Ctrl+Alt+I`), switch to **Agent** mode, and click the **tools icon** (🛠️) at the bottom of the chat box. Under **MCP Server: GitHub**, you should see a list of available actions.

### Hands-On Exercises

Try these prompts in Agent mode to see the GitHub MCP server in action:

```
List the 5 most recent open issues in my repo [owner/repo-name]
```

```
Create a new issue titled "Update README with setup instructions" in [owner/repo-name]
```

```
Show me the open pull requests assigned to me
```

```
What GitHub Actions workflows failed in the last week for [owner/repo-name]?
```

Copilot will invoke the GitHub MCP tools, and you'll be asked to **confirm** each tool invocation before it executes.

### What You Can Do with the GitHub MCP Server

- Browse repos, files, commits, and branches
- Create, update, and search issues and pull requests
- Trigger and monitor GitHub Actions workflows
- Manage releases and analyze Dependabot alerts
- Search code across repositories

---

## 5. Adding a Local MCP Server: Playwright (Browser Automation)

The **Playwright MCP server** by Microsoft is the most popular MCP server in the ecosystem (12K+ GitHub stars). It gives Copilot the ability to control a web browser — navigate pages, click elements, fill forms, take screenshots, and extract content.

Unlike screenshot-based approaches, Playwright MCP works through the browser's **accessibility tree**, giving Copilot a structured, deterministic view of the page.

### Step-by-Step Setup

1. **Ensure Node.js is installed** (`node -v` should return v18+).

2. **Install via the MCP Gallery** (`Ctrl+Shift+X` → search `@mcp` → find **Playwright** → **Install**).

   **Or add manually** to `.vscode/mcp.json`:

   ```json
   {
     "servers": {
       "playwright": {
         "command": "npx",
         "args": ["-y", "@playwright/mcp"]
       }
     }
   }
   ```

3. **Trust and start the server** when prompted. VS Code will run the `npx` command, download the package (first time only), and start the server process.

4. **Verify** by clicking the tools icon in Agent mode Chat. You should see Playwright tools listed (e.g., `browser_navigate`, `browser_screenshot`, `browser_click`, `browser_type`, etc.).

### Hands-On Exercises

Try these prompts:

```
Go to https://code.visualstudio.com, and give me a screenshot of the homepage
```

```
Navigate to https://news.ycombinator.com, and list the top 5 stories on the front page
```

```
Go to https://en.wikipedia.org, search for "Model Context Protocol", and summarize what you find on the page
```

Each step (navigate, click, type, screenshot) will appear as a separate tool invocation that you confirm.

### Useful Configuration Options

You can pass additional arguments in the `args` array to customize behavior:

| Argument | Purpose | Example |
|---|---|---|
| `--browser` | Choose the browser engine | `"--browser", "firefox"` |
| `--headless` | Run without a visible browser window | `"--headless"` |
| `--caps` | Enable extra capabilities | `"--caps", "vision,pdf"` |
| `--port` | Run as HTTP server on a specific port | `"--port", "3000"` |

Example with options:

```json
{
  "servers": {
    "playwright": {
      "command": "npx",
      "args": ["-y", "@playwright/mcp", "--browser", "chrome", "--headless"]
    }
  }
}
```

---

## 6. Adding Another Server: Fetch (Lightweight Web Content Retrieval)

Sometimes you don't need full browser automation — you just want to **retrieve and read a web page**. The **Fetch MCP server** is a lighter-weight option for this.

### When to Use Fetch vs Playwright

| | Fetch | Playwright |
|---|---|---|
| **Use case** | Read-only content extraction | Full interactive browser control |
| **Overhead** | Low — simple HTTP requests | Higher — spawns a browser |
| **JavaScript rendering** | Depends on the server variant | Full JS execution |
| **Best for** | Grabbing docs, articles, API responses | Filling forms, clicking, screenshots |

### Step-by-Step Setup

Add to `.vscode/mcp.json`:

```json
{
  "servers": {
    "fetch": {
      "command": "npx",
      "args": ["-y", "@anthropic-ai/fetch-mcp"]
    }
  }
}
```

> **Note:** There are multiple fetch-style MCP servers in the ecosystem. The above uses Anthropic's reference implementation. Another popular option is `fetcher-mcp` by jae-jae, which uses Playwright under the hood for better JS-rendered page support.

Start the server and verify tools appear in Agent mode.

### Hands-On Exercise

```
Fetch the page at https://docs.github.com/en/copilot/overview and summarize the key features of GitHub Copilot
```

```
Fetch https://api.github.com/zen and tell me what it says
```

---

## 7. Managing Your MCP Tools

Once you have multiple servers running, you'll want to manage which tools are active.

### Viewing and Toggling Tools

1. Open Copilot Chat in **Agent** mode.
2. Click the **Configure Tools** button (🛠️) in the chat input area.
3. You'll see all available tools grouped by MCP server. Toggle individual tools **on or off** with the checkboxes.

This is useful when a server exposes many tools but you only need a few, or when you want to reduce noise and keep Copilot focused.

### Defining Toolsets

**Toolsets** let you group related tools under a name, making it easy to enable or disable a whole category at once. Define them in your VS Code settings:

```json
// settings.json
{
  "chat.toolsets": {
    "web-research": {
      "tools": ["playwright_browser_navigate", "playwright_browser_screenshot", "fetch_url"]
    },
    "github-ops": {
      "tools": ["github_create_issue", "github_list_pull_requests"]
    }
  }
}
```

You can then reference a toolset in chat by name to quickly scope your available tools.

### Tool Confirmation Behavior

By default, Copilot asks you to **confirm each tool invocation** before it runs. This is a safety feature. You can:

- Click **Continue** to allow a single invocation.
- Click **Continue for Session** to allow all invocations of that tool for the current session.

### Debugging: Viewing Server Logs

If a server isn't working as expected:

1. Open the **Output** panel (`Ctrl+Shift+U` / `⇧⌘U`).
2. In the dropdown, look for entries like **MCP: [server-name]**.
3. Review the log output for connection errors, missing dependencies, or tool failures.

---

## 8. Remote vs Local Servers: Understanding the Tradeoffs

| Aspect | Remote Servers (`type: "http"`) | Local Servers (`command` + `args`) |
|---|---|---|
| **Install** | None — just point to a URL | Needs runtime (Node.js, Python, Docker, etc.) |
| **Performance** | Depends on network latency | Runs on your machine, typically faster |
| **Control** | Limited — managed by the provider | Full control over config and behavior |
| **Security** | Data sent to external service | Data stays local |
| **Availability** | Depends on the service being up | Always available when your machine is |
| **Examples** | GitHub MCP, hosted API servers | Playwright, Fetch, Filesystem |

### Remote Development Scenarios

Where the server runs depends on your VS Code setup:

- **Local development:** Servers run on your local machine.
- **SSH / Remote Tunnels:** Servers defined in user settings run locally. Servers in workspace settings run on the **remote machine**.
- **Dev Containers:** Configure servers in `devcontainer.json` so they run inside the container. Use the `"customizations"` → `"vscode"` section.
- **GitHub Codespaces:** Same as Dev Containers — configure in `devcontainer.json`.

To explicitly run a server on a remote machine, use **Command Palette → MCP: Open Remote User Configuration**.

---

## 9. Security and Trust Considerations

MCP servers can execute arbitrary code and make network requests. Treat them with the same caution you would any third-party extension or package.

### Before Adding a Server

- **Check the publisher.** Prefer official servers (Microsoft, GitHub, Anthropic) or well-known maintainers with active repos.
- **Review the source code** if it's open source. Look at what tools are exposed and what permissions they require.
- **Check maintenance activity.** Recent commits, active issue triage, and responsive maintainers are good signs.
- **Read the configuration carefully.** Understand what commands will be run and what URLs will be contacted.

### While Using Servers

- **Use the tool confirmation prompt** as a safety checkpoint. Read what each tool is about to do before clicking Continue.
- **Scope servers appropriately.** Use workspace-level config (`.vscode/mcp.json`) for project-specific servers so they don't bleed into other projects.
- **Be careful with environment variables.** Some servers require API keys or tokens passed via `env` in the config. Don't commit secrets to source control — use `.env` files or VS Code's input variable prompts.

### What Data Flows to the Server

When Copilot invokes a tool, it sends the **tool name and input parameters** to the MCP server. The server processes the request and returns results. For remote servers, this data crosses the network. For local servers, it stays on your machine.

---

## 10. Exploring More Public MCP Servers

Once you're comfortable with the basics, the ecosystem is wide open.

### Where to Find Servers

| Source | URL | Notes |
|---|---|---|
| **GitHub MCP Registry** | Built into VS Code (`@mcp` in Extensions) | Curated, one-click install |
| **awesome-mcp-servers** | github.com/punkpeye/awesome-mcp-servers | Community-maintained, categorized, large collection |
| **PulseMCP** | pulsemcp.com | Web directory, daily updated |
| **Glama** | glama.ai/mcp | Searchable directory with server details |

### Popular Servers to Explore Next

| Server | Category | What It Does |
|---|---|---|
| **Filesystem** | File Operations | Read, write, search, and manage local files and directories |
| **PostgreSQL / SQLite** | Databases | Query and manage databases from natural language |
| **Slack** | Productivity | Send messages, search channels, manage workflows |
| **Notion** | Productivity | Read and write Notion pages and databases |
| **Docker** | DevOps | Manage containers, images, and compose stacks |
| **Kubernetes (k8s)** | DevOps | Interact with clusters, pods, deployments |
| **DuckDuckGo** | Search | Web search without API keys |
| **Memory (knowledge graph)** | Context | Persistent graph-based memory for AI |
| **Context7** | Documentation | Pull up-to-date library docs into Copilot context |

### How to Evaluate a Server

Before adding an unfamiliar server, ask:

1. **Who published it?** Official org vs unknown individual?
2. **How many stars / downloads?** Community trust signal.
3. **When was the last commit?** Actively maintained?
4. **What permissions does it need?** Does it require broad filesystem access? Network access? API keys?
5. **Is the source code available?** Can you inspect what it does?

---

## 11. Putting It All Together: A Multi-Server Workflow

The real power of MCP emerges when you combine multiple servers in a single Agent conversation. Copilot automatically selects which server's tools to use based on your prompt.

### Example: Research and Fix Workflow

With **GitHub + Playwright + Fetch** all running, try a prompt like:

```
Look at the top 3 open issues in my repo [owner/repo].
For the most recent one, use the browser to research the topic on MDN Web Docs.
Then draft a comment on the issue summarizing what you found.
```

Copilot will:

1. Use **GitHub MCP** tools to list issues and read the most recent one.
2. Use **Playwright** tools to navigate to MDN, search, and extract relevant content.
3. Use **GitHub MCP** tools again to post a comment on the issue.

### Tips for Effective Multi-Server Prompting

- **Be explicit about what you want done**, and Copilot will figure out which tools to use. You don't need to name the MCP server.
- **Break complex tasks into steps** in your prompt if Copilot seems confused about the order of operations.
- **Disable irrelevant tools** via the Configure Tools menu to reduce noise and help Copilot pick the right tool faster.
- **Check the tool invocations** as they come through — Agent mode shows you exactly which tool is being called and with what parameters before you confirm.

### Example: Multi-Server `mcp.json` for Reference

Here's what a workspace config looks like with all three servers from this guide:

```json
{
  "servers": {
    "github": {
      "type": "http",
      "url": "https://api.githubcopilot.com/mcp"
    },
    "playwright": {
      "command": "npx",
      "args": ["-y", "@playwright/mcp"]
    },
    "fetch": {
      "command": "npx",
      "args": ["-y", "@anthropic-ai/fetch-mcp"]
    }
  }
}
```

---

## Quick Reference: Common Commands

| Action | How |
|---|---|
| Open MCP Gallery | `Ctrl+Shift+X` → type `@mcp` |
| Open/create workspace MCP config | Create `.vscode/mcp.json` in project root |
| Open user MCP config | Command Palette → `MCP: Open User Configuration` |
| View available tools | Click 🛠️ in Agent mode Chat |
| View server logs | Output panel → dropdown → `MCP: [server-name]` |
| Start/restart a server | Click **Start** / **Restart** in `mcp.json` or Command Palette → `MCP: List Servers` |
| Open Chat Customizations | Command Palette → `Chat: Open Chat Customizations` |

---

## Further Resources

- [VS Code MCP Documentation](https://code.visualstudio.com/docs/copilot/customization/mcp-servers) — Official reference for configuration, schema, and troubleshooting.
- [GitHub Docs: Extending Copilot with MCP](https://docs.github.com/copilot/customizing-copilot/using-model-context-protocol/extending-copilot-chat-with-mcp) — GitHub's guide to MCP in Copilot.
- [GitHub MCP Server Repo](https://github.com/github/github-mcp-server) — Source code, toolsets, and advanced configuration for the GitHub MCP server.
- [Playwright MCP Server Repo](https://github.com/microsoft/playwright-mcp) — Full argument reference and configuration options.
- [MCP Specification](https://modelcontextprotocol.io) — The protocol spec itself, if you want to understand the internals or build your own server.
- [awesome-mcp-servers](https://github.com/punkpeye/awesome-mcp-servers) — Community directory of hundreds of MCP servers.
