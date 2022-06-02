<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMasterUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_unit', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('master_unit_tipe_id');
            $table->unsignedBigInteger('master_unit_parent_id')->nullable()->comment("Jika unit memiliki parent, ex: Fakultas -> Prodi");
            $table->string('unit');

            // FK
            $table->foreign('master_unit_tipe_id')->references('id')->on('master_unit_tipe')->onDelete('cascade');
            $table->foreign('master_unit_parent_id')->nullable()->references('id')->on('master_unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_unit');
    }
}
