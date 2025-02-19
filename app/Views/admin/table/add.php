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
                            <form action="dashboard/table/create" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmai">Số bàn</label>
                                        <input name="table_num" type="table_num" class="form-control" id="inputEmai" placeholder="số bàn" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Số người</label>
                                        <input name="capacity" type="capacity" class="form-control" placeholder="số người" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Số Tầng</label>
                                        <select name="floor" id="floor" class="floor" >
                                            <option value="0" selected>mặc định</option>
                                            <?php foreach($floors as $floor): ?>
                                            <option value="<?= $floor['floor']?>"><?=$floor['floor']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <label for="">Vị trí</label>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Số cột</label>
                                        <input name="col" id="col" type="table_num" class="form-control" placeholder="số bàn" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Số hàng</label>
                                        <input name ="row" id="row" type="capacity" class="form-control" placeholder="số người" required readonly>
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
        $('.floor').on('change', function() {
            const floor = $(this).val();
            if(floor == 0){
                alert("luôn phải chọn tâng để bàn")
            }
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

                    let tableHTML = '<table class="table table-bordered tables">';

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
                                }
                                else{
                                    tableHTML += `<td style = "width: 100px;height:100px">
                                        <button 
                                            type="button" 
                                            class="btn btn-primary add-to-selected" 
                                            data-row="${r}" 
                                            data-col="${c}">
                                            chọn
                                        </button>
                                    </td>`;
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
        $(document).on('click','.add-to-selected',function(){
            document.getElementById("row").value = $(this).data('row') + 1;
            document.getElementById("col").value = $(this).data('col') + 1;

        });
    </script>
<?= $this->endsection('content') ?>