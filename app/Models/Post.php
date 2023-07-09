<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'content', 'type', 'slug', 'trailer_video', 'thumbnail',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Vztahy s dalšími modely
    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    // Metody pro práci s typem příspěvku
    public function isFilm()
    {
        return $this->type === 'film';
    }

    public function isSerial()
    {
        return $this->type === 'serial';
    }

    public function isDivadlo()
    {
        return $this->type === 'divadlo';
    }
}
