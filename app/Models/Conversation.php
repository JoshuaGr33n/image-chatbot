<?php

// app/Models/Conversation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'loggedin_user_id','message', 'image_path'];

    /**
     * Define a belongs-to relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

