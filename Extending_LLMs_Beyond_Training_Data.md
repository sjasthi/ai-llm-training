# Extending LLMs Beyond Training Data

## Introduction

Large Language Models (LLMs) are trained on massive datasets, but their
built-in knowledge is static and limited to the time of training. To
make them useful in real-world, dynamic environments, they are extended
with external mechanisms that allow them to access, retrieve, compute,
and interact with up-to-date or private information.

This document introduces the major ways LLMs can be extended beyond
their base training data.

------------------------------------------------------------------------

## 1. Tool / API Calls

LLMs can interact with external systems through APIs to fetch real-time
or specialized data.

## 2. Retrieval-Augmented Generation (RAG)

Embeddings enable semantic search and power RAG systems.

Uses vector search and retrieved documents to ground answers in private
knowledge.

-   What is RAG?
-   Why RAG is needed
-   Embeddings
-   Vector Databases
-   Chunking strategies
-   Similarity search
-   Retrieval
-   Context injection
-   Answer generation

Popular vector databases: - Pinecone - Chroma - Milvus - Qdrant -
Weaviate - pgvector

## 3. MCP (Model Context Protocol)

A standardized protocol for connecting LLMs to external tools and data
sources.

## 4. Function Calling / Tool Use

LLMs request structured function execution instead of hallucinating
answers.

## 5. Web Browsing / Agentic Search

Allows models to actively search and summarize current information.

## 6. Memory Systems

Stores user preferences and long-term information across sessions.

## 7. Code Execution Environments

Uses Python, SQL, and other runtimes for accurate computation.

## 8. Agent Frameworks

Coordinates multi-step reasoning and tool orchestration.

## 9. Prompt Engineering and In-Context Learning

-   Zero-shot prompting
-   One-shot prompting
-   Few-shot prompting
-   Chain-of-Thought prompting
-   Role prompting
-   Structured prompting

**Key idea:** Better prompts often produce dramatically better results
without changing model weights.

## 10. Fine-Tuning and LoRA

Fine-tuning changes model behavior permanently while LoRA/PEFT provides
lightweight adaptation.

## 11. Multi-Agent Systems

Multiple specialized agents collaborate to solve complex tasks.

## 12. Human-in-the-Loop

Humans approve or supervise critical AI decisions.

------------------------------------------------------------------------

# Comparison of Extension Techniques

  Technique            Retrains Model?   External Data?   Real-Time?   Cost
  -------------------- ----------------- ---------------- ------------ -----------
  Prompt Engineering   No                No               Yes          Very Low
  Few-shot Learning    No                Temporary        Yes          Very Low
  Tool/API Calls       No                Yes              Yes          Low
  Function Calling     No                Yes              Yes          Low
  RAG                  No                Yes              Yes          Low
  MCP                  No                Yes              Yes          Low
  Memory               No                Yes              Yes          Low
  Code Execution       No                Runtime          Yes          Low
  Agents               No                Yes              Yes          Medium
  Fine-Tuning          Yes               Internalized     No           Medium
  LoRA                 Yes               Internalized     No           Medium
  Full Training        Yes               Internalized     No           Very High

------------------------------------------------------------------------

# Choosing the Right Technique

  Need                       Recommended Technique
  -------------------------- -----------------------
  Better answers             Prompt Engineering
  Current/Latest data        API Calls
  Company documents          RAG
  Data Analysis              Python Code Execution
  Database Queries           SQL Invocation
  Enterprise integrations    MCP
  Computation                Code Execution
  User Personalization       Memory
  Domain Specialization      Fine-Tuning
  Multi-step automation      Agents
  Domain-specific behavior   Fine-Tuning / LoRA

  
Decision Flow:

``` text
Need Better AI?
    |
    +-- Better behavior? --> Prompt Engineering / Fine-Tuning
    |
    +-- New knowledge?
            |
            +-- Live? --> APIs
            |
            +-- Private? --> RAG
            |
            +-- Compute? --> Code Execution
            |
            +-- Workflow? --> Agents
            |
            +-- Personalized? --> Memory
            |
            +-- Enterprise Systems? --> MCP
```

## Final Thought

Modern AI systems combine reasoning, retrieval, tools, memory,
execution, and orchestration to extend LLM capabilities far beyond their
original training data.
