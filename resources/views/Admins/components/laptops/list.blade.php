@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Laptops</div>
        <a href="{{ route('admin-addLaptop') }}" class="add-btn">
            Add laptop
        </a>
        <table id="laptops-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Processor</th>
                    <th>RAM</th>
                    <th>ROM</th>
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
            $('#laptops-table').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: false,
                ajax: '{{ route('admin-getLaptop') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'brand_name'
                    },
                    {
                        data: 'processor'
                    },
                    {
                        data: 'ram'
                    },
                    {
                        data: 'rom'
                    },
                    {
                        data: 'img_url',
                        render: function(data, type, row) {
                            return '<img src="' + data + '" alt="laptop image" width="100px" height="100px">';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="delete-btn" onclick="return confirm(\'Are you sure?\')" href="' + '{{ url("admin/laptop") }}' + '/' + data + '/delete">Delete</a>' + 
                                   '<a class="edit-btn" href="' + '{{ url("admin/laptop") }}' + '/' + data + '/edit">Edit</a>';
                        }


                    }
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                    $('.dataTables_info').hide();
                }
            });
        });
    </script>
@endsection
