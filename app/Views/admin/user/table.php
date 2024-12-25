<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <div class="container-fluid">
        <?= view('messages/message') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h2 class = "col-md-6">Bảng quản trị người dùng</h2>
                            <div class=" col-md-6">
                                <a class="float-right" href="<?= base_url('dashboard/user/add')?>">
                                    <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?= site_url(relativePath: 'dashboard/user') ?>">
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
                                        Lọc theo chức vụ
                                        <select name="groupfilter" onchange="this.form.submit()">
                                            <option value="0" <?= $groupfilter == 0 ? 'selected' : ''  ?>> Không </option>
                                            <?php foreach($groups as $group): ?>
                                                <option value="<?= $group['group_id']?>" <?= $groupfilter == $group['group_id'] ? 'selected' : '' ?> ><?=$group['groupName']?></option>
                                            <?php endforeach ?>
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
                        <table id="table" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 50px" >ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>chức vụ</th>
                                    <th style="width: 170px">Số điện thoại</th>
                                    <th style="width: 170px">Lựa Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user):?>
                                    <tr>
                                    <td><?=$user['id']?></td>
                                    <td><?=$user['name']?></td>
                                    <td><?=$user['email']?></td>
                                    <td>
                                        <select name="group_id" id="group_id" class="group_id" onchange="changeGroupId(<?=$user['id']?>,this.value)" >
                                            <?php foreach($groups as $group): ?>
                                            <option value="<?= $group['group_id']?>" <?= $group['group_id'] == $user['group_id']?'selected' :''?>><?=$group['groupName']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><?=$user['phone_number']?></td>
                                    <td class="text-center">
                                            <a href="dashboard/user/edit/<?= $user['id']?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                            <a href="dashboard/user/delete/<?= $user['id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i
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
        function changeGroupId(userid,groupid){
            $.ajax({
                url: '<?= base_url('dashboard/user/updateI') ?>',
                type: 'post',
                data: {
                    user_id: userid,
                    role: groupid
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Cập nhập chức vụ thành công');
                    } else {
                        alert('Cập nhập chức vụ thất bại.');
                    }
                }
            });
        };
    </script>
</body>

<?= $this->endsection('content')?>