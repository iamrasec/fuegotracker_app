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
        <!-- <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="<?php echo base_url('/admin/products/measurements/add_measurement'); ?>">Add Measurement</a> -->
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mt-lg-0 mt-4">
        <div class="card">
          <div class="card-body">
            <form role="form" method="post" action="<?php echo $submit_url; ?>">
              <div class="row mt-4">
                <div class="col-12 col-sm-6">
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control w-100" aria-describedby="emailHelp" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">URL</label>
                    <input type="text" name="url" class="form-control w-100" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-12 col-md-2 col-sm-12 text-center">
                <button type="submit" class="btn btn-lg bg-gradient-primary w-100 mt-4 mb-0">Save</button>
              </div>
              <div class="col-12 col-md-2 col-sm-12 text-left pt-4" style="display:flex; align-items:center;">
                <a href="<?php echo base_url('/admin/strains'); ?>">Cancel</a>
              </div>
            </div>
            </form>
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