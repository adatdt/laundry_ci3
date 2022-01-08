<style type="text/css">
	.tales {
	  width: 100%;
	}
	.carousel-inner{
	  min-width:1200px !important;
	  max-height: 300px !important;
	}
</style>

<div class="row" id="catalogProduct">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

		</ol>
		<div class="carousel-inner">
	    	<div class="carousel-item active">
	      		<img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider1.png" alt="First slide">
	        	<div class="carousel-caption d-none d-md-block">
	    			<h5>...</h5>
	    			<p>...</p>
	  			</div>
	    	</div>

		    <div class="carousel-item">
		      	<img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider2.jpg" alt="Second slide">
		    </div>

		    <div class="carousel-item">
		      	<img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider3.png" alt="Third slide">
		    </div>



		</div>

	  	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Previous</span>
	  	</a>

	  	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Next</span>
	  	</a>
	</div>
</div>
