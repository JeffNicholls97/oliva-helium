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
        Commands\GetHeliumPriceHourly::class,
        Commands\GetTotalMiners::class,
        Commands\GetMinerName::class,
        Commands\GetMinerTopStats::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('heliumprice:cron')
            ->everyMinute()->appendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('totalminers:cron')
            ->everyMinute()->appendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('minername:cron')
            ->everyMinute()->appendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('minertopstats:cron')
            ->daily()->appendOutputTo(storage_path('logs/scheduler.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
