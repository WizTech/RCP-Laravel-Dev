<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_slider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slider_image')->nullable();
            $table->string('slider_type')->nullable();
            $table->string('slider_heading_one')->nullable();
            $table->string('slider_heading_two')->nullable();
            $table->string('slider_minute')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('career_slider');
    }
}
