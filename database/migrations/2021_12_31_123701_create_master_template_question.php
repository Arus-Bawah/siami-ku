<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTemplateQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_template_question', function (Blueprint $table) {
            $table->id();
            $table->integer("master_template_category")->nullable();
            $table->integer("ordering")->nullable();
            $table->text("question")->nullable();
            $table->text("keterangan")->nullable();
            $table->double("capaian")->nullable();
            $table->string("type_answer")->nullable();
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
        Schema::dropIfExists('master_template_question');
    }
}
