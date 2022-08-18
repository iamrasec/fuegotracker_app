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
        <button type="button" class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 form-submit">Save</a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mt-lg-0 mt-4">
        <div class="card">
          <div class="card-body">
            <form role="form" id="add_category_form" method="post" action="<?php echo $submit_url; ?>">
              <div class="row">
                <div class="col-12 col-md-6 col-xs-12">
                  <label class="form-label">Category Name</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" class="form-control" name="cat_name" value="" id="cat_name" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-12 col-md-6 col-xs-12">
                  <div class="row">
                      <label class="form-label">Category URL</label>
                      <div class="col-4 col-sm-4 pe-0">
                        <p class="text-xs mt-3 float-end px-0"><?php echo base_url(); ?>/category/</p>
                      </div>
                      <div class="col-8 col-md-8 col-xs-8 mb-3 ps-1">
                        <div class="input-group input-group-dynamic">
                          <input type="text" id="cat_url" class="form-control w-100 border px-2" name="cat_url" required onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-xs-12">
                  <label class="form-label">Parent Category</label>
                  <div class="input-group input-group-dynamic">
                    <select name="parent_cat" id="parent_cat" class="form-control">
                      <option value="0">None</option>
                      <?php foreach($categories as $category): ?>
                      <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-xs-12">
                  <label class="form-label">Weight</label>
                  <div class="input-group input-group-dynamic">
                    <input type="number" class="form-control" name="cat_weight" value="0" id="cat_weight" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
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
<?php $this->section("scripts") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo base_url(); ?>/assets/js/add_category.js"></script>
<?php $this->endSection() ?>