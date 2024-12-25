<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Sửa chức vụ</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/role/update" method="post">
                        <input type="text" name="role_id" id="" value="<?=$role['role_id']?>" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">url</label>
                                <input name="url" value="<?=$role['url']?>" type="text" class="form-control" id="inputEmai"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Mô tả</label>
                            <input name="description" value="<?=$role['description']?>" type="text" class="form-control" id="inputAddress"
                                placeholder="Mô tả thông tin của chức vụ" required>
                        </div>
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>