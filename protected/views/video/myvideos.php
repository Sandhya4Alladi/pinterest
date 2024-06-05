<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamBox</title>
    <link rel="icon" type="image/png" href="/images/play.png">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/home.css">

</head>
<?php
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        // $cs->registerScriptFile($baseUrl . '/js/yourscript.js');
        $cs->registerCssFile($baseUrl . '/css/home.css');
    ?>
<body>
  <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <button class="navbar-brand p-2 btn btn-primary" id="streambox-logo" >
      <img src="<?php echo Yii::app()->baseUrl . '/assets/images/homelogo.jpg';?>" class="img-fluid" alt="logo" width="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>STREAMBOX</b>
      </button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-3">
            <form class="form-inline" method="get" action="/videos/search" >
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" name="search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
          </li>
              <li class="nav-item mr-3">
                <form class="form-inline" method="get" action="/customs" >
                  <button style="padding-right: 10px;" class="btn btn-outline-light my-2 my-sm-0" type="submit">
                    <i style="font-size:20px" class="fa">&#xf013;</i>
                  </button>
                </form>
              </li>
            
          <!-- <li class="nav-item ml-3">
            <form class="form-inline">
              <button style="border: none; outline: none;" class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-bell"></i>
            </form>
          </li> -->
          <li class="nav-item ml-3">
            <form class="form-inline" method="get" action="/users/find">
              <button style="border: none; outline: none;" class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-user"></i>
            </form>
          </li>
          <li class="nav-item ml-3"></li>
          <form>
            <button class="btn btn-primary" type="submit" id="confirmButton"> Logout </button>
          </form>
        </li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirm Logut</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirmActionButton">Confirm</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Delete Account</h5>
        </div>
        <div class="modal-body">
          Are you sure you want to delete the video?
          <p style="color: red;"><b>Your video will be permenantly deleted</b></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirmDeleteButton">Delete</button>
        </div>
      </div>
    </div>
  </div>
<div class="main-body">
<div class="d-flex" id="wrapper">
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar-wrapper">

      <div class="list-group list-group-flush ">
        <form method="get" action="/home">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
              <i class="fas fa-home"></i> &nbsp;&nbsp;Home
          </button>
        </form>
        <div class="explore">
            <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                <i class="fas fa-compass"></i> &nbsp;&nbsp;Explore
            </button>
            <div class="explore-tags">
                  <form method="get" action="/videos/tags/product-trainings">
                      <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;Product Training
                      </button>
                  </form>
                  <form method="get" action="/videos/tags/process-trainings">
                    <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;Process Training
                    </button>
                  </form>
                  <form method="get" action="/videos/tags/hr-induction">
                      <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;HR Induction
                      </button>
                  </form>
                  <form method="get" action="/videos/tags/infosec-compliance">
                      <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;InfoSec
                      </button>
                  </form>
                  <form method="get" action="/videos/tags/soft-skills">
                    <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;Soft Skills
                    </button>
                  </form>
                  <form method="get" action="/videos/tags/webinars">
                      <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;Webinars
                      </button>
                  </form>
                  <form method="get" action="/videos/tags/events">
                    <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>&#x2022;</b>&nbsp;&nbsp;Events
                    </button>
                  </form>
            </div>
          </div>
        <form action="/videos/trend" method="get">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
              <i class="fas fa-fire"></i> &nbsp;&nbsp;Trending
          </button>
        </form>
        <form action="/videos/uploadvideo" method="get">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
            <i class="fas fa-upload"></i> &nbsp;&nbsp; Upload a Video
          </button>
        </form>
         <form method="get" action="/videos/myvideos">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
            <i class="fa fa-video-camera"></i> &nbsp;&nbsp;My videos
          </button>
        </form>
        <form method="get" action="/videos/analytics">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
            <i class="fa fa-chart-bar"></i> &nbsp;&nbsp;Analytics
          </button>
        </form>
        <form method="get" action="/videos/likedVideos">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
              <i class="fas fa-heart"></i> &nbsp;&nbsp;Liked Videos
          </button>
        </form>
        <form method="get" action="/videos/watchLater">
          <button class="list-group-item list-group-item-action" style="border: none; outline: none;">
              <i class="fas fa-clock"></i> &nbsp;&nbsp;Watch Later
          </button>
        </form>
      </div>
  </div>
</div>
<div class="main">
  <div id="videos">
  </div>
</div>
</div>
<!-- <footer>
</footer> -->
<script src="/static/js/myVideos.js"></script>
    <!-- Include inline JavaScript if needed -->
    <script>
        const allVideos = <%- JSON.stringify(data) %>;
        
        display(allVideos);
        
    </script>
    <script>
      document.getElementsByClassName('explore')[0].addEventListener('click', function(){
          const tags = document.getElementsByClassName('explore-tags')[0]
          if(tags.style.display === 'none' || tags.style.display === ''){
            tags.style.display = 'block';
          }
          else{
            tags.style.display = 'none';
          }
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/confirm.js"></script>
    <script src="../js/logo.js"></script>
</body>
</html>