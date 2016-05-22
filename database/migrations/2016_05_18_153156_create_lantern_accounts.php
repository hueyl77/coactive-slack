<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanternAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lantern_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('contact_person_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lantern_accounts');
    }
}
