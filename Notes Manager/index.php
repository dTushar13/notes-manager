<!DOCTYPE html>
<head>
<Title>New Website</Title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 

<!-- <script> 
$(document).ready(function(){ 
    if (navigator.geolocation) { 
        navigator.geolocation.getCurrentPosition(showLocation); 
    } else { 
        $('#location').html('Geolocation is not supported by this browser.'); 
    } 
}); 
function showLocation(position) { 
    var latitude = position.coords.latitude; 
var longitude = position.coords.longitude;  

$.ajax({ 
type:'POST', 
url:'getLocation.php', 
data:'latitude='+latitude+'&longitude='+longitude, 
success:function(msg){ 
            if(msg){ 
               $("#location").html(msg); 
            }else{ 
                $("#location").html('Not Available'); 
            } 
}
}); 
} 
</script>  -->

</head>

<body>
    <!-- Navigation-->
    <section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Notes Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HOME<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">LOGIN</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">SIGN UP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">ABOUT US</a>
      </li>
     
    </ul>
  </div>
</nav>
    </section>
<!------SLider------>
<div id="slider">
<div id="headerSLider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#headerSLider" data-slide-to="0" class="active"></li>
    <li data-target="#headerSLider" data-slide-to="1"></li>
    <li data-target="#headerSLider" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/image1.jpg" class="d-block img-fluid" alt="...">
      <div class="carousel-caption" id="img1">
        <h5>Do You Want To Manage Your Notes Properly?</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/back2.jpg" class="d-block img-fluid" alt="...">
      <div class="carousel-caption">
        <h5>Are Your Notes Misplaced Regularly?</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/back3.jpg" class="d-block img-fluid" alt="...">
      <div class="carousel-caption">
        <h5>Join Us Now To Mange You Notes Properly.</h5>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#headerSLider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#headerSLider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
<!-----About Us------>
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>About Us</h2>
        <div class="about-content">
        Welcome to our website.Our site is used for management Of Notes.
        Using this notes manager you will bw able to properly manage 
        your lecture notes and also your teachers will be able to 
        upload their notes which can be veiwed by yourself.We have 
        created this notes manager in order to help Students as they
        face a major problem of management of their notes.
      </div>
      <button type="button" class="btn btn-primary"onclick="document.location='about.html'">Read More>></button>
      </div>
      
     </div> 

  </div>
<!-- <p>Your Location: <span id="location"></span></p> -->
</section>
<!------FOoter---->
<section id="footer">
    <div class="container">
         Copyright<i class="fa fa-copyright" aria-hidden="true"></i> 2020
    </div>
</section>

</body>
</html>
