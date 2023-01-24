<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'fromName');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator');
    }
}
