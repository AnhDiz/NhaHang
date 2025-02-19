<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <h1 class="dash-title">Thêm bàn mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card">
                <div class="card-body ">
                    <div class=" row">
                        <div class="col-md-4"> 
                            <form action="dashboard/booking/update" method="post">
                                <div class="form-row">
                                    <input name="id" type="text" hidden value="<?=$booking['id']?>">
                                    <div class="form-group col-md-6">
                                        <label for="table_num">Số bàn</label>
                                        <input name="table_num" type="table_num" class="form-control" id="table_num" placeholder="số bàn" required value="<?=$table['table_num']?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="customer_name">Tên khách hàng</label>
                                        <input name="customer_name" type="customer_name" class="form-control" id="customer_name" placeholder="số bàn" required value="<?=$booking['customer_name']?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="phone_number">Tên khách hàng</label>
                                        <input name="phone_number" type="phone_number" class="form-control" id="phone_number" placeholder="số bàn" required value="<?=$booking['phone_number']?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="request"> Yêu cầu</label>
                                        <textarea name="request" id="request" placeholder="Yêu cầu" style="height: 100px" value="<?=$booking['request']?>"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="time">thời gian</label>
                                        <input name="time" type="datetime-local" class="form-control" id="time" placeholder="số bàn" required value="<?=$booking['time']?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Xác nhận</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <h3 class="text-center mt-4">Sơ đồ Nhà hàng</h3>
                                <p class="text-center text-muted"><span style="color: blue;">Xanh dương</span> - Bàn trống, <span style="color: red;">Đỏ</span> - Bàn có khách, <span style="color: black;">Đen</span> - Bàn đã đặt trước.</p>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="sidebar sidebar-white-primary bordered">
                                            <nav class="mt-2">
                                                <ul class="nav nav-pills nav-sidebar flex-column p-2">
                                                    <h5> Tầng</h5>
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
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).on('click', '.add-to-selected', function () {
            const tableId = $(this).data('id');
            const tableNumberNow = $(this).data('number-now'); 
            let tableNumInput = $('#table_num');
            
            let status = $(this).data('status');
            if (status !== "available") {
                alert("Bàn này đã được đặt trước hoặc đang được sử dụng");
                return;
            }

            // Loại bỏ lớp "bg-info" khỏi tất cả các ô khác
            $('.add-to-selected').removeClass("bg-info");

            // Nếu ô được chọn trước đó là chính nó, bỏ chọn
            if (tableNumInput.val() == tableNumberNow) {
                tableNumInput.val(""); // Xóa giá trị của input
                return;
            }

            // Thêm lớp "bg-info" vào ô mới được chọn
            $(this).addClass("bg-info");

            // Cập nhật giá trị của input table_num với số bàn mới
            tableNumInput.val(tableId);
        });
        $('.type-item').on('click', function() {
            const floor = $(this).data('id');
            let tableNumInput = $('#table_num');
            let val = tableNumInput.value;
            $('.type-item').removeClass('active');
            $(this).addClass('active');


            $.post('<?= base_url("main/booking/getbyfloor") ?>', { floor: floor }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const tables = data.data;
                    const rowCount = parseInt(data.row);
                    const colCount = parseInt(data.col); 
                    const materialList = $('#list');
                    materialList.empty();

                    let tableHTML = '<table class="table table-borderless">';

                    const tableGrid = Array(rowCount).fill().map(() => Array(colCount).fill(null));

                    tables.forEach(table => {
                        const row = parseInt(table.row) - 1;
                        const col = parseInt(table.col) - 1;
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
                                let bg = '';
                                if(table.table_num == val){
                                    let bg = 'bg-info'
                                }
                                tableHTML += `<td style = "width: 100px;height:100px">
                                    <button 
                                        type="button" 
                                        class="add-to-selected ${bg}"
                                        data-id="${table.table_num}"
                                        data-status = "${statusClass}">
                                        <div class="row">
                                            <div class="col-md-6">
                                            ${table.table_num}
                                            <div class="${statusClass}"></div>
                                            </div>
                                            <div class="col-md-6 column">
                                                <div class = "row-md-6">
                                                    ${table.capacity}
                                                    <i class="bi bi-person" style = "width: 40px"></i>
                                                </div>
                                                <div class = "row-md-6">

                                                </div>
                                            </div>
                                        </div>
                                    </button>
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
                                }
                                else{
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
<?= $this->endsection('content') ?>