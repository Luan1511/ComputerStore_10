@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Brands</div>
        <table id="brands-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#brands-table').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: false,
                ajax: '{{ route('admin-getBrand') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                }
            });
        });
    </script>
@endsection
