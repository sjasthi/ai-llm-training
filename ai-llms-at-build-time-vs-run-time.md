# AI/LLM at Build-Time vs Run-Time

A practical guide to understanding where and how AI/LLMs should be used in modern software systems.

---

## 1. Core Distinction

| Aspect | Build-Time AI | Runtime AI |
|------|--------------|-----------|
| When used | During development | During application execution |
| Who uses it | Developers, testers, architects | End users or system workflows |
| Cost type | One-time / bounded | Recurring / usage-based |
| Examples | Code generation, test creation, debugging | Chatbots, copilots, recommendations |
| Default expectation | ✅ Everyone should use | ⚠️ Only where justified |

---

## 2. Build-Time AI (Default Expectation)

### What it means
Using AI/LLMs to **build software faster and better**, but NOT shipping AI as part of the runtime system.

### Typical Use Cases
- Code generation (GHCP, Claude Code)
- Test generation
- Documentation generation
- Code review
- Architecture understanding
- Debugging assistance

### Key Characteristics
- One-time cost (or low recurring tool license)
- Improves developer productivity
- Does NOT impact runtime system behavior

### Simple View
Think of this as:
👉 “AI helps build the product but is not inside the product”

---

## 3. Runtime AI (Selective Usage)

### What it means
Using AI/LLMs **as part of the application behavior at runtime**.

### Typical Use Cases
- Chatbots or copilots
- Natural language interfaces
- Recommendations or personalization
- AI-driven decision support
- Autonomous agents

### Key Characteristics
- Recurring cost (per token / per call / per user)
- Requires governance, monitoring, and safety controls
- Directly impacts end-user experience

### Simple View
Think of this as:
👉 “AI is now part of the product behavior”

---

## 4. Why This Distinction Matters

### 4.1 Cost Control
- Build-time AI → predictable and bounded cost
- Runtime AI → **unbounded, recurring cost**

👉 Poor decisions here can lead to:
- Unexpected cloud spend
- High cost per user interaction
- Scaling problems

---

### 4.2 Architecture Discipline

Not everything needs AI.

A key question:
👉 “Can this be solved with deterministic logic?”

If YES → avoid runtime AI

---

### 4.3 Preventing AI/LLM Tool Creep

**Tool creep = using AI where simple logic is enough**

Examples:

❌ Bad pattern:
- User clicks button → system calls LLM → returns fixed answer

✅ Better pattern:
- User clicks button → deterministic logic → instant response


Another example:

❌ Asking LLM:
- “What is the status of this release?”

✅ Instead:
- Query structured data directly (DB / API)

---

## 5. The Resume Problem (Reality Check)

A growing anti-pattern:

👉 “Everything is labeled as AI to look good on a resume”

But in reality:

| Claimed | Reality |
|--------|--------|
| AI-powered feature | Simple automation / rules engine |
| Intelligent assistant | Predefined workflow |
| AI decision-making | If-else logic |


### Key Insight
👉 **Automation ≠ AI**

- Automation: deterministic, predictable, cheaper, faster
- AI: probabilistic, expensive, flexible, sometimes necessary

---

## 6. Decision Framework (When to Use Runtime AI)

Before adding AI at runtime, ask:

### ✅ Use Runtime AI ONLY if:
- Problem involves **unstructured data** (text, language)
- Requires **reasoning or interpretation**
- Cannot be solved reliably using rules
- Value justifies recurring cost


### ❌ Avoid Runtime AI if:
- Output is predictable
- Logic can be encoded in rules
- Data is structured
- Cost outweighs benefit

---

## 7. Practical Guideline for Teams

### Golden Rule

✅ Everyone should use AI at **build time**

⚠️ Only introduce AI at **runtime with strong justification**

---

## 8. Recommended Architecture Mindset

Think in layers:

1. **Base Layer (No AI)**
   - Rules, APIs, deterministic logic

2. **Automation Layer**
   - Scripts, workflows, pipelines

3. **AI Layer (Optional)**
   - Only where necessary


👉 AI should be the **last resort, not the default**

---

## 9. Final Takeaway

- Build-time AI → productivity multiplier ✅
- Runtime AI → cost center + responsibility ⚠️


### One-line summary

👉 “Use AI everywhere to build software, but only selectively to run software.”

