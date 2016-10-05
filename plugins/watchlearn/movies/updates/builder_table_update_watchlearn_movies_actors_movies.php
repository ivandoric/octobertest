<?php namespace Watchlearn\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateWatchlearnMoviesActorsMovies extends Migration
{
    public function up()
    {
        Schema::table('watchlearn_movies_actors_movies', function($table)
        {
            $table->integer('actor_id')->unsigned()->change();
            $table->integer('movie_id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('watchlearn_movies_actors_movies', function($table)
        {
            $table->integer('actor_id')->unsigned(false)->change();
            $table->integer('movie_id')->unsigned(false)->change();
        });
    }
}
