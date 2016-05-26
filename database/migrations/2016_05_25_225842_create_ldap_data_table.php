<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLdapDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ldap_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('server', 15);
            $table->string('domain', 20);
            $table->string('cn', 20);
            $table->string('bind_dn_password', 30);
            $table->string('user_id', 30);
            $table->string('user_password', 50);
            $table->string('user_given_name', 30);
            $table->string('user_last_name', 50);
            $table->string('user_email', 50);
            $table->string('user_group', 50);
            $table->timestamp('updated_at');
            $table->timestamp('created_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ldap_data');
    }
}
