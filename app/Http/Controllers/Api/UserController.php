<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request){
        
        $q = $request->input('q');

        return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
        // $users = [];

        // if($q){
        //    $users = User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
        // }else{
        //     $users = User::all();
        // }
        // return response()->json([
        //                 'success' => true,
        //                 'src' => $request->getQueryString(),
        //                 'data' => $users,
        //                 'count' => $users->count(),
        //                 'input' => $request->input('q')
        //             ]);
    }
}
