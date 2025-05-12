<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerarPagosMensuales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generar-pagos-mensuales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contratos = \App\Models\Contrato::whereNull('fechaFin')->get();

        foreach ($contratos as $contrato) {
            // Verifica si ya tiene pago para este mes
            $fechaPago = now()->startOfMonth();
    
            $existe = \App\Models\Pago::where('idContrato', $contrato->idContrato)
                        ->whereDate('fechaPago', $fechaPago)
                        ->exists();
    
            if (!$existe) {
                // Calcula salario
                $salario = app(\App\Http\Controllers\PagoController::class)->calcularSalario($contrato->idContrato, $fechaPago);
    
                \App\Models\Pago::create([
                    'idContrato'    => $contrato->idContrato,
                    'idBanco'       => $contrato->empleado->banco->idBanco ?? 1, // Ajusta si es necesario
                    'numCuenta'     => $contrato->empleado->numCuenta ?? '0000',
                    'fechaPago'     => $fechaPago,
                    'estado'        => 1,
                    'monto'         => $salario['monto'],
                    'gratificacion' => $salario['gratificacion'],
                    'fechacreacion' => now(),
                ]);
            }
        }
    
        $this->info('Pagos mensuales generados correctamente.');
    }
}
