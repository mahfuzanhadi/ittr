<script type="text/javascript">
    var save_method;

    function delete_data(id) {
        bootbox.confirm("Anda yakin ingin menghapus data ini?", function(result) {
            if (result)
                $.ajax({
                    url: "<?= base_url('iobat/delete/'); ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        bootbox.alert("Data berhasil dihapus!", function() {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        bootbox.alert('Gagal menghapus data!');
                    }
                });
        });
    }
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data inventaris obat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <h3 class="h3 mb-4 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <a href="<?= base_url('iobat/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Tanggal Masuk</th>
                            <th>Expired</th>
                            <th>Jumlah Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form method="post" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <select class="form-control" name="id_obat" id="id_obat">
                                <option selected="selected">Choose one</option>
                                <?php
                                foreach ($obat as $row) {
                                    echo '<option value="' . $row->id_obat . '">' . $row->nama . ' --- ' . $row->satuan . ' --- ' . $row->ukuran . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Expired</label>
                            <input type="date" name="expired" id="expired" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Jumlah Masuk</label>
                            <input type="text" name="jumlah_masuk" id="jumlah_masuk" class="form-control" />
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_inventaris_obat" id="id_inventaris_obat" />
                            <!-- <input type="hidden" name="id_obat" id="id_obat" /> -->
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" onclick="save()">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "lengthMenu": [10, 20, 50],
            "ajax": {
                url: "<?= base_url('iobat/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 8],
                    "orderable": false
                },
                {
                    "width": "15px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "130px",
                    "targets": 1
                },
                {
                    "width": "30px",
                    "targets": 2
                },
                {
                    "width": "30px",
                    "targets": 3
                },
                {
                    "width": "40px",
                    "targets": 4,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "100px",
                    "targets": 5
                },
                {
                    "targets": 5,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "100px",
                    "targets": 6
                },
                {
                    "targets": 6,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "78px",
                    "targets": 7
                },
                {
                    "width": "70px",
                    "targets": 8
                },
            ]
        });
    });
</script>