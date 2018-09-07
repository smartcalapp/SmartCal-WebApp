<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Site::class, 3)->create()->each(function($site) {
            $site->organizations()->save(factory(App\Organization::class)->make());
        });
    }
}
