<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 検索結果一覧
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = config('const.workshop.status.published');
        $searchPram = [
            'category' => $request->input('category'),
            'area' => $request->input('venue_id'),
        ];
        $searchResult = Workshop::fetchList($status, null, $searchPram);
        return view('search.list', ['workshops' => $searchResult]);
    }



}
