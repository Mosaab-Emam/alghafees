# Training questionnaire

The Arabic form is available at `/training-completion`. It requires no login and is intentionally absent from site navigation and the sitemap. The page sends `noindex, nofollow, noarchive` in both the HTML metadata and the `X-Robots-Tag` response header. Anyone with the URL can access it.

All seven answers are required. The first three questions offer نعم / لا; marital status offers أعزب / عزباء, متزوج / متزوجة, مطلق / مطلقة, and أرمل / أرملة. Questions and answer labels are defined in `config/training.php` and shared by the form, validation, email templates, and WhatsApp message.

Submissions are sent synchronously, with CSRF protection, server-side validation, a honeypot, and a limit of five POST requests per ten minutes per IP. The applicant receives a success state after all selected delivery services accept the messages. Failed sends retain the form answers. No questionnaire records or migrations are added, and no queue worker is required.

## Delivery method and WhatsApp destination

Two feature-specific environment variables select delivery:

```dotenv
TRAINING_QUESTIONNAIRE_DELIVERY_METHOD=email
TRAINING_QUESTIONNAIRE_WHATSAPP_NUMBER=
```

`TRAINING_QUESTIONNAIRE_DELIVERY_METHOD` accepts `email` (the default), `whatsapp`, or `both`, case-insensitively. Email uses the existing dedicated SMTP configuration and `TRAINING_QUESTIONNAIRE_RECIPIENT`. WhatsApp sends an Arabic text message with the applicant's name, email, phone, all four questions and their answer labels, and the submission time in Riyadh. Its destination is `TRAINING_QUESTIONNAIRE_WHATSAPP_NUMBER`, not the applicant's phone number.

Set the WhatsApp destination to a full international number with country code, for example `+966501234567`. An initial `00` is also accepted; spaces, parentheses, and hyphens are removed. WhatsApp uses the site's existing `WhatsAppService` and `WASENDER_API_KEY`, with its connected WaSender session. It does not use SMTP. SMTP does not need to be configured in `whatsapp` mode; WhatsApp settings do not need to be configured in `email` mode.

All selected destinations are validated before sending. Missing configuration or an invalid method returns an error. In `both` mode, each channel is attempted even if the other fails. If only one succeeds, the form reports incomplete delivery and preserves the answers; retrying can send another copy through the channel that already succeeded. Provider rate limits return an error without holding the form open for a delayed retry.

After changing production `.env`, refresh the cached configuration from `domains/alghafestaqeem.com/source`:

```bash
php artisan optimize:clear && php artisan optimize
```

## Delivery logs

Successful email sends write an INFO entry, `Training questionnaire email accepted by SMTP.`, to the application's configured log channel (locally, `storage/logs/laravel.log`). The entry includes the log timestamp, mailer name, SMTP message ID, actual envelope sender and recipients, and send duration in milliseconds. WhatsApp acceptance writes `Training questionnaire WhatsApp message accepted by provider.` with the provider's message ID, configured target number, and duration. Both channels share a submission UUID for correlating their entries. Applicant answers, names, phone numbers, Reply-To addresses, credentials, and provider response bodies are not logged by questionnaire delivery.

These entries confirm service acceptance, not inbox delivery or WhatsApp delivery/read receipts. A send that returns no sent message or an unconfirmed WhatsApp API response is treated as a failure. Failed sends write `Training questionnaire email delivery failed.` or `Training questionnaire whatsapp delivery failed.` with the exception type and submission UUID. WhatsApp errors also include the service's fixed failure reason when available. Invalid configuration writes `Training questionnaire delivery configuration failed.` with a safe configuration reason. Keep the application's log level at `info` or lower to retain success entries.

## Email delivery setup

The default sender is `taqeem@alghafestaqeem.com`, the default recipient is `mosaab.emam123@gmail.com`, and Reply-To is the applicant's email. Messages include an Arabic HTML layout and a plain-text alternative. Both sender and recipient can be configured specifically for this feature.

All questionnaire mail settings use the `TRAINING_QUESTIONNAIRE_` prefix. This mailer does not inherit or change the site's global `MAIL_*` settings. Its SMTP connection is defined in `config/mail.php`; its sender and recipient are defined in `config/training.php`.

Email delivery requires the settings supplied by the provider hosting `taqeem@alghafestaqeem.com`:

```dotenv
TRAINING_QUESTIONNAIRE_MAIL_HOST=your-provider-smtp-host
TRAINING_QUESTIONNAIRE_MAIL_PORT=587
TRAINING_QUESTIONNAIRE_MAIL_ENCRYPTION=tls
TRAINING_QUESTIONNAIRE_MAIL_USERNAME=taqeem@alghafestaqeem.com
TRAINING_QUESTIONNAIRE_MAIL_PASSWORD="your-provider-smtp-password-or-app-password"
TRAINING_QUESTIONNAIRE_MAIL_TIMEOUT=30
TRAINING_QUESTIONNAIRE_MAIL_FROM_ADDRESS=taqeem@alghafestaqeem.com
TRAINING_QUESTIONNAIRE_MAIL_FROM_NAME="شركة صالح علي الغفيص للتقييم العقاري"
TRAINING_QUESTIONNAIRE_RECIPIENT=mosaab.emam123@gmail.com
```

Use the provider's actual port, encryption, and username; some providers require port 465 with `ssl` or a different username. The provider must authorize sending from `taqeem@alghafestaqeem.com`. Set credentials privately in the environment, not in source control. Configure any sender-domain DNS records required by that provider (SPF/DKIM).

`TRAINING_QUESTIONNAIRE_MAIL_EHLO_DOMAIN` is optional; set it only if your provider requires a specific SMTP greeting domain. The timeout is in seconds. There is no fallback to the site's SMTP connection when these settings are missing.

For a local mail catcher, configure the dedicated host and port for that catcher and set `TRAINING_QUESTIONNAIRE_MAIL_ENCRYPTION=null`, `TRAINING_QUESTIONNAIRE_MAIL_USERNAME=null`, and `TRAINING_QUESTIONNAIRE_MAIL_PASSWORD=null` as appropriate.

After updating the environment, run `php artisan config:clear` if configuration was cached, or rebuild the deployment's configuration cache. Change `TRAINING_QUESTIONNAIRE_RECIPIENT` for production. Global `MAIL_*` values can continue to serve other site features independently.

Do not run automated test suites in this project without an explicit user request. For a manual delivery check, submit the form and inspect the selected destination(s) and corresponding acceptance/failure logs.
