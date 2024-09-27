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
                                    <a class="btn btn-primary" id="delete-selected-btn" href="#">Restore</a>
                                </div>
        
                                <div class="box-body table-responsive ">
                                    <div class="card-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($project as $item)
                                                <tr>
                                                    <td><input type="checkbox" class="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->status}}</td>
                                                </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
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

<script>
    const oTable = new DataTable('#example');
 
    $(document).ready(function(){
        $('#delete-selected-btn').on('click', function(e){
            e.preventDefault();

            var selected = [];
            $('.checkbox:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                if (confirm("Are you sure you want to delete these items?")) {
                    $.ajax({
                        url: '{{ route("recycle.restore") }}', // Your Laravel route
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.success) {
                                alert("Selected items restored successfully!");
                                location.reload(); // Reload the page to reflect the changes
                            }
                        },
                        error: function(xhr) {
                            alert("An error occurred: " + xhr.responseText);
                        }
                    });
                }
            } else {
                alert("Please select at least one item.");
            }
        });
    });;
</script>
@endsection


  



