<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerAccountBalance extends Model
{
    use HasFactory;
    protected $table = "viewer_account_blance";
    public function user(){
        return $this->belongsTo(User::class);
    }
}
