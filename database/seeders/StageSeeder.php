<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            'whishlist',
            'applied',
            'offer',
            'declined',
        ];

        foreach($stages as $stage) {
            $new_stage = new Stage();
            $new_stage->name = $stage;
            $new_stage->save();
        }
    }
}
