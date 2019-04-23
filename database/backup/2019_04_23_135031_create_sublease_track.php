<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubleaseTrack extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::connection('mysql2')->create('sublease_track', function (Blueprint $table) {
      $table->increments('id');
      $table->string('ip')->nullable();
      $table->string('username')->nullable();
      $table->text('campus')->nullable();
      $table->string('message')->nullable();
      $table->string('phone')->nullable();
      $table->integer('date');

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
    Schema::connection('mysql2')->dropIfExists('sublease_track');
  }
}
