<?php $this->extend("templates/base_dashboard"); ?>

<?php $this->section("content") ?>

<?php echo $this->include('templates/__dash_navigation.php'); ?>

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
        <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="<?php echo base_url('/admin/compounds/add_compound'); ?>">Add Compound</a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mt-lg-0 mt-4">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">THC %</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">THC mg</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CBD %</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CBD mg</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($compounds as $compound): ?>
                  <tr class="text-xs font-weight-bold mb-0">
                    <td><?php echo $compound->pid; ?></td>
                    <td><?php echo $compound->thc_pct; ?></td>
                    <td><?php echo $compound->thc_mg; ?></td>
                    <td><?php echo $compound->cbd_pct; ?></td>
                    <td><?php echo $compound->cbd_mg; ?></td>
                    <td><a href="<?php echo base_url('admin/compounds') . "/edit_compound/" .$compound->id; ?>">edit</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
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
<script src="<?php echo base_url(); ?>/assets/js/plugins/datatables.js"></script>
<?php $this->endSection(); ?>