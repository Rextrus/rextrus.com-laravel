<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $visible = ['mapExternal', 'topTimePlayer', 'topRPGPlayer', 'topTimeHaxPlayer', 'topRPGHaxPlayer', 'toptime', 'topRPG', 'id_3xp_way', 'name', 'walkthrough'];
    protected $connection = 'mysqlWeb';
    protected $table = "web_cod4_routes";
    
    public $primaryKey = 'id';

    public function map()
    {
        return $this->belongsTo(Map::class, 'id_3xp_map');
    }

    public function mapExternal()
    {
        return $this->belongsTo(MapExternal::class, 'id_3xp_map', 'id');
    }

    public function routesExternal()
    {
        return $this->belongsTo(RouteExternal::class, 'id', 'id_3xp_map');
    }

    public function topTimePlayer() 
    {
        return $this->hasMany(Player::class, "guidShort", "toptime_player");
    }

    public function topRPGPlayer() 
    {
        return $this->hasMany(Player::class, "guidShort", "topRPG_player");
    }

    public function topTimeHaxPlayer() 
    {
        return $this->hasMany(Player::class, "guidShort", "toptime_hax_player");
    }

    public function topRPGHaxPlayer() 
    {
        return $this->hasMany(Player::class, "guidShort", "topRPG_hax_player");
    }

    public function specificMap($map)
    {
        return $this->belongsTo(Map::class, 'id_3xp_map')->where('id_3xp_map', $map);
    }
}
