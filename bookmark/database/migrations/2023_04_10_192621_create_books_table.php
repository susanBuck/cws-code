<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
          
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->string('title');
            $table->smallInteger('published_year');
            $table->string('cover_url');
            $table->string('info_url'); 
            $table->string('purchase_url');
            $table->text('description');

            # Establish One to Many relationship with authors
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('authors');

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
