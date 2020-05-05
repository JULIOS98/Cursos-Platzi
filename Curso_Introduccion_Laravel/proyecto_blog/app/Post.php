<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Post extends Model
{
    use Sluggable;

    protected $table = 'posts';


     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    //Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
