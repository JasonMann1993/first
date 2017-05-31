<?php

namespace App\Api\Controllers;

use App\Api\Requests\SearchRequest;
use App\Api\TransFormers\SearchTransformer;
use App\Models\Keyword;
use App\Models\SearchLog;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends BaseController
{

    /**
     * 热门搜索
     */
    public function hot()
    {
        # 一个月内 搜索最高 的关键字 group by ip
//        $lists = SearchLog::select('ip')->whereBetween('created_at', [,])->groupBy('ip')->get()->get();
        \DB::statement('SET sql_mode = ""');
        $num = 10;
        if (\App::environment('local', 'staging')) { // 开发 测试环境
            $num = 0;
        }
        $lists = \DB::select('select count(id) as num,keyword from (select * from search_logs  where `created_at` between "' . Carbon::now()->subMonth() . '" and "' . Carbon::now() . '" group by `ip`,`keyword`) as slog group by `keyword` having num >= ' . $num . ' ORDER BY num desc,keyword desc limit 10');
        $lists = collect($lists);
        return $lists->pluck('keyword');
    }

    /**
     * 搜索接口
     *
     * @param SearchRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $lists = Keyword::where([
            ['content', 'like', '%' . $request->get('search') . '%']
        ])->with(['commons' => function ($query) {
            $query->where('status', 1);
        }])->get();
        $lists = $lists->filter(function($item){
            return !empty($item->common);
        });

        # 添加搜索记录
        $ins = new SearchLog();
        $ins->keyword = $request->get('search');
        $ins->ip = get_client_ip();
        $ins->save();

        $pageNow = $request->get('page', 1);
        $pageSize = 10;
        $lists = new LengthAwarePaginator($lists->forPage($pageNow, $pageSize), $lists->count(), $pageSize);

        return $this->response->paginator($lists, new SearchTransformer());
    }

}