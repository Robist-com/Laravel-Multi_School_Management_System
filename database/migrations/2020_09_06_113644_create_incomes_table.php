<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('invoice_number');
            $table->date('date');
            $table->float('amount', 8,2);
            $table->date('file');
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('income_type_id');
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
        Schema::dropIfExists('incomes');
    }
}
