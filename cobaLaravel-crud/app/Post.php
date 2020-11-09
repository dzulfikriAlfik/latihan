<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    use Sluggable;
    protected $dates    = ['created_at'];
    protected $fillable = ['user_id', 'title', 'content', 'slug', 'thumbnail'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        return !$this->thumbnail ? asset('images/no-thumbnail.jpg') : $this->thumbnail;
    }
}
