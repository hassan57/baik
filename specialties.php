<?php

include "inti.php";
?>
	<div id="colorlib-page">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="colorlib-navbar-brand">
							<a class="colorlib-logo" href="index.php"><i class="flaticon-cutlery"></i><span>Lu</span><span>to</span></a>
						</div>
						<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
					</div>
				</div>
			</div>
		</header>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_1.jpg);" data-stellar-background-ratio="0.5">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<div class="desc">
				   						<span class="icon"><i class="flaticon-cutlery"></i></span>
					   					<h1>Delicious Specialties</h1>
					   					<p><span><a href="index.html">Home</a></span> <span>Specialties</span></p>
					   					<div class="desc2"></div>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>

		<div class="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 text-center">
						<div class="intro animate-box">
							<span class="icon">
								<i class="icon-map4"></i>
							</span>
							<h2>Address</h2>
							<p>198 West 21th Street, Suite 721 New York NY 10016</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<div class="intro animate-box">
							<span class="icon">
								<i class="icon-clock4"></i>
							</span>
							<h2>Opening Time</h2>
							<p>Monday - Sunday</p>
							<span>8am - 9pm</span>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<div class="intro animate-box">
							<span class="icon">
								<i class="icon-mobile2"></i>
							</span>
							<h2>Phone</h2>
							<p>+ 001 234 567</p>
							<p>+ 001 234 567</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<div class="intro animate-box">
							<span class="icon">
								<i class="icon-envelope"></i>
							</span>
							<h2>Email</h2>
							<p><a href="#">info@domain.com</a><br><a href="#">luto@email.com</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center animate-box intro-heading">
						<span class="icon"><i class="flaticon-cutlery"></i></span>
						<h2>Our Delicious Specialties</h2>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
					</div>
				</div>
				<div class="row">
					 <?php 

					foreach (getspecial(12) as $row) {
						echo "<div class='col-md-4 animate-box'>";
						echo "<div class='dish-wrap'>";
						echo"<p class='price'><span>".$row['offer']."</span></p>";
							echo"<div class='addtocart'>";
								echo"<div class='dis-tc'>";
									
								echo"</div>";
							echo"</div>";
						echo "<div class='wrap'>";
						echo "<div class='dish-img' style='background-image: url(admin/uploads/" . $row['img'] . ");'></div>";
						echo " <div class='desc'>";
						echo " <h2><a href='#'>" . $row['name'] . "</a></h2>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo " </div>";
					}
					?>

				</div>
			</div>
		</div>

<?php include "includes/template/footer.php" ?>