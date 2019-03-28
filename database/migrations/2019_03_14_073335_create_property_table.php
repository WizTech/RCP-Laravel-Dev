<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('property', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('campus_id')->unsigned();
      $table->integer('category_id')->unsigned();
      $table->integer('landlord_id')->unsigned();
      $table->integer('yardi_listing_id')->nullable()->unsigned();
      $table->integer('entrata_listing_id')->nullable()->unsigned();
      $table->integer('rentlinx_listing_id')->nullable()->unsigned();
      $table->integer('pricing')->unsigned()->default('0');
      $table->integer('units_number')->nullable()->unsigned();
      $table->text('title');
      $table->text('description');
      $table->string('address');
      $table->string('street_address_short');
      $table->string('property_clones')->nullable();
      $table->string('meta_title')->nullable();
      $table->text('meta_description')->nullable();
      $table->text('copy');
      $table->double('lat', 10, 6);
      $table->double('lng', 10, 6);
      $table->float('distance_from_campus')->nullable();
      $table->double('duration_from_campus', 10, 2)->nullable();

      $table->string('slug')->nullable();
      $table->string('twilio_number')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->string('special')->nullable();
      $table->string('state_code')->nullable();
      $table->string('city')->nullable();
      $table->string('zip')->nullable();
      $table->string('double_featured_ord')->nullable();
      $table->date('special_expiry')->nullable();
      $table->date('double_feature_expiry_date')->nullable();
      $table->dateTime('property_expiry_date')->nullable();
      $table->dateTime('feature_expiry_date')->nullable();
      $table->dateTime('feature_last_updated')->nullable();
      $table->dateTime('created_on')->nullable();
      $table->enum('status', ['Active', 'Inactive'])->default('Active');
      $table->enum('deleted', ['Active', 'Inactive'])->default('Inactive');
      $table->enum('free_trial', ['Active', 'Inactive'])->default('Inactive');
      $table->enum('topspot_paid', ['Active', 'Inactive'])->default('Inactive');
      $table->enum('update_walking_distance', ['Active', 'Inactive'])->default('Inactive');
      $table->enum('double_featured', ['Active', 'Inactive'])->default('Inactive');
      $table->timestamps();

      $table->foreign('category_id')->references('id')->on('cateogry')->onDelete('cascade');
      $table->foreign('campus_id')->references('id')->on('campus')->onDelete('cascade');
      $table->foreign('landlord_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('property');
  }
}
