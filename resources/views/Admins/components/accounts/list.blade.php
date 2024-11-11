<div class="table-container">
    <table id="exampleTable" class="table table-striped table-bordered table-hover" style="width: 70%;!important">
        <thead id="thead">
            <tr style="background-color: #90e0ef">
                <th>Tên</th>
                <th>Tuổi</th>
                <th>Công việc</th>
                <th>Quốc gia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nguyễn Văn A</td>
                <td>25</td>
                <td>Kỹ sư</td>
                <td>Việt Nam</td>
            </tr>
            <tr>
                <td>Lê Thị B</td>
                <td>30</td>
                <td>Bác sĩ</td>
                <td>Việt Nam</td>
            </tr>
            <!-- Thêm các dòng dữ liệu khác tại đây -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#exampleTable').DataTable({

        });
    });


    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         ajax: "data.json", // Đường dẫn đến file JSON hoặc URL API
    //         columns: [{
    //                 data: "name"
    //             },
    //             {
    //                 data: "age"
    //             },
    //             {
    //                 data: "job"
    //             },
    //             {
    //                 data: "country"
    //             }
    //         ]
    //     });
    // });
</script>
