@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Accounts</div>
        <table id="accounts-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#accounts-table').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: false,
                ajax: '{{ route('admin-getAccount') }}',
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'authority',
                        render: function(data, type, row) {
                            switch (data) {
                                case 1:
                                    return '<i class="fa-solid fa-user-tie" style="font-size: 25px; text-align: center; color: #3063cd"></i>';
                                    break;
                                case 2:
                                    return '<i class="fa-solid fa-user" style="font-size: 25px; text-align: center"></i>';
                                    break;
                            }
                        }
                    },
                    {
                        data: 'img_url',
                        render: function(data, type, row) {
                            if (data && data.trim() !== '') {
                                return '<img src="{{ asset("storage") }}/' + data + '" alt="account image" width="100" height="100">';
                            } else {
                                return '<div>(Empty)</div>';
                            }
                        }

                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="delete-btn" onclick="return confirm(\'Are you sure?\')" href="' +
                                '{{ url('admin/account') }}' + '/' + data + '/delete">Delete</a>';
                        }


                    }
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                }
            });
        });
    </script>
@endsection
