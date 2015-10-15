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
            orderNum: 5 
        };

        $.tableDisplay('#message-list', <?php echo (isset($json_data) && !empty($json_data) ? $json_data : 'null'); ?>, table_options);

    });
</script>
