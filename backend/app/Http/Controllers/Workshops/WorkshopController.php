<?php

namespace App\Http\Controllers\Workshops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\WorkshopDatetime;
use App\Models\UserWorkshopDatetime;
use Carbon\CarbonImmutable;
use DB;
use Auth;

class WorkshopController extends Controller
{
    /**
     * 一覧表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->input('status') ?? config('const.workshop.status.published');

        $workshopList = Workshop::fetchList($status, Auth::id());
        return view('workshops.list', ['workshops' => $workshopList]);
    }

    /**
     * 新規登録フォーム表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->forget('isEdit');
        return view('workshops.register');
    }

    /**
     * 登録内容確認
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        // 入力内容をセッションに保持
        session([
            // タイトル
            'title' => $request->title,
            // 開催地
            'venue' => $request->venue,
            // 紹介文
            'description' => $request->description,
            // 開催日時
            'eventDateTime' => CarbonImmutable::parse($request->eventDateTime),
            // 注意・警告事項
            'caution' => $request->caution,
            // キャンセル期限
            'cancellationDeadline' => CarbonImmutable::parse($request->cancellationDeadline),
            // 最少催行人数
            'minParticipants' => $request->minParticipants,
            // 雨天時の開催
            'caseOfRain' => $request->caseOfRain,
            // 参加費
            'participationFee' => $request->participationFee,
        ]);

        // 新規登録か更新によって遷移先を変更
        if (session()->has('isEdit')) {
            // 更新の場合
            $inputRoute = route('workshop.edit');
            $doneRoute = route('workshop.update');
        } else {
            // 新規登録の場合
            $inputRoute = route('workshop.create');
            $doneRoute = route('workshop.store');
        }
        return view('workshops.confirm', ['inputRoute' => $inputRoute, 'doneRoute' => $doneRoute]);
    }

    /**
     * 登録実行
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // セッションに格納した値を取得し、セッションを空にする
        $storeParam = [];
        $storeParam['title'] = $request->session()->pull('title');
        $storeParam['venue'] = $request->session()->pull('venue');
        $storeParam['description'] = $request->session()->pull('description');
        $storeParam['caution'] = $request->session()->pull('caution');
        $storeParam['cancellationDeadline'] = $request->session()->pull('cancellationDeadline');
        $storeParam['minParticipants'] = $request->session()->pull('minParticipants');
        $storeParam['caseOfRain'] = $request->session()->pull('caseOfRain');
        $storeParam['participationFee'] = $request->session()->pull('participationFee');

        // 押下したボタンに応じて、登録するステータスを決定する
        $storeStatus = $request->input('status');
        if ($storeStatus === config('const.workshop.status.published')) {
            $storeParam['status'] = config('const.workshop.status.published');
        } else {
            $storeParam['status'] = config('const.workshop.status.unpublished');
        }

        // 登録するユーザーのIDを取得する
        $storeParam['userId'] = Auth::id();

        // 開催日時は別テーブルに登録するため、同じ配列には入れない
        $eventDate = $request->session()->pull('eventDateTime');

        // 登録実行
        self::storeOrUpdate(
            $request->session()->pull('id'),
            $request->session()->pull('datetimeId'),
            $storeParam,
            $eventDate,
            $request->session()->pull('isEdit')
        );

        return redirect(route('workshop.list'));
    }

    /**
     * 登録・更新
     * 
     * @param int|null ワークショップID
     * @param int|null 日程ID
     * @param array 登録・更新値
     * @param CarbonImmutable イベント開催日
     * @param bool|null 更新フラグ
     */
    private function storeOrUpdate(
        int|null $id,
        int|null $datetimeId,
        array $param,
        CarbonImmutable $date,
        bool|null $isEdit
    ) {
        $workshop = $isEdit ? Workshop::find($id) : new Workshop();
        $workshopDatetime = $isEdit ? WorkshopDatetime::find($id) : new WorkshopDatetime();

        DB::transaction(function () use (
            $param,
            $date,
            $id,
            $datetimeId,
            $workshop,
            $workshopDatetime
        ) {
            $workshop->store($param);
            $workshopDatetime->store($workshop->id, $date);
        });
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

        return view('workshops.detail', [
            'workshop' => $workshopDetail,
            'participationUsers' => $participationUsers,
            'alreadyApplied' => $alreadyApplied,
        ]);
    }

    /**
     * 参加（確認）
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function joinConfirm(Request $request)
    {
        // ワークショップの詳細を取得
        $workshopDetail = Workshop::fetchDetail(
            $request->input('id'),
            config('const.workshop.status.published')
        );

        // 結合テーブルの値をCarbonImmutableに変更
        $workshopDetail->event_date_time = CarbonImmutable::parse($workshopDetail->event_date_time);
        return view('workshops.join_confirm', ['workshop' => $workshopDetail]);
    }

    /**
     * 参加（実行）
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function joinStore(Request $request)
    {
        // 開催日IDを取得
        $datetimeId = $request->input('id');
        // 登録実行
        DB::transaction(function () use ($datetimeId) {
            // ワークショップのマスタテーブルに登録
            $userWorkshopDatetime = new UserWorkshopDatetime();
            $userWorkshopDatetime->store($datetimeId, Auth::id());
        });

        return redirect(route('workshop.list'));
    }

    /**
     * 更新フォーム表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // 既にセッションに格納されている場合は確認画面からの遷移とみなす
        if (session()->has('id')) {
            return view('workshops.register');
        }

        $workshopId = $request->input('id');
        $workshop = Workshop::fetchDetail($workshopId, null);
        session([
            // ワークショップID
            'id' => $workshop->id,
            // 日程ID
            'datetimeId' => $workshop->datetime_id,
            // タイトル
            'title' => $workshop->title,
            // 開催地
            'venue' => $workshop->venue,
            // 紹介文
            'description' => $workshop->description,
            // 開催日時
            'eventDateTime' => CarbonImmutable::parse($workshop->event_date_time),
            // 注意・警告事項
            'caution' => $workshop->caution,
            // キャンセル期限
            'cancellationDeadline' => CarbonImmutable::parse($workshop->cancellation_deadline),
            // 最少催行人数
            'minParticipants' => $workshop->min_participants,
            // 雨天時の開催
            'caseOfRain' => $workshop->case_of_rain,
            // 参加費
            'participationFee' => intval($workshop->participation_fee),
            // 更新フラグ
            'isEdit' => true,
        ]);

        return view('workshops.register');
    }

    /**
     * 更新実行
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return self::store($request);
    }

    /**
     * 削除実行
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $workshopId = $request->input('id');
        DB::transaction(function () use ($workshopId) {
            $workshop = new Workshop();
            $workshop->deleteById($workshopId);
        });
        return redirect(route('workshop.list'));
    }
}
