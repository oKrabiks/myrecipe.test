<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeKeywordTable extends Migration
{
    public function up()
    {
        Schema::create('recipe_keyword', function (Blueprint $table) {
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
            $table->primary(['recipe_id', 'keyword_id']);
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_keyword');
    }
}
