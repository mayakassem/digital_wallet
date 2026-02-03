# digital_wallet

# Bank Webhooks & Payment XML Generator

This project demonstrates a scalable and clean architecture for handling incoming bank webhooks and generating outgoing payment XML messages using Laravel.

The solution focuses on:
- Clean separation of responsibilities
- Extensibility for adding new banks
- Testability and performance considerations

---

## Overview

The system is divided into two main flows:

1. **Receiving Webhooks (Inbound)**
2. **Generating Payment XML (Outbound)**

Each flow is intentionally isolated to keep the codebase easy to maintain and extend.

---

## Inbound Flow: Receiving Bank Webhooks

### Flow Description

HTTP Request
↓
WebhookController
↓
WebhookStoreService
↓
BankWebhook (DB)
↓
ProcessWebhookJob (Queue)
↓
WebhookProcessingService
↓
BankResolverService
↓
BankParser (per bank)


### Key Concepts

#### 1. Webhook Storage
- Incoming webhooks are stored **as-is** without business logic.
- This ensures:
  - No data loss
  - Easy reprocessing
  - Decoupling ingestion from processing

#### 2. Asynchronous Processing
- Webhooks are processed using queued jobs.
- This allows the system to scale with high webhook volume without blocking HTTP requests.

#### 3. Strategy Pattern for Parsing
- Each bank has its own parser implementing a shared interface:
  - `BankParserInterface`
- No `switch` or `if/else` logic is used in the processing layer.
- Adding a new bank requires:
  - Creating a new parser
  - Registering it in `BankResolverService`

This design follows the **Open/Closed Principle**.

---

## Outbound Flow: Payment XML Generation

### Goal

Generate a bank-compliant XML payment request without handling:
- Network communication
- Persistence
- Transfer tracking

These concerns are intentionally out of scope.

### XML Builder

- Implemented in `PaymentXMLBuilder`
- Responsible only for:
  - Building XML
  - Applying conditional tags based on business rules

#### Conditional Rules Implemented

- `<Notes>` tag is omitted if no notes are provided
- `<PaymentType>` tag is omitted if value = `99`
- `<ChargeDetails>` tag is omitted if value = `SHA`

This keeps the builder deterministic and testable.

---

## Automated Testing

The solution is fully covered by automated tests.

### Test Types

#### 1. Unit Tests
- Bank parsers
- Bank resolver
- XML builder

#### 2. Performance Test
- Parsing 1,000 webhook transactions
- Ensures acceptable performance under load

The performance test demonstrates scalability and efficiency considerations.

---

## Design Decisions

- **Services over Fat Controllers**
- **No business logic inside controllers**
- **No static parsing logic**
- **No hard-coded conditionals for bank types**
- **Clear boundaries between layers**

Some parts may appear over-engineered intentionally to demonstrate design and architectural skills.

---

## Code Quality

- Consistent formatting and naming
- No commented-out code
- No debug calls (`dd`, `dump`, etc.)
- Clear class responsibilities
- Explicit dependencies via constructor injection

---

## Extending the System

### Adding a New Bank
1. Create a new parser implementing `BankParserInterface`
2. Register it in `BankResolverService`
3. Add unit tests

No existing code needs to be modified.

---

## Notes for Reviewers

- Webhook payload formats are assumed to be bank-specific and inconsistent by design.
- Parsing logic is intentionally isolated to minimize blast radius.
- XML generation is intentionally decoupled from transport layers.

---

## Tech Stack

- PHP 8+
- Laravel
- PHPUnit
- Queues for async processing

---

Thank you for reviewing this solution.
