<?php

namespace App\Models;

use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The primary key column name of the table
     *
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The table name
     *
     * @var String
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The one to one relation handler
     *
     * @return Illuminate\Database\Eloquent\Relations
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
