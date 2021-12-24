<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsUsersAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('cms_users', function (Blueprint $table) {
            $table->string("username")->nullable()->after('password');
            $table->string("photo")->nullable();
            $table->string("signature")->nullable();
            $table->string("position")->nullable();
            $table->string("unit")->nullable();
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
