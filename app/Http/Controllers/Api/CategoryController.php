<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request){
        
        $q = $request->input('q');

        return Category::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }
}
