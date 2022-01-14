<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('tmdb_id')->unique()->nullable();
            $table->string('imdb_id', 10)->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->date('deathday')->nullable();
            $table->string('gender', 2)->nullable();
            $table->text('biography')->nullable();
            $table->float('popularity')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->text('homepage')->nullable();
            $table->timestamp('tmdb_last_scraped_at')->nullable();
            $table->foreignId('profile_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
