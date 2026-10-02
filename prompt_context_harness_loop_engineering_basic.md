# Prompt, Context, Harness, and Loop Engineering: A Middle School Guide

**Prompt engineering is how you give instructions. Context engineering is how you supply information. Harness engineering is how you equip and control the AI. Loop engineering is how you make it act, check, and improve.**

Imagine you and an AI helper are building a **model bridge for a school science fair**.

| Type | Main question | Bridge-project analogy |
|---|---|---|
| **Prompt engineering** | What should I tell the AI? | Write a clear assignment: “Design a bridge using 50 popsicle sticks that can hold five pounds.” |
| **Context engineering** | What does the AI need to know right now? | Give it the contest rules, available materials, bridge examples, and results from previous attempts. |
| **Harness engineering** | What tools and rules let the AI work? | Set up the workbench, measuring tools, testing equipment, project notebook, and safety rules. |
| **Loop engineering** | How will it check progress and decide what happens next? | Build a design, test it, find weak spots, improve it, and repeat—with a clear stopping rule. |

These are useful distinctions, but their boundaries overlap. In particular, **the loop is often part of the harness**, rather than a completely separate system. The newer terms are still evolving.

## 1. Prompt Engineering: Write a Clear Assignment

Compare these instructions:

- **Vague:** “Help me with my bridge.”
- **Clear:** “Suggest a popsicle-stick bridge for a seventh-grade science fair. Use no more than 50 sticks. Explain the design in five steps.”

You are specifying the task, limits, audience, and desired answer. That is prompt engineering: designing the instructions so the AI understands what you want.

**Analogy:** A clear assignment sheet helps a student get started.

## 2. Context Engineering: Pack the Right Project Folder

Even a clear assignment will not help much if the AI has the wrong information.

Suppose the AI suggests hot glue, but your contest only permits white glue. It needed the contest rules. Or suppose your first bridge collapsed in the middle. It needs that test result before suggesting improvements.

Context engineering means choosing and updating the information the AI sees: relevant documents, examples, conversation history, and tool results. **More information is not always better**—a folder full of unrelated material can make the important facts harder to find.

**Analogy:** Give the student the right pages from the textbook, along with useful project notes.

## 3. Harness Engineering: Set Up the Workbench

An AI that can describe a bridge is different from an AI system that can use tools to design and test one.

The *harness* is the surrounding system that makes work possible. It might give the AI a design simulator, a place to save files, access to tests, and rules about what it may change. Harness engineering builds that environment so the AI can work reliably.

For our imaginary bridge helper, you might provide:

- A simulator that measures how much weight a design supports.
- A notebook that saves designs and results.
- A rule requiring teacher approval before ordering materials.

**Analogy:** A well-equipped classroom workshop, with tools and rules.

## 4. Loop Engineering: Build the Practice-and-Feedback Routine

The first bridge design might fail. What should the system do then?

You could design this routine:

1. Create a design.
2. Test it in the simulator.
3. Read the results.
4. Fix the weak spots and test again.
5. Stop when it meets the requirements—or after five attempts, ask for help.

Loop engineering designs that repeated process, including feedback, next-step decisions, and stopping conditions. The system handles those steps without needing a person to type a new instruction every time.

**Analogy:** A coach who organizes practice, checks performance, adjusts the exercise, and knows when to stop.

The distinction between harness and loop is especially helpful: **the harness provides the testing equipment; the loop decides when to test and what to do with the result.**

## Why Should You Care?

Because different problems need different fixes. Rewording your prompt cannot solve every problem.

| What goes wrong? | What probably needs attention? |
|---|---|
| The AI writes a college-level explanation for a seventh grader. | **Prompt:** specify the audience and reading level. |
| It recommends materials forbidden by the contest. | **Context:** supply the contest rules. |
| It can suggest a test but cannot actually run it. | **Harness:** provide a testing tool. |
| It keeps repeating a failed design or never stops. | **Loop:** improve the feedback and stopping rules. |

For everyday questions, a clear prompt and relevant context may be enough. When you want an AI to carry out a project over many steps, the harness and loop become more important.

**Remember: assignment, project folder, workbench, practice routine.** All four help—but repeated work only improves when the checks provide useful evidence.

## Sources

- [Anthropic: Effective context engineering for AI agents](https://www.anthropic.com/engineering/effective-context-engineering-for-ai-agents)
- [OpenAI: Harness engineering](https://openai.com/index/harness-engineering/)
- [IBM: What is loop engineering?](https://www.ibm.com/think/topics/loop-engineering)
