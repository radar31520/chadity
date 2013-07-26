<?php

class OrganizationsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('organizations')->delete();

        $organizations = array(
       	    array(
                'name'      => 'Boys & Girls Club',
                'description' => 'We help kids make it!',
            ),
        	array(
                'name'      => 'SEO',
                'description' => 'We help minorities make it!',
            ),
        	array(
                'name'      => 'Tech Promise',
                'description' => 'We help the improvished make it!',
            ),
        	array(
                'name'      => 'Froyo',
                'description' => 'Yolo for Froyo!', 
            ),          	

        );

        // Uncomment the below to run the seeder
        DB::table('organizations')->insert($organizations);
    }

}