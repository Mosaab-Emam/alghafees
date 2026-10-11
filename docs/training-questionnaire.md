# Training questionnaire

The Arabic form is available at `/training-completion`. It requires no login and is intentionally absent from site navigation and the sitemap. The page sends `noindex, nofollow, noarchive` in both the HTML metadata and the `X-Robots-Tag` response header. Anyone with the URL can access it.

All seven answers are required. The first three questions offer نعم / لا; marital status offers أعزب / عزباء, متزوج / متزوجة, مطلق / مطلقة, and أرمل / أرملة. Questions and answer labels are defined in `config/training.php` and shared by the form, validation, and email templates.

Submissions use the dedicated `training_questionnaire` SMTP mailer synchronously, with CSRF protection, server-side validation, a honeypot, and a limit of five POST requests per ten minutes per IP. The applicant receives a success state after SMTP accepts the message. Failed sends retain the form answers. No questionnaire records or migrations are added, and no queue worker is required.

## Delivery logs

Successful form sends write an INFO entry, `Training questionnaire email accepted by SMTP.`, to the application's configured log channel (locally, `storage/logs/laravel.log`). The entry includes the log timestamp, mailer name, SMTP message ID, actual envelope sender and recipients, and send duration in milliseconds. Applicant answers, names, phone numbers, Reply-To addresses, credentials, and SMTP transcripts are not logged.

This confirms SMTP acceptance, not inbox delivery; delivery may happen later. A send that returns no sent message is treated as a failure. Failed sends continue to write `Training questionnaire email delivery failed.` with the exception type. Keep the application's log level at `info` or lower to retain success entries.

## Email delivery setup

The default sender is `taqeem@alghafestaqeem.com`, the default recipient is `mosaab.emam123@gmail.com`, and Reply-To is the applicant's email. Messages include an Arabic HTML layout and a plain-text alternative. Both sender and recipient can be configured specifically for this feature.

All questionnaire mail settings use the `TRAINING_QUESTIONNAIRE_` prefix. This mailer does not inherit or change the site's global `MAIL_*` settings. Its SMTP connection is defined in `config/mail.php`; its sender and recipient are defined in `config/training.php`.

At implementation time, the dedicated SMTP settings are not configured in local `.env`. Real SMTP delivery requires the settings supplied by the provider hosting `taqeem@alghafestaqeem.com`:

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

No automated tests or real emails were run during implementation, per project instructions and pending SMTP configuration.
