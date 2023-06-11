<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlayers extends Model
{
    use HasFactory;

    // public  $visible = [];

    protected $connection = 'mysqlWeb';
    protected $table = "web_cod4_serverlist_currentplayers";
    protected $primaryKey = "id";


}
