<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    // public  $visible = [];

    protected $connection = 'mysqlWeb';
    protected $table = "web_cod4_serverlist";
    protected $primaryKey = "id";

    public function getCurrentPlayers() 
    {
        return $this->hasMany(ServerPlayers::class, 'id_server', 'id');
    }
}
