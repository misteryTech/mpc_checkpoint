<?php
    include('include/header.php');
?>

<style>
  main.request_profile{
    background-image: url("assets/img/pnp_background.jpg");
  }

</style>
<body>

  <main  class="request_profile">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/pnp.png" alt="">
                  <span class="d-none d-lg-block">Request for Profiling</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 w-100">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Profile Information</h5>
                    <p class="text-center small">Enter your personal details</p>
                  </div>

                  <form class="row g-3 needs-validation" action="process/user_request.php" novalidate method="POST" enctype="multipart/form-data">

                    <div class="col-md-7">
                      <img id="imagePreview" src="" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%; height:auto; border:1px solid #ccc; padding:5px; max-height:200px;" />
                      <label for="driver_image" class="form-label">Driver Image</label>
                      <input type="file" class="form-control" id="driver_image" name="driver_image" accept="image/*" capture="camera" required>
                    </div>

                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" name="firstName" class="form-control" id="firstName" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" name="lastName" class="form-control" id="lastName" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="licenseNumber" class="form-label">License Number</label>
                      <input type="text" name="license_no" class="form-control" id="licenseNumber" required>
                      <div class="invalid-feedback">Please enter your license number!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter a valid email address!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="phone" class="form-label">Phone Number</label>
                      <input type="text" name="phone" class="form-control" id="phone" required>
                      <div class="invalid-feedback">Please enter your phone number!</div>
                    </div>


                    <div class="col-md-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-primary w-100" type="submit">Submit Profile</button>
                    </div>
                  </form>

                </div>
              </div>


  <?php
     include('include/footer.php');
  ?>

  <script>
    document.getElementById('driver_image').addEventListener('change', function(event) {
        var imagePreview = document.getElementById('imagePreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';  // Show the image
            }

            reader.readAsDataURL(file);
        }
    });
  </script>
