<?php
    $hlm = "Home";
    if(uri_string()!=""){
        $hlm = ucwords(uri_string());
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url()?>public/NiceAdmin/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?= $this->include('components/header') ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?= $this->include('components/sidebar') ?> 
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <?php
            if($hlm!="Home"){
                ?>
                <li class="breadcrumb-item"><?php echo $hlm?></li> 
                <?php
            }
            ?>          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $hlm?></h5>
              <!-- Table with stripped rows -->
              <?= $this->renderSection('content') ?>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?= $this->include('components/footer') ?> 
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- JQUERY -->
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/js/jquery-3.3.1.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url()?>public/NiceAdmin/assets/js/main.js"></script>
  <?= $this->renderSection('script') ?>

</body>

</html>