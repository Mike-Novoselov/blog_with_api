<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    function upload(Request $request)
    {
        $result =$request->file('file')->store('apiFile');
        return ["result" => $result];
    }
}
