<?php

class AdsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('ads')->delete();

        $ads = array(
       		array(
                'name'      => 'LolCatz',
                'description' => 'I am a funny cat',
                'url'         => 'www.google.com',
                'advertiser_id'  => 1,
                'type_id'      => 1,
            ),
        	array(
                'name'      => 'LolDogz',
                'description' => 'I am a funny dog',
                'url'         => 'www.apple.com',  
                'advertiser_id'  => 2,
                'type_id'      => 2,              
            ),
        	array(
                'name'      => 'LolFrogz',
                'description' => 'I am a funny frog',
                'url'         => 'www.youtube.com',
                'advertiser_id'  => 3,
                'type_id'      => 3,
            ),
        	array(
                'name'      => 'LolHogz',
                'description' => 'I am a funny hog',
                'url'         => 'www.wal-mart.com',
                'advertiser_id'  => 4,
                'type_id'      => 4,
            ),               
        );

        // Uncomment the below to run the seeder
        DB::table('ads')->insert($ads);
    }

}