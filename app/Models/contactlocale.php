<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactlocale extends Model
{
    use HasFactory;
    protected $table = 'contactlocales';

    protected $fillable = [
        'vi',
        'en',
    ];
    public function viContact()
    {
        return $this->belongsTo(contact::class, 'vi');
    }

    public function enContact()
    {
        return $this->belongsTo(contact::class, 'en');
    }
}
