<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecorderController extends Controller
{
    public function index()
    {
        return view('recorder3');
    }

    public function upload(Request $request)
    {
        // LARAVEL VALIDATION HERE

        if(isset($_FILES['recordFile']) and !$_FILES['recordFile']['error']){
            $fileName = $request->recordType . '_' . time() . '.' . $request->recordExtension;
            $destinationPath = public_path('/uploads/');
        
            move_uploaded_file($_FILES['recordFile']['tmp_name'], $destinationPath.$fileName);
        } else {
            // SUCCESS
            $response = [
                'status' => 'false',
                'message' => 'File not found',
                'data' => ''
            ];
            return response()->json($response, 200);
        }

        // SAVE TO DB HERE
    
        // SUCCESS
        $response = [
            'status' => 'true',
            'message' => 'Upload file success',
            'data' => [
                    'fileName' => $fileName
                ]
        ];
        return response()->json($response, 200);
    }
}