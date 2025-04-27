<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewerVideoDetail extends Model
{
    use HasFactory ;
    protected $table = 'viewer_video_details';
    public function user(){
        return $this->belongsTo(Users::class);
    }
}
