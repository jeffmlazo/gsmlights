<div class="col-lg-1 col-md-1 col-sm-1"></div>
<div class="col-lg-10 col-md-10 col-sm-10">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                List of Message
            </h3>
        </div>

        <div class="panel-body" style="padding: 10px;">
            <div id="message-list-container">
                <?php
                $data = (isset($json_data) && !empty($json_data) ? $json_data : null);
                $this->load->view('contents/messages/message_table', $data);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-1 col-md-1 col-sm-1"></div>