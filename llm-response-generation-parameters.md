# LLM Response Generation Parameters

## 1. Introduction

Large Language Models (LLMs) generate text by sampling from a probability distribution over tokens. While the prompt defines *what to say*, generation parameters control *how the model behaves while producing the response*.

These parameters are typically hidden in end-user chat interfaces but are crucial in API-based systems and agentic architectures.

---

# 2. LLM Generation Parameters

## 2.1 Core Parameters

### Temperature

Controls randomness in token selection.

* Low (0.0–0.3): deterministic, focused, factual
* Medium (0.5–0.8): balanced creativity and coherence
* High (0.9–1.5): highly creative, less predictable

---

### Top-p (Nucleus Sampling)

Restricts sampling to tokens whose cumulative probability is ≤ p.

* 0.1 → very strict vocabulary
* 0.9 → natural language diversity
* 1.0 → full distribution

---

### Top-k

Limits selection to the top-k most likely tokens.

* k=1 → greedy decoding (deterministic)
* k=40 → balanced
* k=100+ → more creative output

---

### Max Tokens

Limits the length of generated output.

* Controls cost, latency, and verbosity

---

### Frequency Penalty

Reduces repetition of previously used tokens.

* Higher value → less repetition

---

### Presence Penalty

Encourages introducing new concepts/topics.

* Higher value → more diverse topics

---

### Stop Sequences

Defines when the model should stop generating text.

Example:

```
Stop at "###" or "\nUser:"
```

---

### Seed (Optional)

Ensures reproducibility of outputs when fixed.

* Same seed + same prompt → same output

---

# 3. How Temperature Affects the Same Prompt

## Prompt Example

> "Explain Retrieval-Augmented Generation (RAG) in simple terms."

---

## 3.1 Low Temperature (0.2)

* Structured
* Conservative
* Fact-focused

**Output style:**

> RAG is a technique that combines retrieval of external documents with language model generation to improve factual accuracy.

---

## 3.2 Medium Temperature (0.7)

* Balanced explanation
* Slight variation in phrasing

**Output style:**

> Retrieval-Augmented Generation (RAG) enhances LLM responses by first retrieving relevant documents and then using them to generate more accurate answers.

---

## 3.3 High Temperature (1.2)

* Creative
* More analogies
* Less predictable structure

**Output style:**

> Think of RAG like giving a student access to a library during an exam—the model first looks up useful references, then writes an answer using that information.

---

## Key Insight

Same prompt → different behaviors due to sampling randomness.

---

# 4. Agentic Systems: Dynamic Parameter Tuning (LangGraph Example)

In agentic AI systems, generation parameters are not static. They are adjusted per node depending on the task.

## 4.1 Example LangGraph Node Strategy

| Node             | Purpose              | Temperature         |
| ---------------- | -------------------- | ------------------- |
| Planner          | Break down task      | 0.2 (deterministic) |
| Retriever Router | Query formulation    | 0.3                 |
| Generator        | Answer creation      | 0.7                 |
| Critic           | Evaluate correctness | 0.1                 |
| Reflector        | Improve response     | 0.5                 |

---

## 4.2 LangGraph-style Flow

```mermaid
graph TD
    Q[User Query] --> P[Planner Node<br/>(temp=0.2)]
    P --> R[Retriever Node<br/>(temp=0.3)]
    R --> G[Generator Node<br/>(temp=0.7)]
    G --> C[Critic Node<br/>(temp=0.1)]

    C -->|Needs improvement| R
    C -->|Refine answer| G
    C -->|Accept| F[Final Output]
```

---

## 4.3 Why Dynamic Tuning Matters

* Improves reasoning consistency
* Reduces hallucination in critical steps
* Increases creativity only where needed
* Enables role-specialized agents

---

# 5. Visual Diagram: LLM Inference Stack

```mermaid
graph TD
    A[User Prompt] --> B[System Prompt Injection]
    B --> C[Tokenization]
    C --> D[LLM Model Forward Pass]

    D --> E[Logits (Probability Distribution)]

    E --> F[Sampling Strategy]
    F --> F1[Temperature]
    F --> F2[Top-p]
    F --> F3[Top-k]

    F1 --> G[Token Selection]
    F2 --> G
    F3 --> G

    G --> H[Detokenization]
    H --> I[Generated Response]

    I --> J[Post-processing / Safety Filters]
    J --> K[Final Output]
```

---

# 6. Summary

LLM generation behavior is controlled by a combination of probabilistic sampling parameters and system-level orchestration.

Key takeaways:

* Temperature controls randomness and creativity
* Top-p and top-k shape token selection boundaries
* Agentic systems dynamically adjust parameters per task
* Modern LLM apps combine model behavior with orchestration layers

---

# 7. Teaching Insight

For students:

> The same prompt does not guarantee the same answer unless generation parameters are fixed.

This is a foundational concept in understanding probabilistic AI systems.
