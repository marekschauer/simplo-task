<?php

namespace App\Models;

use App\Models\CustomerGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function groups() {
        return $this->belongsToMany(CustomerGroup::class);
    }
}
