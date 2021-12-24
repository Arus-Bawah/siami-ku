<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Audit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audit', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('purpose')->nullable();
            $table->dateTime('audit_date')->nullable();
            $table->string('audit_area')->nullable();
            $table->string('audit_by')->nullable();
            $table->string('audit_leader')->nullable();
            $table->integer('siklus_number')->nullable();
            $table->integer('siklus_year')->nullable();
            $table->string('status')->nullable();
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
