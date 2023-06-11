<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;

    protected $visible = ['routeExternal', 'runs', 'way_id', 'time', 'guid', 'loads', 'saves', 'rpgs', '125fps', 'haxfps', 'cheats', 'sprinted', 'created_date', 'ele'];
    protected $connection = 'mysql3xP';
    protected $table = "cj_speedrun_highscores";

    public $primaryKey = 'id';

    public function route() 
    {
        return $this->hasOne(Route::class, "way_id", "id");
    }

    public function routeRuns() 
    {
        return $this->hasOne(Route::class, "id_3xp_way", "way_id");
    }

    public function routeExternal() 
    {
        return $this->hasOne(RouteExternal::class, "id", "way_id");
    }

    public function map() 
    {
        return $this->hasOne(Map::class, "way_id", "id");
    }

    public function guid() 
    {
        return $this->hasOne(Player::class, "guid", "guid");
    }
}
