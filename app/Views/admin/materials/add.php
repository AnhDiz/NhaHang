<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Thêm nguyên liệu mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/material/create" method="post">
                        <table class ="table table-head-fixed table-bordered text-nowrap" id="productTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên nguyên liệu</th>
                                    <th>loại</th>
                                    <th>DVD nguyên liệu</th>
                                    <th style="width: 140px;">Số lượng</th>
                                    <th>Giá (vnd/mỗi dvd)</th>
                                    <th>Thời gian hư(giờ)</th>
                                    <th>Lựa chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" name="materials[0][name]" class="form-control" required></td>
                                    <td>
                                        <select name="materials[0][material_type_id]" id="">
                                            <?php foreach($types as $type): ?>
                                                <option value="<?= $type['material_type_id']?>"><?= $type['type_name']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td>
                                    <select name="materials[0][unit]" id="">
                                            <?php foreach($units as $unit): ?>
                                                <option value="<?= $unit['material_unit_id']?>"><?= $unit['unit_name']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td><input type="number" step="0.1" min="0.1"  name="materials[0][number_start]" class="form-control"></td>
                                    <td><input type="number" name="materials[0][price_per_unit]" class="form-control"></td>
                                    <td><input type="number" step="0.1" min="0.1"  name="materials[0][time]" class="form-control"></td>
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
                        <td><input type="text" name="materials[${rowCount}][name]" class="form-control" required></td>
                        <td>
                            <select name="materials[${rowCount}][material_type_id]" id="">
                                <?php foreach($types as $type): ?>
                                    <option value="<?= $type['material_type_id']?>"><?= $type['type_name']?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                        <select name="materials[${rowCount}][unit]" id="">
                                <?php foreach($units as $unit): ?>
                                    <option value="<?= $unit['material_unit_id']?>"><?= $unit['unit_name']?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td><input type="number" step="0.1" min="0.1" name="materials[${rowCount}][number_start]" class="form-control"></td>
                        <td><input type="number" name="materials[${rowCount}][price_per_unit]" class="form-control"></td>
                        <td><input type="number" step="0.1" min="0.1"  name="materials[${rowCount}][time]" class="form-control"></td>
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