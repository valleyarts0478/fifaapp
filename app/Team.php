<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['team_name'];

    public function players() {

        return $this->hasmany('App\Player');

    }
}
