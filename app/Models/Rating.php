<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'player_ratings'; // تحديد اسم الجدول في قاعدة البيانات

    protected $fillable = [
        'coach_id',
        'player_id',
        'rating',
        'feedback',
    ];

    // علاقة التقييم بالمدرب (الموظف)
    public function coach()
    {
        return $this->belongsTo(Employee::class, 'coach_id');
    }

    // علاقة التقييم باللاعب
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
