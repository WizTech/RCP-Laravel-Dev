<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandlordDetails extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('landlord_details', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();

      $table->enum('activate_twilio', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
      $table->string('twilio_number');
      $table->string('h1')->comment('Landlord Dashboard Data');
      $table->string('domain_name')->comment('Landord Website Domain')->nullable();
      $table->string('h2')->comment('Landlord Dashboard Data');
      $table->string('meta_title')->comment('Landlord Dashboard Data');
      $table->text('about_details')->comment('Landlord Dashboard Data');
      $table->text('seo_block');
      $table->text('meta_description');

      $table->integer('entrata_client_id')->unsigned();
      $table->enum('is_entrata', ['ACTIVE', 'INACTIVE'])->default('INACTIVE')->comment('ACTIVE = Listing of concerned landlord will be fetched as fees from Entrata.');
      $table->integer('yardi_user_id')->unsigned();
      $table->enum('is_yardi', ['ACTIVE', 'INACTIVE'])->default('INACTIVE')->comment('ACTIVE = Listing of concerned landlord will be fetched as fees from Yardi.');
      $table->enum('email_leads', ['ACTIVE', 'INACTIVE'])->default('INACTIVE')->comment('ACTIVE = Leads will be sent to property specific email address , INACTIVE = Leads will be sent to landlord & property specific email address');
      $table->enum('landlord_dashboard_status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE')->comment('ACTIVE = Dashboard Link will reflect on listing and detail pages');
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
    Schema::dropIfExists('landlord_details');
  }
}
