<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';

    protected $fillable = [
        'title',
        'career',
        'image',
        'language_id',
    ];
    public function language()
    {
        return $this->belongsTo(language::class, 'language_id');
    }
}
