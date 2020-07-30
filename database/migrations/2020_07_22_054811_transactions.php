<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('fee_id')->nullable(); // fee_structure_id
            // $table->unsignedBigInteger('semester_fee_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('paid_amount', 8,2)->nullable();
            $table->float('balance', 8,2)->nullable();
            $table->string('remark')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('initiated')->nullable();
            $table->date('transaction_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            Schema::disableForeignKeyConstraints();
            // $table->dropForeign(['semester_fee_id']);
            $table->unsignedBigInteger('semester_fee_id')->nullable(); // student_fee_id
            $table->foreign('semester_fee_id')->references('student_fee_id')->on('student_fees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
