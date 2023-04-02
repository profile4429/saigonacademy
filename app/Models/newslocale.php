<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newslocale extends Model
{
    use HasFactory;
    protected $table = 'newslocales';

    protected $fillable = [
        'vi',
        'en',
    ];
    public function viNews()
    {
        return $this->belongsTo(news::class, 'vi');
    }

    public function enNews()
    {
        return $this->belongsTo(news::class, 'en');
    }
}
