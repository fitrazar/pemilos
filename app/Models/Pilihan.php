<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'kandidat'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kandidat() {
        return $this->belongsTo(Kandidat::class);
    }
}
