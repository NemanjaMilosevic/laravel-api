<?php

use Illuminate\Database\Seeder;
use App\Ad;

use Carbon\Carbon;

class AdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 
  public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Ad::truncate();

        $faker = \Faker\Factory::create();

        // Let's create a few ads in our database:
        for ($i = 0; $i < 50; $i++) {
            Ad::create([
                'text' => $faker->paragraph,
                'type' => $faker->randomElement(['type1' ,'type2']),
				'expire_on' => Carbon::now()->addMonths(1)
            ]);
        }
    }
}
