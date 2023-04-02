<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class introlocale extends Model
{
    use HasFactory;
    protected $table = 'introlocales';

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
