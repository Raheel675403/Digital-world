<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaserDetail extends Model
{
    use HasFactory;
    protected $table = 'purchaser_details';
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
