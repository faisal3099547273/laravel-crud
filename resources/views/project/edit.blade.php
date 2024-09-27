@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
             
                <div class="m-4">
                <form action="{{route('projects.update',$project)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="row mt-1">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$project->name}}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="name">Staf Members</label>
                            <select name="member" id="member" class="form-control">
                                <option value="">Select Member</option>
                                @foreach ($users as $item)
                                <option value="{{$item->id}}" @if($project->user_id == $item->id) Selected @endif>{{ucfirst($item->name)}}</option>
                                    
                                @endforeach
                            </select>
                            @if ($errors->has('member'))
                            <span class="text-danger">{{ $errors->first('member') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="name">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$project->description}}</textarea>
                        </div>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="">Select Status</label>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="status" id="status" value="active" @if ($project->status == 'active')
                                checked
                                @endif>
                                <label class="form-check-label" for="status" >
                                 Active
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status"  value="inactive" @if ($project->status == 'inactive')
                                checked
                            @endif>
                                <label class="form-check-label" for="status">
                                  InActive
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="hold" @if ($project->status == 'hold')
                                checked
                            @endif>
                                <label class="form-check-label" for="status">
                                 Hold
                                </label>
                              </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                            <button class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
           
        @endsection
