<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProjectsDataTable;
use App\Mail\ProjectCraeteMail;
use App\Mail\ProjectUpdateMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectFile;
use Session;
use Cache;

class ProjectController extends Controller
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
     * Display a listing of the resource.
     */
    public function index(ProjectsDataTable $dataTable)
    {
        //
        return $dataTable->render('project.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user_id =  auth()->user()->id;
        $images = ProjectFile::where('user_id',$user_id)->get();

        foreach($images as $img){

            if(\File::exists(public_path('/project/file'.$img->file))){
                \File::delete(public_path('/project/file'.$img->file));
            }
        }

        $images = ProjectFile::where('user_id',$user_id)->delete();
        $users = User::where('role_id',2)->get();
        return view('project.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'member' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'user_id' => $request->member,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $project = Project::Create($data);

        ProjectFile::where('user_id',auth()->user()->id)->where('project_id',Null)->update(['project_id' => $project->id]);

        $data =  Mail::to(auth()->user()->email)->send(new ProjectCraeteMail($project->id));
        Session::flash('success', 'New project has been created successfully');

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::where('role_id',2)->get();
        //
         $project = Project::where('id',$id)->first();
        return view('project.edit',compact('project','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'member' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        
        $project = Project::find($id);

        $project->name = $request->name;
        $project->user_id = $request->member;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->save();
        $data =  Mail::to(auth()->user()->email)->send(new ProjectUpdateMail($project->id));
        Session::flash('success', 'Project has been created successfully');

        return redirect(route('projects.index'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Project = Project::where('id', $id)->first();
        $Project->delete();
        Cache::forget('general');
        return response()->json('success',200);
    }
}
