<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->text('description');
			$table->string('url');
            $table->integer('advertiser_id')->unsigned()->index();; 
            $table->integer('type_id')->unsigned()->index();;
            $table->timestamps();

            // Make Foreign Keys
            $table->foreign('advertiser_id')->references('id')->on('advertisers');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ads');
    }

}
