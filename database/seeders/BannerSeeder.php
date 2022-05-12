<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        $banner = new Banner();
        $banner->img = "banner-placeholder.jpeg";
        $banner->save();
    }
}
