<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasRolesTable extends Migration
{
    public function up()
    {
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->id(); // ID de la tabla

            // Se utiliza morphs para manejar la relación polimórfica
            $table->morphs('model'); // Crea las columnas model_id y model_type

            // Relación con la tabla roles
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')->on('roles') // Hace referencia a la tabla roles
                ->onDelete('cascade'); // Si se elimina un rol, también se eliminan sus relaciones

            $table->timestamps(); // Registra las fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_roles');
    }
}

