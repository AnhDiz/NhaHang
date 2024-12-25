<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Chỉnh sửa món ăn</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <form action="dashboard/dish/update/<?= $dish['dish_id'] ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="">Tên món ăn</label>
                                <input name="name" type="text" class="form-control" value="<?= $dish['name'] ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Loại món ăn</label>
                                <select name="type" class="form-control">
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?= $type['type_id'] ?>" <?= $dish['dish_type_id'] == $type['type_id'] ? 'selected' : '' ?>>
                                            <?= $type['type_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Mô tả món ăn</label>
                                <textarea name="description" class="form-control" required><?= $dish['description'] ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Giá món ăn</label>
                                <input name="price" type="text" class="form-control" value="<?= $dish['price'] ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Hình ảnh</label>
                                <input name="image" type="file" class="form-control">
                                <small>Hình ảnh hiện tại: <?= $dish['image'] ?></small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection('content') ?>