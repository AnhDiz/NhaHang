<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Chỉnh sửa quyền của một chức vụ</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/permission/update" method="post">
                        <input type="text" name="group_id" hidden value="<?= $groups['group_id']?>">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">name</label>
                                <input name="name" value="<?= $groups['groupName']?>" type="text" class="form-control" id="inputEmai"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Mô tả</label>
                            <input name="description" value="<?= $groups['description']?>" type="text" class="form-control" id="inputAddress"
                                placeholder="Mô tả thông tin của chức vụ" required>
                        </div>
                        <?php foreach($roles as $role): ?>
                            <input type="checkbox" name="role[]" value="<?= $role['role_id']?>" 
                            <?php foreach($permissions as $pm): ?>
                                <?php if($pm['group_id'] == $groups['group_id']):?>
                                    <?= $pm['role_id']== $role['role_id']?"checked" :"";?>
                                <?php endif;?>
                            <?php endforeach; ?>>
                            <label for=""><?= $role['description']?></label><br>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>