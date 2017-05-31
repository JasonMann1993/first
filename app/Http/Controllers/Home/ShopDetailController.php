<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Home\ShopDetailRequest;
use App\Models\ShopDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 商家详情
 * Class ShopDetailController
 * @package App\Http\Controllers\Home
 */
class ShopDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = ShopDetail::latest()->paginate(10);

        return view('home/shopDetail/index')->with(compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home/shopDetail/add');
    }

    /**
     * 添加
     * @param ShopDetailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShopDetailRequest $request)
    {
        //
        $shopDetailIns = new ShopDetail();
        $shopDetailIns->name = $request->name;
        $shopDetailIns->longitude = $request->lng;
        $shopDetailIns->latitude = $request->lat;
        $shopDetailIns->address = $request->address;
        $shopDetailIns->phone = $request->phone;
        try {
            $shopDetailIns->save();
        } catch (\Exception $error) {
            return redirect()->back()->with('error', '添加失败');
        }
        return redirect()->action('Home\ShopDetailController@index')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
