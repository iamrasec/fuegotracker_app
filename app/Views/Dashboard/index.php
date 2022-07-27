<?php $this->extend("templates/base_dashboard"); ?>

<?php $this->section("content") ?>

<?php // echo $this->include('templates/__dash_navigation.php'); ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar -->
  <?php echo $this->include('templates/__dash_top_nav.php'); ?>
  <!-- End Navbar -->
  
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-6">
        <h4><?php echo $page_title; ?></h4>
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
              <!-- <pre><?php print_r($order_status); ?></pre> -->
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
                  <tr>
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
                      <?php if($order->end_time == '0000-00-00 00:00:00'): ?>
                        <a href="<?= base_url('/order/close/'.$order->id); ?>"><i class="material-icons fixed-plugin-button-nav cursor-pointer">check</i></a>
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

<!-- Product List page js -->
<script>
  $('#orders-table').DataTable();
</script>
<?php $this->endSection(); ?>