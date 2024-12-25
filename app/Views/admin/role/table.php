<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <div class="container-fluid">
        <?= view('messages/message') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class = "card-header">
                        <div class="row">
                            <h2 class="col-md-6"> Bảng danh sách quyền </h2>
                            <div class=" col-md-6">
                                <a class="float-right" href="<?= base_url('dashboard/role/add')?>">
                                    <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?= site_url(relativePath: 'dashboard/role') ?>">
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
                                        Lọc theo loại
                                        <select name="typefilter" onchange="this.form.submit()">
                                            <option value="0" <?= $typefilter == 0 ? 'selected' : ''  ?>> Không </option>
                                            <?php foreach($types as $type): ?>
                                                <option value="<?= $type?>" <?= $typefilter == $type ? 'selected' : '' ?> ><?=$type?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="float-right">
                                        <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm theo url hoặc mô tả" value="<?= $search?>">
                                        <button type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table name="table" id="table" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 75px">Số thứ tự</th>
                                    <th>Url</th>
                                    <th>Chú thích</th>
                                    <th>loại</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($roles as $role):?>
                                    <tr>
                                        <td><?= $role['role_id']?></td>
                                        <td><?= $role['url']?></td>
                                        <td><?= $role['description']?></td>
                                        <td><?= $role['type']?></td>
                                        <td class="text-center">
                                            <a href="dashboard/role/edit/<?= $role['role_id'] ?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                            <a href="dashboard/role/delete/<?= $role['role_id'] ?>" data-url="" class="btn btn-danger btn-del-confirm"><i
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
                </div>
            </div>
        </div>
    </div>
    

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