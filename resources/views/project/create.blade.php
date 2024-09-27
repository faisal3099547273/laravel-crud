@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
             
                <div class="m-4">
                <form action="{{route('projects.store')}}" 
                enctype="multipart/form-data" 
                method="POST">
                    @csrf
                    <div class="row mt-1">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="name">Staf Members</label>
                            <select name="member" id="member" class="form-control">
                                <option value="">Select Member</option>
                                @foreach ($users as $item)
                                <option value="{{$item->id}}">{{ucfirst($item->name)}}</option>
                                    
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
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    {{-- <div class="row mt-3">
                        <div class="col-12">
                            <label for="name">File Upload</label>
                         <input type="file" name="file" id="file" class="form-control">
                        </div>
                        @if ($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                        @endif
                    </div> --}}

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="">Select Status</label>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="status" id="status" value="active">
                                <label class="form-check-label" for="status" >
                                 Active
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" checked value="inactive">
                                <label class="form-check-label" for="status">
                                  InActive
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="hold">
                                <label class="form-check-label" for="status">
                                 Hold
                                </label>
                              </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                            <div id="id_dropzone" class="dropzone" >
                        </div>
                    </div>
                    </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                            <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
           
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
            
            <script src="{% static "dropzone/dropzone.js" %}"></script>
            
            <script type="text/javascript">
            
               Dropzone.autoDiscover = false;
            
               var image_id = 0;
               $(document).ready(function () {
                    $("#id_dropzone").dropzone({
                        maxFiles: 2000,
                        url: "{{route('file.upload')}}",
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (file, response) {
                          
                            
                        }
                    });
               })
               
            </script>
        @endsection



        
 