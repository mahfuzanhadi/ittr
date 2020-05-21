<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Serverside jQuery Datatable</title>
    <link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="card mb-3">
        <div class="card-header">
            <button type="button" data-toggle="modal" data-target="#targetModal" class="btn btn-info btn-sm">Add new</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div id="targetModal" class="modal fade">
                <div class="modal-dialog">
                    <form method="post" id="customer_form">

                    </form>

                </div>
            </div>

            <script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
            <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>


            <script type="text/javascript">
                var table;

                $(document).ready(function() {

                    //datatables
                    table = $('#table').DataTable({

                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.

                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "<?php echo site_url('customers/ajax_list') ?>",
                            "type": "POST"
                        },

                        //Set column definition initialisation properties.
                        "columnDefs": [{
                            "targets": [0], //first column / numbering column
                            "orderable": false, //set not orderable
                        }, ],

                    });

                });
            </script>

</body>

</html>