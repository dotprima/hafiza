<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'survey_id', 'answer'];

    // Relationships
    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function electrics()
    {
        return $this->belongsTo(Electric::class,'id');
    }
    
}
