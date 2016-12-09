<?php

namespace App\Http\Controllers\Api;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public function index(Request $request){
        
        $q = $request->input('q');

        return Template::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
    }
}
