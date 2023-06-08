<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //allow mass assignment for these fields
    protected $fillable = [
        'title',
        'company',
        'location',
        'website',
        'email',
        'description',
        'tags',
        'logo',
        'user_id'
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            //tag is present in job posting
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            //tag is present in job posting
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%')
            ->orWhere('company', 'like', '%' . request('search') . '%')
            ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }

    //Relationships
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
