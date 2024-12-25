<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Thêm loại nguyên liệu mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/material/create" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmai">loại nguyên liệu</label>
                                <input name="name" type="text" class="form-control" id="inputEmai"
                                    placeholder="Tên nguyên liệu" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>