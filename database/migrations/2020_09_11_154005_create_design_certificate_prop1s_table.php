<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignCertificateProp1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_certificate_prop1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('design_certificate_id');
            $table->string('certificate_signature1')->default('off');
            $table->string('certificate_signature1_text_align')->default('center');
            $table->string('certificate_signature1_font_family')->default('serif');
            $table->string('certificate_signature1_font_weight')->default('bold');
            $table->string('certificate_signature1_font_size')->default('22px');
            $table->string('certificate_signature1_font_display')->default('block');
            $table->string('certificate_signature1_margin')->default('10px 0 0 40px');
            $table->string('certificate_signature1_padding')->default('22px 0 0 0');
            $table->string('certificate_signature1_line_height')->default('22px');

            $table->string('certificate_img_signature1')->default('off');
            $table->string('certificate_img_signature1_text_align')->default('');
            $table->string('certificate_img_signature1_font_family')->default('');
            $table->string('certificate_img_signature1_font_weight')->default('');
            $table->string('certificate_img_signature1_font_size')->default('');
            $table->string('certificate_img_signature1_font_display')->default('');
            $table->string('certificate_img_signature1_margin')->default('0 0 0 0');
            $table->string('certificate_img_signature1_padding')->default('');
            $table->string('certificate_img_signature1_line_height')->default('0');
            $table->string('certificate_img_signature1_width')->default('130px');
            $table->string('certificate_img_signature1_height')->default('70px');
            $table->string('certificate_img_signature1_border_radius')->default('0px');

            $table->string('certificate_signature2')->default('off');
            $table->string('certificate_signature2_text_align')->default('center');
            $table->string('certificate_signature2_font_family')->default('serif');
            $table->string('certificate_signature2_font_weight')->default('bold');
            $table->string('certificate_signature2_font_size')->default('22px');
            $table->string('certificate_signature2_font_display')->default('block');
            $table->string('certificate_signature2_margin')->default('0 0 0 200px');
            $table->string('certificate_signature2_padding')->default('22px 0 0 0');
            $table->string('certificate_signature2_line_height')->default('22px');

            $table->string('certificate_img_signature2')->default('off');
            $table->string('certificate_img_signature2_text_align')->default('');
            $table->string('certificate_img_signature2_font_family')->default('');
            $table->string('certificate_img_signature2_font_weight')->default('');
            $table->string('certificate_img_signature2_font_size')->default('');
            $table->string('certificate_img_signature2_font_display')->default('');
            $table->string('certificate_img_signature2_margin')->default('0 50px 0 50px');
            $table->string('certificate_img_signature2_padding')->default('');
            $table->string('certificate_img_signature2_line_height')->default('0');
            $table->string('certificate_img_signature2_width')->default('130px');
            $table->string('certificate_img_signature2_height')->default('70px');
            $table->string('certificate_img_signature2_border_radius')->default('0px');

            $table->string('certificate_signature3')->default('off');
            $table->string('certificate_signature3_text_align')->default('center');
            $table->string('certificate_signature3_font_family')->default('serif');
            $table->string('certificate_signature3_font_weight')->default('bold');
            $table->string('certificate_signature3_font_size')->default('22px');
            $table->string('certificate_signature3_font_display')->default('block');
            $table->string('certificate_signature3_margin')->default('0 0 0 200px');
            $table->string('certificate_signature3_padding')->default('22px 0 0 0');
            $table->string('certificate_signature3_line_height')->default('22px');

            $table->string('certificate_img_signature3')->default('off');
            $table->string('certificate_img_signature3_text_align')->default('');
            $table->string('certificate_img_signature3_font_family')->default('');
            $table->string('certificate_img_signature3_font_weight')->default('');
            $table->string('certificate_img_signature3_font_size')->default('');
            $table->string('certificate_img_signature3_font_display')->default('');
            $table->string('certificate_img_signature3_margin')->default('0 0 0 0');
            $table->string('certificate_img_signature3_padding')->default('');
            $table->string('certificate_img_signature3_line_height')->default('0');
            $table->string('certificate_img_signature3_width')->default('130px');
            $table->string('certificate_img_signature3_height')->default('70px');
            $table->string('certificate_img_signature3_border_radius')->default('0px');

            $table->string('certificate_issue_date')->default('off');
            $table->string('certificate_issue_date_text_align')->default('center');
            $table->string('certificate_issue_date_font_family')->default('serif');
            $table->string('certificate_issue_date_font_weight')->default('normal');
            $table->string('certificate_issue_date_font_size')->default('22px');
            $table->string('certificate_issue_date_font_display')->default('');
            $table->string('certificate_issue_date_margin')->default('5px 0 0 0');
            $table->string('certificate_issue_date_padding')->default('0px 120px 0px 160px');
            $table->string('certificate_issue_date_line_height')->default('0');
            $table->string('certificate_issue_date_width')->default('130px');
            $table->string('certificate_issue_date_height')->default('70px');
            $table->string('certificate_issue_date_border_radius')->default('0px');
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
        Schema::dropIfExists('design_certificate_prop1s');
    }
}
