## Extending LLMs Beyond Training Data

### Introduction

Large Language Models (LLMs) are trained on massive datasets, but their built-in knowledge is static and limited to the time of training. To make them useful in real-world, dynamic environments, they are extended with external mechanisms that allow them to access, retrieve, compute, and interact with up-to-date or private information.

---

## 1. Tool Calling (aka Function Calling)

**Definition:**
Tool calling allows an LLM to invoke external capabilities (APIs, services, or runtimes) instead of relying only on its internal knowledge.

**Examples of Tools:**
- Web Search (Wikipedia, Bing, Google)
- Calculator
- Python execution
- SQL query engine
- Weather APIs
- GitHub / GitLab APIs
- Jira APIs

**How it works (conceptual flow):**
1. User asks a question
2. LLM determines a tool is required
3. LLM generates a structured tool call
4. Tool executes and returns result
5. LLM uses result to generate final answer

**Typical Capability Mapping:**

| Tool Type     | Example Usage        | Target System     |
|--------------|---------------------|------------------|
| API Call     | Get weather         | External Service |
| Python       | Data analysis       | Runtime          |
| SQL          | Query data          | Database         |
| Search       | Latest information  | Search Engine    |
| DevOps APIs  | Repo queries        | GitHub/GitLab    |

**Key Benefits:**
- Enables real-time data access
- Reduces hallucination
- Extends LLM capability beyond training

---

## 2. Retrieval-Augmented Generation (RAG)

Uses vector search and retrieved documents to ground answers in private knowledge.

---

## Comparison of Extension Techniques

| Technique            | Retrains Model? | External Data? | Real-Time? | Cost       |
|---------------------|----------------|----------------|-------------|------------|
| Prompt Engineering  | No             | No             | Yes         | Very Low   |
| Few-shot Learning   | No             | Temporary      | Yes         | Very Low   |
| Tool/API Calls      | No             | Yes            | Yes         | Low        |
| Function Calling    | No             | Yes            | Yes         | Low        |
| RAG                 | No             | Yes            | Yes         | Low        |
| MCP                 | No             | Yes            | Yes         | Low        |
| Memory              | No             | Yes            | Yes         | Low        |
| Code Execution      | No             | Runtime        | Yes         | Low        |
| Agents              | No             | Yes            | Yes         | Medium     |
| Fine-Tuning         | Yes            | Internalized   | No          | Medium     |
| LoRA                | Yes            | Internalized   | No          | Medium     |
| Full Training       | Yes            | Internalized   | No          | Very High  |

---

## Capability and Typical Target

| Capability        | Typical Target              |
|------------------|-----------------------------|
| API Call         | External Service            |
| Function Call    | Registered Tool             |
| Python Execution | Runtime                     |
| SQL Invocation   | Database                    |
| Web Search       | Search Engine               |
| RAG              | Vector Database             |
| MCP              | External Tool Ecosystem     |

---

## Choosing the Right Technique

| Need                    | Recommended Technique |
|-------------------------|----------------------|
| Better answers          | Prompt Engineering   |
| Current/Latest data     | API Calls            |
| Company documents       | RAG                  |
| Data Analysis           | Python Execution     |
| Database Queries        | SQL                  |
| Enterprise integrations | MCP                  |
| Computation             | Code Execution       |
| Personalization         | Memory               |
| Domain specialization   | Fine-Tuning / LoRA   |
| Automation workflows    | Agents               |

---

### Final Thought

Modern AI systems combine reasoning, retrieval, tools, memory, execution, and orchestration to extend LLM capabilities far beyond their original training data.
