<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_title')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('school_logo')->nullable();
            $table->string('school_signature')->nullable();
            $table->string('school_background_image')->nullable();

           
            $table->string('roll_no')->default('off');
            $table->string('student_name')->default('off');
            $table->string('class')->default('off');
            $table->string('grade')->default('off');
            $table->string('father_name')->default('off');
            $table->string('mother_name')->default('off');
            $table->string('address')->default('off');
            $table->string('status')->default('off');
            $table->string('school_header_color')->default('#ffffff');
            $table->string('school_footer_color')->default('#ffffff');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('school_id');
            $table->softDeletes();
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
        Schema::dropIfExists('certificate_templates');
    }
}
