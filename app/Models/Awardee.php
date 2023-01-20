<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awardee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function parent()
    {
        return $this->belongsTo(OrangTua::class, 'parent_id');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
