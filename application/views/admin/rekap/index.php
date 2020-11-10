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
                    <input type="text" id="dokter" name="dokter" placeholder="Dokter" class="form-control" />
                </div>
                <div class="col-md-3">
                    <button type="submit" id="search" name="search" class="btn btn-primary active" aria-pressed="true">Search</button>
                </div>
            </div>
        </div>
        <div class="card-body">
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
            data: {
                start_date: start_date,
                end_date: end_date,
                dokter: dokter
            },
            success: function(response) {
                let data_rekap = jQuery.parseJSON(response);

                function addHeaders(table, keys) {
                    var row = table.insertRow();
                    for (var i = 0; i < keys.length; i++) {
                        var cell = row.insertCell();
                        cell.appendChild(document.createTextNode(keys[i]));
                    }
                }

                var table = document.createElement('table');
                for (var i = 0; i < data_rekap[0].length; i++) {

                    var child = data_rekap[0][i];
                    if (i === 0) {
                        addHeaders(table, Object.keys(child));
                    }
                    var row = table.insertRow();
                    Object.keys(child).forEach(function(k) {
                        // console.log(k);
                        var cell = row.insertCell();
                        cell.appendChild(document.createTextNode(child[k]));
                    })
                }
                $("#container").empty();
                document.getElementById('container').appendChild(table);
                table.className = 'table table-hover table-bordered';

                let data_total = data_rekap[1];
                let total = 0;
                for (var i in data_total) {
                    total += parseInt(data_total[i]);
                }

                var total_data = document.getElementById("total");
                var format_total = new Intl.NumberFormat(['ban', 'id']).format(total);
                total_data.innerHTML = 'Total : Rp. ' + format_total;
                // console.log(total);
                // total_seluruh.forEach(myFunction);

                // function myFunction(item, index) {
                //     let total += parseInt(item);
                //     // document.getElementById("total").innerHTML += item + ":" + item + "<br>";
                // }

            }
        });
    });
</script>