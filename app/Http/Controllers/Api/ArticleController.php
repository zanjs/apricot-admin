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
  
     
    //    $tags = DB::table('article_tags')->where('tag_id', 'in', 'select tag_id from article_tags where article_id=1')->get();
       $tags = DB::select("SELECT article_id from article_tags where tag_id in (select tag_id from article_tags where article_id=".$id.") and article_id<>".$id."");

       return response()->json(['data' => $tags]);
    }
}
