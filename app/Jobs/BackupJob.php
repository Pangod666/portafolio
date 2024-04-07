<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facade\Artisan;

class BackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fecha = Carbon::now();
        
        $nombreArchivo = 'respaldo_' . str($fecha) . '.sql';

        // Ejecutar el comando mysqldump para generar el respaldo
        $comando = sprintf(
            'mysqldump -u%s -p%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE'),
            storage_path('app/' . $nombreArchivo)
        );

        exec($comando);
    }
}


