<?php

include "inti.php";

?>
	<div id="colorlib-page">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="colorlib-navbar-brand">
							<a class="colorlib-logo" href="index.php"><i class="flaticon-cutlery"></i><span>BA</span><span>IK</span></a>
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
					   					<h1>Our Menu</h1>
					   					<p><span><a href="index.php">Home</a></span> <span>Menu</span></p>
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
                    <div class="colorlib-menu-2">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center animate-box intro-heading">
                                <span class="icon"><i class="flaticon-cutlery"></i></span>
                                <h2>Lutong Bahay Menu</h2>
                                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 animate-box">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <ul class="nav nav-tabs text-center" role="tablist">
											<?php 
										foreach (getcat() as $cat) {

											echo "<li role='presentation' class='";
											if ($cat['Name'] == 'Main') {
												echo 'active';
											}
											echo "'><a href='#" . $cat['Name'] . "'aria-controls='" . $cat['Name'] . "' role='tab' data-toggle='tab'>" . $cat['Name'] . "</a></li>";

										}
										?>

							            </ul>
							       </div>
							      </div>
							<div class="tab-content">
							<?php 
									$n = countcat();
									for ($i = 1; $i <= $n; $i++) {
										echo "<div role='tabpanel' class='tab-pane";
										if ($i == '1') {
											echo ' active';
										} else {
											echo '';
										}
										echo "' id='";
										foreach (getcatby($i) as $cat) {
											echo $cat['Name'];
										};
										echo "'>";
										echo "<div class='row'>";
										echo "<div class='col-md-6'>";
										echo "<ul class='menu-dish'>";
										foreach (getitem($i, "6") as $item) {
											echo "<li>";
											echo "<figure class='dish-entry'>";
											echo "<div class='dish-img' style='background-image: url(admin/uploads/" . $item['image'] . ");'></div>";
											echo "</figure>";
											echo "<div class='text'>";
											echo "<span class='price'>" . $item['price'] . "</span>";
											echo "<h3>" . $item['Name'] . "</h3>";
											echo "<p class='cat'>" . $item['Descrbtion'] . "</p>";
											echo "</div>";
											echo "</li>";
										}
										echo "</ul>";
										echo "</div>";
										echo "<div class='col-md-6'>";
										echo "<ul class='menu-dish'>";
										foreach (getlastitem($i, "6") as $item) {
											echo "<li>";
											echo "<figure class='dish-entry'>";
											echo "<div class='dish-img' style='background-image: url(admin/uploads/" . $item['image'] . ");'></div>";
											echo "</figure>";
											echo "<div class='text'>";
											echo "<span class='price'>" . $item['price'] . "</span>";
											echo "<h3>" . $item['Name'] . "</h3>";
											echo "<p class='cat'>" . $item['Descrbtion'] . "</p>";
											echo "</div>";
											echo "</li>";
										}
										echo "</ul>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
									} ?>

                                    </div>
                                </div>
                            <div class="col-md-12 animate-box text-center">
                                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost</p>
                                <p><a href="reservation.php" class="btn btn-primary btn-outline btn-md">Book a table</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

	
       <?php include $tpl."footer.php";