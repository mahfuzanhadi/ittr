<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h3 class="h3 my-2 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <div class=" row">
                <div class="col-md-3">
                    <input type="date" id="start_date" name="start_date" placeholder="Start Date" class="form-control" />
                </div>
                <div class="col-md-3">
                    <input type="date" id="end_date" name="end_date" placeholder="End Date" class="form-control" />
                </div>
                <div class="col-md-3">
                    <select class="custom-select custom-select-sm" name="dokter" id="dokter">
                        <option value="" hidden>Pilih Dokter</option>
                        <?php
                        foreach ($dokter as $row) {
                            echo '<option value="' . $row->id_dokter . '" ' . set_select('dokter', $row->id_dokter) . '> ' . $row->nama . ' </option>';
                        } ?>
                    </select>
                    <span id="error_dokter" class="text-danger"></span>
                </div>
                <div class="col-md-3">
                    <button type="submit" id="search" name="search" class="btn btn-primary active" aria-pressed="true">Search</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="d-none" id="if_null" style="text-align: center">Data tidak ditemukan!</p>
            <div class="float-right mr-4">
                <p id="total"></p>
            </div>
            <div class="table-responsive">
                <div id="container" class="table table-hover table-bordered" width="100%" cellspacing="0">

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $('#search').click(function() {
        let local = "<?php echo base_url('rekap/rangeDates'); ?>";
        $("#dataTable").load("#dataTable");
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();
        let dokter = $('#dokter').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('rekap/rangeDates'); ?>",
            dataType: "JSON",
            data: {
                start_date: start_date,
                end_date: end_date,
                dokter: dokter
            },
            success: function(response) {
                if (response[1] != 0) {
                    $("#if_null").removeClass('d-sm-inline-block');
                    $("#if_null").addClass('d-none');
                    $("#total").removeClass('d-none');
                    $("#total").addClass('d-sm-inline-block');
                    $("#container").removeClass('d-none');
                    $("#container").addClass('d-sm-inline-block');

                    function addHeaders(table, keys) {
                        var row = table.insertRow();
                        for (var i = 0; i < keys.length; i++) {
                            var cell = row.insertCell();
                            keys[0] = "No";
                            keys[1] = "Tanggal";
                            keys[2] = "No. RM";
                            keys[3] = "Pasien";
                            keys[4] = "Dokter";
                            keys[5] = "Tindakan";
                            keys[6] = "Biaya Tindakan";
                            keys[7] = "Biaya Obat";
                            keys[8] = "Total"
                            cell.appendChild(document.createTextNode(keys[i]));
                        }
                    }

                    var table = document.createElement('table');
                    for (var i = 0; i < response[0].length; i++) {
                        var child = response[0][i];
                        if (i === 0) {
                            addHeaders(table, Object.keys(child));
                        }
                        var row = table.insertRow();
                        Object.keys(child).forEach(function(k) {
                            var cell = row.insertCell();
                            cell.id = "cell" + k;
                            var tableCell = cell.appendChild(document.createTextNode(child[k]));
                            tableCell.parentElement.innerHTML = child[k];
                        })
                    }
                    $("#container").empty();
                    document.getElementById('container').appendChild(table);
                    table.className = 'table table-hover table-bordered';
                    table.setAttribute("id", "tableRekap");

                    var tbodyRef = document.getElementById('tableRekap').getElementsByTagName('tbody')[0];
                    tbodyRef.style.whiteSpace = "pre-wrap";

                    let data_total = response[1];
                    let total = 0;
                    for (var i in data_total) {
                        total += parseInt(data_total[i]);
                    }

                    var total_data = document.getElementById("total");
                    var format_total = new Intl.NumberFormat(['ban', 'id']).format(total);
                    total_data.innerHTML = 'Total : Rp. ' + format_total;

                } else {
                    $("#if_null").removeClass('d-none');
                    $("#if_null").addClass('d-sm-inline-block');
                    $("#total").removeClass('d-sm-inline-block');
                    $("#total").addClass('d-none');
                    $("#container").removeClass('d-sm-inline-block');
                    $("#container").addClass('d-none');

                }
            }
        });
    });
</script>