<?php $this->extend("templates/base_dashboard"); ?>

<?php $this->section("content") ?>

<?php // echo $this->include('templates/__dash_navigation.php'); ?>
<style>
  .datepicker-container { z-index: 10000 !important; }
</style>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar -->
  <?php echo $this->include('templates/__dash_top_nav.php'); ?>
  <!-- End Navbar -->
  
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-6 d-flex flex-row align-items-center">
        <h4 class="mb-0"><?php echo $page_title; ?></h4>
        <div class="export_wrapper ms-5">
          <a href="#" class="export-excel" data-bs-toggle="modal" data-bs-target="#exportExcelModal"><img src="<?= base_url('assets/img/icons/microsoft-excel.png'); ?>"></a>
        </div>
      </div>
      <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
        <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="<?php echo base_url('/order/create'); ?>">Add Ticket</a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mt-lg-0 mt-4">
        <div class="card">
          <div class="card-body">
            <div class="table-responsives">
              <table id="orders-table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th>Order Number</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Order Source</th>
                    <th>Order Status</th>
                    <th>Additional Note</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($orders as $order): ?>
                  <tr id="order-<?= $order->id; ?>">
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->order_number; ?></a></td>
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->start_time; ?></a></td>
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->end_time; ?></a></td>
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->customer_name; ?></a></td>
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->phone; ?></a></td>
                    <td>
                    <?php foreach($order_sources as $source): ?>
                      <?php if($source->id == $order->order_source): ?>
                      <a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $source->source; ?></a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    </td>
                    <td>
                    <?php foreach($order_status as $status): ?>
                      <?php if($status->id == $order->order_status): ?>
                        <a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $status->status; ?></a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    </td>
                    <td><a href="<?= base_url('/order/view/'.$order->id); ?>"><?= $order->additional_note; ?></a></td>
                    <td>
                      <a href="<?= base_url('/order/view/'.$order->id); ?>"><i class="material-icons fixed-plugin-button-nav cursor-pointer">pageview</i></a> &nbsp; 
                      <?php if($order->order_status == 4): ?>
                        <!-- <a href="<?= base_url('/order/close/'.$order->id); ?>"><i class="material-icons fixed-plugin-button-nav cursor-pointer">check</i></a> -->
                        <a href="#" id="update_order" data-bs-toggle="modal" data-bs-target="#updateModal" data-order-id="<?= $order->id; ?>" data-status-id="<?= $order->order_status; ?>">
                          <i class="material-icons fixed-plugin-button-nav cursor-pointer">check</i>
                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <th>Order Number</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>Order Source</th>
                  <th>Order Status</th>
                  <th>Additional Note</th>
                  <th>Action</th>
                </tfoot>
              </table>
            
            <?php include('_update_order.php'); ?>
            <?php include('_export_data.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php $this->endSection(); ?>

<?php $this->section('scripts'); ?>
<!-- Load Data Table JS -->
<script src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/order.js') ?>"></script>

<!-- Product List page js -->
<script>
  var currStatus = "";
  $('#orders-table').DataTable();
</script>
<?php $this->endSection(); ?>