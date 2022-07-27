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
    <form id="create_order" class="create_order_form" action="<?=base_url('/users/save_user'); ?>" method="POST">
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
              <h5 class="font-weight-bolder">User Information</h5>
              <div class="row mt-4">
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">First Name</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" id="first_name" class="form-control w-100 border px-2" name="first_name" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">Last Name</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" class="form-control w-100 border px-2" id="last_name" name="last_name" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">Password</label>
                  <div class="input-group input-group-dynamic">
                    <input type="password" id="password" class="form-control w-100 border px-2" name="password" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">Confirm Password</label>
                  <div class="input-group input-group-dynamic">
                    <input type="password" class="form-control w-100 border px-2" id="confirm_password" name="confirm_password" onfocus="focused(this)" required onfocusout="defocused(this)">
                  </div>
                </div>
              </div>  
              <div class="row mt-4">
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">Email Address</label>
                  <div class="input-group input-group-dynamic">
                    <input type="text" id="email" class="form-control w-100 border px-2" name="email" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-6 col-md-6 col-xs-12 mb-3">
                  <label class="form-label" for="name">Role</label>
                  <div class="input-group input-group-dynamic">
                    <select id="role" name="role" class="form-control w-100 border px-2" required onfocus="focused(this)" onfocusout="defocused(this)">
                      <option>Please Select One</option>
                      <?php foreach($roles as $role): ?>
                        <option value="<?php echo $role->id; ?>"><?= $role->role; ?></option>
                      <?php endforeach; ?>
                    </select>
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