<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    /**
     * A tag has and belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        $pivotTable = 'article_tags';

        return $this->belongsToMany(Article::class, $pivotTable, 'tag_id', 'article_id');
    }
}
