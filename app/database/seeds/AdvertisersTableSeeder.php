<?php

class AdvertisersTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('advertisers')->delete();

        $advertisers = array(
       	    array(
                'name'      => 'Google',
                'description' => 'Google who? Google what?',
            ),
        	array(
                'name'      => 'Youtube',
                'description' => 'I watch Youtube videos all the time',
            ),
        	array(
                'name'      => 'Apple',
                'description' => 'Can you take a bite out of apple',
            ),
        	array(
                'name'      => 'Wal-Mart',
                'description' => 'I love Wal-Mart, but haterz gonna hate!', 
            ),          	

        );

        // Uncomment the below to run the seeder
        DB::table('advertisers')->insert($advertisers);
    }

}