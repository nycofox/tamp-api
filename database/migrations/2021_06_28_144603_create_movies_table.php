<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tmdb_id')->nullable();
            $table->string('imdb_id', 10)->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title')->nullable();
            $table->text('overview')->nullable();
            $table->float('popularity')->default(0);
            $table->date('release_date')->nullable();
            $table->unsignedBigInteger('revenue')->nullable();
            $table->unsignedInteger('runtime')->nullable();
            $table->string('status')->nullable();
            $table->text('title')->nullable();
            $table->text('tagline')->nullable();
            $table->float('vote_average')->nullable();
            $table->unsignedInteger('vote_count')->nullable();
            $table->foreignId('backdrop_id')->nullable();
            $table->foreignId('poster_id')->nullable();
            $table->unsignedBigInteger('budget')->nullable();
            $table->text('homepage')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
