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
                            <h2 class = "col-md-6">Bảng danh sách bàn được đặt</h2>
                            <div class=" col-md-6">
                                <a class="float-right" href="<?= base_url('dashboard/table/add')?>">
                                    <button type="button"  class= "btn btn-block btn-primary ">Thêm mới</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="<?= site_url(relativePath: 'dashboard/table') ?>">
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
                                        <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm" value="<?= $search?>">
                                        <button type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="table" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 50px" >ID</th>
                                    <th>Số bàn</th>
                                    <th>Tên khách</th>
                                    <th>Số điện thoại</th>
                                    <th>Yêu cầu</th>
                                    <th>Thời gian ăn</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 170px">Lựa Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($bookings as $table):?>
                                    <tr>
                                    <td><?=$table['id']?></td>
                                    <td><?=$table['table_id']?></td>
                                    <td><?=$table['customer_name']?></td>
                                    <td><?=$table['phone_number']?></td>
                                    <td><?=$table['request']?></td>
                                    <td><?=$table['time']?></td>
                                    <td><?=$table['status']?></td>
                                    <td class="text-center">
                                            <a href="dashboard/booking/edit/<?= $table['id']?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                            <a href="dashboard/booking/delete/<?= $table['id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i
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
        function changeId(material_id,id,name){
            $.ajax({
                url: '<?= base_url('dashboard/table/updateI')?>',
                type: 'post',
                data: {
                    user_id: material_id,
                    role: id,
                    name:name
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Cập nhập thành công');
                    } else {
                        alert('Cập nhập thất bại.');
                    }
                }
            });
        };
    </script>
</body>

<?= $this->endsection('content')?>