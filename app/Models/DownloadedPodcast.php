<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadedPodcast extends Model
{
    use HasFactory;
    use Uuid; 
    
    protected $fillable = ['event_id', 'episode_id', 'podcast_id', 'occurred_at', 'type'];
}
