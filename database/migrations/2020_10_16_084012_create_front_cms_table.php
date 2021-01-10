<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_cms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('head_background_color')->nullable();
            $table->string('header_bg_color')->nullable();
            $table->string('header_fg_color')->nullable();
            $table->string('footer_background_color')->nullable();
            $table->string('head_fore_color')->nullable();
            $table->string('footer_fore_color')->nullable();
            $table->string('footer_bg_color')->nullable();
            $table->string('footer_fg_color')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('theme_name')->nullable();
            $table->tinyInteger('theme_status')->default(0);
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('icon')->nullable();
            $table->string('image_logo')->nullable();
            $table->string('image_fav')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            
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
        Schema::dropIfExists('front_cms');
    }
}
