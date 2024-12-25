<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Xuất nguyên liệ<ul></ul></h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-2" style = "">
                                        <div class="sidebar sidebar-white-primary bordered">
                                            <nav class="mt-2">
                                                <ul class="nav nav-pills nav-sidebar flex-column p-2">
                                                    <?php foreach ($types as $type): ?>
                                                        <li class="nav-item">
                                                            <div class="nav-link type-item" data-id="<?= $type['material_type_id'] ?>" style="width: 95px">
                                                                <p><?= $type['type_name'] ?></p>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <table class="table table-head-fixed table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Tên nguyên liệu</th>
                                                    <th style="width: 40px;">Số lượng hiện tại</th>
                                                    <th>lựa chọn</th>
                                                </tr>
                                            </thead>
                                            <tbody id="material-list">
                                                <!-- Dữ liệu sẽ được load tại đây -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <form action="dashboard/material/extract" method="post">
                                    <table class ="table table-head-fixed table-bordered text-nowrap" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> Tên nguyên liệu</th>
                                                <th> Số lượng</th>
                                                <th> Lựa chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let rowCount = 1; // Đếm số dòng hiện tại trong bảng "sản phẩm được chọn"

        // Sự kiện khi nhấn vào một nguyên liệu trong danh sách nguyên liệu
        $(document).on('click', '.add-to-selected', function () {
            const materialId = $(this).data('id'); // Lấy ID của nguyên liệu
            const materialName = $(this).data('name'); // Lấy tên nguyên liệu
            const materialNumberNow = $(this).data('number-now'); // Số lượng hiện tại

            // Kiểm tra xem nguyên liệu đã được thêm vào bảng chưa
            if ($('#productTable tbody').find(`tr[data-id="${materialId}"]`).length > 0) {
                alert('Nguyên liệu này đã được thêm vào bảng!');
                return;
            }

            // Thêm nguyên liệu vào bảng "sản phẩm được chọn"
            const newRow = `
                <tr data-id="${materialId}">
                    <td>${rowCount}</td>
                    <td>${materialName}</td>
                    <td><input type="number" step="0.1" min="0.1" max = "${materialNumberNow}" name="materials[${rowCount}][quanity]" class="form-control" required></td>
                    <td>
                        <input type="hidden" name="materials[${rowCount}][material_id]" value="${materialId}">
                        <button type="button" class="btn btn-danger remove-row">Xóa</button>
                    </td>
                </tr>
            `;
            $('#productTable tbody').append(newRow);
            rowCount++;
        });

        // Xóa dòng khỏi bảng "sản phẩm được chọn"
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
            rowCount--;
            // Cập nhật lại số thứ tự
            $('#productTable tbody tr').each(function (index) {
                $(this).find('td:first').text(index + 1);
            });
        });

        // Sự kiện khi chọn loại nguyên liệu
        $('.type-item').on('click', function () {
            const typeId = $(this).data('id');
            $('.type-item').removeClass('active'); // Loại bỏ lớp "active" khỏi tất cả các mục
            $(this).addClass('active');           // Thêm lớp "active" cho mục được chọn

            // Gửi Ajax để lấy danh sách nguyên liệu
            $.post('<?= base_url("dashboard/material/getbytype") ?>', { type_id: typeId }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const materials = data.data;
                    const materialList = $('#material-list');
                    materialList.empty();

                    // Hiển thị danh sách nguyên liệu trong bảng
                    materials.forEach(material => {
                        materialList.append(`
                            <tr>
                                <td>${material.name}</td>
                                <td>${material.number_now}</td>
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-primary add-to-selected" 
                                        data-id="${material.material_id}" 
                                        data-name="${material.name}" 
                                        data-number-now="${material.number_now}">
                                        Thêm
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    alert(data.message);
                }
            });
        });
    </script>
<?= $this->endsection('content') ?>