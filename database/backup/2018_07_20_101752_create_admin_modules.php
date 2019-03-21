<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('controller');
            $table->string('icon');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');;
            $table->enum('type', ['0', '1'])->default('0')->comment('0 = Accesible to all , 1= Limited');
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
        Schema::dropIfExists('admin_modules');
    }
}
