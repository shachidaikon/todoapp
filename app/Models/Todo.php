<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;


class Todo extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'is_checked',
        'title',
        'content',
        'user_id',
        'routine_id'
    ];

    function getOwnPaginateByLimit(int $limit_count = 5){
        return $this->with('user')->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate($limit_count);    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }    
    
    public function routine()
    {
        return $this->belongsTo('App\Models\Routine');
    }
    
    

}
