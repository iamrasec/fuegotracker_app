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
        <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="<?php echo base_url('/admin/categories/add_category'); ?>">Add Category</a>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">URL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parent</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Weight</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($categories as $category): ?>
                  <tr class="text-xs font-weight-bold mb-0">
                    <td><?php echo $category->name; ?></td>
                    <td><?php echo $category->url; ?></td>
                    <td><?php echo $category->parent; ?></td>
                    <td><?php echo $category->weight; ?></td>
                    <td><a href="<?php echo base_url('admin/categories') . "/edit_category/" .$category->id; ?>">edit</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- <pre><?php echo print_r($categories); ?></pre> -->
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