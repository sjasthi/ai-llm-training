
# Prompt Engineering Patterns — Comprehensive Reference

---

# Section A — Foundational Patterns

## 1. Persona
**Definition:** Assign a role to shape tone, expertise, and style.  
**When to use:** When domain expertise or perspective matters.

**Example:**
Act as a senior DevOps architect. Review this CI/CD pipeline and suggest improvements.

---

## 2. Audience
**Definition:** Tailor output to a specific audience level.  
**When to use:** When clarity and communication style matter.

**Example:**
Explain Kubernetes autoscaling to a non-technical business stakeholder.

---

## 3. Template
**Definition:** Enforce structured output.  
**When to use:** For consistency and reuse.

**Example:**
Provide output in this format:
- Title:
- Summary:
- Risks:
- Recommendations:

---

## 4. Output Constraints
**Definition:** Restrict format, length, or style.  
**When to use:** For precision and token control.

**Example:**
Summarize in 5 bullets, max 12 words each.

---

## 5. Meta Language
**Definition:** Define reusable instructions or command shortcuts.  
**When to use:** For complex workflows or repeated commands.

**Example:**
When I say "Audit Mode", perform:
1. Risk analysis
2. Compliance assessment
3. Gap identification

---

# Section B — Reasoning Patterns

## 6. Chain-of-Thought
**Definition:** Step-by-step reasoning.  
**Example:**
Solve step-by-step and explain reasoning.

---

## 7. Chain-of-Questions
**Definition:** Solve via structured questions.  
**Example:**
Answer in order:
1. What is the problem?
2. What are constraints?
3. What approaches exist?
4. Final answer?

---

## 8. Least-to-Most
**Definition:** Start simple → increase complexity.  
**Example:**
Break this problem into simple steps and gradually build to full solution.

---

## 9. Tree-of-Thought
**Definition:** Explore multiple reasoning paths before selecting best.  
**Example:**
Generate 3 approaches, evaluate pros/cons, then pick best.

---

## 10. Self-Consistency
**Definition:** Generate multiple answers and select most consistent.  
**Example:**
Solve this 3 different ways and select the most consistent answer.

---

## 11. ReAct (Reason + Act)
**Definition:** Combine reasoning with actions/tool use.  
**Example:**
Think → Act → Observe → Refine until solution is complete.

---

# Section C — Evaluation Patterns

## 12. Critic
**Definition:** Evaluate and suggest improvements.  
**Example:**
Review this design and identify weaknesses.

---

## 13. Reflection
**Definition:** Generate → evaluate → improve.  
**Example:**
Create a solution, then critique it, then improve it.

---

## 14. Self-Refine
**Definition:** Iterative improvement loop.  
**Example:**
Step 1: Generate  
Step 2: Critique  
Step 3: Improve  
Step 4: Final answer

---

## 15. Chain-of-Verification
**Definition:** Systematic validation.  
**Example:**
Verify:
- Facts
- Logic
- Assumptions

---

## 16. Checklist
**Definition:** Evaluate against predefined criteria.  
**Example:**
Check for:
- Security
- Performance
- Compliance

---

# Section D — Multi-Perspective Patterns

## 17. Expert Panel
**Definition:** Multiple expert viewpoints.  
**Example:**
Analyze from:
- Security architect
- DevOps lead
- Product manager

---

## 18. Debate
**Definition:** Present opposing views.  
**Example:**
Provide arguments for and against microservices adoption.

---

## 19. Socratic Tutor
**Definition:** Guide via questions instead of answers.  
**Example:**
Do not answer directly. Ask questions to guide learning.

---

# Section E — Agentic & Workflow Patterns

## 20. Planning
**Definition:** Decompose tasks into executable steps.  
**Example:**
Break this into execution plan with phases and milestones.

---

## 21. Tool Selection
**Definition:** Decide which tools/actions to use.  
**Example:**
Select appropriate tools for:
- Data retrieval
- Analysis
- Visualization

---

## 22. Retrieval
**Definition:** Pull in relevant knowledge before answering.  
**Example:**
Use available documents to answer with citations.

---

## 23. Playbook
**Definition:** Structured, repeatable workflow.  
**Example:**
Create a step-by-step playbook for incident response.

---

## 24. Progressive Disclosure
**Definition:** Ask clarifying questions before full answer.  
**Example:**
Ask questions one at a time until problem is clear.

---

## 25. Agent Handoff
**Definition:** Transition between roles/agents.  
**Example:**
First act as analyst, then switch to reviewer, then final approver.

---

# Section F — Token Optimization Patterns

## 26. Context Compression
**Definition:** Summarize context to reduce tokens.  
**Example:**
Summarize this document into key points before analysis.

---

## 27. Context Reset
**Definition:** Clear prior context to avoid drift.  
**Example:**
Ignore all previous instructions. Start fresh with this task.

---

## 28. Session Isolation
**Definition:** Keep tasks independent.  
**Example:**
Treat this request as a separate session from prior conversation.

---

## 29. File Reference
**Definition:** Operate only on provided artifacts.  
**Example:**
Use only the attached file for your analysis.

---

## 30. Diff Pattern
**Definition:** Show only changes.  
**Example:**
Provide only the differences between version A and B.

---

## 31. One-Hop Change
**Definition:** Make minimal targeted modification.  
**Example:**
Only fix grammar errors. Do not modify content.

---

## 32. Context Budget
**Definition:** Manage token usage explicitly.  
**Example:**
Limit reasoning + output to under 300 tokens.

---

## 33. Cost-Aware
**Definition:** Optimize for cost-efficient responses.  
**Example:**
Provide concise answer with minimal tokens while preserving accuracy.

---

# Key Insight

The real power comes from **pattern composition**:

Example:
Persona + Audience + Template + Least-to-Most + Reflection

→ Produces reliable, structured, and high-quality outputs
