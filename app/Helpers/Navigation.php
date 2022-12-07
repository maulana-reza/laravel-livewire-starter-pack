<?php


namespace App\Helpers;


use Illuminate\Support\Arr;

class Navigation
{

    /**
     * Menu
     * Roles => [route name => label menu]
     */
    static protected $menus = [
        'default' => [
            'dashboard' => 'dashboard'
        ],
        'super-admin' => [
            'user.list'=>'users',
        ],
        'general' => [
        ]
    ];
    static public function get()
    {
        $data = auth()->user()->getRoleNames()->toArray();
        $result = [];
        foreach (self::$menus as $key => $item){
            $isAccessible = array_search($key,$data);
            if ($isAccessible >= -1 || $key === "default"){
                $result = Arr::collapse([$result,$item]);
            }
        }
        return $result;
    }
    static public function getSubActive($key)
    {
        foreach (self::get() as $k => $item) {
            if (is_array($item)) {
                if (array_key_exists($key, $item)) {
                    return [ucwords($k), ucwords($item[$key])];
                }
            }
        }
    }

    static public function checkSubActive($key, $route)
    {
        return array_key_exists($route, self::get()[$key]);
    }

    static public function pathNavigation()
    {
        $key = \Illuminate\Support\Facades\Route::currentRouteName();
        return @self::get()[$key] ? [self::get()[$key]] : self::getSubActive($key);
    }
}
