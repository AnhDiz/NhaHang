<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Thêm mới một chức vụ</h1>
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
                    <form action="dashboard/role/create" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">url</label>
                                <input name="url" type="text" class="form-control" id="inputEmai"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Mô tả</label>
                            <input name="description" type="text" class="form-control" id="inputAddress"
                                placeholder="Mô tả thông tin của chức vụ" required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Loại</label>
                            <input name="type" type="text" class="form-control" id="inputAddress"
                                placeholder="Mô tả thông tin của chức vụ" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="types[]" value="add">
                            <label for="inputAddress">Thêm</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="types[]" value="edit">
                            <label for="inputAddress">sửa</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="types[]" value="delete">
                            <label for="inputAddress">Xóa</label>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>