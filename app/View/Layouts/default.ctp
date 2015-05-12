<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title><?php echo $title_for_layout; ?></title>

    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css('bootstrap'); ?>
    <?php echo $this->Html->css('style'); ?>
    <?php echo $this->fetch("script"); ?>

    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body> 

    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <?php echo $this->MenuBuilder->build('left-menu'); ?>
        </div>
        <div class="col-sm-8">
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch("content"); ?>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <?php echo $this->Html->script('bootstrap'); ?>
    <?php echo $this->fetch("script"); ?>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>

</html>