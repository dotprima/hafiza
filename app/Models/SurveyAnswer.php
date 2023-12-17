<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['electric_id', 'watt', 'pemakaian', 'user_id'];

    public function electric()
    {
        return $this->belongsTo(Electric::class, 'electric_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
