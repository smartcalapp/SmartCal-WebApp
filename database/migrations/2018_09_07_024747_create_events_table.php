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
            $table->unsignedInteger('site_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('organization_id');
            $table->char('name', 128);
            $table->boolean('published')->default(false);
            $table->text("description")->nullable();
            $table->json('tags')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp('freq_interval')->nullable();
            $table->timestamp('freq_start')->nullable();
            $table->timestamp('freq_end')->nullable();
            $table->char('freq_byday', 64)->nullable();
            $table->char('freq_bymonthday', 64)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations');
        });

        Schema::create('sites_roles_pivot', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('user_id');
            $table->enum('authorization', ['owner', 'admin', 'readonly']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('organizations_roles_pivot', function(Blueprint $table){
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('user_id');
            $table->enum('authorization', ['owner', 'admin', 'draftonly', 'readonly']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');
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
