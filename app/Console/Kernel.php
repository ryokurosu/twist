<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       // \App\Console\Commands\Inspire::class,
       \App\Console\Commands\DailyStatistic::class,
       \App\Console\Commands\Tweet::class,
       \App\Console\Commands\GetFollowers::class,
       \App\Console\Commands\ThanksDM::class,
       \App\Console\Commands\ThanksReplytweet::class,
       \App\Console\Commands\Autofollow::class,
       \App\Console\Commands\Autounfollow::class,
       \App\Console\Commands\Autolike::class

   ];


    /**
     * アプリケーションのコマンド実行スケジュール定義
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dailystatistic')->daily();
        $schedule->command('getfollower')->hourly();
        $schedule->command('autolike')->hourly();
        $schedule->command('tweet')->everyMinute();
        $schedule->command('thanksreplytweet')->everyMinute();
        $schedule->command('thanksdm')->everyMinute();
        $schedule->command('autofollow')->everyMinute();
        $schedule->command('autounfollow')->everyMinute();
    }



    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
