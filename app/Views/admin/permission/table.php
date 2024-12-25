<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <div class="container-fluid">  
        <?= view('messages/message') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Danh sách liên kết giữa chức vụ và quyền</h2>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?= site_url(relativePath: 'dashboard/permission') ?>">
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
                                        <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm theo tên hoặc email" value="<?= $search?>">
                                        <button type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="table" class="table table-bordered"" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Group name</th>
                                    <th>Description</th>
                                    <th>Role name</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($groups as $group):?>
                                    <tr>
                                        <td><?= $group['group_id']?></td>
                                        <td><?= $group['groupName']?></td>
                                        <td><?= $group['description']?></td>
                                        <td>   
                                            <?php foreach($permissions as $pm):?>
                                                <?php if($pm['group_id'] == $group['group_id']):?>
                                                    <?php foreach($roles as $role):?>
                                                        <?php if($pm['role_id'] == $role['role_id']):?>
                                                        <?= $role['description'] ?><br>
                                                        <?php endif;?>
                                                    <?php endforeach ?>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </td>
                                        <td class="text-center">
                                            <a href="dashboard/permission/edit/<?= $group['group_id']?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
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