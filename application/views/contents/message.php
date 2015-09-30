<div class="col-lg-2 col-md-2 col-sm-2"></div>
<div class="col-lg-8 col-md-8 col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">List of Message</h3>
        </div>

        <div class="panel-body" style="padding: 10px;">

            <table id="message_list" class="display">
                <thead>
                    <tr>
                        <th>Phone Number</th>
                        <th>Username</th>
                        <th>Messages</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // echo $msg_results; 
                    for ($i = 0; $i < 20; $i++) {
                        echo '<tr>' .
                        '<td>Phone' . $i . '</td>' .
                        '<td>Username' . $i . '</td>' .
                        '<td>lorem ipsum dolor sit amet, consectetur adipisicing elit...' . $i . '</td>' .
                        '</tr>';
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2"></div>

<script>
    $(function() {

        $('#message_list').DataTable({
            "scrollX": true,
            "order": [[0, "asc"]],
            "pagingType": "simple_numbers",
            "info": true,
            "lengthMenu": [[10, 50, 100, 500, 1000], [10, 50, 100, 500, 1000]],
            "language": {
                "lenghtMenu": "Display_MENU_records per page",
                "zeroRecords": "Nothing found - sorry",
                "info": "showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from_MAX_total records)"
            }
        });

    });
</script>
