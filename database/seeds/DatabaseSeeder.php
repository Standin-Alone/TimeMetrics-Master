<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$faker=Faker\Factory::create();
    	 for($i=0;$i<1000;$i++)
        {
        DB::table('ss_users')
	    			->insert(
	    				[
	    					'FirstName' => $faker->name,
	    					'MiddleName' => $faker->name,
	    					'LastName' => $faker->name,
	    					'Email' => $faker->name,
	    					'Contact' => $faker->name,
	    					'Password' => DB::raw("AES_ENCRYPT('" .$faker->name."',911)"),
	    					'RoleID' => 2,
	    					'BranchID' => 1
	    				]);

	   	}
    }
}
