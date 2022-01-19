<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url()?>assets/blockUi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>


<style type="text/css">
    .bot-pad{
        margin-bottom: 10px;
    }

    #countChart
    {

        display: inline-block; 
        width: 25px; 
        height: 25px;
        background-color: blue;
        border-radius: 20px; 
        text-align: center;
        color: white;
        font-size: 15px
    }
</style>
</head>
<body>

    <header>
        <?php $getCount=empty($this->session->userdata('countProduct'))?0:$this->session->userdata('countProduct')?>

        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url()?>home">Home</a>
                    </li>
<!--                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Product</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= site_url()?>product/index/3">Voucher Pulsa</a>
                            <a class="dropdown-item" href="<?= site_url()?>product/index/4">Aksesoris</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url()?>productPulsa/">Pulsa</a>
                            <a class="dropdown-item" href="<?= site_url()?>product/index/2">Paket Data</a>
                        </div>
                    </li>                     -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>productJasa/" >Product</a>
                    </li>                
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>checkTransaction">Cek Transaksi</a>
                    </li>
                    <?php if($this->session->userdata("username")) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>transactionJasa">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>login/logout">logout</a>
                    </li>                    
                    <?php } 
                    else {
                    ?>                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>registration">Daftar</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url()?>login">Login</a>
                    </li>         
                    <?php } ?>
                </ul>
            </div>
<!--             <div><a class="btn" href="<?=site_url()?>order"><span id="countChart"><?= $getCount ?></span><i class="fa fa-shopping-cart fa-2x pull-left" aria-hidden="true" style="color: red; "></i></a>

                
            </div>   -->
        </nav>
    </header> 

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
            </ol>
        </nav>        

    <main role="main" class="container" style="min-height: 190px" >



           <?php echo isset($content) ? $this->load->view($content) : ''; ?>

    </main>

<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span></span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 "></i>Laudry Kahfi
          </h6>
          <p class="text-left" >
             Melayani Jasa laundry pakaian, dengan layanan express, reguler dan disini juga tersedia jasa setrika pakaian
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p class="text-left" ><i class="fa fa-home me-3"></i> Bekasi, Rt 03 RW 25, cibitung - Bekasi 17520</p>
          <p class="text-left" ><i class="fa fa-phone me-3"></i> + 0810090000</p>
          <!-- <p><i class="fa fa-print me-3"></i> + 01 234 567 89</p> -->
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="#">Skripsi Nusa Mandiri tahun 2022</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

</body>
</html>