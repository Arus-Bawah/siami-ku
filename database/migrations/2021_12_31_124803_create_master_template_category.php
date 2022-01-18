<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTemplateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_template_category', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("master_template")->nullable();
            $table->string("main_category")->nullable();
            $table->string("category")->nullable();
            $table->integer("ordering")->nullable();
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
        Schema::dropIfExists('master_template_category');
    }
}
