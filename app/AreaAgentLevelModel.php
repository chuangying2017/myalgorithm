<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAgentLevelModel extends Model
{
    protected $connection = 'yz-mysql';
    protected $table = 'tbl_area_agent_level';
    protected $guarded = [];

    const STATUS_ACTIVE = 'active';//活跃
    const STATUS_FORBIDDEN = 'forbidden';//禁用

    public function scopeStatus($query)
    {
        return $query->where('status',self::STATUS_ACTIVE);
    }
}
