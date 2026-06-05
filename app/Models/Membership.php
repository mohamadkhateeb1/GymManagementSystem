<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'player_id',
        'start_date',
        'end_date',
        'status',
        'plan_name', // إضافة هذا الحقل لاسم الخطة
    ];
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    // دالة للتحقق مما إذا كانت الاشتراك منتهية
    // يمكنك استخدام هذه الدالة في أي مكان في التطبيق للتحقق مما إذا كانت الاشتراك منتهية أم لا
    //عملها كالتالي if ($membership->isExpired()) {
    //    // الاشتراك منتهي
    //} else {
    //    // الاشتراك لا يزال فعالاً
    //}

    public function isExpired()
{
    return \Carbon\Carbon::now()->greaterThan($this->end_date);// إذا كان التاريخ الحالي أكبر من تاريخ الانتهاء، فإن الاشتراك منتهي
}
}
