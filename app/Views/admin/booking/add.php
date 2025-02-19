<?= $this->extend('admin/home')?>
<?= $this->section('content')?>
<body>
<div class="container-fluid">
    <h1 class="dash-title">Đặt bàn mới</h1>
    <div class="row">
        <div class="col-xl-12">
            <?= view('messages/message') ?>
            <div class="card easion-card" style="height: 700px;">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-center mt-4">Sơ đồ Nhà hàng</h3>
                            <p class="text-center text-muted"><span style="color: blue;">Xanh dương</span> - Bàn trống, <span style="color: red;">Đỏ</span> - Bàn có khách, <span style="color: black;">Đen</span> - Bàn đã đặt trước.</p>
                            <div class="col-md-12 row">
                                <div class="col-md-2 sidebar sidebar-white-primary bordered">
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
                                <div class="col-md-8 bg-white " style="height: 400px;">
                                    <div id="list">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <form class="col-md-4" action="dashboard/booking/create" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <table class ="table table-head-fixed table-bordered text-nowrap bg-white" id="Table">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="" data-target-input="nearest">
                                        <label for="customer_name">Tên khách hàng</label>
                                        <input name="customer_name" type="text" class="form-control datetimepicker-input" id="customer_name" placeholder="Tên khách hàng" data-target="#date3" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="" data-target-input="nearest">
                                        <label for="phone_num">số điện thoại</label>
                                        <input name="phone_num" type="text" class="form-control datetimepicker-input" id="phone_num" placeholder="Tên khách hàng" data-target="#date3" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="" data-target-input="nearest">
                                        <label for="datetime">Date & Time</label>
                                        <input name="time" type="datetime-local" class="form-control datetimepicker-input" id="datetime" placeholder="Ngày giờ đặt" data-target="#date3" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <label for="message">Yêu cầu</label>
                                        <textarea name="request" class="form-control" placeholder="Yêu cầu" id="message" style="height: 100px"></textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    let count = 1;
    $(document).on('click', '.add-to-selected', function () {
        const tableId = $(this).data('id');
        const tableNumberNow = $(this).data('number-now'); 
        const existingRow = $('#Table tbody').find(`tr[data-id="${tableId}"]`);
        
        let status = $(this).data('status');
        if(status != "available"){
            alert("Bàn này đã được đặt trược hoặc đang được sử dụng");
            return;
        }
        if (existingRow.length > 0) {
            existingRow.remove();
            $(this).removeClass("bg-info");
            count --;
            return;
        } else {
            const newRow = `
                <tr data-id="${tableId}" id="${tableId}">
                    <td><input name = "tables[${count}]" value ="${tableId}" readonly></input></td>
                </tr>
            `;
            $('#Table tbody').append(newRow); // Thêm phần tử nếu chưa tồn tại
        }
        $(this).addClass("bg-info");
        count ++;
    });
    $('.type-item').on('click', function() {
        const floor = $(this).data('id');
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
                            tableHTML += `<td style = "width: 100px;height:100px">
                                <button 
                                    type="button" 
                                    class="add-to-selected"
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
<?= $this->endsection('content')?>