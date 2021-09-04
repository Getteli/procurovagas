<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->increments('vagas_id');
            $table->integer('origem');
            $table->char('cnpj',19)->unique()->nullable();
            $table->string('razao_social',60)->nullable();
            $table->string('nome_recrutador',45)->nullable();
            $table->string('local',45)->nullable();
            $table->mediumText('desc_empresa',45)->nullable();
            $table->string('tipo_vaga',25)->nullable();
            $table->string('cargo',50)->nullable();
            $table->integer('n_vagas')->nullable()->default(1);
            $table->string('forma_trabalho',20)->nullable();
            $table->string('cidade',50)->nullable();
            $table->char('estado',2)->nullable();
            $table->longText('desc_vaga')->nullable();
            $table->longText('qualificacao')->nullable();
            $table->string('caracteristicas',45)->nullable();
            $table->decimal('remuneracao', $precision = 10, $scale = 2)->nullable();
            $table->mediumText('beneficios')->nullable();
            $table->string('jornada',70)->nullable();
            $table->dateTime('tempo_vaga')->nullable();
            $table->timestamps(); // created_at/updated_At
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
