<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditPerbaikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audit_perbaikan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('audit_id')->nullable();
            $table->string('created_by')->nullable();
            $table->smallInteger('cms_users_id')->nullable();
            $table->string('area')->nullable();
            $table->text('recomended')->nullable();
            $table->string('pic')->nullable();
            $table->string('target')->nullable();
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
