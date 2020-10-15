<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];

    public function shifts(){
        return $this->hasMany('App\Models\Shift');
    }

    public function getWorksOnDaysOfWeekAttribute(){
        return $this->shifts->map(function ($item) {
            return $item->day_of_week;
        })->toArray();
    }
}
