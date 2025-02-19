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
                            <h2 class = "col-md-6">Bảng quản lý các lên món</h2>
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
                                    <th>Tên món</th>
                                    <th>Trạng thái</th>
                                    <th>Số lượng</th>
                                    <th style="width: 170px">Lựa Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tabledishs as $tbs):?>
                                    <?php foreach($tables as $table):?>
                                        <?php foreach($dishs as $dish): ?>
                                            <?php if($tbs['table_id'] == $table['id'] && $tbs['dish_id'] == $dish['dish_id']) {?>
                                            <tr>
                                            <td><?=$table['id']?></td>
                                            <td><?=$table['table_num']?></td>
                                            <td><?=$dish['name']?></td>
                                            <td>
                                            </td>
                                            <td> <?= $tbs['quanity']?></td>
                                            <td class="text-center">
                                                    <a href="dashboard/table/edit/<?= $table['id']?>" class="btn btn-primary"><i class="fas fa-edit" name="btn-edit"></i></a>
                                                    <a href="dashboard/table/delete/<?= $table['id']?>" data-url="" class="btn btn-danger btn-del-confirm"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?= $pager = \Config\Services::pager()->makeLinks($currentPage, $perPage, $total,'pagination') ?>
                    </div>
                </div>
                <div class="card">
                    <h3 class="text-center mt-4">Sơ đồ Nhà hàng</h3>
                    <p class="text-center text-muted"><span style="color: blue;">Xanh dương</span> - Bàn trống, <span style="color: red;">Đỏ</span> - Bàn có khách, <span style="color: black;">Đen</span> - Bàn đã đặt trước.</p>
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
                        <div class="col-md-10 bg-white">
                            
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
        $('.type-item').on('click', function() {
            const floor = $(this).data('id');
            $('.type-item').removeClass('active');
            $(this).addClass('active');

            $.post('<?= base_url("dashboard/table/getbyfloor") ?>', { floor: floor }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const tables = data.data;
                    const rowCount = parseInt(data.row);
                    const colCount = parseInt(data.col);
                    const materialList = $('#list');
                    materialList.empty();

                    let tableHTML = '<table class="table table-bordered">';

                    const tableGrid = Array(rowCount).fill().map(() => Array(colCount).fill(null));

                    tables.forEach(table => {
                        const row = table.row - 1; 
                        const col = table.col - 1;
                        tableGrid[row][col] = table;
                    });

                    for (let r = 0; r < rowCount; r++) {
                        tableHTML += '<tr>'; 

                        for (let c = 0; c < colCount; c++) {
                            const table = tableGrid[r][c]; 
                            
                            if (table) {
                                let statusClass;
                                switch (table.status) {
                                    case '2':
                                        statusClass = 'ordered';
                                        break;
                                    case '3':
                                        statusClass = 'eating';
                                        break;
                                    default:
                                        statusClass = 'available';
                                } 
                                tableHTML += `<td style = "width: 100px;height:100px"  class="" data-id="${table.table_num}">
                                    <div class="row">
                                        <div class="col-md-6">
                                        ${table.table_num}
                                        <div class="${statusClass}"></div>
                                        </div>
                                        <div class="col-md-6">
                                        ${table.capacity}
                                        <i class="bi bi-person" style = "width: 40px"></i>
                                        </div>
                                    </div>
                                </td>`;
                            } else {
                                if(r == 2 && c == 0){
                                tableHTML += `<td style = "width: 100px;height:100px" class="" data-id="">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <i class="bi-bar-chart-steps" style = "width: 40px"></i>
                                        Cầu thang
                                        </div>
                                    </div>
                                </td>`;
                                }else if(r == 0 && c==4){
                                    tableHTML += `<td style = "width: 100px;height:100px" class="" data-id="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="bi-door-open-fill" style = "width: 40px"></i>
                                                Cửa
                                                </div>
                                            </div>
                                        </td>`;
                                }else{
                                    tableHTML += '<td style = "width: 100px;height:100px"></td>'
                                }
                            }
                        }
                        
                        tableHTML += '</tr>'; 
                    }
                    tableHTML += '</table>';
                    materialList.append(tableHTML); 
                } else {
                    alert(data.message);
                }
            });
        });

    </script>
</body>

<?= $this->endsection('content')?>