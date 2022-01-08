<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
 -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url()?>assets/blockUi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script> -->

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<style type="text/css">
    .bot-pad{
        margin-bottom: 10px;
    }

#body-row {
    margin-left:0;
    margin-right:0;
}
#sidebar-container {
    min-height: 100vh;   
    background-color: #333;
    padding: 0;
}


.sidebar-expanded {
    width: 230px;
}
.sidebar-collapsed {
    width: 60px;
}


#sidebar-container .list-group a {
    height: 50px;
    color: white;
}


#sidebar-container .list-group .sidebar-submenu a {
    height: 45px;
    padding-left: 30px;
}
.sidebar-submenu {
    font-size: 0.9rem;
}


.sidebar-separator-title {
    background-color: #333;
    height: 35px;
}
.sidebar-separator {
    background-color: #333;
    height: 25px;
}
.logo-separator {
    background-color: #333;    
    height: 60px;
}


#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
  content: " \f0d7";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}

#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
  content: " \f0da";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}    

</style>
</head>
<body>

     <!-- Start Sidebar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <a class="navbar-brand" href="#">
<!--             <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="menu-collapsed">DMT</span> -->
        </a>


        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
          
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
            
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        <a href="<?=site_url() ?>home" class="dropdown-item">home</a>
                        <a href="<?=site_url() ?>category" class="dropdown-item">Kategori</a>
                        <a href="<?=site_url() ?>operator" class="dropdown-item">Operator</a>
                        <a href="<?=site_url() ?>transaction" class="dropdown-item">Transaksi</a>                    
                        <a href="<?=site_url() ?>user" class="dropdown-item">User</a>
                        <a href="<?=site_url() ?>product" class="dropdown-item">Produk</a>                              
                    </div>

                </li>
          
            </ul>
        </div>

    <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#" class="text-white"><span class="fa fa-user"></span> Profile</a></li> -->
      <li><a href="<?= site_url()?>login/logout" class="text-white"><span class="fa fa-exit"></span> Logout</a></li>
    </ul>
    </nav>


    <div class="row" id="body-row">
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>


                <div id='submenu1' class="sidebar-submenu">
                    <a href="<?=site_url() ?>home" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">home</span>
                    </a>
                    <a href="<?=site_url() ?>category" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Kategori</span>
                    </a>
                    <a href="<?=site_url() ?>operator" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Operator</span>
                    </a>
                    <a href="<?=site_url() ?>transaction" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Transaksi</span>
                    </a>                    
                    <a href="<?=site_url() ?>user" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">User</span>
                    </a>
                    <a href="<?=site_url() ?>product" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Produk</span>
                    </a>                                                                                                    
                </div>


<!--                 <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenu2' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Settings</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Password</span>
                    </a>
                </div>   -->          
               
            </ul>
        </div> <!-- End Sidebar -->

        <!-- MAIN -->
        <div class="col">
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
            </nav>        

            <div class="col-md-12">
                <?php echo isset($content) ? $this->load->view($content) : ''; ?>
            </div>

        </div>
    </div>

</body>
</html>