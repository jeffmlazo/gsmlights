<div class="col-lg-2 col-md-2 col-sm-2"></div>
<div class="col-lg-8 col-md-8 col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">List of File</h3>
        </div>

        <div class="panel-body" style="padding: 10px;">

            <table id="file_list" class="display">
                <thead>
                    <tr>
                        <th></th>
                        <th>Phone Number</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Job Title</th>
                    </tr>
                </thead>

                <tbody>
                    <?php echo $file_results; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2"></div>

<script>
    $(function() {

        $('#file_list').DataTable({
            "scrollX": true,
            "order": [[2, "asc"]],
            "aoColumnDefs": [
                // disable sorting per column change 1 or more to select a particular column
                // the 0 indicates the first column you can add multiple ex. [0, 2, 5]
                {'bSortable': false, 'aTargets': [0]}
            ],
            "pagingType": "simple_numbers",
            "info": true,
            "lengthMenu": [[10, 50, 100, 500, 1000], [10, 50, 100, 500, 1000]],
            "language": {
                "lenghtMenu": "Display_MENU_records per page",
                "zeroRecords": "Nothing found - sorry",
                "info": "showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)"
            }
        });

    });
</script>
