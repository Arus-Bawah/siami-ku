<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('audit', function (Blueprint $table) {
            $table->string('unit')->nullable();
            $table->string('code')->nullable();
            $table->string('template_code')->nullable();
            $table->string('status_publish')->nullable();
            $table->dateTime("deleted_at")->nullable();
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
