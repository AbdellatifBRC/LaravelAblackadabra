<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public const READ = 'read';
    public const UNREAD = 'unread';
    public const SAVED = 'saved';


    protected $fillable =[
        'text',
        'name',
        'email',
        'user_id',
        'status'
    ];

    public function read(){
        return $this::READ;
    }
    public function unread(){
        return $this::UNREAD;
    }
    public function fav(){
        return $this::SAVED;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
