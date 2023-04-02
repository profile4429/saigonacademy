<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admissionslocale extends Model
{
    use HasFactory;
    protected $table = 'admissionslocales';

    protected $fillable = [
        'vi',
        'en',
    ];
    public function viIntro()
    {
        return $this->belongsTo(intro::class, 'vi');
    }

    public function enIntro()
    {
        return $this->belongsTo(intro::class, 'en');
    }
}
