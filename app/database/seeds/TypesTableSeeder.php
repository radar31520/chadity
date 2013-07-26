<?php

class TypesTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('types')->delete();

        $types = array(
        	array(
                'name'      => 'Technology',
            ),
        	array(
                'name'      => 'Entertainment',
            ),
        	array(
                'name'      => 'Sports',
            ),
        	array(
                'name'      => 'Health',
            ),                        
        );

        // Uncomment the below to run the seeder
        DB::table('types')->insert($types);
    }

}