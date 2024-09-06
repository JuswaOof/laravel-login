@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-lg-12">
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="row">
                        <div class="alert alert-success col">
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="row">
                        <div class="alert alert-danger col">
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                @endif
                <div class="row">
                    @if (count($errors))
                        <div class="alert alert-danger col">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#addRoleModal"><i
                        class="fas fa-address-book fa-lg" id="addRole"></i>&nbsp;&nbsp;Add New Role</button>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>name</th>
                                    <th>display name</th>
                                    <th>description</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roleTable as $row)
                                    <tr class="text-center">
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->display_name }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>
                                            {{-- {{ Form::open(['route' => ['role.edit', $row->id], 'method' => 'get', 'style' => 'display: inline-block !important']) }}
                                            {{ Form::submit('Edit', ['class' => 'btn btn-primary edit', 'id' => $row->id, 'data-target' => 'editRoleModel', 'data-toggle' => 'modal']) }}
                                            {{ Form::close() }}
                                            {{ Form::open(['route' => ['role.delete', $row->id], 'method' => 'delete', 'style' => 'display: inline-block !important']) }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger delete']) }}
                                            {{ Form::close() }} --}}

                                            {{-- <form action="{{ route('role.edit', $row->id) }}" method="GET"
                                                class="d-inline-block"> --}}
                                            <button id="edit" type="submit" class="btn btn-primary"
                                                data-target="#editRoleModal" data-toggle="modal"
                                                data-id = "{{ $row->id }}" data-name = "{{ $row->name }}"
                                                data-display_name = "{{ $row->display_name }}"
                                                data-description = "{{ $row->description }}">Edit</button>
                                            {{-- </form> --}}

                                            <form action="{{ route('role.delete', $row->id) }}" method="POST"
                                                class="d-inline-block !important">
                                                @csrf
                                                @method('delete')
                                                <button id="delete" type="submit" name="Delete"
                                                    class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                {{-- add role modal --}}
                <div class="modal" id="addRoleModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Role</h4>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                {{ Form::open(['route' => 'role.store']) }}
                                <div class="form-group row">
                                    {{ Form::label('name', 'Name', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('name', '', ['placeholder' => 'Name', 'required' => 'required', 'class' => 'form-control input-sm']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('display_name', 'Display name', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('display_name', '', ['placeholder' => 'Display name', 'required' => 'required', 'class' => 'form-control input-sm']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('description', 'Description', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('description', '', ['placeholder' => 'Description', 'required' => 'required', 'class' => 'form-control input-sm']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        {{ Form::submit('Add', ['class' => 'btn btn-primary', 'id' => 'addRoleButton']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>

                {{-- edit role modal --}}
                <div class="modal" id="editRoleModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Role</h4>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                {{ Form::open(['route' => 'role.edit', 'id' => 'editForm', 'method' => 'POST']) }}
                                <div class="form-group row">
                                    {{ Form::label('name', 'Name', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('name', '', ['placeholder' => 'Name', 'required' => 'required', 'class' => 'form-control input-sm', 'id' => 'editName']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('display_name', 'Display name', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('display_name', '', ['placeholder' => 'Display name', 'required' => 'required', 'class' => 'form-control input-sm', 'id' => 'editDisplayName']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('description', 'Description', ['class' => 'control-label col-lg-3']) }}
                                    <div class="col-lg-6">
                                        {{ Form::text('description', '', ['placeholder' => 'Description', 'required' => 'required', 'class' => 'form-control input-sm', 'id' => 'editDescription']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        {{ Form::hidden('id', '', ['class' => 'form-control input-sm', 'id' => 'editId']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        {{ Form::submit('Edit', ['class' => 'btn btn-primary', 'id' => 'editRoleButton']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function($) {

            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            document.onkeydown = function(e) {
                // Disable F12
                if (e.keyCode == 123) {
                    return false;
                }
                // Disable Ctrl+Shift+I
                if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                    return false;
                }
                // Disable Ctrl+Shift+C (inspect)
                if (e.ctrlKey && e.shiftKey && e.keyCode == 67) {
                    return false;
                }
                // Disable Ctrl+Shift+J (console)
                if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                    return false;
                }
                // Disable Ctrl+U (view source)
                if (e.ctrlKey && e.keyCode == 85) {
                    return false;
                }
            }


            $('#navbarDropdown').on('click', function() {
                $('.dropdown-menu').show(500);
            });

            $('.table').DataTable();
            $("body").on("click", "#edit", function(e) {
                e.preventDefault();
                var name = $(this).data('name');
                var displayName = $(this).data('display_name');
                var editDescription = $(this).data('description');
                var id = $(this).data('id');
                $("#editRoleModal #editName").val(name);
                $("#editRoleModal #editDisplayName").val(displayName);
                $("#editRoleModal #editDescription").val(editDescription);
                $("#editRoleModal #editId").val(id);

                $('#editRoleButton').click(function() {
                    var insertData = $("#editForm").serialize();
                    $.ajax({
                        url: '{{ route('role.edit') }}',
                        type: 'POST',
                        data: insertData,
                        success: function(response) {
                            console.log('Success:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
            });



            // $("body").on("click", "#editRoleButton", function(e) {
            //     insertData = $("#editForm").serialize();
            //     $.ajax({
            //         url: {{ route('role.edit') }},
            //         type: "POST",
            //         data: insertData,
            //         success: function(response) {

            //         },
            //     });
            // });
        });
    </script>
@endsection
