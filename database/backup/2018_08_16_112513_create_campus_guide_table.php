<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusGuideTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('campus_guide', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->text('rent');
      $table->text('life');
      $table->string('image');
      $table->string('alt');
      $table->string('title');
      $table->text('description');
      $table->string('roommate_title');
      $table->string('roommate_h1');
      $table->text('roommate_description');
      $table->text('roommate_copy');
      $table->string('sublease_title');
      $table->string('sublease_h1');
      $table->text('sublease_description');
      $table->text('sublease_copy');
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
    Schema::dropIfExists('campus_guide');
  }
}
