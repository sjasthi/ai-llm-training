# Prompt, Context, Harness, and Loop Engineering

## A Practical Guide for Software Engineers

Reliable AI-assisted software development depends on more than the model. It depends on the instructions, the information available at each decision, the execution environment, and the feedback process that determines the next action.

**Prompt engineering defines the instructions. Context engineering manages the information supplied to the model. Harness engineering builds the runtime and working environment around it. Loop engineering designs the repeated execution and feedback process.**

These are overlapping engineering concerns, not four competing technologies or four mandatory maturity stages. In particular, the execution loop is usually implemented within the harness. “Loop engineering” is an emerging term whose scope varies across practitioners. The distinctions below provide a practical way to reason about responsibility and failure.

## 1. The Four Concerns at a Glance

| Concern | Primary question | Typical artifacts | Familiar software-engineering analogy |
|---|---|---|---|
| **Prompt engineering** | What behavior and output should this model invocation produce? | Instructions, task specifications, examples, output schemas | A precise work ticket or function contract |
| **Context engineering** | What information should the model see at this step? | Retrieved code, documentation, tool results, task state, summaries | Preparing the relevant working set for a developer |
| **Harness engineering** | How can the model observe, act, persist state, and operate within enforced boundaries? | Tool adapters, workspace isolation, permission controls, checkpointing, telemetry | A development environment combined with a job runner |
| **Loop engineering** | How should the system use results to choose the next action, retry, finish, or escalate? | State transitions, verification policies, retry rules, budgets, termination conditions | A feedback controller or reconciler |

A useful shorthand is **instructions, information, infrastructure, iteration**.

## 2. A Running Example: Add Phone Verification to an Existing Service

Assume a team asks a coding agent to implement the following change:

> Add a nullable `phone_verified_at` field. Reset it whenever the canonical phone number changes. Preserve verification when a formatting-only edit leaves the canonical number unchanged. Produce a reviewable pull request with appropriate tests and a migration plan.

This apparently small feature touches requirements, normalization, update paths, persistence, migrations, and verification. It illustrates why a better prompt alone may be insufficient.

### Prompt: Express the Desired Behavior

The task must define what counts as a phone-number change, how removal behaves, what the output should contain, and which ambiguities require clarification.

### Context: Supply the Relevant Evidence

The agent needs the schema, normalization utility, verification workflow, all relevant write paths, migration conventions, and existing tests.

### Harness: Enable Controlled Execution

The agent needs a workspace, file-editing tools, a test runner, an appropriate disposable database, bounded command execution, and a way to preserve progress and produce a diff.

### Loop: Drive the Work to a Verified Outcome

The system must decide how to inspect, implement, test, diagnose failures, revise, and stop. Passing one test does not demonstrate that every update path preserves the invariant.

## 3. Prompt Engineering: Design the Behavioral Contract

Prompt engineering concerns the wording and organization of instructions and examples that guide model behavior. It includes defining the task, constraints, decision criteria, and expected output.

**Analogy:** Give an engineer a ticket with acceptance criteria, instead of asking them to “improve phone verification.”

### Example Task Specification

```text
Implement phone-verification tracking in the existing service.

Required behavior:
- Add a nullable phone_verified_at timestamp using project migration conventions.
- Reset verification when the canonical phone number changes.
- Preserve verification for formatting-only edits with the same canonical number.
- Reset verification when an existing phone number is removed.
- Use the established normalization and validation behavior.

Investigate:
- All supported phone-number write paths, including administrative and bulk updates.
- Existing null, empty-string, and invalid-input behavior.
- Deployment compatibility and migration risks.

Deliver:
- A focused code change.
- Tests covering the behavioral requirements.
- A summary of validation, migration implications, and unresolved assumptions.

If existing behavior leaves a material product decision ambiguous,
identify it before implementing that decision.
```

This is an illustrative specification; actual requirements must match the service's domain rules.

### Engineering Practices

- Specify observable outcomes and invariants.
- Distinguish requirements from suggestions and examples.
- Define what to do when evidence is missing or contradictory.
- Use structured output when downstream software must consume the result; validate the structure outside the model.
- Version prompts and evaluate changes against representative tasks.

### Failure Modes

Ambiguous requirements, contradictory instructions, examples that imply the wrong behavior, and claims of completion without supporting evidence.

**Boundary:** A prompt can request a restriction. Runtime enforcement belongs in the harness. “Do not access production” is an instruction; withholding production credentials and network access is an enforced boundary.

## 4. Context Engineering: Manage the Model's Working Set

Context engineering selects, organizes, retrieves, and updates the information available to the model at each invocation. It includes instructions as well as code, documents, conversation history, tool results, and carried-forward state.

**Analogy:** Prepare the files, logs, and design notes an engineer needs for the current debugging step.

### Context for the Running Example

| Information | Why it matters |
|---|---|
| Current database schema and migration conventions | Avoid incompatible schema changes or incorrect rollback assumptions |
| Canonical phone normalization utility | Compare semantic values rather than raw formatting |
| API, UI, admin, import, and background-job write paths | Find updates that could bypass reset logic |
| Verification completion workflow | Understand when and how the timestamp is set |
| Existing tests and fixtures | Preserve established behavior and identify coverage gaps |
| Database engine/version and deployment process | Assess migration behavior in the actual environment |
| Recent failure output and current diff | Make the next iteration respond to current evidence |

### Engineering Practices

- Retrieve relevant material at the point of need rather than loading the entire repository.
- Track provenance: file path, revision, environment, and timestamp where relevant.
- Distinguish trusted instructions from untrusted content found in issues, documents, or tool output.
- Refresh information after edits and invalidate stale observations.
- Preserve important decisions, unresolved questions, and test evidence when summarizing long sessions.
- Supply sufficient context, while removing irrelevant or repeated material.

### Failure Modes

Stale code, missing write paths, outdated documentation, excessive irrelevant content, summaries that discard important constraints, and retrieved text that is incorrectly treated as an instruction.

**Boundary:** Retrieval is one technique within context engineering. The broader concern is everything the model sees and how that working set changes over time. Stored information helps only when relevant information is retrieved into a subsequent invocation.

## 5. Harness Engineering: Build the System Around the Model

The harness is the software that connects the model to its working environment. It invokes the model, executes permitted tool calls, handles results, maintains sessions and state, and implements operational controls. Harness engineering can also include shaping the repository and development environment so agents can navigate and verify work effectively.

**Analogy:** Combine an IDE, isolated development workspace, CI runner, permission system, and execution log.

### Harness for the Running Example

- An isolated checkout associated with a known base revision.
- File read/edit tools and repository search.
- A command runner with timeouts, cancellation, and bounded output.
- A disposable test database with appropriate configuration and no production credentials.
- Migration and test execution tools.
- Checkpoints for task state and work products.
- Traces connecting model decisions, tool calls, results, and revisions.
- Permission enforcement around external writes, deployment, and other consequential actions.

### Engineering Practices

- Define narrow tool interfaces with clear arguments, results, and error semantics.
- Enforce capabilities and permissions outside the model.
- Handle process failures, timeouts, interrupted sessions, and recovery explicitly.
- Make external mutations idempotent where possible; track whether an action already occurred before retrying.
- Preserve enough execution evidence to diagnose failures without exposing secrets.
- Keep test environments reproducible and distinguish environment failures from implementation failures.

### Failure Modes

Overpowered credentials, broken tool contracts, inconsistent environments, lost state, duplicate external mutations after retries, and missing telemetry.

**Boundary:** Creating a test runner is a harness concern. Deciding when to run it and how its results alter the next action is a loop concern. The same implementation often handles both.

## 6. Loop Engineering: Design the Feedback and Control Policy

Loop engineering defines how work progresses through repeated model calls and tool execution. It determines the next action based on observed state, evidence, and remaining resources.

**Analogy:** A controller checks the current state against a target, chooses a corrective action, and stops or escalates when appropriate.

A useful pattern is:

1. Observe the current state.
2. Choose an action.
3. Execute through the harness.
4. Evaluate the result against explicit criteria.
5. Update task state and context.
6. Continue, finish, or escalate.

### Illustrative Controller Logic

```python
# Conceptual pseudocode, not a production implementation.
state = inspect_task()
budget = Budget(max_steps=20, max_minutes=15)

while budget.remaining():
    context = assemble_context(state)
    action = choose_action(context)
    result = execute_with_permissions(action)
    state = record_observation(state, action, result)

    if completion_evidence_satisfies_requirements(state):
        return reviewable_artifact(state)

    if material_decision_needs_human_input(state):
        return escalate_with_evidence(state)

    if repeated_failure_without_progress(state):
        return blocked_with_diagnostics(state)

return incomplete_with_checkpoint(state)
```

### Completion Criteria for the Running Example

Completion evidence could include:

- Migration application succeeds in a representative disposable environment.
- Formatting-only edits preserve verification.
- Changes to the canonical number and phone removal reset verification.
- Invalid inputs follow the established validation contract.
- Supported write paths uphold the invariant.
- Relevant regression tests pass and the resulting diff meets the task scope.
- Deployment assumptions and residual risks are documented for review.

A rollback check is appropriate when the project's migration strategy requires it. Migration runtime and locking should be assessed against realistic data and database behavior when material to deployment.

### Engineering Practices

- Define measurable success and explicit terminal states: completed, blocked, failed, canceled, or budget exhausted.
- Prefer executable checks and authoritative evidence over model self-assessment.
- Classify failures before retrying: transient infrastructure failure, code defect, missing context, or unresolved requirement.
- Detect repeated actions and lack of progress.
- Bound time, tool calls, model usage, and external mutations.
- Escalate with specific evidence and the decision needed.

### Failure Modes

Unbounded retries, cycling between equivalent fixes, treating a model's confidence as verification, optimizing for incomplete tests, and continuing after the useful budget is exhausted.

**Boundary:** Repetition alone is not feedback. Reissuing “try again” without interpreting the failure is a weak loop. A scheduled recurring task may contain a feedback loop, but scheduling itself does not establish one.

## 7. How the Concerns Fit Together

| Relationship | Practical interpretation |
|---|---|
| Prompt and context | Instructions are part of the model's context; prompt engineering focuses on their behavioral effect. |
| Context and harness | The harness implements mechanisms for retrieval, tool results, memory, and context assembly. |
| Harness and loop | The harness executes actions and enforces limits; the loop policy chooses actions and responds to evidence. |
| Loop and context | Every action changes what may be relevant to the next model invocation. |

These distinctions describe design responsibilities. They do not require four separate services, teams, or frameworks.

## 8. Why Software Engineers Should Care

### Diagnose the Actual Failure

| Symptom | First area to investigate | Concrete intervention |
|---|---|---|
| The agent implements the wrong interpretation of “phone changed.” | Prompt | Specify canonical comparison and removal behavior. |
| It misses an administrative update path. | Context | Retrieve and inspect that path; improve discovery coverage. |
| It cannot run tests or uses the wrong database configuration. | Harness | Repair the runner and environment contract. |
| It repeats the same failing patch. | Loop | Classify the failure, detect repetition, and change strategy or escalate. |
| It declares completion after a narrow test passes. | Loop and prompt | Define completion evidence that covers the actual requirements. |
| It follows malicious instructions embedded in retrieved content. | Context and harness | Preserve trust boundaries and enforce restricted capabilities. |

A symptom is a starting point, not proof of root cause. Review the execution trace before choosing an intervention.

### Evaluate Changes Independently

| Concern | Useful measurements |
|---|---|
| Prompt | Requirement adherence, output validity, task success on fixed examples |
| Context | Retrieval coverage, source freshness, omission rate, context size |
| Harness | Tool success rate, recovery behavior, permission enforcement, environment reproducibility |
| Loop | Verified completion rate, steps to completion, no-progress rate, escalation quality, cost and latency |

Evaluate the complete system as well. A faster loop that produces more regressions is not an improvement.

For meaningful comparisons, use representative tasks, record the model and configuration, retain the base repository revision, and change one major variable at a time where practical. Some model behavior varies between runs, so avoid drawing strong conclusions from a single successful demonstration.

### Match Complexity to the Task

| Workload | Reasonable starting point |
|---|---|
| Explain a function or draft release notes | Clear instructions and relevant source material |
| Answer questions over internal documentation | Context selection, provenance, and access controls |
| Implement a bounded repository change | A controlled execution harness and verification loop |
| Run repeated maintenance tasks | Persistent state, budgets, recovery, reliable checks, and escalation rules |

The choice is about the workload and consequences, not whether a team has adopted the newest terminology.

## 9. A Practical Adoption Sequence

1. Define the task and acceptance evidence.
2. Establish a baseline on representative examples.
3. Improve instructions when failures show ambiguity.
4. Improve context when failures show missing or stale information.
5. Add tools and runtime controls needed for execution.
6. Introduce iteration when observed results can guide the next action.
7. Monitor outcomes and adjust the component responsible for recurring failures.

For the phone-verification feature, reliable delivery means the requested invariant holds across supported operations and the change is reviewable. A persuasive explanation from the agent is useful, but it is not sufficient completion evidence.

## References and Terminology Note

The definitions above synthesize the sources below into a practical engineering framework. The running example, pseudocode, diagnostic mappings, and measurement suggestions are illustrative recommendations, not a formal industry standard.

- [Anthropic: Effective context engineering for AI agents](https://www.anthropic.com/engineering/effective-context-engineering-for-ai-agents) — instructions, context selection, retrieval, and context management.
- [OpenAI: Harness engineering](https://openai.com/index/harness-engineering/) — agent-friendly environments, tooling, constraints, and feedback systems.
- [IBM: What is loop engineering?](https://www.ibm.com/think/topics/loop-engineering) — iterative agent workflows, feedback, and stopping criteria.
