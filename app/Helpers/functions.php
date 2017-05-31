<?php


/**
 * 获取当前控制器名
 *
 * @return string
 */
function get_current_controller_name()
{
    return get_current_action()['controller'];
}

/**
 * 获取当前方法名
 *
 * @return string
 */
function get_current_method_name()
{
    return get_current_action()['method'];
}

/**
 * 获取当前控制器与方法
 *
 * @return array
 */
function get_current_action()
{
    $action = request()->route()->getActionName();
    list($class, $method) = explode('@', $action);

    return ['controller' => $class, 'method' => $method];
}


/**
 * 获取偏移之后的 经纬度
 * @param $lng
 * @param $lat
 * @param int $deviation
 * @return array
 */
function get_lng_and_lat_deviation($lng, $lat, $deviation = 10000) {
    $y = $deviation / 110852; //纬度的范围
    $x = $deviation / (111320*cos($lat)); //经度的范围
    return [
        'lng' => [
            $x > 0 ? $lng - $x : $lng + $x,
            $x > 0 ? $lng + $x : $lng - $x,
        ],
        'lat' => [
            $y > 0 ? $lat - $y : $lat + $y,
            $y > 0 ? $lat + $y : $lat - $y,
        ]
    ];
}

/**
 * 获取 两个经纬度 之间的距离
 * @param $lat1
 * @param $lon1
 * @param $lat2
 * @param $lon2
 * @return float
 */
function get_lng_and_lat_distance($lat1, $lon1, $lat2, $lon2) {
    $R = 6371393; //地球平均半径,单位米
    $dlat = deg2rad($lat2-$lat1);
    $dlon = deg2rad($lon2-$lon1);
    $a = pow(sin($dlat/2), 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * pow(sin($dlon/2), 2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $d = $R * $c;
    return round($d);
}


function get_distance_text($deviation){
    if($deviation <= 1000)
        return $deviation .'m';
    else
        return number_format($deviation/1000,2) .'km';

}
if (!function_exists('recursive_child')) {
    /**
     * 递归 Child 方式
     * @param $lists
     * @param int $parent_id
     * @return mixed
     */
    function recursive_child($lists, $parent_id = 0)
    {
        $funcName = __FUNCTION__;
        $res = $lists->filter(function ($item) use ($lists, $parent_id, $funcName) {
            if ($item->parent_id == $parent_id) {
                $item->child = $funcName($lists, $item->id);
                return $item;
            }
        });
        return $res;
    }
}



if (!function_exists('recursive_sort')) {

    /**
     * 递归 Sort 方式
     * @param $lists
     * @param int $parent_id
     * @param int $level
     * @return \Illuminate\Support\Collection
     */
    function recursive_sort($lists, $parent_id = 0, $level = 0)
    {
        static $res;
        if (!$res)
            $res = collect();
        $funcName = __FUNCTION__;
        $lists->filter(function ($item) use ($lists, $parent_id, $level, $res, $funcName) {
            if ($item->parent_id == $parent_id) {
                $item->level = $level;
                $res->push($item);
                $funcName($lists, $item->id, $level + 1);
            }
        });
        return $res;
    }
}



/**
 * 获取Request Rules
 * @param $ins
 * @param $commons
 * @return array
 */
function get_request_rules($ins, $commons){
    $action = get_current_method_name();
    $tmpAction = $action . 'Rules';
    if (method_exists($ins, $tmpAction))
        return array_merge($commons, (array)$ins->$tmpAction());
    return $commons;
}


/**
 * 获取客户端IP
 * @return string
 */
function get_client_ip()
{
    $realip = "";
    $server = collect($_SERVER);
    if ($server->get('HTTP_X_FORWARDED_FOR') && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $server->get('HTTP_X_FORWARDED_FOR')))
    {
        $realip = $server->get('HTTP_X_FORWARDED_FOR');
    }
    else if ($server->get('HTTP_CLIENT_IP')  && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $server->get('HTTP_CLIENT_IP')))
    {
        $realip = $server->get('HTTP_CLIENT_IP');
    }
    else if($server->get('REMOTE_ADDR') && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $server->get('REMOTE_ADDR')))
    {
        $realip = $server->get('REMOTE_ADDR');
    }
    return $realip;
}

