<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Chỉnh sửa chức vụ</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title"> Thông tin chức vụ </div>
                </div>
                <div class="card-body ">
                    <form action="dashboard/group/update" method="post">
                        <input type="text" name="group_id" value="<?=$group['group_id']?>" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">name</label>
                                <input name="groupName" value="<?= $group['groupName']?>" type="text" class="form-control" id="inputEmai"
                                    placeholder="Group Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Mô tả</label>
                            <input name="description" value="<?= $group['description']?>" type="text" class="form-control" id="inputAddress"
                                placeholder="Mô tả thông tin của chức vụ" required>
                        </div>
                        <!-- <div class="form-group" style = "max-height: 500px; overflow: auto;">
                            <label for="inputAddress" >Chỉnh sửa quyền của chưc vụ</label>
                            <br>
                            <?php foreach($roles as $role): ?>
                                <label>
                                    <?= $role['type']?>
                                </label>
                                <input type="checkbox" name="role[]" value="<?= $role['role_id']?>"
                                <?php foreach($permissions as $pm): ?>
                                    <?php if($pm['group_id'] == $group['group_id']):?>
                                        <?= $pm['role_id']== $role['role_id']?"checked" :"";?>
                                    <?php endif;?>
                                <?php endforeach; ?>>
                                <label for=""><?= $role['description']?></label><br>
                            <?php endforeach; ?>
                        </div> -->
                        <div class="form-group" style="max-height: 500px; overflow: auto;">
                            <label for="inputAddress">Chỉnh sửa quyền của chức vụ</label>
                            <br>
                            <?php foreach ($groupedRoles as $type => $roles): ?>
                                <fieldset style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                    <legend style="font-weight: bold;"><?= htmlspecialchars($type) ?></legend>
                                    <?php foreach ($roles as $role): ?>
                                        <label>
                                            <input type="checkbox" name="role[]" value="<?= $role['role_id'] ?>"
                                            <?php foreach ($permissions as $pm): ?>
                                                <?php if ($pm['group_id'] == $group['group_id']): ?>
                                                    <?= $pm['role_id'] == $role['role_id'] ? "checked" : ""; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>>
                                            <?= htmlspecialchars($role['description']) ?>
                                        </label><br>
                                    <?php endforeach; ?>
                                </fieldset>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>