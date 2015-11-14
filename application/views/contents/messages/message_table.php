<table id="message-list" class="display">
    <thead>
        <tr>
            <th>Phone Number</th>
            <th>Username</th>
            <th>Message</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Created On</th>
        </tr>
    </thead>

    <tbody>
        <!--Data for <td> will be populated here-->
    </tbody>
</table>

<script>
    $(function() {

        var table_options = {
            orderNum: 5,
            // Center the 1st and 2nd column cell velues
            columnDefs: [{className: "dt-body-center", "targets": [0, 1]}]
        };

        $.tableDisplay('#message-list', <?php echo (isset($json_data) && !empty($json_data) ? $json_data : 'null'); ?>, table_options);

    });
</script>
