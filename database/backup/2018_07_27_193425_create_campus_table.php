<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('campus', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('featured_landlord');
      $table->string('name');
      $table->string('title');
      $table->string('address');
      $table->string('h1');
      $table->string('h2');
      $table->float('lat', 10, 6);
      $table->float('lng', 10, 6);
      $table->string('seo_block');
      $table->string('meta_title');
      $table->string('meta_description');
      $table->enum('rating', ['Active', 'Inactive'])->default('Active');
      $table->enum('premium_banner', ['Active', 'Inactive'])->default('Active');
      $table->enum('live', ['Active', 'Inactive'])->default('Active');
      $table->enum('status', ['Active', 'Inactive'])->default('Active');
      $table->timestamps();
    });

    Schema::create('linked_campuses', function (Blueprint $table) {
      $table->integer('campus_id')->unsigned()->index();
      $table->foreign('campus_id')->references('id')->on('campus')->onDelete('cascade');
      $table->integer('linked_campus_id')->unsigned()->index();
      $table->foreign('linked_campus_id')->references('id')->on('campus')->onDelete('cascade');


    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('campus');
    Schema::dropIfExists('linked_campuses');
  }
}
