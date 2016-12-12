<?php

namespace App\Http\Controllers\Api;


use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ArticleController extends Controller
{
    public function similar(Request $request,$id){
        
        // $tags = ArticleTag::where('article_id',$id)->get();

        // $tags = DB::('article_tags')->select(['article_id'])->where('tag_id', '=', $id);
        // DB::table('article_tags')
        //     ->join('article_tags', 'users.id', '=', 'contacts.user_id')
        //     ->join('article_tags', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
      $article = Article::find($id);
      if(!$article){
          return response()->json(['success' => false]);
      }
      $articleTable = 'articles';
      $articleTagsTable = 'article_tags';
     
    //    $tags = DB::table('article_tags')->where('tag_id', 'in', 'select tag_id from article_tags where article_id=1')->get();
    //    $data = DB::select("SELECT article_id from article_tags where tag_id in (select tag_id from article_tags where article_id=".$id.") and article_id<>".$id." limit 5 ");
    //    $data = DB::select("SELECT * from articles WHERE id in(SELECT DISTINCT(article_id) from article_tags where tag_id in (select tag_id from article_tags where article_id=".$id.") and article_id<>".$id.") limit 5 ");
       $data = DB::select("SELECT * from ".$articleTable." a RIGHT JOIN (
           SELECT article_id,COUNT(article_id) num from ".$articleTagsTable." ats
           where tag_id in (select tag_id from ".$articleTagsTable." where article_id=".$id.") and article_id<>".$id."
           group by article_id order by num desc limit 5
           ) tt
           on a.id=tt.article_id");
           

       return response()->json(['success' => true,'data' => $data]);
    }
}
