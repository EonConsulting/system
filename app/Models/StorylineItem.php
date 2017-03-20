<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorylineItem extends Model {

    protected $table = 'storyline_items';
    protected $primaryKey = 'id';
    protected $fillable = ['parent_id', 'storyline_id', 'type', 'name', 'description', 'file_name', 'file_url'];

    public function parent() {
        return $this->belongsTo(StorylineItem::class, 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany(StorylineItem::class, 'id', 'parent_id');
    }

    public function storyline() {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

}
