<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusRentingQuestion extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('campus_renting_question', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->string('title');
      $table->string('alt');
      $table->string('image');
      $table->text('description');
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
    Schema::dropIfExists('campus_renting_question');
  }
}
