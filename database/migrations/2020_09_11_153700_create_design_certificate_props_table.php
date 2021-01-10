<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignCertificatePropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_certificate_props', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('design_certificate_id');
            $table->string('certificate_company_name')->default('off');
            $table->string('certificate_company_name_height')->default('760px');
            $table->string('certificate_company_name_font_size')->default('44px');
            $table->string('certificate_company_name_font_weight')->default('bold');
            $table->string('certificate_company_name_font_family')->default('serif');
            $table->string('certificate_company_name_margin')->default('5px 0 0 0');
            $table->string('certificate_company_name_padding')->default(' 35px 0 0 0');
            $table->string('certificate_company_name_display')->default('block'); 
            $table->string('certificate_company_name_text_align')->default('center'); 

            $table->string('certificate_logo')->nullable();
            $table->string('certificate_logo_width')->default('110px');
            $table->string('certificate_logo_height')->default('110px');
            $table->string('certificate_logo_margin')->default('0 300px 0 500px');
            $table->string('certificate_logo_padding')->default(' 5px 0 0 0');
            $table->string('certificate_logo_display')->default('0 300px 0 500px');

            $table->string('certificate_company_address')->default('off');
            $table->string('certificate_company_address_width')->default('');
            $table->string('certificate_company_address_height')->default('');
            $table->string('certificate_company_address_font_size')->default('20px');
            $table->string('certificate_company_address_font_weight')->default('normal');
            $table->string('certificate_company_address_font_family')->default('serif');
            $table->string('certificate_company_address_margin')->default('0 0 0 0');
            $table->string('certificate_company_address_padding')->default(' 0 0 0 0');
            $table->string('certificate_company_address_display')->default('block'); 
            $table->string('certificate_company_address_text_align')->default('center'); 

            $table->string('certificate_title')->default('off');
            $table->string('certificate_title_text_align')->default('center');
            $table->string('certificate_title_font_family')->default('serif');
            $table->string('certificate_title_font_weight')->default('bold');
            $table->string('certificate_title_font_size')->default('30px');
            $table->string('certificate_title_font_display')->default('block');
            $table->string('certificate_title_margin')->default('0 0 35px 0');
            $table->string('certificate_title_padding')->default('35px 0 0 0');
            
            $table->string('certificate_certify_title')->default('off');
            $table->string('certificate_certify_text_align')->default('center');
            $table->string('certificate_certify_title_font_family')->default('serif');
            $table->string('certificate_certify_title_font_weight')->default('normal');
            $table->string('certificate_certify_title_font_size')->default('20px');
            $table->string('certificate_certify_title_font_display')->default('block');
            $table->string('certificate_certify_title_margin')->default('0 0 0 0');
            $table->string('certificate_certify_title_padding')->default('0 0 0 0');

            $table->string('certificate_holder_name')->default('off');
            $table->string('certificate_holder_text_align')->default('center');
            $table->string('certificate_holder_font_family')->default('serif');
            $table->string('certificate_holder_font_weight')->default('bold');
            $table->string('certificate_holder_font_size')->default('50px');
            $table->string('certificate_holder_font_display')->default('block');
            $table->string('certificate_holder_margin')->default('10px 0 10px 0 ');
            $table->string('certificate_holder_padding')->default('0 0 0 0');

            $table->string('certificate_information')->default('off');
            $table->string('certificate_information_text_align')->default('center');
            $table->string('certificate_information_font_family')->default('serif');
            $table->string('certificate_information_font_weight')->default('normal');
            $table->string('certificate_information_font_size')->default('22px');
            $table->string('certificate_information_font_display')->default('block');
            $table->string('certificate_information_margin')->default('5px 0 0 0');
            $table->string('certificate_information_padding')->default('0px 120px 0px 160px');

          
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
        Schema::dropIfExists('design_certificate_props');
    }
}
