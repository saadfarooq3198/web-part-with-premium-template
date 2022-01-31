<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->text('page_description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_background_color')->nullable();
            $table->string('button_text_color')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('page_text_font')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
