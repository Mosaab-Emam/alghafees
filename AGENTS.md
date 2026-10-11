# Agent instructions

## Testing

Do **not** run PHPUnit, Pest, `php artisan test`, or any other automated test commands in this project unless the user explicitly asks you to run them. Do not suggest running automated test suites as a follow-up step.

Reason: the test setup previously targeted a real database; running automated tests here can be destructive. The user prefers agents skip automated testing.

The production checks described below are allowed for deployment work: check the new code when it is simple to check or does not involve writing to the database; otherwise, suggest a manual check. This does not authorize running automated test suites.

## Production deployment

Use this workflow when the user requests a deployment. Production uses shared hosting; the site is `https://alghafestaqeem.com`.

1. Commit and push the intended changes to GitHub if they have not already been committed and pushed.
2. Connect to the production shared hosting box:

   ```bash
   ssh alghafees
   ```

3. Select the project directory for the branch being deployed. The `main` branch lives in:

   ```bash
   cd domains/alghafestaqeem.com/source
   ```

   Other branches have their own directories, such as `domains/alghafestaqeem.com/internal`. Confirm the correct directory and branch before pulling; do not deploy a non-main branch into `source`.

4. Pull the latest changes from GitHub for that branch. For `main`:

   ```bash
   git pull --ff-only origin main
   ```

5. Apply migrations if the deployed changes include new migrations:

   ```bash
   php artisan migrate --force
   ```

6. Determine whether the public site changed. If the changes affect only the dashboard, skip the frontend dependency installation and build in the next step.
7. If the public site changed, load `nvm`, select an installed Node version compatible with the project using `nvm use`, and install dependencies (`npm ci` when a lockfile is available, otherwise `npm install`). Shared hosting has limited resources, so use this build command instead of a plain `npm run build`:

   ```bash
   RAYON_NUM_THREADS=1 \
   RUST_MIN_STACK=1048576 \
   UV_THREADPOOL_SIZE=1 \
   GOMAXPROCS=1 \
   npm run build
   ```

   Confirm the build completes successfully before continuing.

8. Clear and rebuild Laravel's optimized caches:

   ```bash
   php artisan optimize:clear && php artisan optimize
   ```

9. Shared hosting serves the application directly. Do not run `php artisan serve` or start a development server on production.
10. Check the new code in production when it is straightforward to check or can be checked without writing to the database. Otherwise, suggest a manual check. Follow the automated-test restriction above; do not run a test suite against production.
