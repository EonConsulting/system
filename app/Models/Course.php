<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'featured_image', 'tags', 'xml_file', 'creator_id'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

}
