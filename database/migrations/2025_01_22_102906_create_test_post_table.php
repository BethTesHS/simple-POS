<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('test_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Post title
            $table->text('body');     // Post content
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  // Foreign key to categories table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_posts');
    }
};
