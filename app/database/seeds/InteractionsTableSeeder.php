<?php

class InteractionsTableSeeder extends Seeder {

	//Totel Number Of Interactions
	protected $total = 2000;

	//Max Number Of Users, Ads, Organizations
	protected $max = 4;

    public function run()
    {
    	//Uncomment the below to wipe the table clean before populating
        DB::table('interactions')->delete();

        $interactions = array();

		for ($i = 1; $i <= $this->total; $i++) {

    			$user_id = rand(1, $this->max);
    			$ad_id = rand(1, $this->max);
    			$organization_id = rand(1, $this->max); 
                $days = strval(rand(-500000, 0));
                $time   = new DateTime;   
                $time->modify($days . ' seconds');

    			$single_inteaction = array(	'user_id'=> $user_id, 'ad_id' => $ad_id, 'organization_id' => $organization_id,
                                            'created_at' => $time);	

    			$interactions[] = $single_inteaction;   			
		}

        //Uncomment the below to run the seeder
     	DB::table('interactions')->insert($interactions);
    }

}