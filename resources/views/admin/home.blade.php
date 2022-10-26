@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">All Users</div>
                    <div class="card-body">
                        <table class="table table-bordered usertable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            var table=$('.usertable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/user-ssd',
                columns: [

                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' },
                ]   
            });

            $(document).on('click','.delete',function(){
                var id=$(this).data('id');
                var url="{{ url('/admin/delete') }}";
                var dltUrl=url+'/'+id;
                // alert(id);
                $.ajax({
                    url:dltUrl,
                    type:'GET',
                    success:function(){
                        table.ajax.reload();
                    }
                })
            });
        });

       
    </script>
@endpush
