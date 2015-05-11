<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= PATH ?>/ico/favicon.png">

    <title>Supr FRONT TEST</title>

    <!-- Bootstrap core CSS -->
    <link href="/style/front/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/style/front/css/navbar.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="/style/front/css/carousel.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    

    <?php
        $this->getBox('home/menu'); // navigation
    ?>
      
    <?php
        $this->getBox('home/carousel'); // carousel
    ?>

  
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <?php echo $content; ?>  

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/style/front/js/jquery.js"></script>
    <script src="/style/front/js/bootstrap.min.js"></script>
    <script src="/style/front/js/holder.js"></script>
  </body>
</html>
