<?php $this->extend("templates/base"); ?>

<?php $this->section("content") ?>

<main class="main-content mt-0 vh-100">
  <div class="page-header align-items-start min-height-300 m-3 border-radius-xl">

  </div>
  <div class="container mb-4">
    <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card mt-8">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1 text-center py-4">
              <h4 class="font-weight-bolder text-white mt-1">Sign In</h4>
              <p class="mb-1 text-sm text-white">Enter your email and password to Sign In</p>
            </div>
          </div>
          <div class="card-body">
            <form role="form" class="text-start" action="<?= base_url(); ?>/home/login" method="POST">
              <div class="input-group input-group-static mb-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="john@email.com">
              </div>
              <div class="input-group input-group-static mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="•••••••••••••">
              </div>
              <!-- <div class="form-check form-switch d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
              </div> -->
              <div class="text-center">
                <input type="submit" class="btn bg-gradient-dark w-100 mt-3 mb-0" value="Sign in">
              </div>
            </form>
          </div>
          <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
            <p class="mb-4 text-sm mx-auto">
              Don't have an account?
              <a href="javascript:;" class="text-success text-gradient font-weight-bold">Sign up</a>
            </p>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <footer class="footer position-absolute bottom-2 py-2 w-100">
    <div class="container">
      
    </div>
  </footer>
</main>

<?php $this->endSection() ?>