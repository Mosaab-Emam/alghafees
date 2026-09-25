# Evaluation role WhatsApp notifications

Assigning an employee on creation, or replacing an employee on update, sends an Arabic WhatsApp notification immediately for each changed role:

| Field | Arabic role |
| --- | --- |
| evaluation_employee_id | الإدخال |
| previewer_id | المعاين |
| review_id | المقيم |
| income_id | المراجع |
| approver_id | المعتمد |

Unchanged assignments and removals do not notify anyone. Assigning the same employee to multiple roles produces a separate message for each role. Existing assignments are not backfilled. Model events cover Eloquent creates/updates; direct SQL and bulk query updates bypass these events.

Employees now have an optional phone field in both the dashboard employee editor and the legacy admin editor. Enter an international number such as `+966501234567`. Missing or invalid phone numbers are skipped and logged. Adding a phone later does not resend a previously skipped notification.

Notifications are synchronous, with no queue or worker. When a save is inside a database transaction, delivery occurs immediately after commit; rolled-back assignments do not send messages. Each notification makes one API request, without throttling or rate-limit retries. Delivery failures are logged without interrupting the saved evaluation or the remaining notifications. Failed sends are not automatically retried. Saving waits for the API requests to finish (each has a 20-second request timeout).

## Local setup

Composer and npm dependencies are installed from their lock files, and frontend assets have been built. Use the available PHP 8.3 runtime: the locked dependencies reject the system PHP 8.5 runtime. The new migration has already been applied to the local database with:

```sh
/opt/homebrew/opt/php@8.3/bin/php artisan migrate --path=database/migrations/2026_09_17_000000_add_phone_to_evaluation_employees_table.php
```

No migration has been run on hosting. Laravel startup succeeds locally.

The existing `.env.example` and `config/services.php` already define:

```dotenv
WASENDER_API_KEY=
WASENDER_API_WEBHOOK_SECRET=
```

Set the API key to the connected WhatsApp session's API key. The webhook secret is used by the existing inbound bot; outgoing assignment messages do not require a new webhook. Refresh cached configuration after changing environment variables.

No queue configuration or worker is required. No live WhatsApp messages have been sent as part of this change.

## Manual testing scenario

1. Add your own WhatsApp number to a test employee. For المعتمد, use one of the existing permitted approver employees (IDs 179 or 64).
2. Create an evaluation with that employee assigned to a role. Confirm one Arabic message with the correct role and transaction number arrives immediately on saving.
3. Repeat for all five roles. The same employee in several roles should receive one message per role.
4. Save the evaluation again without changing assignments, then edit only its notes. Neither save should send another assignment message.
5. As the assigning admin (existing role locks still apply), replace an assignee: only the new employee should receive a message. Clear a role: no notification should be sent.
6. Assign an employee without a phone: the save should succeed and log a skip. With an invalid API key, confirm the assignment is saved, a delivery failure is logged, and the page still returns successfully.

Example message:

> مرحباً أحمد،
> تم إسناد دور «المقيم» إليك في معاملة التقييم رقم 12345.
> يرجى متابعة المعاملة في النظام.
> شركة صالح الغفيص للتقييم العقاري

Implementation follows [WASenderAPI text-message documentation](https://wasenderapi.com/api-docs/messages/send-text-message) (`POST /api/send-message`, Bearer authentication, `to` and `text`).

Automated tests were not run per the project's AGENTS.md policy. PHP syntax and diff checks passed; runtime delivery remains to be verified manually using a test employee's WhatsApp number.
