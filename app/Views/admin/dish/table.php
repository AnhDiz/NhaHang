<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <section class="container-fluid">
        <?= view('messages/message') ?>
        <div class = "card">
            <div class="card-header">
                <div class="row">
                    <h2 class="col-md-6"> Bảng món ăn</h2>
                    <div class=" col-md-6">
                        <a class="float-right" href="<?= base_url('dashboard/dish/add')?>">
                            <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="<?= site_url(relativePath: 'dashboard/dish') ?>">
                    <div class="row">
                        <div class="row col-md-6">
                            <label class="col-md-4">
                                Hiện thị
                                <select name="per_page" onchange="this.form.submit()">
                                    <option value="1" <?= $perPage == 1 ? 'selected' : '' ?>>1 </option>
                                    <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5 </option>
                                    <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10 </option>
                                </select>
                            </label>
                            <label class="col-md-6">
                                Lọc theo loại món ăn
                                <select name="typefilter" onchange="this.form.submit()">
                                    <option value="0" <?= $typefilter == 0 ? 'selected' : ''  ?>> Không </option>
                                    <?php foreach($types as $type): ?>
                                        <option value="<?= $type['type_id']?>" <?= $typefilter == $type['type_id'] ? 'selected' : '' ?> ><?=$type['type_name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </label>
                        </div>
                        <div class="col-md-6 ">
                            <div class="float-right">
                                <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm theo chức vụ hoặc mô tả" value="">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <table class = "table table-head-fixed table-bordered text-nowrap" id="table" width="100%">
                        <thead>
                            <tr>
                                <th style="width :100px">ID</th>
                                <th style = "width :100px">Ảnh</th>
                                <th>Tên món</th>
                                <th>Loại</th>
                                <th>Mô tả</th>
                                <th>Lựa chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($dishs as $dish):?>
                                <tr>
                                    <td><?= $dish['dish_id']?></td>
                                    <td>
                                        <img src="<?= "images/dish/". $dish['image']?>" height="100px" width="100px"  alt="">
                                        
                                    </td>
                                    <td><?= $dish['name']?></td>
                                    <td>
                                        <select name="type" type="" class="form-control" id="" >
                                            <?php foreach($types as $type): ?>
                                                <option value="<?= $type['type_id'] ?>" <?= $dish['dish_type_id'] == $type['type_id'] ? 'selected':''?>><?=$type['type_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><?= $dish['description']?></td>
                                    <td class="text-center">
                                        <a href="dashboard/dish/edit/<?= $dish['dish_id'] ?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                        <a href="dashboard/dish/delete/<?= $dish['dish_id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i
                                                class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                <?= $pager = \Config\Services::pager()->makeLinks($currentPage, $perPage, $total,'pagination') ?>
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
    </script>
</body>

<?= $this->endsection('content') ?>