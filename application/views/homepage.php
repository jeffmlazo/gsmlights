<div class="col-lg-4 col-md-4 col-sm-4"></div>
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Order</h3>
        </div>

        <div class="panel-body">

            <?php if (isset($msg_success)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $msg_success; ?>
                </div>
            <?php endif; ?>

            <form method="post" action=" <?php echo base_url(); ?>inventory_orders/save_order" autocomplete="false">

                <div class="form-group">
                    <label for="name">Name Of Product:</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="product">Product Number:</label>
                    <input type="text" class="form-control" id="product" name="product" required autofocus>
                </div>

                <div class="form-group">
                    <label for="type">Type:</label>
                    <input type="text" class="form-control" id="type" name="type" required autofocus>
                </div>

                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color" required autofocus>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" required autofocus>
                </div>

                <input type="submit" value="Submit" style="display:block; margin: 0 auto;" required autofocus>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4"></div>