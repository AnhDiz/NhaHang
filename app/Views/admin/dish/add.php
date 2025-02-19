<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <div class="container-fluid">
        <h1 class="dash-title">Thêm món ăn mới</h1>
        <div class="row">
            <div class="col-xl-12">
                <?= view('messages/message') ?>
                <div class="card easion-card">
                    <div class="card-body ">
                        <form action="dashboard/dish/create" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="">Tên món ăn</label>
                                    <input name="name" type="text" class="form-control" id=""
                                        placeholder="Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Loại món ăn</label>
                                    <select name="type" type="" class="form-control" id="" >
                                        <?php foreach($types as $type): ?>
                                            <option value="<?= $type['type_id'] ?>"><?=$type['type_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Mô tả món ăn</label>
                                    <textarea name="description" class="form-control" id="" required placeholder="Thêm mô tả về món ăn"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Giá món ăn</label>
                                    <input name="price" type="text" class="form-control" id="" required placeholder="Nhập giá của món ăn">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">ảnh món ăn</label>
                                    <input name="image" type="file" class="form-control" id="" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?= $this->endsection('content') ?>