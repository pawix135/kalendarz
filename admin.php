<?php require 'php/kalendarz.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://localhost/kalendarz/css/bootstrap.min.css?rand=<?= rand(); ?>">
    <link rel="stylesheet" href="http://localhost/kalendarz/css/style.css?rand=<?= rand(); ?>">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row full">
        <div class="col-sm-3 col-md-2 navMenu">
          <div class="btn-group-vertical">
            <button type="button" class="btn btn-lg btn-block mB hB">Home</button>
            <button type="button" class="btn btn-lg btn-block mB eB">Edit</button>
          </div>
        </div>
        <div class="col-sm-9 col-md-10 content">
          <div class="row">
            <div class="col-md-12">
              <div class="mainBlock">
                <div class="title">
                  <span class="bold">Kalendarz</span>
                </div>
                <div class="body" style="overflow-x:auto;">
                  <?= createCalendar($month, $year); ?>
                </div>
              </div>
              <div class="mainBlock">
                <div class="title">
                  <span>Title</span>
                </div>
                <div class="body">
                  Test
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="http://localhost/kalendarz/js/jquery.min.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost/kalendarz/js/popper.min.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost/kalendarz/js/bootstrap.min.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
    <script src="http://localhost/kalendarz/js/app.js?rand=<?= rand(); ?>" charset="utf-8"></script>
  </body>
</html>
