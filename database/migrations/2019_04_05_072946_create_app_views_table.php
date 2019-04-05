<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('app_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->integer('campus_id')->nullable();
            $table->integer('listing_id')->nullable();
            $table->enum('page_type', ['Home','Campus','Detail','Favorite','Contact','Call-Landlord','Email-Landlord','Settings','My_Account','Messages','Home-Map','Home-Listing','Roommats-Detail','Subleases-Detail'])->nullable();
            $table->string('date')->nullable();
            $table->integer('date_created')->nullable();
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
        Schema::dropIfExists('app_views');
    }
}
