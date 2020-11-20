<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('place')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('school_events');
    }
}
