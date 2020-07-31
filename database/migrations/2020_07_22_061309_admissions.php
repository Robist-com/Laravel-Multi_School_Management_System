<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('current_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport')->nullable();
            $table->date('dateregistered')->nullable();
            $table->string('class_code')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->unsignedBigInteger('student_fee_id')->nullable(); // student_fee_id
            // $table->foreign('student_fee_id')->references('student_fee_id')->on('student_fees')->onDelete('cascade');

            // $table->foreign('student_fee_id')->references('student_fee_id')->on('student_fees');
            // ->onDelete('cascade');

            // $table->unsignedBigInteger('transaction_id')->nullable(); // transaction_id
            // $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
            // $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
            // ->onDelete('cascade');

            // $table->unsignedBigInteger('invoice_id')->nullable(); // invoice_id
            // $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            // $table->foreign('invoice_id')->references('id')->on('invoices');
            // ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admissions');
    }
}