<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
    <section class="container">
        <div class = "content-header"> <h1> Bảng loại nguyên liệu </h1></div>
        <?= view('messages/message') ?>
        <div class = "card">
            <div class="card-header">
                <form method="get" action="<?= site_url(relativePath: 'dashboard/materialtype') ?>">
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
                                <input style="width: 400px" type="text" name="search" placeholder="Tìm kiếm theo tên hoặc email" value="<?= $search?>">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class = "table table-head-fixed table-bordered text-nowrap" id="table" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 40px" >Material ID</th>
                            <th>Đơn vị đo</th>
                            <th>Chi tiết</th>
                            <th style="width: 170px">Lựa Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($types as $type):?>
                            <tr>
                                <td><?= $type['material_unit_id']?></td>
                                <td><?= $type['unit']?></td>
                                <td><?= $type['unit_name']?></td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <?= $pager = \Config\Services::pager()->makeLinks($currentPage, $perPage, $total,'pagination') ?>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                searching: false,
                ordering: true,
                paging: false,
                info :false,
               
            });
        });
    </script>
</body>

<?= $this->endsection('content') ?>