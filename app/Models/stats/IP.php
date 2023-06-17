<?php

namespace App\Models\stats;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    use HasFactory;

    protected $connection = 'mysqlWeb';
    protected $table = "web_stats_ip";
    protected $primaryKey = "id";

    public function countIP()
    {
        return $this->hasMany(IPCount::class, 'id_web_stats_ip', 'id');
    }

}
