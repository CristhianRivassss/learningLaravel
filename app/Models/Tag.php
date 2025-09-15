<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function messages()
    {
        return $this->morphedByMany(Model::class, 'taggable');
    }
}
