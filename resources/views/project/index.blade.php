@extends('layouts.app')

@section('content')
<div class="container">
 
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="box">
                                <div class="box-header m-2">
                                    <a class="btn btn-primary" href="{{ route('projects.create') }}">Add Project</a>
                                </div>
        
                                <div class="box-body table-responsive ">
                                    <div class="card-body">
                                        {{ $dataTable->table() }}
                                    </div>
        
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                   
                </div>
         
    
</div>
<script src="{{ asset('public/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
{{ $dataTable->scripts() }};
@endsection


  



