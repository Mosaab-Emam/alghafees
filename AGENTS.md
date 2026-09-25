# Agent instructions

## Testing

Do **not** run PHPUnit, Pest, `php artisan test`, or any other automated test commands in this project unless the user explicitly asks you to run them. Do not suggest running tests as a follow-up step.

Reason: the test setup previously targeted a real database; running tests here can be destructive. The user prefers agents skip testing entirely.
