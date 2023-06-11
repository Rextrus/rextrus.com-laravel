<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapExternal extends Model
{
    use HasFactory;

    protected $connection = 'mysql3xP';

    protected $table = "cj_speedrun_maps";
    public $primaryKey = 'id';

}
