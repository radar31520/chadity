<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInteractionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
			$table->integer('ad_id')->unsigned()->index();
			$table->integer('organization_id')->unsigned()->index();
            $table->timestamps();

            // Make Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ad_id')->references('id')->on('ads');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('interactions');
    }

}
