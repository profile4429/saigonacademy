<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admissions extends Model
{
    use HasFactory;
    protected $table = 'admissions';

    protected $fillable = [
        'title',
        'image',
        'description',
        'date',
        'language_id',
    ];
    public function language()
    {
        return $this->belongsTo(language::class, 'language_id');
    }
}
