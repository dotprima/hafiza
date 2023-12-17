<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('electric_id');
            
            $table->text('watt');
            $table->text('pemakaian');
            $table->timestamps();
    
            $table->foreign('question_id')->references('id')->on('survey_questions');
            $table->foreign('survey_id')->references('id')->on('surveys');
            $table->foreign('electric_id')->references('id')->on('electrics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
