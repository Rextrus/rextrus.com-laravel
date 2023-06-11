<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    // protected $visible = ['mainAlias', 'guidShort'];
    protected $connection = 'mysqlWeb';
    protected $table = "web_cod4_alias";

    public $primaryKey = 'id';

    public function runs() 
    {
        return $this->hasMany(Run::class, "guid", "guid")->where('cheats', 0)->orderBy('created_date', 'DESC');
    }

    public function longestRuns() 
    {
        return $this->hasMany(Run::class, "guid", "guid")->select('guid', 'way_id', 'time')->where('cheats', 0)->orderBy('time', 'DESC')->limit(20);
    }

    public function countRuns() 
    {
        return $this->runs()->selectRaw('guid, count(*) as runs')->groupBy('guid');
    }

    public function topTimePlayer() 
    {
        return $this->hasMany(Route::class, "toptime_player", "guidShort");
    }

    public function topRPGPlayer() 
    {
        return $this->hasMany(Route::class, "topRPG_player", "guidShort");
    }

    public function topTimeHaxPlayer() 
    {
        return $this->hasMany(Route::class, "toptime_hax_ele_player", "guidShort");
    }

    public function topRPGHaxPlayer() 
    {
        return $this->hasMany(Route::class, "topRPG_hax_ele_player", "guidShort");
    }

}
