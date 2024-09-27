<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectFile;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function fileUpload(Request $request){

        if($request->file('file')) {
            $imageName = time().'.'.$request->file->getClientOriginalExtension();
            $filePathe = $request->file->move(public_path('/project/file'), $imageName);

            $images[] = [
                'name' => $imageName,
                'path' => asset('/project/file'. $imageName),
                'user_id' => auth()->user()->id,
            ];
        }

        // $data = [];
        foreach ($images as $imageData) {
            $image = ProjectFile::create($imageData);
            $data = $image->id;
        }
     
        return response()->json(['success'=>$images,'data' => $data]);
    }
}
