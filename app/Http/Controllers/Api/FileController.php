<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\File;
class FileController extends Controller
{
    //
    function upload(Request $request)
    {
        $file = new File;
        $file -> path = $request->file('file')->store('apiFile'); // "path" - название столбца куда помещать строку пити файла
        $result = $file -> save();
        if ($result){
            return ["result" => "File uploaded successfully"];
        }else{
            return ["result" => "File not uploaded"];
        }

    }
}
