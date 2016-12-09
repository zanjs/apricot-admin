<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * A article has and belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        $pivotTable = 'article_tags';

        return $this->belongsToMany(Tag::class, $pivotTable, 'article_id', 'tag_id');
    }
}
