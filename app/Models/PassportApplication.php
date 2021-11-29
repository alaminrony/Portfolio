<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportApplication extends Model
{
    use HasFactory;
    
    public function attachments()
    {
        return $this->hasMany(DocumentAttachment::class,'application_id');
    }
}
