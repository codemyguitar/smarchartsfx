<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        // 'name',
        'address',
        'phone',
        'fb_username',
        'user_id'
    ];

    /**
     * The inverse one to one relationship handler
     *
     * @return null
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
