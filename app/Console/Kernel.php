<?php

namespace App\Console;

use App\Models\Evaluation\EvaluationTransaction;
use App\Models\User;
use App\Notifications\TimeNotification;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use LaraZeus\Sky\Models\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');

        // Send notifications for appointments
        $schedule->call(function () {
            $user = User::find('1');
            $start_dt = Carbon::now()->subDays(3)->format('Y-m-d H:m:s');
            $end_dt = Carbon::now()->addDays(3)->format('Y-m-d H:m:s');
            foreach (['preview', 'income', 'review'] as $type) {
                $evaluation_transactions = EvaluationTransaction::where('status', 3)
                    ->whereDate($type . '_date_time', '>', $start_dt)
                    ->whereDate($type . '_date_time', '<', $end_dt)
                    ->get();
                foreach ($evaluation_transactions as $evaluation_transaction) {
                    $user->notify(new TimeNotification($type, $evaluation_transaction));
                }
            }
        })->everyMinute();

        // Generate sitemap.xml
        $schedule->call(function () {
            $sm = Sitemap::create()
                ->add(Url::create('/'))
                ->add(Url::create('/about-us'))
                ->add(Url::create('/our-services'))
                ->add(Url::create('/our-clients'))
                ->add(Url::create('/events'))
                ->add(Url::create('/privacy-policy'))
                ->add(Url::create('/request-evaluation'))
                ->add(Url::create('/blog'))
                ->add(Url::create('/contact-us'))
                ->add(Url::create('/track-your-request'))
                ->add(Url::create('/join-us'))
                ->add(Url::create('/faq'));


            // Add published blog posts
            $posts = Post::where('published_at', '!=', null)->get();
            foreach ($posts as $post) {
                $sm->add(Url::create('/blog/' . $post->slug)->setLastModificationDate($post->updated_at));
            }

            $sm->writeToFile(public_path('sitemap.xml'));
        })->everyMinute();


        // $schedule->command('queue:work --stop-when-empty')
        //     ->everyMinute()
        //     ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
