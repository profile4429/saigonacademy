<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedbacklocale extends Model
{
    use HasFactory;
    protected $table = 'feedbacklocales';

    protected $fillable = [
        'vi',
        'en',
    ];
    public function viFeedback()
    {
        return $this->belongsTo(feedback::class, 'vi');
    }

    public function enFeedback()
    {
        return $this->belongsTo(feedback::class, 'en');
    }
}
