<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusApartmentTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('campus_apartment', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->string('meta_title');
      $table->text('meta_description');
      $table->string('h1');
      $table->string('h2');
      $table->text('seo_block');
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
    Schema::dropIfExists('campus_apartment');
  }
}
