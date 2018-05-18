<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->unique(['book_id','locale']);
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_translations');
    }
}
