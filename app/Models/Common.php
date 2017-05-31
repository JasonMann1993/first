<?php

namespace App\Models;


trait Common
{

    /**
     * 获取 最近的商家列表
     * @param $lng
     * @param $lat
     * @param array $where
     * @return bool
     */
    public function getNearLists($lng, $lat, $where = [] ,$distance = 50000)
    {
        $offsets = get_lng_and_lat_deviation($lng, $lat, $distance);
        $res = $this->with('imgs')
            //->whereBetween('longitude', $offsets['lng'])
            //->whereBetween('latitude', $offsets['lat']) # TODO
            ->where($where)
            ->get();
        if (!$res->count())
            return collect();
        $res->map(function ($item) use ($lng, $lat) {
            $tmpNum = get_lng_and_lat_distance($item->latitude, $item->longitude, $lat, $lng);
            $item->distanceNum = $tmpNum;
            $item->distance = get_distance_text($tmpNum);
        });
        return $res->sortBy('distanceNum');
    }


}
