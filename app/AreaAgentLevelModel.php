<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;

class AreaAgentLevelModel extends Model
{
    use Notifiable;
    protected $table = 'tbl_area_agent_level';
    protected $guarded = [];
    protected $casts = [
        'settings' => 'array'
    ];

    const STATUS_ACTIVE = 1;//启用
    const STATUS_FORBIDDEN = 0;//禁用
    const AREA_AGENT_ARRAY = [self::FIELD_DISTRICT=>'区代理', self::FIELD_CITY=>'市代理', self::FIELD_PROVINCE=>'省代理'];
    const FIELD_PROVINCE = 'province';
    const FIELD_CITY = 'city';
    const FIELD_DISTRICT = 'district';

    //table condition select field
    const TABLE_STATUS = 'status';
    const TABLE_SITE_ID = 'site_id';
    const TABLE_SETTINGS = 'settings';
    const TABLE_NAME = 'name';

    //request parameter
    const REQUEST_STATUS = 'status';//选择状态

    //verify condition restrict
    const WHERE_DECIMAL = 100.000;

    protected $hidden = [self::CREATED_AT, self::UPDATED_AT];

    public function scopeStatus($query)
    {
        return $query->where(self::TABLE_STATUS, request(self::REQUEST_STATUS,self::STATUS_ACTIVE));
    }

    public function scopeForbidden($query)
    {
        return $query->where(self::TABLE_STATUS, self::STATUS_FORBIDDEN);
    }

    public function scopeActive($query)
    {
        return $query->where(self::TABLE_STATUS, self::STATUS_ACTIVE);
    }

    public function dataFilter(array $data): Model
    {
        return $this->fill([
            self::TABLE_NAME => $data[self::TABLE_NAME],
            self::TABLE_SETTINGS => [
                self::FIELD_PROVINCE => $data[self::FIELD_PROVINCE],
                self::FIELD_CITY => $data[self::FIELD_CITY],
                self::FIELD_DISTRICT => $data[self::FIELD_DISTRICT]
            ]
        ]);
    }
}
