<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use Input;
use Response;

class FileController extends Controller{

    public function imgs()
    {
        // $this->wrongTokenAjax();
        $file = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        $destinationPath = 'upload/api/';
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
                return Response::json(
                    [
                        'success' => true,
                        'src' => asset($destinationPath.$filename),
                    ]
                );
    }



    

    
}



