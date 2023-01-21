<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Information extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ['id'];

    public function excerpt()
    {
        return Str::words($this->first_paragraph, 25);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
