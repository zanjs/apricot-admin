<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    /**
     * A activle_tag has and belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        $pivotTable = 'article_tags';
        return $this->hasMany('App\Models\ArticleTag', 'tag_id', 'id');
        // return $this->belongsToMany(Article::class, $pivotTable, 'tag_id', 'article_id');
    }
}
