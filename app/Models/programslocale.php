<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programslocale extends Model
{
    use HasFactory;
    protected $table = 'programslocales';

    protected $fillable = [
        'vi',
        'en',
    ];
    public function viPrograms()
    {
        return $this->belongsTo(programs::class, 'vi');
    }

    public function enPrograms()
    {
        return $this->belongsTo(programs::class, 'en');
    }
}
