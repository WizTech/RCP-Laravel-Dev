<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImitationLeadsTrack extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {


    Schema::connection('mysql2')->create('imitation_leads_track', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->integer('property_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->string('sender_name')->nullable();
      $table->string('sender_email')->nullable();
      $table->string('sender_phone')->nullable();
      $table->string('bedrooms')->nullable();
      $table->string('sess_id')->nullable();
      $table->string('sender_ip')->nullable();
      $table->string('timezone_rb')->nullable();
      $table->dateTime('date_created');
      $table->integer('student_id');
      $table->integer('message_id');
      $table->string('mailgun_message_id');
      $table->integer('timestamp_rb');
      $table->integer('read_timestamp');
      $table->integer('leads_for')->unsigned()->default('1')->comment('1=COLLEGEPADS,2=CityPads');
      $table->integer('insert_from')->unsigned()->default('0')->comment('0=site');
      $table->enum('leads_come_from', ['RCP', 'Craigslist', 'Trulia'])->default('RCP');
      $table->enum('email_status', ['read', 'unread'])->default('unread');
      $table->enum('user_from', ['Web', 'App'])->default('Web');
      $table->enum('banner_lead', ['Yes', 'No'])->default('No');
      $table->text('sender_message');
      $table->text('email_template');
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
    Schema::connection('mysql2')->dropIfExists('imitation_leads_track');
  }
}
