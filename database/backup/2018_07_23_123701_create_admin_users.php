<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default('1')->comment('0:Any;1=administrator');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('admin_campuses', function (Blueprint $table) {
            $table->integer('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on('admin_users')->onDelete('cascade');

            $table->integer('campus_id')->unsigned()->index();
            $table->foreign('campus_id')->references('id')->on('campus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_campuses');
    }
}
