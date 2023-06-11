<?php

namespace App\Models\cod4;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapperInternal extends Model
{
    use HasFactory;

    // protected $hidden = array('pivot');
    protected $connection = 'mysql';
    protected $table = "usermaps";
    
    public $primaryKey = 'ID_usermaps';

    public function __construct(array $attributes = []) {
        $this->table = env('mysql').'.'.$this->table;
        parent::__construct($attributes);
    }

    // public function mappers() {
    //     return $this->belongsToMany(Map::class, "usermaps", "id", "id_3xp_map");
    // }
}
