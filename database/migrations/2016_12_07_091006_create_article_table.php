<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id');
            $table->boolean('active')->default(0);
            $table->string('thumb');
            // $table->string('tags_id');
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->integer('template_id');
            $table->integer('user_id')->unsigned();
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
        //
    }
}
