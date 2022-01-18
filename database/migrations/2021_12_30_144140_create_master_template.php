<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_template', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("unit")->nullable();
            $table->text("purpose")->nullable();
            $table->string("audit_area")->nullable();
            $table->text("criteria")->nullable();
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
        Schema::dropIfExists('master_template');
    }
}
