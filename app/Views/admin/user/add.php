<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title"> Thêm tài khoản </div>
                </div>
                <div class="card-body ">
                    <form action="dashboard/user/create" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmai"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Tên hiển thị</label>
                                <input name="name" type="text" class="form-control" id="inputAddress"
                                    placeholder="Tên hiển thị người dùng" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Số điện thoại</label>
                                <input name="phone_number" type="text" class="form-control" id="inputAddress"
                                    placeholder="Số điện thoại" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="">Chọn chức vụ: </label>
                            <select name="group_id" id="group_id" class="group_id" >
                                <?php foreach($groups as $group): ?>
                                <option value="<?= $group['group_id']?>" ><?=$group['groupName']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Mật khẩu</label>
                                <input name="password" type="password" class="form-control"
                                    id="password" placeholder="Nhập vào mật khẩu">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm">Xác nhận mật khẩu</label>
                                <input name="password_confirm" type="password" class="form-control"
                                    id="password-confirm" placeholder="Xác nhận lại mật khẩu">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                        <button type="reset" class="btn btn-secondary">Nhập lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>