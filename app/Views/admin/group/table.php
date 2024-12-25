<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <section class="containe-fluid">
        <?= view('messages/message') ?>
        <div class = "card">
            <div class="card-header">
                <div class="row">
                    <h2 class="col-md-6"> Bảng chức vụ </h2>
                    <div class="col-md-6">
                        <a class="float-right" href="<?= base_url('dashboard/group/add')?>">
                            <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                        </a>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <form method="get" action="<?= site_url(relativePath: 'dashboard/group') ?>">
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
                            
                        </div>
                        <div class="col-md-6 ">
                            <div class="float-right">
                                <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm theo chức vụ hoặc mô tả" value="<?= $search?>">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class = "table table-bordered" id="table" width="100%">
                    <thead>
                        <tr>
                            <th style="width :100px">Group ID</th>
                            <th>Name</th>
                            <th>description</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($groups as $group):?>
                            <tr>
                                <td><?= $group['group_id']?></td>
                                <td><?= $group['groupName']?></td>
                                <td><?= $group['description']?></td>
                                <td class="text-center">
                                    <a href="dashboard/group/edit/<?= $group['group_id'] ?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                    <a href="dashboard/group/delete/<?= $group['group_id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i class="far fa-trash-alt"></i></a>
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