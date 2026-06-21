## 🧠 Prompt Engineering Patterns: A Reference Guide

### 📘 Introduction

Prompt patterns are reusable design structures that help guide Large Language Models (LLMs) to produce better, more reliable, and more structured outputs.
This guide contains **37 practical prompt patterns** used in software engineering, AI agents, learning, and business applications.

---

## Section A — Foundational Patterns

### Learning Objective
Understand the structural building blocks that shape tone, format, and control.

---

### 1. Persona 🎭
**Definition:** Assign a role to shape tone, expertise, and style.

**When to use:** When domain expertise or perspective matters.

**Example:**
Act as a senior DevOps architect. Review this CI/CD pipeline and suggest improvements.

**Note:**
Use this pattern to show how the exact same task changes when the model is asked to act as an architect, auditor, product manager, or instructor.

**Practice Exercise:**
Rewrite one prompt three ways: as a security reviewer, product manager, and support engineer.

---

### 2. Audience 👥
**Definition:** Tailor output to a specific audience level.

**When to use:** When clarity and communication style matter.

**Example:**
Explain Kubernetes autoscaling to a non-technical business stakeholder.

**Note:**
Emphasize that the same factual content can be reframed for executives, contributors, customers, or students.

**Practice Exercise:**
Explain the same technical concept for an executive and then for a new engineer.

---

### 3. Template 🧩
**Definition:** Enforce structured output.

**When to use:** For consistency and reuse.

**Example:**
Provide output in this format:
- Title:
- Summary:
- Risks:
- Recommendations:

**Note:**
Templates are especially useful for repeatable reviews, audit evidence summaries, release notes, and status updates.

**Practice Exercise:**
Create a template for design review feedback.

---

### 4. Output Constraints 📏
**Definition:** Restrict format, length, or style.

**When to use:** For precision and token control.

**Example:**
Summarize in 5 bullets, max 12 words each.

**Note:**
This is valuable when outputs need to fit slides, dashboards, status mails, or executive summaries.

**Practice Exercise:**
Ask for a summary in 3 bullets, then in 1 sentence, then in 50 words.

---

### 5. Meta Language 🏷️
**Definition:** Define reusable instructions or command shortcuts.

**When to use:** For complex workflows or repeated commands.

**Example:**
When I say "Audit Mode", perform:
- Risk analysis
- Compliance assessment
- Gap identification

**Note:**
This pattern is useful for creating reusable shorthand in long-running sessions.

**Practice Exercise:**
Define a custom command called "Review Mode" for code or document analysis.

---

### 6. N-Shot Prompting 🧪
**Definition:** Provide examples to guide model behavior.

**When to use:** When output must follow a pattern.

**Example:**
A → B
C → D
X →

**Note:**
Explain that examples often outperform vague instructions when consistency matters.

**Practice Exercise:**
Provide two examples of desired bug triage output, then ask for a third.

---

### 7. Directional Stimulus 🎯
**Definition:** Guide attention using hints or focus areas.

**When to use:** When you want to steer reasoning without strict constraints.

**Example:**
Focus on:
- Security risks
- Compliance gaps

**Note:**
Great for steering the model toward risk, user value, performance, or edge cases.

**Practice Exercise:**
Prompt the model to review a design with emphasis on scalability and maintainability.

---

## Section B — Reasoning Patterns

### Learning Objective
Learn how to guide problem solving, analysis, and exploration.

---

### 8. Chain-of-Thought 🪜
**Definition:** Step-by-step reasoning.

**Example:**
Solve step-by-step and explain reasoning.

**Note:**
Use with care when you want a visible reasoning structure for learning or debugging.

**Practice Exercise:**
Apply it to a troubleshooting or planning scenario.

---

### 9. Chain-of-Questions ❓
**Definition:** Solve via structured questions.

**Example:**
Answer in order:
- What is the problem?
- What are constraints?
- What approaches exist?
- Final answer?

**Note:**
Helpful when teams need more disciplined thinking rather than immediate conclusions.

**Practice Exercise:**
Create a question chain for selecting a new internal tool.

---

### 10. Least-to-Most 📈
**Definition:** Start simple → increase complexity.

**Example:**
Break this problem into simple steps and gradually build to full solution.

**Note:**
Excellent for teaching, onboarding, and reducing overwhelm on difficult tasks.

**Practice Exercise:**
Use it to explain a multi-step DevOps workflow from beginner to advanced level.

---

### 11. Tree-of-Thought 🌳
**Definition:** Explore multiple reasoning paths before selecting best.

**Example:**
Generate 3 approaches, evaluate pros/cons, then pick best.

**Note:**
Useful when there is no single obvious path and trade-offs matter.

**Practice Exercise:**
Compare three approaches to incident triage or process automation.

---

### 12. Self-Consistency 🔁
**Definition:** Generate multiple answers and select most consistent.

**Example:**
Solve this 3 different ways and select the most consistent answer.

**Note:**
Show how repeated reasoning can improve reliability for nuanced or ambiguous tasks.

**Practice Exercise:**
Ask for multiple summaries, then compare common themes.

---

### 13. ReAct (Reason + Act) ⚡
**Definition:** Combine reasoning with actions/tool use.

**Example:**
Think → Act → Observe → Refine until solution is complete.

**Note:**
This is a useful bridge into copilots, agents, and tool-enabled workflows.

**Practice Exercise:**
Ask learners to design a prompt that retrieves information, analyzes it, and revises the answer.

---

## Section C — Evaluation Patterns

### Learning Objective
Use patterns that improve quality, correctness, and confidence before finalizing outputs.

---

### 14. Critic 🧾
**Definition:** Evaluate and suggest improvements.

**Example:**
Review this design and identify weaknesses.

**Note:**
Good for design reviews, document QA, and response improvement.

**Practice Exercise:**
Have the model critique its own executive summary.

---

### 15. Reflection 🔁
**Definition:** Generate → evaluate → improve.

**Example:**
Create a solution, then critique it, then improve it.

**Note:**
This is one of the easiest ways to improve draft quality.

**Practice Exercise:**
Generate an email, reflect on tone and clarity, then improve it.

---

### 16. Self-Refine 🔧
**Definition:** Iterative improvement loop.

**Example:**
Step 1: Generate
Step 2: Critique
Step 3: Improve
Step 4: Final answer

**Note:**
Useful when outputs benefit from one or two visible refinement cycles.

**Practice Exercise:**
Run a two-pass refinement on a policy summary.

---

### 17. Chain-of-Verification ✅
**Definition:** Systematic validation.

**Example:**
Verify:
- Facts
- Logic
- Assumptions

**Note:**
Strong pattern for audit, compliance, requirements review, and technical analysis.

**Practice Exercise:**
Review a recommendation and explicitly verify assumptions before finalizing it.

---

### 18. Checklist 📋
**Definition:** Evaluate against predefined criteria.

**Example:**
Check for:
- Security
- Performance
- Compliance

**Note:**
This pattern turns abstract review into repeatable quality control.

**Practice Exercise:**
Create a checklist for production-readiness review.

---

## Section D — Multi-Perspective Patterns

### Learning Objective
See how different viewpoints improve completeness and reduce blind spots.

---

### 19. Expert Panel 🧠
**Definition:** Multiple expert viewpoints.

**Example:**
Analyze from:
- Security architect
- DevOps lead
- Product manager

**Note:**
This pattern is helpful for cross-functional decisions and trade-off discussions.

**Practice Exercise:**
Run an expert panel review on a proposed AI feature.

---

### 20. Debate ⚖️
**Definition:** Present opposing views.

**Example:**
Provide arguments for and against microservices adoption.

**Note:**
Useful for surfacing assumptions, risks, and alternatives.

**Practice Exercise:**
Debate build vs buy for an internal tool.

---

### 21. Socratic Tutor 🎓
**Definition:** Guide via questions instead of answers.

**Example:**
Do not answer directly. Ask questions to guide learning.

**Note:**
Great for learning sessions, coaching, and self-discovery.

**Practice Exercise:**
Use Socratic questions to help a learner understand why a deployment failed.

---

## Section E — Agentic & Workflow Patterns

### Learning Objective
Understand how patterns support planning, tool use, retrieval, and multi-step workflows.

---

### 22. Planning 🗺️
**Definition:** Decompose tasks into executable steps.

**Example:**
Break this into execution plan with phases and milestones.

**Note:**
Works well for implementation plans, rollout planning, and workshop sequencing.

**Practice Exercise:**
Create a rollout plan for an internal AI pilot.

---

### 23. Tool Selection 🛠️
**Definition:** Decide which tools/actions to use.

**Example:**
Select appropriate tools for:
- Data retrieval
- Analysis
- Visualization

**Note:**
Important when models can search, retrieve, summarize, or transform content.

**Practice Exercise:**
Given a business question, decide whether to search files, meetings, chats, or web sources.

---

### 24. Retrieval 📚
**Definition:** Pull in relevant knowledge before answering.

**Example:**
Use available documents to answer with citations.

**Note:**
Highlight that grounding improves trust and reduces unsupported claims.

**Practice Exercise:**
Answer a question using only provided reference material.

---

### 25. Playbook 📖
**Definition:** Structured, repeatable workflow.

**Example:**
Create a step-by-step playbook for incident response.

**Note:**
A playbook is one of the most practical outcomes of prompt engineering for enterprise teams.

**Practice Exercise:**
Build a mini playbook for release readiness review.

---

### 26. Progressive Disclosure 🔍
**Definition:** Ask clarifying questions before full answer.

**Example:**
Ask questions one at a time until problem is clear.

**Note:**
Use this to show that better inputs lead to better outputs.

**Practice Exercise:**
Have the model clarify a vague request before solving it.

---

### 27. Flipped Interaction 🔄
**Definition:** Ask questions before answering to gather context.

**When to use:** When requirements are unclear.

**Example:**
Ask me one question at a time until you can answer accurately.

**Note:**
This pattern makes the model behave more like a consultant or facilitator.

**Practice Exercise:**
Use it on a vague request such as “help me improve this process.”

---

### 28. Agent Handoff 🔁
**Definition:** Transition between roles/agents.

**Example:**
First act as analyst, then switch to reviewer, then final approver.

**Note:**
Good for demonstrating staged workflows and quality gates.

**Practice Exercise:**
Split a task into analyst → reviewer → decision-maker stages.

---

### 29. Step-by-Step Decomposition 🧱
**Definition:** Break tasks into sequential phases.

**When to use:** For complex workflows.

**Example:**
Break into phases:
- Data collection
- Analysis
- Implementation
- Validation

**Note:**
Useful for structured execution when the task has dependencies.

**Practice Exercise:**
Break a migration or audit-prep task into phases.

---

## Section F — Token Optimization Patterns

### Learning Objective
Learn how to control context size, reduce cost, and improve efficiency.

---

### 30. Context Compression 🗜️
**Definition:** Summarize context to reduce tokens.

**Example:**
Summarize this document into key points before analysis.

**Note:**
Show how summarization can make later prompts cleaner and cheaper.

**Practice Exercise:**
Compress a long transcript into a short planning brief.

---

### 31. Context Reset 🔄
**Definition:** Clear prior context to avoid drift.

**Example:**
Ignore all previous instructions. Start fresh with this task.

**Note:**
Helpful when a conversation has drifted or the new task is unrelated.

**Practice Exercise:**
Compare outputs with and without resetting context.

---

### 32. Session Isolation 🧳
**Definition:** Keep tasks independent.

**Example:**
Treat this request as a separate session from prior conversation.

**Note:**
Useful when multiple projects or topics should not mix.

**Practice Exercise:**
Ask for two similar tasks and explicitly isolate them.

---

### 33. File Reference 📎
**Definition:** Operate only on provided artifacts.

**Example:**
Use only the attached file for your analysis.

**Note:**
Important when you want grounded analysis and limited scope.

**Practice Exercise:**
Review one file without using outside context.

---

### 34. Diff Pattern 🔍
**Definition:** Show only changes.

**Example:**
Provide only the differences between version A and B.

**Note:**
This pattern is highly useful for review workflows and version comparisons.

**Practice Exercise:**
Compare two drafts and return only the changed items.

---

### 35. One-Hop Change 🎯
**Definition:** Make minimal targeted modification.

**Example:**
Only fix grammar errors. Do not modify content.

**Note:**
Ideal when users want high control over edit scope.

**Practice Exercise:**
Apply only formatting fixes to a draft.

---

### 36. Context Budget 📊
**Definition:** Manage token usage explicitly.

**Example:**
Limit reasoning + output to under 300 tokens.

**Note:**
Useful when optimizing for speed, UI space, or cost.

**Practice Exercise:**
Ask for the same answer in 300 tokens and then in 75 tokens.

---

### 37. Cost-Aware 💡
**Definition:** Optimize for cost-efficient responses.

**Example:**
Provide concise answer with minimal tokens while preserving accuracy.

**Note:**
Useful for scaled AI adoption where efficiency matters.

**Practice Exercise:**
Rewrite a long prompt into a shorter cost-aware version.

---

## Food for Thought

Can you improve a weak prompt using at least four patterns from different sections?
Suggested format:
1. Original prompt
2. Chosen patterns
3. Revised prompt
4. Why the revised version is stronger

---

## Key Takeaway

The strongest prompts often combine patterns.
A practical combination for workplace use is:
- Persona
- Audience
- Template
- Reflection
- Checklist

This combination improves clarity, structure, quality, and usability.

---
