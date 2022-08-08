<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = 'projects';

    use HasFactory;

    public function attachments() {
        return $this->hasMany(DocumentAttachment::class, 'project_id');
    }

}
