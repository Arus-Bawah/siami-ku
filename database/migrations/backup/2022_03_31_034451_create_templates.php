<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('master_unit_tipe_id');
            $table->unsignedBigInteger('master_unit_id');
            $table->unsignedBigInteger('master_unit_jenjang_id')->nullable()->comment("Jika unit adalah Prodi, ex: Doktoral, Magister, Sarjana");
            $table->string('name');

            // FK
            $table->foreign('master_unit_tipe_id')->references('id')->on('master_unit_tipe')->onDelete('cascade');
            $table->foreign('master_unit_id')->references('id')->on('master_unit')->onDelete('cascade');
            $table->foreign('master_unit_jenjang_id')->nullable()->references('id')->on('master_unit_jenjang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
