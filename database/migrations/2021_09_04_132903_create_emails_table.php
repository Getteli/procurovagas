<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('emails_id');
            $table->string('email',80)->unique()->nullable();
            $table->integer('tipo_email')->nullable();
            $table->integer('vagas_id')->unsigned()->nullable();
            $table->foreign('vagas_id')->references('vagas_id')->on('vagas')->onDelete('cascade');
            $table->integer('config_subscribe')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
