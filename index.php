<?php

  include("header.php");

?>

    <!-- Begin page content -->
    <main role="main"> <!-- class="container" -->

      <div><a href="index.php"><img src="images/logo/kays-originals.png" style="display: block; margin: 0 auto; height: 50%; width: 15%; margin-bottom: -5px;"></a></div>

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="first-slide" src="images/about/gallery-inside.jpg" alt="First slide" style="width: 100%;">
                  <div class="container">
                    <div class="carousel-caption text-left">
                      <h1>Kay's Originals</h1>
                      <p>Small Art Gallery</p>
                      <p><a class="btn btn-lg btn-primary" href="html/about.php" role="button">Learn More</a></p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="second-slide" src="images/events/owen-howard.jpg" alt="Second slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h2>Upcoming Event</h2>
                      <h1>Me, Myself and Eye: Owen Howard</h1>
                      <p>Drummer and composer Owen Howard in a solo concert featuring cutting-edge jazz.</p>
                      <p><a class="btn btn-lg btn-primary" href="html/events/march-4-2018-owen-howard.php" role="button">Learn more</a></p>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="third-slide" src="images/da-vinci/ultima-cena.jpg" alt="Third slide">
                  <div class="container">
                    <div class="carousel-caption text-right">
                      <h2>Artist of the Week</h2>
                      <h1>Leonardo da Vinci</h1>
                      <p>The Last Supper</p>
                      <p><a class="btn btn-lg btn-primary" href="html/artists/leonardo-da-vinci.php" role="button">Browse Artwork</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>


            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container marketing">

              <!-- Three columns of text below the carousel -->
              <div class="row">
                <div class="col-lg-4">
                  <img class="rounded-circle" src="images/about/learn-more.png" alt="Kay's Originals Logo" width="140" height="140">
                  <h2>About Us</h2>
                  <p></p>
                  <p><a class="btn btn-secondary" href="html/about.php" role="button">Welcome &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <img class="rounded-circle" src="images/events/Events.jpg" alt="Owen Howard" width="140" height="140">
                  <h2>Upcoming Events</h2>
                  <p></p>
                  <p><a class="btn btn-secondary" href="html/events.php" role="button">Learn More &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <img class="rounded-circle" src="images/artwork/artwork.jpg" alt="Leonardo da Vinci" width="140" height="140">
                  <h2>View Artwork</h2>
                  <p></p>
                  <p><a class="btn btn-secondary" href="html/artists.php" role="button">View &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
              </div><!-- /.row -->


              <!-- START THE FEATURETTES -->
<!--
              <hr class="featurette-divider">

              <div class="row featurette" id="Kay's Originals">
                <div class="col-md-7">
                  <h2 class="featurette-heading">Kay's Originals</h2>
                  <p class="lead">We're a small Art Gallery with Big Heart.</p>
                  <p><a class="btn btn-secondary" href="html/about.html" role="button">Learn More About Us &raquo;</a></p>
                </div>
                <div class="col-md-5">
                  <img class="featurette-image img-fluid mx-auto" src="images/logo/logo.png" alt="Kay's Originals Logo">
                </div>
              </div>

              <hr class="featurette-divider">

              <div class="row featurette" id="Upcoming Event">
                <div class="col-md-7 order-md-2">
                  <h2 class="featurette-heading">Me, Myself and Eye: Owen Howard</h2>
                  <p class="lead">Drummer and composer Owen Howard in a solo concert featuring cutting-edge jazz.</p>
                  <p>Mar 4, 2018 | 4:40 PM – 6:40 PM</p>
                  <p><a class="btn btn-secondary" href="html/events/march-4-2018-owen-howard.html" role="button">View Details &raquo;</a></p>
                </div>
                <div class="col-md-5 order-md-1">
                  <img class="featurette-image img-fluid mx-auto" src="images/events/owen-howard.jpg" alt="Owen Howard">
                </div>
              </div>

              <hr class="featurette-divider">

              <div class="row featurette" id="Artist of the Week">
                <div class="col-md-7">
                  <h2 class="featurette-heading">Artist of the Week:<br /> <span class="text-muted">Leonardo da Vinci</span></h2>
                  <p class="lead">He has been variously called the father of paleontology, ichnology, and architecture, and is widely considered one of the greatest painters of all time.</p>
                  <p><a class="btn btn-secondary" href="#" role="button">View Artwork &raquo;</a></p>
                </div>
                <div class="col-md-5">
                  <img class="featurette-image img-fluid mx-auto" src="images/da-vinci/leonardo-da-vinci.jpg" alt="Generic placeholder image">
                </div>
              </div>

              <hr class="featurette-divider">
-->
              <!-- /END THE FEATURETTES -->

            </div><!-- /.container -->

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">3664 Elk Creek Rd. Brightwaters, NY 11718</span>
        <span class="text-muted">-</span>
        <span class="text-muted">555-555-5555</span>
        <span class="text-muted">-</span>
        <span class="text-muted"><a target="_blank" href="mailto:kay@kaysoriginals.com">Kay@KaysOriginals.com</a></span>
        <span class="text-muted">-</span>
        <span class="text-muted"><b>Thu-Fri:</b>  1:00 pm - 4:00 pm  |  <b>Sat-Sun:</b>  12:00 pm - 3:00 pm</span>
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Kay's Originals <!-- &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> --></p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
