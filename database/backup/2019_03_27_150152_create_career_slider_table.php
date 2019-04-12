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
            $table->string('slider_image');
            $table->string('slider_type');
            $table->string('slider_heading_one');
            $table->string('slider_heading_two');
            $table->string('slider_minute');
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
