<?php

namespace App\Models;

use App\Http\Controllers\Manage\Management\CoalGassesController;
use App\Http\Controllers\Manage\Management\DeliverWaterController;
use App\Http\Controllers\Manage\Management\PublicToiletsController;
use App\Http\Controllers\Manage\Management\RecoveriesController;
use App\Http\Controllers\Manage\Management\UnlockController;
use App\Http\Controllers\Manage\Service\HouseMoveController;
use App\Http\Controllers\Manage\Service\RentalController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $sexText = [
        0 => '未知',
        1 => '男',
        2 => '女'
    ];

    public $modelWithControllers = [
        CoalGass::class => CoalGassesController::class,
        DeliverWater::class => DeliverWaterController::class,
        HouseMoving::class => HouseMoveController::class,
        PublicToilet::class => PublicToiletsController::class,
        Recovery::class => RecoveriesController::class,
        Rental::class => RentalController::class,
        Unlock::class => UnlockController::class
    ];

    public $modelWithTexts = [
        CoalGass::class => '煤气',
        DeliverWater::class => '送水',
        HouseMoving::class => '搬家',
        PublicToilet::class => '公厕',
        Recovery::class => '回收',
        Rental::class => '租房',
        Unlock::class => '开锁'
    ];

    /**
     * 用户详细信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = encrypt($password);
    }



}
