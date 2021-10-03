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
			$table->string('cnpj',19)->unique()->nullable();
			$table->string('razao_social',100)->nullable();
			$table->string('nome_recrutador',50)->nullable();
			$table->mediumText('desc_empresa',45)->nullable();
			$table->string('tipo_vaga',25)->nullable();
			$table->string('cargo',50)->nullable();
			$table->integer('n_vagas')->nullable()->default(1);
			$table->string('forma_trabalho',20)->nullable();
			$table->longText('desc_vaga')->nullable();
			$table->longText('qualificacao')->nullable();
			$table->decimal('remuneracao',10,2)->nullable();
			$table->mediumText('beneficios')->nullable();
			$table->string('jornada',70)->nullable();
			$table->string('cep', 13)->nullable();
			$table->string('endereco', 100)->nullable();
			$table->string('numero', 45)->nullable();
			$table->string('bairro', 45)->nullable();
			$table->char('estado', 2)->nullable();
			$table->string('cidade', 100)->nullable();
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
