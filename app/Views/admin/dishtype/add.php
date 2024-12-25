<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Thêm nguyên liệu mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/dishtype/create" method="post">
                        <table class ="table table-head-fixed table-bordered text-nowrap" id="productTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>loại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" name="types[0][type_name]" class="form-control" required></td>
                                    
                                    <td><button type="button" class="btn btn-danger remove-row">Xóa</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="addRow" class="btn btn-primary">Thêm dòng</button>
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let rowCount = 1; // Đếm số dòng hiện tại

            // Thêm dòng mới
            $('#addRow').click(function () {
                let newRow = `
                    <tr>
                        <td>${rowCount + 1}</td>
                        <td><input type="text" name="types[${rowCount}][type_name]" class="form-control" required></td>
                        
                        <td><button type="button" class="btn btn-danger remove-row">Xóa</button></td>
                    </tr>
                `;
                $('#productTable tbody').append(newRow);
                rowCount++;
            });

            // Xóa dòng
            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                rowCount--;
                // Cập nhật lại số thứ tự
                $('#productTable tbody tr').each(function (index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    </script>
<?= $this->endsection('content') ?>