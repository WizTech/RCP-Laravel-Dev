<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyImagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('property_images', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('property_id')->unsigned();
      $table->integer('floorplan_id')->unsigned()->nullable();
      $table->string('original_name');
      $table->string('image');
      $table->integer('order')->unsigned()->nullable();
      $table->integer('featured')->unsigned()->nullable();
      $table->date('date');
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
    Schema::dropIfExists('property_images');
  }
}
