<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_title')->nullable();
            $table->string('book_number')->nullable();
            $table->string('isbn_number')->nullable();
            $table->string('publish')->nullable();
            $table->string('author')->nullable();
            $table->string('subject')->nullable();
            $table->string('rac_number')->nullable();
            $table->integer('book_qty')->nullable();
            $table->float('book_price')->nullable();
            $table->date('post_date')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('books');
    }
}
