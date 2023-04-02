<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programs extends Model
{
    use HasFactory;
    protected $table = 'programs';

    protected $fillable = [
        'title',
        'description',
        'language_id',
        'image',
    ];
    public function language()
    {
        return $this->belongsTo(language::class, 'language_id');
    }
}
