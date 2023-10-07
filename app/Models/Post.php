<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use Storage;
use Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
    ];


    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured',true);
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories',function($query) use($category){
            $query->where('slug',$category);
        });
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function getReadingTime(){
        $words = str_word_count($this->body);
        return ceil($words/250);
    }

    public function getExcerpt(){
        return Str::limit(strip_tags($this->body), 150);
    }

    public function getThumbnailImage(){
        $isUrl = str_contains($this->image,'http');

        return ($isUrl) ? $this->image:Storage::disk('public')->url($this->image);
    }

}
