<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActualizarEstatusCitas extends Command
{
    protected $signature = 'citas:actualizar-estatus';

    protected $description = 'Actualizar el estatus de las citas';

    public function handle()
    {
        // Obtener la fecha actual
        $fecha_actual = Carbon::now();

        // Actualizar estatus de las citas
        DB::table('citas')
            ->where('fecha', '<', $fecha_actual->subDay())
            ->where('estatus', '=', 'En espera')
            ->update(['estatus' => 'Cancelada']);

        DB::table('citas')
            ->where('fecha', '=', $fecha_actual->copy()->addDay())
            ->where('estatus', '=', 'En espera')
            ->update(['estatus' => 'En espera']);

        $this->info('Estatus de citas actualizado exitosamente.');
    }
}

