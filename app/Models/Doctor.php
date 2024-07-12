<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'phone_number', 'studio_adress', 'CV', 'performance'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
