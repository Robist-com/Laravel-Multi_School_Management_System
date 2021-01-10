<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->bigIncrements('student_fee_id');
            // $table->integer('student_id')->nullable();
            $table->integer('fee_id')->nullable(); // fee_structure_id
            $table->integer('level_id')->nullable();
            $table->float('amount', 8,2)->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('student_id')->nullable();
            // // $table->foreignId('student_id')->constrained()->onDelete('cascade');
            // $table->foreign('student_id')->ferences('id')->on('admissions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_fees');
    }
}
