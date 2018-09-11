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
            factory(\App\Organization::class, 3)->create(['site_id' => $site->id])->each(function($organization){
                factory(\App\Event::class, 3)->create(['organization_id' => $organization->id]);
            });
        });
    }
}
