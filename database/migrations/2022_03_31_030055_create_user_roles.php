<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('master_unit_tipe_id');
            $table->unsignedBigInteger('master_unit_id');

            // FK
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('master_unit_tipe_id')->references('id')->on('master_unit_tipe')->onDelete('cascade');
            $table->foreign('master_unit_id')->references('id')->on('master_unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
