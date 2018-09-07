<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function(Blueprint $table) {
           $table->increments('id');
           $table->uuid('uuid')->unique();
           $table->char('url', 64)->unique();
           $table->char('name', 128);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('organizations', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->char('name', 128);
            $table->uuid('parent_site');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_site')->references('uuid')->on('sites');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->uuid('parent_organization');
            $table->char('name', 128);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp('freq_interval')->nullable();
            $table->timestamp('freq_start')->nullable();
            $table->timestamp('freq_end')->nullable();
            $table->char('freq_byday', 64)->nullable();
            $table->char('freq_bymonthday', 64)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_organization')->references('uuid')->on('organizations');
        });

        Schema::create('sites_roles_pivot', function(Blueprint $table) {
            $table->uuid('parent_site');
            $table->uuid('parent_user');
            $table->enum('authorization', ['owner', 'admin', 'user']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_site')->references('uuid')->on('sites');
            $table->foreign('parent_user')->references('uuid')->on('users');
        });

        Schema::create('organizations_roles_pivot', function(Blueprint $table){
            $table->uuid('parent_organization');
            $table->uuid('parent_user');
            $table->enum('authorization', ['owner', 'admin', 'user']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_organization')->references('uuid')->on('organizations');
            $table->foreign('parent_user')->references('uuid')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('sites_roles_pivot');
        Schema::dropIfExists('organizations_roles_pivot');
        Schema::dropIfExists('events');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('sites');
    }
}