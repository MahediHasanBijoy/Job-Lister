<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    protected $fillable = ['company', 'title', 'location', 'email', 'website', 'tags', 'logo', 'description', 'user_id'];

    // relationship with user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
