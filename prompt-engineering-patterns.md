# Prompt Engineering Patterns: A Reference Guide

## Introduction

Prompt patterns are reusable design structures that help guide Large Language Models (LLMs) to produce better, more reliable, and more structured outputs.

This guide contains **37 practical prompt patterns** used in software engineering, AI agents, learning, and business applications.

---

## Section A — Foundational Patterns

### 1. Persona
  
**Definition:** Assign a role to shape tone, expertise, and style.**When to use:** When domain expertise or perspective matters.  
**Example:**Act as a senior DevOps architect. Review this CI/CD pipeline and suggest improvements.

### 2. Audience
  
**Definition:** Tailor output to a specific audience level.**When to use:** When clarity and communication style matter.  
**Example:**Explain Kubernetes autoscaling to a non-technical business stakeholder.

### 3. Template
  
**Definition:** Enforce structured output.**When to use:** For consistency and reuse.  
**Example:**Provide output in this format:
- Title:
- Summary:
- Risks:
- Recommendations:

### 4. Output Constraints
  
**Definition:** Restrict format, length, or style.**When to use:** For precision and token control.  
**Example:**Summarize in 5 bullets, max 12 words each.

### 5. Meta Language
  
**Definition:** Define reusable instructions or command shortcuts.**When to use:** For complex workflows or repeated commands.  
**Example:**When I say "Audit Mode", perform:
- Risk analysis
- Compliance assessment
- Gap identification

### 6. N-Shot Prompting
  
**Definition:** Provide examples to guide model behavior.**When to use:** When output must follow a pattern.  
**Example:**A → B
C → D
X →

### 7. Directional Stimulus
  
**Definition:** Guide attention using hints or focus areas.**When to use:** When you want to steer reasoning without strict constraints.  
**Example:**Focus on:
- Security risks
- Compliance gaps

## Section B — Reasoning Patterns

### 8. Chain-of-Thought
  
**Definition:** Step-by-step reasoning.**Example:**Solve step-by-step and explain reasoning.

### 9. Chain-of-Questions
  
**Definition:** Solve via structured questions.**Example:**Answer in order:
- What is the problem?
- What are constraints?
- What approaches exist?
- Final answer?

### 10. Least-to-Most
  
**Definition:** Start simple → increase complexity.**Example:**Break this problem into simple steps and gradually build to full solution.

### 11. Tree-of-Thought
  
**Definition:** Explore multiple reasoning paths before selecting best.**Example:**Generate 3 approaches, evaluate pros/cons, then pick best.

### 12. Self-Consistency
  
**Definition:** Generate multiple answers and select most consistent.**Example:**Solve this 3 different ways and select the most consistent answer.

### 13. ReAct (Reason + Act)
  
**Definition:** Combine reasoning with actions/tool use.**Example:**Think → Act → Observe → Refine until solution is complete.

## Section C — Evaluation Patterns

### 14. Critic
  
**Definition:** Evaluate and suggest improvements.**Example:**Review this design and identify weaknesses.

### 15. Reflection
  
**Definition:** Generate → evaluate → improve.**Example:**Create a solution, then critique it, then improve it.

### 16. Self-Refine
  
**Definition:** Iterative improvement loop.**Example:**Step 1: Generate
Step 2: Critique
Step 3: Improve
Step 4: Final answer

### 17. Chain-of-Verification
  
**Definition:** Systematic validation.**Example:**Verify:
- Facts
- Logic
- Assumptions

### 18. Checklist
  
**Definition:** Evaluate against predefined criteria.**Example:**Check for:
- Security
- Performance
- Compliance

## Section D — Multi-Perspective Patterns

### 19. Expert Panel
  
**Definition:** Multiple expert viewpoints.**Example:**Analyze from:
- Security architect
- DevOps lead
- Product manager

### 20. Debate
  
**Definition:** Present opposing views.**Example:**Provide arguments for and against microservices adoption.

### 21. Socratic Tutor
  
**Definition:** Guide via questions instead of answers.**Example:**Do not answer directly. Ask questions to guide learning.

## Section E — Agentic & Workflow Patterns

### 22. Planning
  
**Definition:** Decompose tasks into executable steps.**Example:**Break this into execution plan with phases and milestones.

### 23. Tool Selection
  
**Definition:** Decide which tools/actions to use.**Example:**Select appropriate tools for:
- Data retrieval
- Analysis
- Visualization

### 24. Retrieval
  
**Definition:** Pull in relevant knowledge before answering.**Example:**Use available documents to answer with citations.

### 25. Playbook
  
**Definition:** Structured, repeatable workflow.**Example:**Create a step-by-step playbook for incident response.

### 26. Progressive Disclosure
  
**Definition:** Ask clarifying questions before full answer.**Example:**Ask questions one at a time until problem is clear.

### 27. Flipped Interaction
  
**Definition:** Ask questions before answering to gather context.**When to use:** When requirements are unclear.  
**Example:**Ask me one question at a time until you can answer accurately.

### 28. Agent Handoff
  
**Definition:** Transition between roles/agents.**Example:**First act as analyst, then switch to reviewer, then final approver.

### 29. Step-by-Step Decomposition
  
**Definition:** Break tasks into sequential phases.**When to use:** For complex workflows.  
**Example:**Break into phases:
1. Data collection
2. Analysis
3. Implementation
4. Validation

## Section F — Token Optimization Patterns

### 30. Context Compression
  
**Definition:** Summarize context to reduce tokens.**Example:**Summarize this document into key points before analysis.

### 31. Context Reset
  
**Definition:** Clear prior context to avoid drift.**Example:**Ignore all previous instructions. Start fresh with this task.

### 32. Session Isolation
  
**Definition:** Keep tasks independent.**Example:**Treat this request as a separate session from prior conversation.

### 33. File Reference
  
**Definition:** Operate only on provided artifacts.**Example:**Use only the attached file for your analysis.

### 34. Diff Pattern
  
**Definition:** Show only changes.**Example:**Provide only the differences between version A and B.

### 35. One-Hop Change
  
**Definition:** Make minimal targeted modification.**Example:**Only fix grammar errors. Do not modify content.

### 36. Context Budget
  
**Definition:** Manage token usage explicitly.**Example:**Limit reasoning + output to under 300 tokens.

### 37. Cost-Aware
  
**Definition:** Optimize for cost-efficient responses.**Example:**Provide concise answer with minimal tokens while preserving accuracy.

## Key Insight
  
The real power comes from **pattern composition**:  
Example:
Persona + Audience + Template + Least-to-Most + Reflection  
→ Produces reliable, structured, and high-quality outputs
