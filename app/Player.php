<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['player_no', 'player_name', 'player_image_url', 'team_id'];

    public function team() {

        return $this->belongsTo('App\Team');

    }

}
