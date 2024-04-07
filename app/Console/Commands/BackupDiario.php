<?php

namespace App\Console\Commands;
use Illuminate\Support\Facade\Artisan;

use Illuminate\Console\Command;

class BackupDiario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:diario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $now = now();
    
        if ($now->hour === 0 && $now->minute === 0) {
        
            $fecha = Carbon::now('America/La_Paz');
        
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
}
