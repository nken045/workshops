<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\UserWorkshopDatetime;
use Carbon\CarbonImmutable;
use Auth;

/** 
 * Topページ表示用Controllerクラス
 */
class DefaultController extends Controller 
{
    /**
     * Topページ表示
     */
    public function viewAction(Request $request){
        $status = config('const.workshop.status.published');
        $workshopList = Workshop::fetchList($status, null, null);
       return view('top', ['workshopList' => $workshopList]);
    }
	
    /**
     * 詳細表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $status = $request->input('status') ?? config('const.workshop.status.published');
        // ワークショップの詳細を取得
        $workshopDetail = Workshop::fetchDetail($request->input('id'), $status);

        // 結合テーブルの値をCarbonImmutableに変更
        $workshopDetail->event_date_time = CarbonImmutable::parse($workshopDetail->event_date_time);

        // 参加予定ユーザーの取得
        $participationUsers = UserWorkshopDatetime::fetchList($workshopDetail->datetime_id);

        // 自身が既に参加申し込み済みか判定
        $alreadyApplied = $participationUsers->contains(function ($user, $index) {
            return $user->guest_user_id === Auth::id();
        });

        return view('detail', [
            'workshop' => $workshopDetail,
            'participationUsers' => $participationUsers,
            'alreadyApplied' => $alreadyApplied,
        ]);
    }

}