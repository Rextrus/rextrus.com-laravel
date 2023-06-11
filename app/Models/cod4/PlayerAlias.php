<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerAlias extends Model
{
    use HasFactory;

    // protected $visible = ['mainAlias', 'guidShort'];
    protected $connection = 'mysqlWeb';
    protected $table = "content_aliases";

    public $primaryKey = 'id';

    public function getGuid() 
    {
        return $this->hasOne(Player::class, "id", "id_guid");
    }
}
