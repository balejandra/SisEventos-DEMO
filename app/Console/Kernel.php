<?php

namespace App\Console;

use App\Console\Commands\VerificationZarpe;
use App\Console\Commands\VerificationZarpeRescate;
use App\Console\Commands\VerificationZarpeVencido;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       VerificationZarpeVencido::class,
        VerificationZarpeRescate::class,
    ];
    protected $routeMiddleware = [
        // ...
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('verification:zarpevencido')->everyMinute();
        $schedule->command('verification:zarperescate')->everyMinute();
        $schedule->call(function (){
            logger("Tareas ejecutando");
        })->everyTwoMinutes();
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
