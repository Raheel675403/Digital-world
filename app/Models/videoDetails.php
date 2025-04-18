<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class videoDetails extends Model
{
  use HasFactory;
  protected $table = 'video_details';
  protected $guarded = '';

  public function user(){
      return $this->belongsTo(User::class);
  }
}
