<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class RecycleController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $project = Project::onlyTrashed()->get();

        return view('recycle',compact('project'));

    }

    public function restore(Request $request){

        // return $request->all();

        $ids = $request->input('ids');
    
    if (!empty($ids)) {
        Project::onlyTrashed()->whereIn('id', $ids)->restore();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'No items selected.']);
    }
}
