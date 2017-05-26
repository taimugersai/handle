<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('upload');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('cover')) {
            $file = $request->file('cover');
            if($file->isValid()){
                $ext = strtolower($file->guessExtension());
                $filename = md5(microtime()) . '.' . $ext ;
                $storagePath = 'uploads/images/'. date('Ymd');
                $destinationPath = public_path($storagePath);
                $file->move($destinationPath ,$filename);
                $path = url('/'.$storagePath .'/' .$filename);
                if($path) {
                    return response()->json([
                        'responseCode'=>'1',
                        'responseMsg'=>'上传成功',
                        'data'=> compact('path')
                    ]);
                }else {
                    return response()->json([
                        'responseCode'=>'0',
                        'responseMsg'=>'上传失败，请稍后再试',
                        'data'=> []
                    ]);
                }
            }
        }
    }
}
