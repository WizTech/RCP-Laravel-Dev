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
      $table->string('fax')->nullable();
      $table->string('website')->nullable();
      $table->string('domain_name')->comment('Landord Website Domain')->nullable();
      $table->string('company')->comment('Landord Company')->nullable();
      $table->string('h2')->comment('Landlord Dashboard Data')->nullable();
      $table->string('meta_title')->comment('Landlord Dashboard Data')->nullable();
      $table->text('about_details')->comment('Landlord Dashboard Data')->nullable();
      $table->text('seo_block')->nullable();
      $table->text('meta_description')->nullable();

      $table->string('aboutus_h1')->comment('Landlord Website About Us Page H1')->nullable();;
      $table->string('aboutus_title')->comment('Landlord Website About Us Page Title')->nullable();;
      $table->text('aboutus_seo_block')->nullable();
      $table->text('aboutus_description')->nullable();

      $table->string('homepage_h1')->comment('Landlord Website Home Page Page H1')->nullable();;
      $table->string('homepage_title')->comment('Landlord Website Home Page Page Title')->nullable();;
      $table->text('homepage_seo_block')->nullable();;
      $table->text('homepage_description')->nullable();

      $table->string('contactus_h1')->comment('Landlord Website Contact Us Page H1')->nullable();;
      $table->string('Home Page_title')->comment('Landlord Website Contact Us Page Title')->nullable();;
      $table->text('Home Page_seo_block')->nullable();;
      $table->text('Home Page_description')->nullable();


      $table->integer('entrata_client_id')->unsigned();
      $table->enum('is_entrata', ['ACTIVE', 'INACTIVE'])->default('INACTIVE')->comment('ACTIVE = Listing of concerned landlord will be fetched as fees from Entrata.');
      $table->enum('type', ['Personal', 'Company'])->default('Personal');
      $table->enum('free_trial', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
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
