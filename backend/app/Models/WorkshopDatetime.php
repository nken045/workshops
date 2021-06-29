<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\CarbonImmutable;

class WorkshopDatetime extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id',
        'event_date_time',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'workshop_id' => 'integer',
        'event_date_time' => 'datetime',
    ];

    /**
     * 新規登録
     * 
     * @param int ワークショップID
     * @param CarbonImmutable 開催日時
     */
    public function store(int $id, CarbonImmutable $datetime)
    {
        $this->fill([
            'workshop_id' => $id,
            'event_date_time' => $datetime,
        ])
            ->save();
    }
}
