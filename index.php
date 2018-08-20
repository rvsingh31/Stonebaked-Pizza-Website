
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Restaurant</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap_theme.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	<link href="css/jquery-loading.css" rel="stylesheet">
	<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>    
<style>
.nav-tabs { border-bottom: 2px solid #DDD; }
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
	.nav-tabs > li > a { border: none; color: #666; }
			.nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
			.nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
	.nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

	.navbar-brand {
  background: url(images/logo.jpg) center / contain no-repeat;
  width: 200px;
}

</style>
</head>

<body>
<!-- preloader section -->
<section class="preloader a">

</section>

<div>
<!-- navigation section -->
<section class="navbar navbar-default navbar-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand"></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#home" class="smoothScroll">HOME</a></li>
				<li><a href="#gallery" class="smoothScroll">FOOD GALLERY</a></li>
				<li><a href="#menu" class="smoothScroll">MENU</a></li>
				<li><a href="#team" class="smoothScroll">LOGIN/REGISTER</a></li>
				<li><a href="#contact" class="smoothScroll">CONTACT</a></li>
			</ul>
		</div>
	</div>
</section>


<!-- home section -->
<section id="home" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>STONEBAKED</h1>
				<h2>LIVE PIZZA</h2>

			<!--	<h2>CLEAN &amp; SIMPLE DESIGN</h2>    -->
				<a href="#gallery" class="smoothScroll btn btn-default">LEARN MORE</a>
			</div>
		</div>
	</div>
</section>


<!-- gallery section -->
<section id="gallery" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
				<h1 class="heading">Food Gallery</h1>
				<hr>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.3s">
				<a href="images/gallery-img1.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/item1.jpg" alt="gallery img"></a>
				<div>
					<h3>Lemon-Rosemary Prawn</h3>
					<span>Seafood / Shrimp / Lemon</span>
				</div>
				<a href="images/gallery-img2.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/item3.jpg" alt="gallery img"></a>
				<div>
					<h3>Lemon-Rosemary Vegetables</h3>
					<span>Tomato / Rosemary / Lemon</span>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<a href="images/gallery-img3.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/item2.jpg" alt="gallery img"></a>
				<div>
					<h3>Lemon-Rosemary Bakery</h3>
					<span>Bread / Rosemary / Orange</span>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.9s">
				<a href="images/gallery-img4.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img4.jpg" alt="gallery img"></a>
				<div>
					<h3>Lemon-Rosemary Salad</h3>
					<span>Chicken / Rosemary / Green</span>
				</div>
				<a href="images/gallery-img5.jpg" data-lightbox-gallery="zenda-gallery"><img src="images/gallery-img5.jpg" alt="gallery img"></a>
				<div>
					<h3>Lemon-Rosemary Pizza</h3>
					<span>Pasta / Rosemary / Green</span>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- menu section -->
<section id="menu" class="parallax-section">
	<div class="container">
		<div class="row" >
			<div class="col-md-offset-2 col-md-8 col-sm-12 text-center">
				<h1 class="heading">Menu</h1>
				<hr>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Veg. Classic Pizza - <span>&#8377; 120</span></h4>
				<h5>Onion,Capsicum,Tomato</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Tandoori Paneer Pizza - <span>&#8377; 170</span></h4>
				<h5>Paneer,Onion,Capsicum,Tomato,Tandoori,Mayo</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Margarita Pizza - <span>&#8377; 200</span></h4>
				<h5>Plain Cheese</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Hawaiin Pizza - <span>&#8377; 240</span></h4>
				<h5>Black Olive,Jalapeno,Red Paprika</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Special Stonebaked Pizza - <span>&#8377; 260</span></h4>
				<h5>Black Olive,Jalapeno,Red Paprika,Onion,Capsicum,Tomato,Corn,Paneer</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Burger Pizza - <span>&#8377; 100</span></h4>
				<h5></h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Burger Pizza with Tandoori Mayo - <span>&#8377; 120</span></h4>
				<h5></h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Magic Duo Pizza - <span>&#8377; 240</span></h4>
				<h5>Pineapple,Corn</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Country Feast Pizza - <span>&#8377; 260</span></h4>
				<h5>Baby Corn,Red Paprika,Capsicum,Paneer,Onion,Tomato</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Cheese Garlic Bread - <span>&#8377; 100</span></h4>
				<h5>(5 pcs.)</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Tandoori Garlic Bread - <span>&#8377; 120</span></h4>
				<h5>(5 pcs.)</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Special Stonebaked Garlic Bread - <span>&#8377; 140</span></h4>
				<h5>(5 pcs.)</h5>
			</div>
			<div class="col-md-6 col-sm-6">
				<h4>Bruschetta - <span>&#8377; 120</span></h4>
				<h5>(5 pcs.)</h5>
			</div>
			
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<a href="#!" style="text-decoration:none;text-align:center"><h4> Download Menu </h4></a>
			</div>
		</div>
	</div>
</section>


<!-- team section -->
<section id="team" class="parallax-section">
	<div class="container">
		
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12">
				<h1 class="heading">Testimonials</h1>
				<hr>
			</div>
			
		</div>
	
	
		<div class="row fadeInUp"  data-wow-delay="0.3s">
		
			
			  <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        
          <!-- Quote 1 -->
          <div class="item active">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="images/ravinder.jpg" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>Though being the developer of this site, I personally dined at this place and found myself pleased by the pizza offered here. The thin crust makes it more lovely and tasty.</p>
                  <small>Ravinder Singh</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 2 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/mijustin/128.jpg" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor nec lacus ut tempor. Mauris.</p>
                  <small>Someone famous</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 3 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/keizgoesboom/128.jpg" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum elit in arcu blandit, eget pretium nisl accumsan. Sed ultricies commodo tortor, eu pretium mauris.</p>
                  <small>Someone famous</small>
                </div>
              </div>
            </blockquote>
          </div>
        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>
		</div>
		
		</div>




	<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12">
				<h1 class="heading">Create An Account</h1>
				<hr>
			</div>
			<div class="col-md-6 col-sm-6 wow fadeInUp"  data-wow-delay="0.3s">
				<h4>Things to Know before Creating Account</h5>
				<ul style="text-align:left">
					<li><p>After Creating account , you are required to enter your address details (It's a one-time process.)<p></li>
					<li><p>You can keep a track of all your Orders .</p></li>
					<li><p>You will be allocated CREDITS on every purchase and once the credits cross 100,you can use them while paying where 1 credit=&#8377; 1.</p></li>
					<li><p>You can even provide your feedbacks and suggest your own dish for the respective sections.</p></li>
					<li><p>If the order is below &#8377; 300, then delivery charge of &#8377; 20 will be charged, else it will be a free home-delivery.</p></li>
					<li><p>Home-delivery is possible only within 5kms radius of IIM-A area.</p></li>
					<li><p>You can order only in open-hours that is 6pm to 11pm.</p></li>
					<li><p>For any kind of help,you can contact 0900800760</p></li>
				</ul>
				

			</div>
			<div class="col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
				<div>
					<ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab"><h5>Login</h5></a></li>
                <li role="presentation"><a href="#register" aria-controls="profile" role="tab" data-toggle="tab"><h5>Register</h5></a></li>
        </ul>

                                    <!-- Tab panes -->
        <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="login">
					<form method="post" action="login.php" id="login_form">
							<div class="form-group">
								<input type="text" name="username" placeholder="Username." class="form-control" id="username" >
							</div>
							<div class="form-group">
								<input type="password" name="password" placeholder="Password." class="form-control" id="password" >
							</div>
					
			<!--	<div id="RecaptchaField1"></div>   
				
				-->
				<br>
				
					<button class="right btn btn-primary " onclick="log_check()" type="button" id="l_btn">Login</button>
				<br>
				<br>
				<a href="recover.php">Forgot Password?</a>
					</form>
					
				</div>
              <div role="tabpanel" class="tab-pane" id="register">
					<form method="post" action="register.php" id="reg_form">
						<div class="form-group">
							<input type="text" name="r_firstname" class="form-control" id="r_firstname" placeholder="Firstname ">
						</div>
						<div class="form-group">
							<input type="text" name="r_lastname" class="form-control" id="r_lastname" placeholder="Lastname ">
						</div>
						<div class="form-group">
							<input type="text" name="r_username" class="form-control" id="r_username" onblur="check_u(this.value)" placeholder="Username ">
						</div>
						<div class="form-group">
							<input type="password" name="r_password" class="form-control" id="r_password" placeholder="Password ">
						</div>
						<div class="form-group">
							<input type="password" name="r_repassword" class="form-control" id="r_repassword" placeholder="Password (Same as Above)">
						</div>
						<div class="form-group">
							<input type="text" name="r_email" class="form-control" id="r_email" placeholder="Email Address">
						</div>
					
						<p style="text-align:left">Enter an active email address,as the order updates will be sent on the registered mail.</p>
						
							<div id="RecaptchaField2"></div>  
						<br>
						
						<button type="button" onclick="reg_check()" class="btn btn-primary">Register</button>
					</form>
				</div>
        </div>
				</div>
			</div>
		</div>
		
		<br>
		
</section>


<!-- contact section -->
<section id="contact" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 col-sm-12 text-center">
				<h1 class="heading">Contact Us</h1>
				<hr>
			</div>
			<div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
				<form action="https://formspree.io/ravindersingh3104.rs@gmail.com" method="post">
					<div class="col-md-6 col-sm-6">
						<input name="name" type="text" class="form-control" id="name" placeholder="Name">
				  </div>
					<div class="col-md-6 col-sm-6">
						<input name="email" type="email" class="form-control" id="email" placeholder="Email">
				  </div>
					<div class="col-md-12 col-sm-12">
						<textarea name="message" rows="8" class="form-control" id="message" placeholder="Message"></textarea>
					</div>
					<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
						<input name="submit" type="submit" class="form-control" id="submit" value="Send">
					</div>
				</form>
			</div>
			<div class="col-md-2 col-sm-1"></div>
		</div>
	</div>
</section>


<!-- footer section -->
<footer class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Contact Info.</h2>
				<div class="ph">
					<p><i class="fa fa-phone"></i> Phone</p>
					<h4>090-080-0760</h4>
				</div>
				<div class="address">
					<p><i class="fa fa-map-marker"></i> Our Location</p>
					<h4>IIM Road,Ahmedabad,Gujarat.</h4>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Open Hours</h2>
					<p>Sunday <span>06:00 PM - 11:00 PM</span></p>
					<p>Mon-Fri <span>06:00 PM - 11:00 PM</span></p>
					<p>Saturday <span>06:00 PM - 11:00 PM</span></p>
			</div>
			<div class="col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
				<h2 class="heading">Follow Us</h2>
				<ul class="social-icon">
					<li><a href="https://www.facebook.com/Stonebaked-pizza-215489562219878/?fref=ts" class="fa fa-facebook wow bounceIn" data-wow-delay="0.3s"></a></li>
					<li><a href="#" class="fa fa-instagram wow bounceIn" data-wow-delay="0.6s"></a></li>
					<li><a href="https://www.youtube.com/watch?v=8impgpB2OsI" class="fa fa-youtube wow bounceIn" data-wow-delay="0.9s"></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>


<!-- copyright section -->
<section id="copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h3>STONEBAKED LIVE PIZZA</h3>
				<br>
				<p>&copy; All Rights Reserved.<span style="color:yellow;">2016</span>

                |  Developed by : <a rel="nofollow" href="http://rvsingh31.github.io" target="_parent">Ravinder Singh</a></p>
			</div>
		</div>
	</div>
</section>
</div>
<!-- JAVASCRIPT JS FILES -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery-loading.js"></script>
<script src="js/jquery.toaster.js"></script>

<script>
$(document).ready(function() {
  $('#quote-carousel').carousel({
    pause: true,
    interval: 6000,
  });
});


	$(document).ready(function(){
			$('.a').loading({ overlay: true,base: 0.6 });

		setTimeout(function(){
		$('.a').loading('hide');
		$('.b').fadeIn();
		},30000);

	});
</script>
<script type="text/javascript">
    var CaptchaCallback = function() {
        grecaptcha.render('RecaptchaField1', {'sitekey' : '6LdQ1g8UAAAAAFOdY2VbgI7WQCfMJzN6h2A7iPgV'});
        grecaptcha.render('RecaptchaField2', {'sitekey' : '6LdQ1g8UAAAAAFOdY2VbgI7WQCfMJzN6h2A7iPgV'});
    };
</script>

<script>
var error="";
	function reg_check()
	{
		var fn=document.getElementById("r_firstname").value;
		var ln=document.getElementById("r_lastname").value;
		var un=document.getElementById("r_username").value;
		var pd=document.getElementById("r_password").value;
		var repd=document.getElementById("r_repassword").value;
		var email=document.getElementById("r_email").value;
		
		if(fn=='' || ln=='' || un=='' || pd=='' || repd=='' || email=='')
		{
				$.toaster({ priority : 'danger', title : 'Warning', message : 'All Fields are required'});
		}
		else if(error=="false")
		{
				$.toaster({ priority : 'danger', title : 'Warning', message : 'Username already exists!'});		
		}
		else if(pd!=repd)
		{
				$.toaster({ priority : 'danger', title : 'Warning', message : 'Both Passwords doesn\'t match '});
		}
		else if(validateEmail(email)!==true)
		{
			$.toaster({ priority : 'danger', title : 'Warning', message : 'Eamil is invalid'});
		}
		else{
			document.getElementById("reg_form").submit();
		}
	}
	
	
		function validateEmail(email) 
		{
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}
		
	function check_u(str)
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
	       if (this.readyState == 4 && this.status == 200) {
			if($.trim(this.responseText)=="error")
			 {
					error="false";
							$.toaster({ priority : 'danger', title : 'Warning', message : 'Username already exists!'});				
			 }
			 else
			 {
				 error="true";
			 }
            }
        };
        xmlhttp.open("GET", "/checkusername.php?q=" + str, true);
        xmlhttp.send();
    
	}
	
	function log_check(){
		var u=document.getElementById("username").value;
		var p=document.getElementById("password").value;
		if(u=='' || p=='')
		{
							$.toaster({ priority : 'danger', title : 'Warning', message : 'All fields are required!'});				
		}
		else
		{
			document.getElementById("login_form").submit();
		}
	}
</script>

	<?php
	if(isset($_GET["msg"]))
	{
		if($_GET["msg"]!==null)
		{
				$data = trim($_GET["msg"]);
				$type=trim($_GET["type"]);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
	?>
			<script>
				var result="<?php echo $data; ?>";
				var type="<?php echo $type;?>";
				$(document).ready(function(){
					setTimeout(function(){
						if(type=="1")
						{
							$.toaster({ priority : 'success', title : 'Success', message : result});
						}
						else
						{
									$.toaster({ priority : 'danger', title : 'Failure', message : result});
						}
					},2000);
						
				});
			</script>
	<?php
		}
	}
	?>
	
	
	
</body>
</html>
