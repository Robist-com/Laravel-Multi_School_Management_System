<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('certificate_frame_width')->default('1085px');
            $table->string('certificate_frame_height')->default('760px');
            $table->string('certificate_frame_margin')->default('30px auto');
            $table->string('certificate_frame_padding')->default('5mm');
            $table->string('certificate_frame_box_shodow')->default('.5px .5px 7px #000');
            $table->string('certificate_frame_border_radius')->default('2px');
            $table->string('certificate_frame_overflow')->default('hidden');
            $table->string('certificate_frame_word_spacing')->default('');
            $table->string('certificate_frame_letter_spacing')->default('');
            $table->string('certificate_frame_text_decoration')->default('none');
            $table->string('certificate_frame_vertical_align')->default('');
            $table->string('certificate_frame_text_transform')->default('');
            $table->string('certificate_frame_text_indent')->default('');
            $table->string('certificate_frame_line_height')->default('');
            $table->string('certificate_frame_border_width')->default('');
            $table->string('certificate_frame_border_color')->default('');
            $table->string('certificate_frame_border_style')->default('');
            $table->string('certificate_frame_border')->default('');
            $table->string('certificate_frame_float')->default('');
            $table->string('certificate_frame_white_space')->default('');
            $table->string('certificate_frame_list_style_type')->default('');
            $table->string('certificate_framelist_style_image')->default('');

            $table->string('certificate_background_image')->nullable();
            $table->string('certificate_background_width')->default('1085px');
            $table->string('certificate_background_height')->default(' 755px');
            $table->string('certificate_background_size')->default('cover');
            $table->string('certificate_background_repeat')->default('no-repeat');
            $table->string('certificate_background_margin')->default('');
            $table->string('certificate_background_padding')->default('');
            $table->string('certificate_background_opacity')->default('');
            $table->string('certificate_background_box_shodow')->default('');
            $table->string('certificate_background_border_radius')->default('');
            $table->string('certificate_background_overflow')->default('');

            
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
        Schema::dropIfExists('design_certificates');
    }
}
