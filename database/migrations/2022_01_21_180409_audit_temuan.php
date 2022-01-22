<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditTemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audit_temuan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('audit_id')->nullable();
            $table->string('created_by')->nullable();
            $table->smallInteger('cms_users_id')->nullable();
            $table->string('type')->nullable();
            $table->text('referensi')->nullable();
            $table->text('pernyataan')->nullable();
            $table->string('file')->nullable();
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
