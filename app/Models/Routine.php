<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Routine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'remind_time',
        'user_id',
    ];

    public function todos()
    {
        return $this->hasMany('App\Models\Todo');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }    
    public function getOwnPaginateByLimit(int $limit_count = 5)
    {
        return $this->with('user')->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate($limit_count);    
    }

    public function getTodos($routine)
    {
        return Todo::with('user')->where('routine_id', $routine->id)->orderBy('updated_at', 'DESC')->paginate(5);
    }

}
