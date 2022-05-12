<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //
            $about = new About();
            $about->about = "ALS is a non-profit, charitable organization that is concerned with the welfare of animals in Toronto. It accepts donations from individuals. It also sells products that are of interest to animal lovers. A percentage of the sales price supports ALS. ALS uses this money to support education programs, lobby government, investigate illegal activities related to animal welfare and pay employee expenses. The database is to provide access to information about welfare.";
            $about->img =  "1652226162japheth-mast-Ga6z9QD8yvw-unsplash.jpg";    
            $about->save();
    }
}
