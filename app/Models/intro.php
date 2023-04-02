<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intro extends Model
{
    use HasFactory;
    protected $table = 'intro';

    protected $fillable = [
        'title',
        'description',
        'language_id',
    ];
    public function language()
    {
        return $this->belongsTo(language::class, 'language_id');
    }
}
