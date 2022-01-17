<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    protected $dates = ['deleted_at'];
}
