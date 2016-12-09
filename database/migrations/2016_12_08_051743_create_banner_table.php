<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->string('url')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('category_id');
            $table->integer('type_id');
            $table->boolean('active')->default(0);
            $table->string('thumb')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('bg_img')->nullable();
            $table->text('description')->nullable();
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
