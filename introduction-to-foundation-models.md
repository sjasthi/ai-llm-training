# Foundation Models: The Landscape, the Players, and the Code

> **The analogy that frames everything:** Think of foundation models the way you think about medical specialists. Your general practitioner handles 90% of what you need — checkups, common ailments, referrals. You only go to a cardiac surgeon when you need heart surgery, and to a neurologist when you need a brain scan. Choosing the right model follows the same logic: a large, expensive, specialist model is overkill for most tasks. A small, fast, cheap model is dangerous for high-stakes reasoning. **The skill is knowing when to use which.**

---

## What Is a Foundation Model?

A **foundation model** is a large neural network trained on massive, broad datasets — text, code, images, audio, video — that can be adapted to a wide range of downstream tasks through prompting or fine-tuning. They are called "foundation" models because they serve as the base layer for thousands of downstream applications.

The term was coined by researchers at Stanford in 2021. Before foundation models, teams trained specialized models for each task (one for translation, one for summarization, one for classification). Foundation models changed this: train once at scale, deploy everywhere.

```
Before foundation models:
  Task A → Train Model A
  Task B → Train Model B
  Task C → Train Model C

After foundation models:
  [Foundation Model] → Prompt for Task A → Answer
                     → Prompt for Task B → Answer
                     → Prompt for Task C → Answer
  (+ fine-tune for specialized domains)
```

---

## Why Are There So Many Models?

Three forces drive model proliferation:

**1. No single model wins on all dimensions.**
Speed, cost, reasoning depth, context length, language support, multimodality, safety, and domain expertise all trade off against each other. A model optimized for cost is rarely the best at reasoning. A model optimized for code isn't always the best at creative writing.

**2. Strategic and competitive incentives.**
Every major technology company wants to control the AI stack. Models are infrastructure. Whoever controls the model layer influences how developers build, which clouds they use, and who captures the value.

**3. Open source democratization.**
Meta's open release of Llama created an ecosystem where anyone can download, fine-tune, and run models without paying per token. This spawned hundreds of derivative models optimized for specific domains, languages, and hardware constraints.

The result: a **diverse ecosystem of models at different price points, sizes, and capabilities** — exactly like medical specialists.

---

## The Doctor Analogy: Matching Model to Task

```
General Practitioner (GP)
→ Small/medium base models (GPT-4o mini, Claude Haiku, Gemini Flash, Llama 3.1 8B)
→ Use for: classification, summarization, simple Q&A, chat, routing
→ Cost: fraction of a cent per 1K tokens
→ When: the vast majority of your workload

Specialist Physician (e.g., cardiologist, oncologist)
→ Large frontier models (Claude Opus, GPT-4o, Gemini Ultra, Grok-2)
→ Use for: complex multi-step reasoning, nuanced analysis, expert-level writing
→ Cost: 10–50x the base model
→ When: the task genuinely requires it

Brain / Cardiac Surgeon
→ Domain-specific fine-tuned models (BioGPT for biomedical, CodeLlama for code,
   Mistral-Med for clinical reasoning)
→ Use for: specialized domains where general models fall short
→ Cost: often lower (smaller, purpose-built)
→ When: domain precision matters more than generality

```

**The mistake most teams make:** Using the cardiac surgeon for every appointment. Running GPT-4o or Claude Opus on every API call — including ones that could be handled by a $0.0001/token model — is like booking a neurosurgeon to check if you have a cold.

**A routing architecture:**

```python
def select_model(task: dict) -> str:
    complexity = task["complexity"]  # low / medium / high
    domain = task["domain"]          # general / medical / code / legal

    # Simple tasks: use the GP
    if complexity == "low":
        return "claude-haiku-4-5"

    # Specialized domain: use the specialist
    if domain == "code" and complexity == "medium":
        return "codestral-latest"

    # High complexity general: use the consultant
    if complexity == "high":
        return "claude-opus-4-6"

    return "claude-sonnet-4-6"  # default: the competent generalist
```

---

## The Players

---

### 🟠 Anthropic — Claude Family

**Background:** Founded in 2021 by former OpenAI researchers including Dario and Daniela Amodei. Safety-focused by mission — their core research agenda is AI alignment. Claude is designed with "Constitutional AI" — trained to be helpful, harmless, and honest through a set of explicit principles.

**Model family:**

| Model | Best for | Context window |
|---|---|---|
| **Claude Opus 4.x** | Complex reasoning, nuanced writing, research | Up to 200K tokens |
| **Claude Sonnet 4.x** | Balanced performance and cost, most workloads | Up to 200K tokens |
| **Claude Haiku 4.x** | Speed and cost efficiency, simple tasks | Up to 200K tokens |

**Differentiators:**
- Best-in-class for long-context tasks (200K token window)
- Particularly strong at nuanced instruction following
- Strong safety and refusal design
- Artifacts and extended thinking modes

**Access:** API via Anthropic, also available on AWS Bedrock and Google Cloud Vertex AI.

---

### 🟢 OpenAI — GPT Family

**Background:** The company that ignited the current AI era with GPT-3 (2020) and ChatGPT (2022). Now majority Microsoft-backed. Set the de facto API standard that the entire industry has adopted (more on this below).

**Model family:**

| Model | Best for | Notes |
|---|---|---|
| **GPT-4o** | Multimodal reasoning, general tasks | Vision + audio + text |
| **GPT-4o mini** | High-volume, cost-efficient tasks | Excellent quality/cost ratio |
| **o1 / o3** | Deep reasoning, math, science | "Thinking" models — slower, more accurate |
| **o4-mini** | Fast reasoning at lower cost | Reasoning model, smaller |

**Differentiators:**
- Set the industry API standard (see OpenAI API compatibility section)
- Widest ecosystem of integrations and tooling
- o1/o3 reasoning models for complex chain-of-thought tasks
- DALL-E image generation, Whisper speech recognition, Sora video

**Access:** OpenAI API, Azure OpenAI Service.

---

### 🔵 Google — Gemini Family

**Background:** Google DeepMind merged with Google Brain to form the Gemini team. Uniquely positioned: Google controls the infrastructure (TPUs), the data (Search, YouTube, Gmail), and the distribution (Android, Chrome, Workspace).

**Model family:**

| Model | Best for | Notes |
|---|---|---|
| **Gemini Ultra / 1.5 Pro** | Complex reasoning, long documents | 1M+ token context window |
| **Gemini Flash** | Speed and cost efficiency | Best-in-class latency |
| **Gemini Nano** | On-device inference | Runs locally on Android |
| **Gemma 2 / 3** | Open weights, local deployment | Google's open-source line |

**Differentiators:**
- Largest context window in production (1M+ tokens = can process entire codebases)
- Native multimodality (trained on text, image, audio, video together, not bolted on)
- Deep Google Search integration
- Gemma open-weight models for self-hosted deployments

**Access:** Google AI Studio, Vertex AI.

---

### 🔵 Microsoft — Azure OpenAI + Phi Family

**Background:** Microsoft made a multi-billion dollar bet on OpenAI, giving it exclusive Azure deployment rights and deep integration into GitHub (Copilot), Office (Copilot for M365), and Windows. But Microsoft also develops its own models.

**Model family:**

| Model | Best for | Notes |
|---|---|---|
| **Azure OpenAI GPT-4o** | Enterprise GPT-4o with compliance | Data residency, no training on your data |
| **Phi-3 / Phi-4** | On-device, edge deployment | Tiny but remarkably capable |
| **Phi-3.5-mini** | Mobile and embedded inference | 3.8B parameters, runs on phone |

**Differentiators:**
- Enterprise compliance and data sovereignty (SOC 2, HIPAA, FedRAMP)
- Phi models are the best small models for their size — designed to punch above their weight
- Native Azure integration for enterprise customers already in the Microsoft ecosystem

**Access:** Azure OpenAI Service, Phi models on Hugging Face.

---

### 🟣 Meta — Llama Family

**Background:** Meta releases its models as open weights — downloadable, free to use, fine-tune, and deploy. This is a deliberate strategic choice: Meta benefits from a healthy open AI ecosystem, gains developer goodwill, and avoids being dependent on proprietary model providers for its own AI products.

**Model family:**

| Model | Parameters | Best for |
|---|---|---|
| **Llama 3.1 8B** | 8 billion | Local deployment, edge inference |
| **Llama 3.1 70B** | 70 billion | High-quality open-source general use |
| **Llama 3.1 405B** | 405 billion | Frontier-level, self-hosted |
| **Llama 3.2** | 1B–90B | Vision capabilities added |
| **Code Llama** | 7B–70B | Code-specialized fine-tune |

**Differentiators:**
- Truly open weights — download and run anywhere, including air-gapped environments
- Enormous fine-tuning ecosystem (thousands of community fine-tunes on Hugging Face)
- No per-token cost when self-hosted
- Foundation for many commercial models (Mistral, Together AI, Perplexity, etc.)

**Access:** Meta website, Hugging Face, via Ollama locally.

---

### ⚫ xAI — Grok Family

**Background:** Founded by Elon Musk in 2023, xAI builds Grok — integrated into X (Twitter) and competing directly with OpenAI. Positioned as a "maximally truth-seeking" model with fewer content restrictions than most commercial alternatives.

**Model family:**

| Model | Notes |
|---|---|
| **Grok-1** | Open weights released March 2024 — 314B MoE parameters |
| **Grok-2** | Commercial, multimodal, integrated with X |
| **Grok-3** | Latest, with "DeepSearch" and reasoning modes |

**Differentiators:**
- Real-time X (Twitter) data access — live information without a knowledge cutoff lag
- Grok-1 is one of the largest open-weight models ever released
- Less restrictive content policies than Anthropic/OpenAI
- Aurora image generation model

**Access:** X Premium+, xAI API, Grok-1 weights on Hugging Face.

---

### 🟡 Hugging Face — The Model Hub

**Background:** Hugging Face is not a model creator in the same sense — it's the GitHub of AI models. It hosts over 900,000 models, provides the `transformers` library (the standard interface for running models in Python), and offers its own hosted inference API.

**Their own models:**

| Model | Notes |
|---|---|
| **Zephyr** | Fine-tuned Mistral for chat |
| **StarCoder 2** | Code generation |
| **IDEFICS** | Vision-language model |
| **Falcon (partnership)** | With TII UAE |

**What Hugging Face actually is:**

```python
# Hugging Face is the npm registry of AI models
# You pull models from it the way you pull packages

from transformers import pipeline

# Download and run Llama 3 locally
generator = pipeline("text-generation", model="meta-llama/Llama-3.1-8B-Instruct")
result = generator("Explain transformers in one paragraph:")
print(result[0]["generated_text"])
```

**Access:** huggingface.co, `pip install transformers`

---

### Other Notable Players

**Mistral AI (France)**
European frontier lab. Known for punching well above their parameter count. Mistral 7B was the best 7B model for months after release. Mixtral (Mixture of Experts architecture) is widely used.

```
Mistral 7B       → Best-in-class small model, Apache 2.0 license
Mixtral 8x7B     → Mixture of Experts, effectively 47B but runs like 12B
Mistral Large    → Commercial frontier model
Codestral        → Code-specialized model
```

**Cohere**
Enterprise-focused. Particularly strong at RAG and enterprise search. Command R+ is their flagship. Embed models are used widely in production RAG pipelines.

**AI21 Labs**
Israeli AI company. Jamba (hybrid Mamba/Transformer architecture) and Jurassic model family. Strong in enterprise NLP.

**Aleph Alpha (Germany)**
European sovereign AI. Built for data residency and regulatory compliance in European markets. Luminous model family.

**Together AI / Groq / Fireworks AI**
Not model builders — inference providers. Host open-source models (Llama, Mistral, etc.) at low cost and/or high speed. Groq's LPU hardware runs Llama 70B at 500+ tokens/second.

---

## Model Sizes and Parameters: What They Actually Mean

A model's **parameter count** is the number of numerical weights in the neural network. More parameters = more capacity to learn patterns, but also more compute to run.

```
Parameters → Approximate compute cost → Use case

1B–7B    → Runs on a laptop GPU (8GB VRAM)    → Simple tasks, local/edge
8B–13B   → Mid-tier GPU (16GB VRAM)            → Good general performance locally
30B–70B  → High-end GPU (40–80GB VRAM)         → Near-frontier, self-hosted
100B+    → Multi-GPU server clusters            → Frontier reasoning
400B+    → Data center scale                    → Research, maximum capability
```

**Why bigger isn't always better:**

```
GPT-4o mini vs. GPT-4o for "Classify this support ticket as billing, technical, or general":
  GPT-4o mini:  ~$0.00015 per call, latency ~200ms, accuracy 94%
  GPT-4o:       ~$0.005 per call,   latency ~800ms, accuracy 96%

  The 2% accuracy gain costs 33x more and 4x the latency.
  For 10 million tickets/month: $1,500 vs. $50,000.
  Use the small model.
```

**Mixture of Experts (MoE):** A technique where a large model has many "expert" sub-networks but only activates a few per token. Mixtral 8x7B has 47B parameters total but only uses ~12B per inference — giving frontier quality at mid-tier cost.

---

## Commercial vs. Open Source Models

This is one of the most important strategic decisions in your AI architecture.

| Dimension | Commercial (Closed) | Open Source (Open Weights) |
|---|---|---|
| **Examples** | GPT-4o, Claude, Gemini Ultra | Llama 3, Mistral, Gemma, Falcon |
| **Access** | API only — you never see the weights | Download the weights and run anywhere |
| **Cost model** | Per-token pricing | Infrastructure cost only |
| **Data privacy** | Your prompts leave your environment | Can run fully air-gapped |
| **Customization** | Limited (fine-tuning APIs only) | Full fine-tuning, quantization, merging |
| **Quality ceiling** | Higher (frontier models lead here) | Closing fast — Llama 3.1 405B is competitive |
| **Compliance** | Depends on provider contracts | Full control — audit the code |
| **Operational burden** | None — provider handles it | You manage infrastructure, updates, scaling |

**When to choose commercial:**
- You need frontier reasoning quality today
- You don't have ML infrastructure expertise
- Your data is not highly sensitive (or provider has appropriate compliance)
- You want to move fast without managing infrastructure

**When to choose open source:**
- Data sovereignty is non-negotiable (healthcare, government, finance)
- You need to fine-tune extensively on proprietary data
- You have high volume and want to eliminate per-token cost
- You want full auditability of the model's behavior
- You're deploying at the edge or on-device

**The hybrid pattern** (what most mature teams do):
```
Sensitive data / high volume → Local Llama / Mistral (open source)
Complex reasoning tasks      → Claude Opus / GPT-4o (commercial)
Everyday tasks               → Claude Haiku / GPT-4o mini (commercial, cheap)
Domain-specific tasks        → Fine-tuned open model
```

---

## Multimodal Models: Beyond Text

Modern foundation models increasingly handle multiple modalities — text, images, audio, video, and code — within a single model.

```
Text only (1st gen):
  GPT-3, original Claude, original Llama

Text + Code:
  Codex, Code Llama, Codestral

Text + Images (Vision):
  GPT-4V, Claude 3+ (all tiers), Gemini 1.5, Llama 3.2

Text + Images + Audio:
  GPT-4o (real-time audio), Gemini Ultra

Text + Images + Audio + Video:
  Gemini 1.5 Pro (video understanding), GPT-4o (video frames)

Text + Images + Code + Structured data:
  Most frontier models now
```

**Why this matters for engineers:**

```python
# Old way: separate models for each modality
text_response = text_model.complete(user_query)
image_description = vision_model.describe(image_file)
code_suggestion = code_model.complete(code_snippet)

# New way: one model handles all
response = claude.messages.create(
    model="claude-opus-4-6",
    messages=[{
        "role": "user",
        "content": [
            {"type": "text",  "text": "What bug is in this code? Also look at the error screenshot."},
            {"type": "image", "source": {"type": "base64", "data": screenshot_b64}},
            {"type": "text",  "text": f"Code:\n```python\n{code}\n```"}
        ]
    }]
)
```

---

## The OpenAI API Standard: Write Once, Run Anywhere

One of the most important practical facts about the model ecosystem: **the vast majority of model providers have adopted OpenAI's API format as the de facto standard.** This means code written for one provider works — with only a URL and key change — across most others.

**The standard format:**

```python
# This structure works across OpenAI, Anthropic (via SDK), Mistral,
# Together AI, Groq, Ollama, and dozens of other providers:

response = client.chat.completions.create(
    model="model-name",
    messages=[
        {"role": "system", "content": "You are a helpful assistant."},
        {"role": "user",   "content": "Explain recursion in one paragraph."}
    ],
    temperature=0.7,
    max_tokens=500
)

print(response.choices[0].message.content)
```

**Why this happened:** OpenAI's API became the standard because ChatGPT made it ubiquitous. Other providers adopted it to make migration easy — which made it even more ubiquitous.

**What this means for you:**
- You can switch model providers with a two-line change
- You can A/B test models with the same codebase
- You can build a provider-agnostic abstraction layer
- Vendor lock-in is a choice, not a necessity

---

## Python Examples: API Keys and Calling Models

---

### Setting Up API Keys (Best Practices)

```python
# NEVER hardcode API keys in source code
# Use environment variables or a secrets manager

# .env file (not committed to git)
# ANTHROPIC_API_KEY=sk-ant-...
# OPENAI_API_KEY=sk-...
# MISTRAL_API_KEY=...
# GOOGLE_API_KEY=...

import os
from dotenv import load_dotenv

load_dotenv()  # pip install python-dotenv

ANTHROPIC_API_KEY = os.environ.get("ANTHROPIC_API_KEY")
OPENAI_API_KEY    = os.environ.get("OPENAI_API_KEY")
MISTRAL_API_KEY   = os.environ.get("MISTRAL_API_KEY")

# .gitignore should always include:
# .env
# *.key
# secrets/
```

---

### Example 1: Anthropic Claude

```python
# pip install anthropic

import anthropic

client = anthropic.Anthropic(api_key=os.environ["ANTHROPIC_API_KEY"])

response = client.messages.create(
    model="claude-sonnet-4-6",      # or claude-haiku-4-5, claude-opus-4-6
    max_tokens=1024,
    system="You are a senior software engineer. Be concise and precise.",
    messages=[
        {"role": "user", "content": "What is the difference between a thread and a process?"}
    ]
)

print(response.content[0].text)

# Streaming response (better UX for long outputs)
with client.messages.stream(
    model="claude-haiku-4-5",
    max_tokens=1024,
    messages=[{"role": "user", "content": "Write a Python decorator that logs function calls."}]
) as stream:
    for text in stream.text_stream:
        print(text, end="", flush=True)
```

---

### Example 2: OpenAI GPT

```python
# pip install openai

from openai import OpenAI

client = OpenAI(api_key=os.environ["OPENAI_API_KEY"])

response = client.chat.completions.create(
    model="gpt-4o-mini",    # or gpt-4o, o1, o3-mini
    messages=[
        {"role": "system", "content": "You are a helpful assistant."},
        {"role": "user",   "content": "Explain database indexing to a junior developer."}
    ],
    temperature=0.7,
    max_tokens=500
)

print(response.choices[0].message.content)
print(f"\nTokens used: {response.usage.total_tokens}")
print(f"Estimated cost: ${response.usage.total_tokens * 0.00000015:.6f}")  # gpt-4o-mini pricing
```

---

### Example 3: Google Gemini

```python
# pip install google-generativeai

import google.generativeai as genai

genai.configure(api_key=os.environ["GOOGLE_API_KEY"])

model = genai.GenerativeModel("gemini-1.5-flash")   # or gemini-1.5-pro, gemini-2.0-flash

response = model.generate_content(
    "Summarize the CAP theorem in three bullet points for a software engineer."
)

print(response.text)

# Multimodal: text + image
import PIL.Image

model = genai.GenerativeModel("gemini-1.5-pro")
image = PIL.Image.open("architecture_diagram.png")

response = model.generate_content([
    "Identify any architectural anti-patterns in this diagram.",
    image
])
print(response.text)
```

---

### Example 4: Mistral AI

```python
# pip install mistralai

from mistralai import Mistral

client = Mistral(api_key=os.environ["MISTRAL_API_KEY"])

# OpenAI-compatible format
response = client.chat.complete(
    model="mistral-small-latest",   # or mistral-large-latest, codestral-latest
    messages=[
        {"role": "system", "content": "You are a code review assistant."},
        {"role": "user",   "content": "Review this Python function for edge cases:\n\ndef divide(a, b):\n    return a / b"}
    ]
)

print(response.choices[0].message.content)

# Codestral for code-specific tasks
code_response = client.chat.complete(
    model="codestral-latest",
    messages=[
        {"role": "user", "content": "Write a binary search function in Python with type hints."}
    ]
)
print(code_response.choices[0].message.content)
```

---

### Example 5: Meta Llama via Groq (Fast Inference)

```python
# pip install groq
# Groq hosts open-source models at extremely high speed (500+ tokens/sec)

from groq import Groq

client = Groq(api_key=os.environ["GROQ_API_KEY"])

response = client.chat.completions.create(
    model="llama-3.1-70b-versatile",   # or llama-3.1-8b-instant, mixtral-8x7b-32768
    messages=[
        {"role": "system", "content": "You are a helpful assistant."},
        {"role": "user",   "content": "What are the SOLID principles? Give a one-line summary of each."}
    ],
    temperature=0.5,
    max_tokens=500
)

print(response.choices[0].message.content)
```

---

### Example 6: Local Model via Ollama (Fully Offline)

```bash
# Install Ollama: https://ollama.ai
# Pull a model locally:
ollama pull llama3.1
ollama pull mistral
ollama pull phi3
```

```python
# Ollama exposes an OpenAI-compatible API on localhost
# No API key needed — runs entirely on your machine

from openai import OpenAI

# Point the OpenAI client at your local Ollama instance
client = OpenAI(
    base_url="http://localhost:11434/v1",
    api_key="ollama"    # placeholder — Ollama doesn't need a real key
)

response = client.chat.completions.create(
    model="llama3.1",   # or mistral, phi3, codellama, etc.
    messages=[
        {"role": "user", "content": "Explain the difference between TCP and UDP."}
    ]
)

print(response.choices[0].message.content)
# Runs entirely locally — no data leaves your machine, no cost per token
```

---

### Example 7: Provider-Agnostic Wrapper (Write Once, Run Anywhere)

```python
# A simple abstraction that lets you swap providers with one config change

import os
from openai import OpenAI

PROVIDER_CONFIGS = {
    "openai": {
        "base_url": "https://api.openai.com/v1",
        "api_key":  os.environ.get("OPENAI_API_KEY"),
        "default_model": "gpt-4o-mini"
    },
    "anthropic-compat": {
        # Anthropic also offers an OpenAI-compatible endpoint
        "base_url": "https://api.anthropic.com/v1",
        "api_key":  os.environ.get("ANTHROPIC_API_KEY"),
        "default_model": "claude-haiku-4-5"
    },
    "mistral": {
        "base_url": "https://api.mistral.ai/v1",
        "api_key":  os.environ.get("MISTRAL_API_KEY"),
        "default_model": "mistral-small-latest"
    },
    "groq": {
        "base_url": "https://api.groq.com/openai/v1",
        "api_key":  os.environ.get("GROQ_API_KEY"),
        "default_model": "llama-3.1-70b-versatile"
    },
    "local": {
        "base_url": "http://localhost:11434/v1",
        "api_key":  "ollama",
        "default_model": "llama3.1"
    }
}

def ask(
    question: str,
    provider: str = "openai",
    model: str = None,
    system: str = "You are a helpful assistant."
) -> str:
    config = PROVIDER_CONFIGS[provider]
    client = OpenAI(base_url=config["base_url"], api_key=config["api_key"])
    chosen_model = model or config["default_model"]

    response = client.chat.completions.create(
        model=chosen_model,
        messages=[
            {"role": "system", "content": system},
            {"role": "user",   "content": question}
        ]
    )
    return response.choices[0].message.content


# Usage — same code, different providers:
question = "What is the time complexity of quicksort?"

print("--- OpenAI ---")
print(ask(question, provider="openai"))

print("\n--- Groq (Llama) ---")
print(ask(question, provider="groq"))

print("\n--- Local Ollama ---")
print(ask(question, provider="local"))
```

---

### Example 8: Cost-Aware Model Router

```python
# Route tasks to the cheapest model that can handle them

import anthropic

client = anthropic.Anthropic()

def classify_complexity(task: str) -> str:
    """Use the cheapest model to classify task complexity."""
    response = client.messages.create(
        model="claude-haiku-4-5",   # cheapest model for classification
        max_tokens=10,
        system="Classify the complexity of the following task. "
               "Respond with only one word: 'simple', 'medium', or 'complex'.",
        messages=[{"role": "user", "content": task}]
    )
    return response.content[0].text.strip().lower()


def smart_complete(task: str) -> str:
    complexity = classify_complexity(task)

    model_map = {
        "simple":  "claude-haiku-4-5",    # ~$0.00025 / 1K tokens
        "medium":  "claude-sonnet-4-6",   # ~$0.003 / 1K tokens
        "complex": "claude-opus-4-6"      # ~$0.015 / 1K tokens
    }

    chosen_model = model_map.get(complexity, "claude-sonnet-4-6")
    print(f"Complexity: {complexity} → Using: {chosen_model}")

    response = client.messages.create(
        model=chosen_model,
        max_tokens=1024,
        messages=[{"role": "user", "content": task}]
    )
    return response.content[0].text


# Test the router
tasks = [
    "What is 2 + 2?",                                    # → haiku
    "Summarize the key points of the CAP theorem.",      # → sonnet
    "Design a distributed rate limiting system that "
    "handles 1M req/sec with sub-5ms latency globally."  # → opus
]

for task in tasks:
    print(f"\nTask: {task[:60]}...")
    result = smart_complete(task)
    print(f"Answer: {result[:200]}...")
```

---

## Quick Comparison: Model Tiers at a Glance

| Model | Provider | Type | Size | Cost (per 1M tokens in) | Best for |
|---|---|---|---|---|---|
| **Claude Opus 4** | Anthropic | Commercial | ~Unknown | ~$15 | Complex reasoning, research |
| **Claude Sonnet 4** | Anthropic | Commercial | ~Unknown | ~$3 | General purpose, most tasks |
| **Claude Haiku 4** | Anthropic | Commercial | ~Unknown | ~$0.25 | Speed, cost efficiency |
| **GPT-4o** | OpenAI | Commercial | ~Unknown | ~$2.50 | Multimodal, general |
| **GPT-4o mini** | OpenAI | Commercial | ~Unknown | ~$0.15 | High-volume, cheap |
| **o3** | OpenAI | Commercial | ~Unknown | ~$10 | Deep reasoning, math |
| **Gemini 1.5 Pro** | Google | Commercial | ~Unknown | ~$1.25 | Long context (1M tokens) |
| **Gemini Flash** | Google | Commercial | ~Unknown | ~$0.075 | Fastest commercial model |
| **Llama 3.1 70B** | Meta | Open Source | 70B | ~$0.10 (hosted) | Open, customizable |
| **Llama 3.1 8B** | Meta | Open Source | 8B | Free (self-host) | Local, edge, free |
| **Mistral 7B** | Mistral | Open Source | 7B | Free (self-host) | Small, capable, Apache 2.0 |
| **Mixtral 8x7B** | Mistral | Open Source | 47B (MoE) | ~$0.24 (hosted) | Quality at mid-tier cost |
| **Phi-4** | Microsoft | Open Source | 14B | Free (self-host) | Edge, small but smart |
| **Grok-3** | xAI | Commercial | ~Unknown | Via xAI API | Real-time X data |
| **Gemma 3** | Google | Open Source | 1B–27B | Free (self-host) | Local Google-quality |

*Costs approximate as of mid-2025 and subject to change. Always check provider pricing pages.*

---

## The Ecosystem Map

```
                        FOUNDATION MODEL ECOSYSTEM

    CLOSED / COMMERCIAL                    OPEN SOURCE / OPEN WEIGHTS
    ─────────────────────                  ──────────────────────────
    ┌──────────────────┐                   ┌──────────────────────────┐
    │    Anthropic     │                   │    Meta (Llama family)   │
    │  Claude Opus/    │                   │  8B → 70B → 405B        │
    │  Sonnet/Haiku    │                   └──────────────┬───────────┘
    └──────────────────┘                                  │
    ┌──────────────────┐                   ┌──────────────▼───────────┐
    │     OpenAI       │                   │      Community           │
    │  GPT-4o / o3 /  │                   │  Hugging Face Hub        │
    │   o4-mini        │                   │  900K+ models            │
    └──────────────────┘                   │  Fine-tunes, merges      │
    ┌──────────────────┐                   └──────────────────────────┘
    │     Google       │                   ┌──────────────────────────┐
    │ Gemini Ultra /   │                   │    Mistral AI            │
    │ Pro / Flash      │                   │  Mistral 7B, Mixtral,    │
    └──────────────────┘                   │  Codestral               │
    ┌──────────────────┐                   └──────────────────────────┘
    │   xAI (Grok)     │                   ┌──────────────────────────┐
    │  Grok-2/3        │                   │  Microsoft (Phi)         │
    └──────────────────┘                   │  Phi-3, Phi-4 (tiny+smart│
                                           └──────────────────────────┘
                                           ┌──────────────────────────┐
                                           │  Google (Gemma)          │
                                           │  Gemma 2, Gemma 3        │
                                           └──────────────────────────┘

    INFERENCE PROVIDERS (host open models):
    Groq · Together AI · Fireworks AI · Replicate · Perplexity

    LOCAL INFERENCE:
    Ollama · LM Studio · llama.cpp · vLLM
```

---

## References

### Provider Documentation & APIs

- **Anthropic Claude** — [docs.anthropic.com](https://docs.anthropic.com) | [API Reference](https://docs.anthropic.com/en/api/getting-started)
- **OpenAI** — [platform.openai.com/docs](https://platform.openai.com/docs) | [API Reference](https://platform.openai.com/docs/api-reference)
- **Google Gemini** — [ai.google.dev](https://ai.google.dev) | [Vertex AI](https://cloud.google.com/vertex-ai/generative-ai/docs)
- **Meta Llama** — [llama.meta.com](https://llama.meta.com) | [Hugging Face](https://huggingface.co/meta-llama)
- **Mistral AI** — [docs.mistral.ai](https://docs.mistral.ai)
- **xAI Grok** — [x.ai/api](https://x.ai/api)
- **Hugging Face** — [huggingface.co/docs](https://huggingface.co/docs)
- **Microsoft Azure OpenAI** — [learn.microsoft.com/azure/ai-services/openai](https://learn.microsoft.com/en-us/azure/ai-services/openai/)
- **Phi Models** — [Hugging Face microsoft/phi-4](https://huggingface.co/microsoft/phi-4)
- **Cohere** — [docs.cohere.com](https://docs.cohere.com)

### Inference Providers

- **Groq** (fast inference) — [console.groq.com](https://console.groq.com)
- **Together AI** — [docs.together.ai](https://docs.together.ai)
- **Fireworks AI** — [docs.fireworks.ai](https://docs.fireworks.ai)
- **Ollama** (local) — [ollama.ai](https://ollama.ai)

### Python Libraries

- **anthropic** — `pip install anthropic` | [github.com/anthropics/anthropic-sdk-python](https://github.com/anthropics/anthropic-sdk-python)
- **openai** — `pip install openai` | [github.com/openai/openai-python](https://github.com/openai/openai-python)
- **google-generativeai** — `pip install google-generativeai` | [github.com/google/generative-ai-python](https://github.com/google/generative-ai-python)
- **mistralai** — `pip install mistralai` | [github.com/mistralai/client-python](https://github.com/mistralai/client-python)
- **groq** — `pip install groq` | [github.com/groq/groq-python](https://github.com/groq/groq-python)
- **transformers** (Hugging Face) — `pip install transformers` | [github.com/huggingface/transformers](https://github.com/huggingface/transformers)
- **litellm** (universal wrapper) — `pip install litellm` | [github.com/BerriAI/litellm](https://github.com/BerriAI/litellm)

### Benchmarks & Model Comparisons

- **LMSYS Chatbot Arena** (human preference leaderboard) — [chat.lmsys.org](https://chat.lmsys.org)
- **Open LLM Leaderboard** (Hugging Face) — [huggingface.co/spaces/HuggingFaceH4/open_llm_leaderboard](https://huggingface.co/spaces/HuggingFaceH4/open_llm_leaderboard)
- **Artificial Analysis** (independent benchmarks + cost/speed) — [artificialanalysis.ai](https://artificialanalysis.ai)
- **LiveBench** (contamination-free benchmarks) — [livebench.ai](https://livebench.ai)

### Key Papers

- **Foundation Models** — *On the Opportunities and Risks of Foundation Models*, Bommasani et al. 2021 — [arxiv.org/abs/2108.07258](https://arxiv.org/abs/2108.07258)
- **Llama 3** — [arxiv.org/abs/2407.21783](https://arxiv.org/abs/2407.21783)
- **Gemini** — [arxiv.org/abs/2312.11805](https://arxiv.org/abs/2312.11805)
- **Mixtral MoE** — [arxiv.org/abs/2401.04088](https://arxiv.org/abs/2401.04088)
- **Phi-3** — [arxiv.org/abs/2404.14219](https://arxiv.org/abs/2404.14219)
