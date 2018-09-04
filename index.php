<?php

include "inti.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$full    = $_POST['full'];
	$email	 = $_POST['email'];
	$phone   = $_POST['phon'];
	$date    = $_POST['dat'];
	$time    = $_POST['time'];
	$person  = $_POST['people'];

	$stmt = $con->prepare("INSERT INTO resrvtion(Name , Email, Phone, Date, Time,Number_Guests ) 
	                       VALUES (?, ?, ? , ? , ? ,?)");
	$stmt->execute(array($full, $email, $phone, $date, $time, $person));


}

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
                        <li style="background-image: url(images/img_bg_1.jpg);">
                            <div class="overlay"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
                                        <div class="slider-text-inner text-center">
                                            <div class="desc">
                                                <span class="icon"><i class="flaticon-cutlery"></i></span>
                                                <h1>Special &amp; Fresh Food</h1>
                                                <p>Far far away, behind the word mountains, there live the blind texts.</p>
                                                <p><a href="reservation.php" class="btn btn-primary btn-lg btn-learn">Book a table</a></p>
                                                <div class="desc2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="background-image: url(images/img_bg_2.jpg);">
                            <div class="overlay"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
                                        <div class="slider-text-inner text-center">
                                            <div class="desc">
                                                <span class="icon"><i class="flaticon-cutlery"></i></span>
                                                <h1>Exquisite Dishes From Chef</h1>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                                <p><a href="reservation.php" class="btn btn-primary btn-lg btn-learn">Book a table</a></p>
                                                <div class="desc2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="background-image: url(images/img_bg_3.jpg);">
                            <div class="overlay"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
                                        <div class="slider-text-inner text-center">
                                            <div class="desc">
                                                <span class="icon"><i class="flaticon-cutlery"></i></span>
                                                <h1>We are Delicious Restaurant</h1>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                                <p><a href="reservation.php" class="btn btn-primary btn-lg btn-learn">Book a table</a></p>
                                                <div class="desc2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="background-image: url(images/img_bg_4.jpg);">
                            <div class="overlay"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
                                        <div class="slider-text-inner text-center">
                                            <div class="desc">
                                                <span class="icon"><i class="flaticon-cutlery"></i></span>
                                                <h1>Book a table here in our site</h1>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                                <p><a href="reservation.php" class="btn btn-primary btn-lg btn-learn">Book a table</a></p>
                                                <div class="desc2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="mouse">
                        <a href="#" class="mouse-icon">
                            <div class="mouse-wheel"></div>
                        </a>
                    </div>
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

            <div class="goto-here"></div>

            <div class="colorlib-about" class="colorlib-light-grey">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="about-desc">
                                    <div class="col-md-12 col-md-offset-0 animate-box intro-heading">
                                        <span>Welcome to luto</span>
                                        <h2>Taste a delicious food here in Egypt &amp; We are inspired since 2000</h2>
                                    </div>
                                    <div class="col-md-12 animate-box">
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6 animate-box">
                                    <div class="about-img" style="background-image: url(images/about.jpg);">
                                    </div>
                                </div>
                                <div class="col-md-6 animate-box">
                                    <div class="about-img about-img-2" style="background-image: url(images/about-2.jpg);">
                                    </div>
                                </div>
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
                        foreach(getspecial(3) as $row){
                            echo"<div class='col-md-4 animate-box'>";
                              echo "<div class='dish-wrap'>";
                                echo  "<div class='wrap'>";
                                    echo  "<div class='dish-img' style='background-image: url(admin/uploads/".$row['img'].");'></div>";
                                       echo" <div class='desc'>";
                                           echo" <h2><a href='#'>".$row['name']."</a></h2>";
                                        echo "</div>";
                                   echo "</div>";
                                echo "</div>";
                           echo" </div>";
                         }
                        ?>
                    </div>
                </div>
            </div>

            <div class="colorlib-introduction" style="background-image: url(images/cover_bg_1.jpg);" data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-md-push-3">
                            <div class="intro-box animate-box">
                                <h2>
                                    <a href="#"></a>Foods you love to taste</h2>
                                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                <p><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn btn-primary btn-lg btn-outline popup-vimeo"><i class="icon-play3"></i> Watch Video</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>h
            <div class="colorlib-testimony" style="background-image: url(images/cover_bg_2.jpg);" data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center animate-box intro-heading">
                            <h2>Our Customer Says</h2>
                        </div>
                    </div>
                    <div class="row animate-box">
                        <div class="owl-carousel">
                            <div class="item">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <div class="testimony">
                                        <blockquote>
                                            <p>"A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                            <span>" &mdash; George Brooks</span>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <div class="testimony">
                                        <blockquote>
                                            <p>"Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World
                                                of Grammar.</p>
                                            <span>" &mdash; Daniel Foster</span>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <div class="testimony">
                                        <blockquote>
                                            <p>"When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove</p>
                                            <span>" &mdash; Liam Jenkins</span>
                                        </blockquote>
                                    </div>
                                </div>
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
                                        }
                                        else{
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
                                            echo"<div class='dish-img' style='background-image: url(admin/uploads/".$item['image'].");'></div>";
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

	
            <div class="colorlib-reservation reservation-img" style="background-image: url(images/cover_bg_2.jpg);" data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center animate-box intro-heading">
                            <h2>Make A Reservation</h2>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="colorlib-form">
                                        <div class="row">
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="name">Fullname</label>
                                                    <div class="form-field">
                                                        <input type="text"  name="full" required = "required" class="form-control" placeholder="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <div class="form-field">
                                                        <input type="text"name="email" required = "required" class="form-control" placeholder="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <div class="form-field">
                                                        <input type="tel" name="phon" required = "required" class="form-control" placeholder="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="date">Date:</label>
                                                    <div class="form-field">
                                                        <i class="icon "></i>
                                                        <input type="date" name="dat"  class="form-control " placeholder="Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="time">Time</label>
                                                    <div class="form-field">
                                                        <i class="icon icon-arrow-down3"></i>
                                                        <select name="time"  id="time" class="form-control">
                                                            <?php for($i=6; $i < 24; $i++)
                                                                echo "<option value='$i:00:00'>".$i.":00</option>";
                                                                ?>
                                                      </select>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 animate-box">
                                                <div class="form-group">
                                                    <label for="person">Person</label>
                                                    <div class="form-field">
                                                        <i class="icon icon-arrow-down3"></i>
                                                        <select name="people" id="people" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5+</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 animate-box">
                                                <div class="row">
                                                    <div class="col-md-4 col-md-offset-4">
                                                        <input type="submit" name="submit" id="submit" value="Book a table" class="btn btn-primary btn-block">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include "includes/template/footer.php"?>