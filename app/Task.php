<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'id', 'user_id', 'calendar_id', 'summary', 'description', 'htmlLink', 'location', 'status', 'creator_displayName', 'creator_email', 'organizer_displayName', 'organizer_email', 'start_dateTime', 'end_dateTime',
        ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
