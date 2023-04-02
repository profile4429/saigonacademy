<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    protected $fillable = [
        'title',
        'address',
        'phone',
        'description',
        'language_id',
    ];
    public function language()
    {
        return $this->belongsTo(language::class, 'language_id');
    }
}
