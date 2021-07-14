<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\WorkshopDatetime;
use Carbon\CarbonImmutable;
use DB;
use App\Consts\Category;
use App\Consts\AreaConsts;

class Workshop extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host_user_id',
        'title',
        'venue_id',
        'venue',
        'description',
        'caution',
        'cancellation_deadline',
        'min_participants',
        'case_of_rain',
        'participation_fee',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'host_user_id' => 'integer',
        'venue_id' => 'integer',
        'cancellation_deadline' => 'datetime',
        'participation_fee' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * 一覧取得
     * 
     * @param string ステータス
     * @param int|null ユーザーID
     * @return Collection ワークショップ一覧
     */
    public static function fetchList(String $status, int|null $userId, array|null $serchParam)
    {
        // dd($status === config('const.workshop.status.unpublished'));

        $result =  Workshop::select([
            'workshops.id',
            'workshops.host_user_id',
            'workshops.title',
            'workshops.venue_id',
            'workshops.venue',
            'workshops.description',
            'workshops.status',
        ])
            ->when($status === config('const.workshop.status.unpublished'), function ($query) use ($userId) {
                return $query->where('workshops.host_user_id', $userId);
            })
            ->where('workshops.status', $status)
            ->leftJoin('workshop_datetimes', function ($join) {
                $join->on('workshops.id', '=', 'workshop_datetimes.workshop_id')
                    ->whereNull('workshop_datetimes.deleted_at');
            })
            ->where('workshop_datetimes.event_date_time', '>', now());
            
        if (!empty($serchParam))
        {
            if ($serchParam['category'] !== null)
        {
            $result->when(array_key_exists($serchParam['category'], Category::CATEGORY_LIST_LOGICAL), function ($query) use ($serchParam) {
                return $query->where('workshops.category_id', $serchParam['category']);
            });
        } elseif ($serchParam['area'] !== null)
        {
            $result->when(array_key_exists($serchParam['area'], AreaConsts::PREFECTURE_LIST), function ($query) use ($serchParam) {
                return $query->where('workshops.venue_id', $serchParam['area']);
            });
        }
        }    
    
            return $result->get();
    }

    /**
     * 詳細取得
     * 
     * @param int ワークショップID
     * @param string|null ステータス
     * @return Collection ワークショップ一覧
     */
    public static function fetchDetail(int $workshopId, String|null $status)
    {
        return Workshop::select([
            'workshops.id',
            'workshops.host_user_id',
            'workshops.title',
            'workshops.venue_id',
            'workshops.venue',
            'workshops.description',
            'workshops.caution',
            'workshops.cancellation_deadline',
            'workshops.min_participants',
            'workshops.case_of_rain',
            'workshops.participation_fee',
            'workshops.status',
            'workshop_datetimes.id AS datetime_id',
            'workshop_datetimes.event_date_time',
        ])
            ->when($status, function ($query) use ($status) {
                return $query->where('workshops.status', $status);
            })
            ->where('workshops.id', $workshopId)
            ->join('workshop_datetimes', function ($join) {
                $join->on('workshops.id', '=', 'workshop_datetimes.workshop_id')
                    ->whereNull('workshop_datetimes.deleted_at');
            })
            ->first();
    }

    /**
     * 登録
     * 
     * @param array 登録パラメータ
     */
    public function store(array $storeParam)
    {
        $this->fill([
            'host_user_id' => $storeParam['userId'],
            'title' => $storeParam['title'],
            'venue_id' => $storeParam['venue_id'],
            'venue' => $storeParam['venue'],
            'description' => $storeParam['description'],
            'caution' => $storeParam['caution'],
            'cancellation_deadline' => $storeParam['cancellationDeadline'],
            'min_participants' => $storeParam['minParticipants'],
            'case_of_rain' => $storeParam['caseOfRain'],
            'participation_fee' => $storeParam['participationFee'],
            'status' => $storeParam['status'],
        ])
            ->save();
    }

    /**
     * 削除
     * 
     * @param int ワークショップID
     */
    public function deleteById(int $id)
    {
        $this->where('id', $id)->delete();
    }
}
