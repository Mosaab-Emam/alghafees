# WhatsApp messages from Contacts

The Contacts resource uses the existing `services.wasender.api_key` connection. Messages are plain text and support Arabic. There is no message history table or saved outgoing-message content in the database.

## Dashboard actions

- **إرسال واتساب** on a contact: choose one of the contact's usable phone numbers and enter a message.
- **إرسال واتساب للمحدد**: use the table checkboxes to select contacts, then compose one shared message.
- **إرسال واتساب لنتائج التصفية**: apply category filters and/or table search, then send to the matching contacts across all pages. The confirmation modal lists the actual recipient names/numbers and excluded contacts before sending.

Bulk messaging sends individual messages, rather than creating a WhatsApp group. The recipient list is frozen when the modal opens. Bulk sends use the first usable phone per contact. Shared numbers are deduplicated; contacts without a usable number are excluded with an explanation. A contact deleted or whose number changes before sending is skipped with a visible error.

Default limits are 100 contacts per batch and 4,000 characters per message. `WASENDER_LEAD_BATCH_LIMIT` can change the contact limit. Each user can have one active batch at a time, including across browser tabs, to prevent duplicate submissions.

International E.164 phone numbers are accepted, including `00` international prefixes and Arabic/Persian digits. Recognizable Saudi mobiles (`05xxxxxxxx` or `5xxxxxxxx`) are converted to `+966`. Other local phone formats need an explicit country code; the app does not guess it.

## Background sending and notifications

Sending runs on the dedicated `lead_whatsapp` queue connection and `lead-whatsapp` queue, backed by the `lead_whatsapp_jobs` table. This leaves the rest of the application's queue configuration unchanged. Each job payload contains only the batch UUID and initiating user ID.

The message is temporarily encrypted with Laravel's application key in the configured cache store. The default is the local file cache, under `storage/framework/cache/data`; a shared cache with atomic locks such as Redis is required when web and queue workers run on different hosts. Configure it with `WASENDER_LEAD_CACHE_STORE=redis`. Do not use an in-memory `array` cache, clear this cache, or rotate `APP_KEY` while batches are active.

The encrypted text is removed on completion, cancellation, or failure. A fixed 48-hour batch deadline bounds rate-limit retries and temporary retention. Finished progress metadata, without message text, expires after one hour. Only counts and a Contacts link are saved in the completion notification. Provider response bodies are not logged by the WhatsApp service.

The dashboard shows live progress, rate-limit waits, per-contact failures, and a cancel button. Refreshing or returning to Contacts restores the latest batch's progress while its metadata remains available. The job continues if the user closes the page, and a dashboard notification reports the accepted, failed/unconfirmed, and excluded counts. Cancellation stops remaining recipients; a request already in flight may still be accepted.

Success means the API acknowledged the request with `success: true`; it is not a delivery or read receipt. Ambiguous timeouts and worker crashes are not retried automatically for the affected recipient, since the provider may already have accepted it. Their error directs the user to check WA Sender before sending again.

## Adaptive rate limiting

Requests are sequential, with a shared sender lock to serialize contact batches using the same configured API key. Normal batches start with a one-second interval. With account protection enabled, a rejected recipient remains pending; HTTP 429 or a recognized legacy account-protection error causes a delayed retry of that same recipient, rather than dropping it or advancing the list.

Delays use the provider's JSON `retry_after` or `Retry-After` header; exhausted-window reset headers are a fallback. With no usable hint, the fallback is five seconds, plus a one-second boundary cushion. A rejected batch adopts a slower interval for subsequent recipients. Repeated rate-limit rejections continue retrying up to the batch deadline. Waiting releases the queue job, so it does not hold up a worker. Accepted recipients are never automatically re-sent.

This works with account protection on or off and also accommodates the longer trial/daily rate limits. Other activity using the same WA Sender account, including the existing chatbot, may consume its sending allowance; the new sender respects resulting rate-limit responses.

API authentication, subscription, or session failures stop the batch with clear errors. A rejected recipient can fail independently while other recipients continue. The worker checks the initiating user's sending permission and dashboard access before each attempt.

Protocol references: [send text message](https://wasenderapi.com/api-docs/messages/send-text-message), [rate limits](https://www.wasenderapi.com/api-docs/rate-limits/understanding-rate-limits), [error responses](https://www.wasenderapi.com/api-docs/responses-errors/error-responses).

## Deployment and local setup

The Contacts/category and permission migrations, plus `2026_10_10_000002_create_lead_whatsapp_queue_and_permission.php`, have been applied to the local database. Apply these migrations through the normal hosting deployment process as well. The new `send_whatsapp_lead` permission is granted to the existing **المدير العام** role; assign it to other permitted roles on the Shield roles page. Existing dashboard access restrictions continue to apply.

For immediate processing, run a supervised worker:

```sh
php artisan queue:work lead_whatsapp --queue=lead-whatsapp --sleep=1 --timeout=45 --tries=0
```

Locally, use `/opt/homebrew/opt/php@8.3/bin/php` instead of the system PHP 8.5. The existing Laravel scheduler also has a dedicated worker command that drains this queue every minute; it requires the normal `schedule:run` cron to be active. It processes only the new Contacts queue. No WA Sender account settings need to be queried or changed.

The request timeout is 20 seconds, the worker timeout is 45 seconds, lock leases are 60 seconds, and the queue reservation timeout is 90 seconds. Keep that ordering when customizing workers to prevent overlapping API requests.

Automated tests were skipped per AGENTS.md. No live WhatsApp messages were sent during implementation.
