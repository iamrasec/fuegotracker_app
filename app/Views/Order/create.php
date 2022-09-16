<?php $this->extend("templates/base_dashboard"); ?>

<?php $this->section("content") ?>
<style>
  .breaker {
    margin-top: 10px;
  }
</style>
<?php // echo $this->include('templates/__dash_navigation.php'); ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar -->
  <?php echo $this->include('templates/__dash_top_nav.php'); ?>
  <!-- End Navbar -->
  
  <div class="container-fluid py-4">
    <form id="create_order" class="create_order_form" action="<?=base_url('/order/save'); ?>" method="POST">
      <div class="row">
        <div class="col-lg-6">
          <h4><?php echo $page_title; ?></h4>
        </div>
        <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
          <button type="submit" class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Save</button>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 col-xs-12 mt-lg-0 mt-4">
          <div class="card">
            <div class="card-body">
              <h5 class="font-weight-bolder">Order Information</h5>
              <div class="row mt-4">
                <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">Start Time</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" id="start_time" class="form-control w-100 border px-2" name="start_time" value="<?= date("Y-m-d H:i:s"); ?>" readonly onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <!-- <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">End Time</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" class="form-control w-100 border px-2" id="end_time" name="end_time" onfocus="focused(this)" readonly onfocusout="defocused(this)">
                  </div>
                </div> -->
              </div>
              <div class="row mt-4">
                <div class="col-8 col-md-8 col-xs-12 mb-3">
                  <label class="form-label" for="name">Customer Name</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" id="customer_name" class="form-control w-100 border px-2" name="customer_name" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">Phone</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" class="form-control w-100 border px-2" id="phone" name="phone" onfocus="focused(this)" required onfocusout="defocused(this)">
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">Order Number</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" id="order_number" class="form-control w-100 border px-2" name="order_number" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">Order Source</label>
                  <div class="input-group input-group-dynamic">
                    <select id="order_source" name="order_source" class="form-control w-100 border px-2" required onfocus="focused(this)" onfocusout="defocused(this)">
                      <option>Please Select One</option>
                      <?php foreach($order_sources as $order_source): ?>
                        <?php if(!in_array($order_source->id, [1,2,3,4,7])): ?>
                        <option value="<?php echo $order_source->id; ?>"><?= $order_source->source; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-4 col-md-4 col-xs-12 mb-3">
                  <label class="form-label" for="name">Order Status</label>
                  <div class="input-group input-group-dynamic">
                    <select id="order_status" name="order_status" class="form-control w-100 border px-2" required onfocus="focused(this)" onfocusout="defocused(this)">
                      <option>Please Select One</option>
                      <?php foreach($order_status as $ostatus): ?>
                        <option value="<?php echo $ostatus->id; ?>"><?= $ostatus->status; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-12 col-xs-12 mb-3">
                  <label class="form-label" for="name">Additional Note</label>
                  <div class="input-group input-group-dynamic">
                    <textarea onfocus="focused(this)" required onfocusout="defocused(this)" style="width: 100%;" id="additional_note" name="additional_note"></textarea>
                  </div>
                </div>
              </div>
              
              
              
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>

<?php $this->endSection(); ?>