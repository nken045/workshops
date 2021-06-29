<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWorkshopDatetime extends Model
{
    protected $table = 'user_workshop_datetime';

    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datetime_id',
        'guest_user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'datetime_id' => 'integer',
        'guest_user_id' => 'integer',
    ];

    /**
     * 一覧取得
     * 
     * @param int ワークショップ開催日ID
     */
    public static function fetchList(int $datetimeId)
    {
        return UserWorkshopDatetime::select([
            'user_workshop_datetime.datetime_id',
            'user_workshop_datetime.guest_user_id',
            'users.name',
            'users.name_kana',
            'users.nickname',
        ])
            ->where('datetime_id', $datetimeId)
            ->join('users', function ($join) {
                $join->on('user_workshop_datetime.guest_user_id', '=', 'users.id');
            })
            ->get();
    }    

    /**
     * 登録
     * 
     * @param int ワークショップ開催日ID
     * @param int ユーザーID
     */
    public function store(int $datetimeId, int $userId)
    {
        $this->fill([
            'datetime_id' => $datetimeId,
            'guest_user_id' => $userId,
        ])
            ->save();
    }
}
