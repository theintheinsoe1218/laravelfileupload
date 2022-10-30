@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-content-center">
                        <h2>All Users</h2>
                        <a href="{{ route('excel.export') }}" class="btn btn-secondary">Export</a>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered usertable" style="width:100%">
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
                        {{-- {!! $dataTable->table() !!} --}}

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
                responsive: true,
                ajax: '/admin/user-ssd',
                columns: [

                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                
                  
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
    {{-- {!! $dataTable->scripts() !!} --}}

@endpush
