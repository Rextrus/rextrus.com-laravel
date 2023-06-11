<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    // public  $visible = ['routesInternal', 'date', 'ID_usermaps', 'id_3xp_map', 'name', 'download', 'totalRuns', 'release_date', 'mapper', 'routesExternal'];

    protected $connection = 'mysqlWeb';
    protected $table = "web_cod4_usermaps";
    protected $primaryKey = "ID_usermaps";

    public function routesExternal()
    {
        return $this->hasMany(RouteExternal::class, 'map_id', 'id_3xp_map');
    }
}
