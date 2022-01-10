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

	body
	{
		background-color: #343a40;	
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

.card-body{
	/* box-shadow: 0px 17px 12px -5px rgba(149,184,191,0.75);
	-webkit-box-shadow: 0px 17px 12px -5px rgba(149,184,191,0.75);
	-moz-box-shadow: 0px 17px 12px -5px rgba(149,184,191,0.75); */
	background-color:#343a40;

}

</style>
</head>
<body>
  <div class="container">
	    <div class="row">
		    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
		        <div class="card card-signin my-5">
			        <div class="card-body text-white">
			            <h5 class="card-title text-center">Member Laundry</h5>
			            <form class="form-signin" id="form-login" action="<?= site_url() ?>login/actionLogin" method="post" >
				            <div class="form-label-group">
				                <label for="username">Username</label>
				                <input type="text" id="username" class="form-control" placeholder="Username" name="username"  autofocus>
				            </div>
			              	<p></p>
				            <div class="form-label-group">
				                <label for="Password">Password</label>
				                <input type="password" id="Password" class="form-control" placeholder="Password" name="password" >
				            </div>
			              	<p></p>

			              	<div class="btn btn-sm btn-danger btn-block text-uppercase" id="submit"><i class="fa fa-user-o" aria-hidden="true"></i> Masuk</div>
							  Kembali ke <a href="<?= site_url()?>home">Home</a>
			              	

			            </form>
			        </div>
		        </div>
		    </div>
	    </div>
  </div>

	<script type="text/javascript">
		function sendData(data,url)
		{

			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){

					console.log(x)
					// var html =``
					if(x.code==1)
					{
						// toastr.success(x.message,'Berhasil');
						window.location.href = "<?= site_url() ?>home";

					}
					else
					{
						toastr.error(x.message,'gagal');
					}

				}
			});		
		}

		$(document).ready(function(){

			$("#submit").on("click",function(){
				var data =$("#form-login").serialize();
	    		var url =$("#form-login").attr("action");
				sendData(data,url);
			});
		})
	</script>  
</body>