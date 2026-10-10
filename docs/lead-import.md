# Contacts and spreadsheet import

The dashboard has **جهات الاتصال** (Contacts) and **تصنيفات جهات الاتصال** (Contact categories) next to each other in the Contacts navigation group. Categories are shared across contacts, with one optional category per contact. Deleting a category leaves its contacts intact and uncategorized.

## Setup

Apply the two new migrations using the project's normal deployment process (`php artisan migrate`). The migrations create the tables and Shield permissions. They grant the new permissions to the existing **المدير العام** role; other roles can be granted them on the dashboard Roles page. The existing restriction limiting certain accounts to evaluation transactions continues to apply.

Import requires `view_any_lead`, `create_lead` and `import_lead`. Export requires `view_any_lead` and `export_lead`. Category permissions use the existing Shield convention, for example `create_lead::category`. No queue worker, new package, or separate file storage is required.

## File format

Use **تحميل نموذج الاستيراد** on Contacts to download a blank XLSX template. Exports use the same headers and can be imported again.

- XLSX: exactly one worksheet; no password protection, formulas, or merged cells. Legacy XLS files are not accepted; save as XLSX first.
- CSV: UTF-8, with or without a UTF-8 BOM. Comma, semicolon and tab delimiters are supported. The import modal offers automatic detection or explicit selection. Quote values containing the CSV delimiter or line breaks using standard CSV double quotes.
- Maximum 10 MB, 5,000 rows after the header (including blank rows), and 100 columns. Split larger files. The limits also prevent accidental ingestion of huge sheets with stray cells.
- Row 1 must contain headers. One contact per subsequent row. Empty rows are skipped. For CSV with multiline quoted fields, reported row numbers refer to CSV records, as shown when opened in Excel.
- Only the name column is required. Other columns and their values are optional. A contact may have a name and notes without a phone or email.
- Headers can be in any order. Common Arabic/English aliases are accepted; Arabic diacritics, alef variants, case, spaces and underscores are normalized. Unknown or duplicate headers are rejected so a misspelled column cannot silently discard data. Empty columns can remain only if they contain no data.

| Field | Arabic template header | Example accepted alternatives |
| --- | --- | --- |
| Name | الاسم | اسم، الاسم الكامل، اسم جهة الاتصال، name, full_name, contact name |
| Phones | أرقام الهاتف | الهاتف، هاتف، الجوال، رقم الجوال، phone, phones, mobile, phone_number |
| Emails | البريد الإلكتروني | البريد الالكتروني، الإيميل، email, emails, email_address |
| Category | التصنيف | الفئة، تصنيف جهة الاتصال، category, lead category |
| Notes | ملاحظات | الملاحظات، notes, comments |

## Multiple phone numbers and emails

Use either or both:

- Separate values within a cell using `|`, commas (including `،`), semicolons (including `؛`), or line breaks. Example: `0501234567 | +966501234568`.
- Use separately numbered columns: `هاتف 1`, `هاتف ٢`, `phone_3`, `email 1`, `البريد الإلكتروني 2`. Values from these columns are combined.

There can be at most 20 distinct phones and 20 distinct emails per contact. Repeated values within a contact are removed. Emails are trimmed and normalized to lowercase; each must be a valid email address with at most 254 characters.

**Format phone cells as Text before entering numbers in Excel.** Numeric phone cells are rejected because Excel may have removed a leading zero or changed the number's precision. Changing the format alone cannot restore lost digits: re-enter the full number after switching to Text. CSV values are read as text.

Phone numbers must contain 7–15 digits, optionally preceded by `+`. Arabic and Persian digits are converted to Latin digits. Spaces, hyphens, dots and parentheses are removed. Scientific notation and extensions are not supported; put extensions in notes. Local numbers are preserved without guessing a country code.

Names have a maximum of 255 characters. Notes have a maximum of 10,000 characters. A category cell must match the full name of an existing category after trimming surrounding whitespace; categories are never created silently during import.

## Saving and duplicates

The complete file is validated before any contact is written, and saving is transactional. Any validation or database error leaves the import with **zero new contacts**. Import creates contacts; it never updates or merges existing records by name, phone or email.

Exact duplicates within the file or against existing contacts are skipped. The comparison includes name, category, all phones, all emails and notes. Phone/email order does not matter; normalized phone formatting and email case do not matter. A changed category or notes makes a row a new contact. The success message states how many contacts were created and how many exact matches were skipped.

## Error reporting and exports

Validation errors stay in the upload modal with the row number, Excel column letter/header, offending value and actionable correction. The modal shows the first 100 errors and offers an XLSX report containing up to 1,000 errors per attempt. Long offending values are truncated to 500 characters in the report. After correcting the errors, upload again; more errors may appear if the previous attempt reached the 1,000-error cap.

The main export respects the current table search and category filter and includes all matching contacts, across pagination. The bulk action exports only selected contacts. Both produce Arabic headers, one contact per row, and phones/emails joined by ` | `. Every cell is explicitly written as text to preserve phone numbers and prevent user content from becoming a spreadsheet formula.

Uploaded source files are temporary. Successful imports delete the temporary upload; unsuccessful uploads are left available for correction in the modal and are subject to Livewire's normal temporary-file cleanup.

No automated tests or migrations were run during implementation, per the project instructions and the need to avoid touching the configured database.
