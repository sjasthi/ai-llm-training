# AI Prompt Patterns Reference Guide (Expanded Edition)

## Introduction

Prompt patterns are reusable design structures that help guide Large Language Models (LLMs) to produce better, more reliable, and more structured outputs.

This guide contains **23 practical prompt patterns** used in education, software engineering, AI agents, and business applications.

---

# 1. Persona Pattern

Assign a role to the AI.

```text id="p1"
Act as a [role] and perform the task.
```

---

# 2. Flipped Interaction Pattern

AI asks questions before answering.

```text id="p2"
Ask me questions one at a time until you have enough information.
```

---

# 3. N-Shot Prompting Pattern

Use examples to guide output.

```text id="p3"
A → B
C → D
X →
```

---

# 4. Directional Stimulus Pattern

Guide attention using hints.

```text id="p4"
Focus on:
- Key idea 1
- Key idea 2
```

---

# 5. Template Pattern

Force structured output.

```text id="p5"
Title:
Summary:
Key Points:
```

---

# 6. Meta Language Pattern

Create reusable commands.

```text id="p6"
When I say "Summary", do X, Y, Z.
```

---

# 7. Chain-of-Thought Pattern

Encourage step-by-step reasoning.

```text id="p7"
Solve step by step and explain reasoning.
```

---

# 8. Socratic Tutor Pattern

Teach using guided discovery.

```text id="p8"
Do not give the answer. Ask guiding questions.
```

---

# 9. Chain-of-Questions Pattern (NEW)

Break reasoning into a structured sequence of questions.

```text id="p9"
Solve this by answering these questions in order:
1. What is being asked?
2. What do we know?
3. What rules apply?
4. What is the solution?
```

---

# 10. Critic Pattern

Review and improve content.

```text id="p10"
Review the output and identify improvements.
```

---

# 11. Reflection Pattern

Generate → evaluate → improve.

```text id="p11"
Create a solution, then evaluate it and improve it.
```

---

# 12. Self-Refine Pattern (NEW)

Iterative improvement loop.

```text id="p12"
Step 1: Generate answer
Step 2: Critique it
Step 3: Improve it
Step 4: Final answer
```

---

# 13. Chain-of-Verification Pattern (NEW)

Verify claims systematically.

```text id="p13"
Answer the question.

Then verify:
- Facts
- Logic
- Calculations

Revise if needed.
```

---

# 14. Step-by-Step Decomposition Pattern

Break tasks into smaller parts.

```text id="p14"
Break into phases and solve each phase.
```

---

# 15. Audience Pattern

Adapt to target audience.

```text id="p15"
Explain to a 7th-grade student.
```

---

# 16. Output Constraints Pattern

Control format and limits.

```text id="p16"
Answer in 5 bullets, max 15 words each.
```

---

# 17. Expert Panel Pattern

Multiple expert perspectives.

```text id="p17"
Analyze from teacher, parent, and student perspectives.
```

---

# 18. Debate Pattern

Present opposing views.

```text id="p18"
Present arguments for and against.
```

---

# 19. Checklist Pattern

Evaluate using criteria.

```text id="p19"
Check:
- Security
- Performance
- Scalability
```

---

# 20. Self-Consistency Pattern

Generate multiple solutions and compare.

```text id="p20"
Solve in multiple ways and select best answer.
```

---

# 21. Tree-of-Thought Pattern

Explore multiple reasoning paths.

```text id="p21"
Generate options, evaluate, and select best path.
```

---

# 22. Least-to-Most Pattern

Start simple → build complexity.

```text id="p22"
Solve in increasing difficulty steps.
```

---

# 23. ReAct Pattern (Reason + Act)

Reason, act, observe, repeat.

```text id="p23"
Think → Act → Observe → Update reasoning.
```

---

# Key Insight

The real power of prompt engineering comes from **combining patterns**, not using them individually.

Example:

* Persona + Audience + Template + Least-to-Most + Reflection

---

# End of Guide
