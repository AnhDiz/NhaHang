<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <section class="container-fluid">
        <?= view('messages/message') ?>
        <div class="row">
            <div class="col-md-12">
                <div class = "card">
                    <div class="card-header">
                        <div class="row">
                            <h2 class="col-md-6">Bảng nguyên liệu</h2>
                            <div class="col-md-6">
                                <a class="float-right" href="<?= base_url('dashboard/material/add')?>">
                                    <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                                </a>
                                <a class="float-right" href="<?= base_url('dashboard/material/extract')?>">
                                    <button type="button"  class= "btn btn-block btn-primary ">Xuất hàng</button>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?= site_url(relativePath: 'dashboard/material') ?>">
                            <div class="row">
                                <div class="row col-md-8">
                                    <label class="col-md-2">
                                        Hiện thị
                                        <select name="per_page" onchange="this.form.submit()">
                                            <option value="1" <?= $perPage == 1 ? 'selected' : '' ?>>1 </option>
                                            <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5 </option>
                                            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10 </option>
                                        </select>
                                    </label>
                                    <label class="col-md-5">
                                        Nhóm nguyên liệu
                                        <select name="typefilter" onchange="this.form.submit()">
                                            <option value="0" <?= $typefilter == 0 ? 'selected' : ''  ?>> Không </option>
                                            <?php foreach($types as $material_type): ?>
                                                <option value="<?= $material_type['material_type_id']?>" <?= $typefilter == $material_type['material_type_id'] ? 'selected' : '' ?> ><?=$material_type['type_name']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </label>
                                    <label class="col-md-5">
                                        ĐVT
                                        <select name="unitfilter" onchange="this.form.submit()">
                                            <option value="0" <?= $unitfilter == "" ? 'selected' : ''  ?>> Không </option>
                                            <?php foreach($units as $material_unit): ?>
                                                <option value="<?= $material_unit['material_unit_id']?>" <?= $unitfilter ==$material_unit['material_unit_id'] ? 'selected' : '' ?> ><?=$material_unit['unit']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </label>
                                </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                        <input style="width: 300px" type="text" name="search" placeholder="Tìm kiếm theo tên hoặc email" value="<?= $search?>">
                                        <button type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class = "table table-head-fixed table-bordered text-nowrap" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 40px" >ID</th>
                                    <th>Tên nguyên liệu</th>
                                    <th style="width: 100px">Loại nguyên liệu</th>
                                    <th style="width: 50px">Đơn vị tính</th>
                                    <th style="width: 70px">Số lượng nhập</th>
                                    <th style="width: 70px">Số lượng tồn</th>
                                    <th style="width: 90px">Giá cho mỗi đơn vị (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($materials as $material):?>
                                    <tr>
                                        <td><?= $material['material_id']?></td>
                                        <td><?= $material['name']?></td>
                                        <td>
                                            <select name="material_type_id" id="material_type_id" class="material_type_id" onchange = "changeId(<?=$material['material_id']?>,this.value,'material_type_id')" >
                                                <?php foreach($types as $material_type): ?>
                                                <option value="<?= $material_type['material_type_id']?>" <?= $material_type['material_type_id'] == $material['material_type_id']?'selected' :''?>><?=$material_type['type_name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="unit" id="unit" class="unit" onchange = "changeId(<?=$material['material_id']?>,this.value,'unit')" >
                                                <?php foreach($units as $material_unit): ?>
                                                <option value="<?= $material_unit['material_unit_id']?>" <?= $material_unit['material_unit_id'] == $material['unit']?'selected' :''?>><?=$material_unit['unit']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><?= $material['number_start']?></td>
                                        <td><?= $material['number_now']?></td>
                                        <td><?= $material['price_per_unit']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?= $pager = \Config\Services::pager()->makeLinks($currentPage, $perPage, $total,'pagination') ?>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                searching: false,
                ordering: true,
                paging: false,
                info :false,
               
            });
        });
        function changeId(material_id,id,name){
            $.ajax({
                url: '<?= base_url('dashboard/material/updateI')?>',
                type: 'post',
                data: {
                    user_id: material_id,
                    role: id,
                    name:name
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Cập nhập thành công');
                    } else {
                        alert('Cập nhập thất bại.');
                    }
                }
            });
        };
    </script>
</body>

<?= $this->endsection('content') ?>