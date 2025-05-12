<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos Artisan personalizados.
     */
    protected $commands = [
        // Registra aquí tus comandos personalizados
    ];

    /**
     * Define la programación de comandos.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('pagos:mensuales')->monthlyOn(1, '00:01');
    }

    /**
     * Registra los archivos de comandos.
     */
    protected function commands(): void
    {
        
    }
}
