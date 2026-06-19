# Extending LLMs Beyond Training Data

## Introduction

Large Language Models (LLMs) are trained on massive datasets, but their built-in knowledge is static and limited to the time of training. To make them useful in real-world, dynamic environments, they are extended with external mechanisms that allow them to access, retrieve, compute, and interact with up-to-date or private information.

This document introduces the major techniques used to extend LLM capabilities beyond their base training data.

---

## 1. Tool Calling (aka Function Calling)

**Definition:**  
Tool calling allows an LLM to invoke external capabilities (APIs, services, or runtimes) instead of relying only on its internal knowledge.

**Examples of Tools:**
- Web Search (Bing, Google, Wikipedia)
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
5. LLM uses the result to generate the final answer  

**Typical Capability Mapping:**

| Tool Type    | Example Usage       | Target System      |
|--------------|--------------------|-------------------|
| API Call     | Get weather        | External Service  |
| Python       | Data analysis      | Runtime           |
| SQL          | Query data         | Database          |
| Search       | Latest information | Search Engine     |
| DevOps APIs  | Repo queries       | GitHub/GitLab     |

**Example:**
User: “What is the current temperature in Shoreview, MN?”  
→ LLM calls Weather API  
→ Returns real-time result  

**Key Benefits:**
- Enables real-time data access  
- Reduces hallucinations  
- Extends LLM capabilities beyond training  

**When to Use:**
- Need real-time or external data  
- Need integration with enterprise systems  

**Avoid When:**
- No reliable API/tool exists  
- Data is static and already known  

---

## 2. Retrieval-Augmented Generation (RAG)

**Definition:**  
RAG enables LLMs to retrieve relevant documents from external sources and use them to generate grounded responses.

**Key Concepts:**
- Embeddings  
- Vector databases  
- Chunking  
- Similarity search  
- Context injection  

**Popular Vector Databases:**
- Pinecone  
- Chroma  
- Milvus  
- Qdrant  
- Weaviate  
- pgvector  

**Example:**
User: “What is our company’s PTO policy?”  
→ LLM retrieves internal documents  
→ Generates answer grounded in company data  

**When to Use:**
- Private/company-specific data  
- Frequently updated knowledge  

**Avoid When:**
- Dataset is small and static  
- Latency must be minimal  

---

## 3. MCP (Model Context Protocol)

**Definition:**  
A standardized protocol for connecting LLMs to external tools, systems, and enterprise platforms.

**Typical Use Cases:**
- Enterprise integrations  
- Multi-system orchestration  
- Standardized tool access  

---

## 4. Web Browsing / Agentic Search

Allows LLMs to actively search for and summarize live information.

**Use Cases:**
- News  
- Market trends  
- Latest updates  

---

## 5. Memory Systems

Stores user preferences and long-term context across sessions.

**Use Cases:**
- Personalization  
- Conversational continuity  

---

## 6. Code Execution Environments

Allows LLMs to run Python, SQL, or other code for precise computation.

**Use Cases:**
- Data analysis  
- Calculations  
- Transformations  

---

## 7. Agent Frameworks

Coordinates multi-step reasoning and orchestrates multiple tools.

**Use Cases:**
- Automation workflows  
- Complex tasks  
- Multi-step reasoning  

---

## 8. Prompt Engineering and In-Context Learning

Improves performance by structuring input prompts.

**Techniques:**
- Zero-shot  
- One-shot  
- Few-shot  
- Chain-of-Thought  
- Role prompting  
- Structured prompting  

**Key Insight:**  
Better prompts often significantly improve results without changing model weights.

---

## 9. Fine-Tuning and LoRA

**Definition:**
- Fine-tuning modifies model behavior permanently  
- LoRA/PEFT provides lightweight adaptation  

**Use Cases:**
- Domain-specific behavior  
- Specialized outputs  

**Trade-off:**
- Requires training effort and cost  
- Not suitable for frequently changing requirements  

---

## 10. Embeddings and Vector Databases

Power semantic search and enable RAG systems.

---

## 11. Multi-Agent Systems

Multiple specialized agents collaborate to solve complex tasks.

---

## 12. Human-in-the-Loop

Humans validate or approve AI decisions for critical tasks.

---

## Comparison of Extension Techniques

| Technique           | Retrains Model? | Uses External Data? | Real-Time? | Cost       |
|--------------------|----------------|--------------------|------------|------------|
| Prompt Engineering | No             | No                 | Yes        | Very Low   |
| Few-shot Learning  | No             | Temporary          | Yes        | Very Low   |
| Tool/API Calls     | No             | Yes                | Yes        | Low        |
| RAG                | No             | Yes                | Yes        | Low        |
| MCP                | No             | Yes                | Yes        | Low        |
| Memory             | No             | Yes                | Yes        | Low        |
| Code Execution     | No             | Runtime            | Yes        | Low        |
| Agents             | No             | Yes                | Yes        | Medium     |
| Fine-Tuning        | Yes            | Internalized       | No         | Medium     |
| LoRA               | Yes            | Internalized       | No         | Medium     |
| Full Training      | Yes            | Internalized       | No         | Very High  |

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

| Need                    | Recommended Technique       |
|-------------------------|-----------------------------|
| Better answers          | Prompt Engineering          |
| Current/latest data     | Tool/API Calls              |
| Company documents       | RAG                         |
| Data analysis           | Code Execution (Python)     |
| Database queries        | SQL                         |
| Enterprise integrations | MCP                         |
| Computation             | Code Execution              |
| Personalization         | Memory                      |
| Domain specialization   | Fine-Tuning / LoRA          |
| Multi-step automation   | Agents                      |

---

## Decision Guide

| Goal                        | Approach                     |
|-----------------------------|------------------------------|
| Improve behavior            | Prompt Engineering / Fine-Tuning |
| Add real-time knowledge     | Tool/API Calls               |
| Use private data            | RAG                          |
| Perform computation         | Code Execution               |
| Automate workflows          | Agents                       |
| Personalize experience      | Memory                       |
| Integrate enterprise systems| MCP                          |

---

## Final Thought

Modern AI systems combine reasoning, retrieval, tools, memory, execution, and orchestration to extend LLM capabilities far beyond their original training data.
