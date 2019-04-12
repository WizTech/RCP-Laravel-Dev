<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contact_us', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email');
      $table->string('phone');
      $table->string('company');
      $table->string('fax');
      $table->string('message');
      $table->dateTime('add_date');

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
    Schema::dropIfExists('contact_us');
  }
}
