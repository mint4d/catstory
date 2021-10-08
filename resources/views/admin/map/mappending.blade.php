@extends('layouts.backend.style')

@section('title', 'Adopt')

    @push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
            rel="stylesheet">
    @endpush

@section('content')
    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 center-block">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Adopt
                            {{-- <span class="badge bg-blue">{{ $cat->count() }}</span> --}}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($cats as $key => $cat)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($cat->name, '10') }}</td>
                                            <td>{{ $cat->user->name }}</td>
                                            <td>{{ $cat->body }}</td>
                                            <td>
                                                @if ($cat->status == true)
                                                    <strong>มีเจ้าของ</strong>
                                                @else
                                                    <strong>ไม่มีเจ้าของ</strong>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cat->is_approved == true)
                                                    <span class="badge bg-blue">Approved</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                               
                                                <a href="{{ route('admin.map.show', $cat->id) }}"
                                                class="btn btn-success waves-effect">
                                                รายละเอียด
                                            </a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

        function approvePost(status) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form-' + status).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }

    </script>
@endpush
