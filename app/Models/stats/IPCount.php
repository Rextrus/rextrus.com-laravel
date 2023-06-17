<?php

namespace App\Models\stats;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPCount extends Model
{
    use HasFactory;
    
    protected $connection = 'mysqlWeb';
    protected $table = "web_stats_ip_count";
    protected $primaryKey = "id";

}
