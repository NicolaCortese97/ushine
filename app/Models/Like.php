<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'reazioni';
    protected $primaryKey = 'reazione_id';

    protected $fillable = [
        'post_id',
        'user_id',
        'tipo_reazione',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
}
