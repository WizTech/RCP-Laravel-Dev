<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('meta_details', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->enum('page_type', ['landing', 'map', 'city', 'listing', 'roommates', 'subleases', 'openhouse'])->default('landing');
      $table->enum('is_filter_page', ['Yes', 'No'])->default('No');
      $table->string('field_title')->nullable();
      $table->string('meta_title')->nullable();
      $table->text('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->string('h1')->nullable();
      $table->text('copy')->nullable();
      $table->text('content')->nullable();

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
    Schema::dropIfExists('meta_details');
  }
}
