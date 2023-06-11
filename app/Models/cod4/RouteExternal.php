<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteExternal extends Model
{
    use HasFactory;

    // protected $visible = ['name', 'countRuns'];

    protected $connection = 'mysql3xP';
    protected $table = "cj_speedrun_ways";
    
    public $primaryKey = 'id';

    public function runs() 
    {
        return $this->hasMany(Run::class, "way_id", "id")->where('cheats', 0)->orderBy('time')->limit(500);
    }

    public function countRuns() 
    {
        return $this->runs()->selectRaw('way_id, count(*) as runs')->groupBy('way_id');
    }

    public function routesInternal()
    {
        return $this->hasOne(Route::class, 'id_3xp_way', 'id');
    }

    public function map() 
    {
        return $this->hasOne(MapExternal::class, "id", "map_id");
    }
}
