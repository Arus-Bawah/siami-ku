<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditKelengkapanAnswersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audit_kelengkapan_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('audit_kelengkapan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
