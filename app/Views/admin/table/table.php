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
                            <h2 class = "col-md-6">Bảng quản trị người dùng</h2>
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
                                    <label class="col-md-6">
                                        Lọc số số người tối đa mỗi bàn
                                        <select name="capacityfilter" onchange="this.form.submit()">
                                            <option value="0" <?= $capacityfilter == 0 ? 'selected' : ''  ?>> Không </option>
                                            <?php foreach($capacitys as $capacity): ?>
                                                <option value="<?= $capacity['capacity']?>" <?= $capacityfilter == $capacity['capacity'] ? 'selected' : '' ?> ><?=$capacity['capacity']?></option>
                                            <?php endforeach ?>
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
                        <table id="table" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 50px" >ID</th>
                                    <th>Số bàn</th>
                                    <th>Trạng thái</th>
                                    <th>Số người tối đa</th>
                                    <th style="width: 170px">Lựa Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tables as $table):?>
                                    <tr>
                                    <td><?=$table['id']?></td>
                                    <td><?=$table['table_num']?></td>
                                    <td>
                                        <select name="status" id="status" class="status" onchange="changeId(<?=$table['id']?>,this.value,'status')" >
                                            <?php foreach($status as $statu): ?>
                                            <option value="<?= $statu['id']?>" <?= $statu['id'] == $table['status']?'selected' :''?>><?=$statu['description']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="capacity" id="capacity" class="capacity" onchange="changeId(<?=$table['id']?>,this.value,'capacity')" >
                                            <?php foreach($capacitys as $capacity): ?>
                                            <option value="<?= $capacity['capacity']?>" <?= $capacity['capacity'] == $table['capacity']?'selected' :''?>><?=$capacity['capacity']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                            <a href="dashboard/table/edit/<?= $table['id']?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                            <a href="dashboard/table/delete/<?= $table['id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i
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
                <div class="card">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="sidebar sidebar-white-primary bordered">
                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column p-2">
                                        <?php foreach ($floors as $table): ?>
                                            <li class="nav-item">
                                                <div class="nav-link type-item" data-id="<?= $table['floor'] ?>" style="width: 95px">
                                                    <p><?='Tầng '.$table['floor'] ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h1 class="text-center mt-4">Sơ đồ Nhà hàng</h1>
                            <div id="list">
                            </div>
                        </div>
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
        // function changeId(material_id,id,name){
        //     $.ajax({
        //         url: '<?= base_url('dashboard/table/updateI')?>',
        //         type: 'post',
        //         data: {
        //             user_id: material_id,
        //             role: id,
        //             name:name
        //         },
        //         success: function(response) {
        //             if (response.status === 'success') {
        //                 alert('Cập nhập thành công');
        //             } else {
        //                 alert('Cập nhập thất bại.');
        //             }
        //         }
        //     });
        // };
        $('.type-item').on('click', function() {
            const floor = $(this).data('id');
            $('.type-item').removeClass('active');
            $(this).addClass('active');

            $.post('<?= base_url("dashboard/table/getbyfloor") ?>', { floor: floor }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const tables = data.data;
                    const rowCount = parseInt(data.row.row); // Số hàng (row)
                    const colCount = parseInt(data.col.col); // Số cột (col)
                    const materialList = $('#list');
                    materialList.empty();

                    // Tạo bảng 2 chiều
                    let tableHTML = '<table class="table table-bordered">';

                    // Khởi tạo mảng 2 chiều để giữ các bàn ăn
                    const tableGrid = Array(rowCount).fill().map(() => Array(colCount).fill(null));

                    // Lặp qua các bàn và điền vào grid
                    tables.forEach(table => {
                        const row = parseInt(table.row) - 1; // Chuyển đổi row từ 1-indexed thành 0-indexed
                        const col = parseInt(table.col) - 1; // Chuyển đổi col từ 1-indexed thành 0-indexed
                        tableGrid[row][col] = table; // Gán bàn vào vị trí tương ứng trong grid
                    });

                    // Duyệt qua các hàng
                    for (let r = 0; r < rowCount; r++) {
                        tableHTML += '<tr>'; // Mở một hàng mới
                        
                        // Duyệt qua các cột
                        for (let c = 0; c < colCount; c++) {
                            const table = tableGrid[r][c]; // Lấy bàn tại vị trí (r, c)
                            
                            if (table) {
                                // Nếu có bàn tại vị trí đó
                                const statusClass = table.status === '1' ? 'available' : 'occupied'; // Ví dụ: 1 là có bàn trống
                                tableHTML += `<td style = "width: 100px" class="${statusClass}" data-id="${table.table_num}">
                                    Bàn ${table.table_num}
                                </td>`;
                            } else {
                                // Nếu không có bàn, hiển thị ô trống
                                tableHTML += '<td style = "width: 100px"></td>';
                            }
                        }
                        
                        tableHTML += '</tr>'; // Đóng hàng
                    }

                    tableHTML += '</table>'; // Đóng bảng
                    materialList.append(tableHTML); // Thêm bảng vào danh sách
                } else {
                    alert(data.message);
                }
            });
        });

    </script>
</body>

<?= $this->endsection('content')?>