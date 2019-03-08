<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://localhost/kalendarz/css/bootstrap.min.css?rand=<?= rand(); ?>">
    <link rel="stylesheet" href="http://localhost/kalendarz/css/style.css?rand=<?= rand(); ?>">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.min.css?rand=<?= rand(); ?>">
		<link rel="stylesheet" href="http://localhost/kalendarz/css/jquery-ui.multidatespicker.css?rand=<?= rand(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <title>Panel</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row full">
        <div class="col-sm-12 col-md-12 content">
          <div class="row">
            <div class="col-md-12">
              <div class="mainBlock calendarBlock">
                <div class="title">
                  <span>Kalendarz</span>
                </div>
                <div class="body" style="overflow-x:auto;">
                  <div class="kalendarz">

                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit">
                Launch demo modal
              </button>
              <div class="mainBlock editBlock">
                <div class="title">
                  <span>Edycja</span>
                </div>
                <div class="body editTable" style="overflow-x: auto;">
                  <table class='table table-stripped'>
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nazwa wydarzenia</th>
                        <th>Data rozpoczęcia</th>
                        <th>Data zakończenia</th>
                        <th>Daty dodatkowe</th>
                        <th>Daty wyłączone</th>
                        <th>Funkcje</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary saveEdit">Zapisz</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          </div>
        </div>
      </div>
    </div>
    <script src="http://localhost/kalendarz/js/jquery.min.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost/kalendarz/js/popper.min.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost/kalendarz/js/bootstrap.min.js?rand=<?= rand(); ?>"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui-1.12.1/jquery-ui.min.js?rand=<?= rand(); ?>"></script>
		<script src="http://localhost/kalendarz/js/jquery-ui.multidatespicker.js?rand=<?= rand(); ?>"></script>
    <script src="http://localhost/kalendarz/js/app.js?rand=<?= rand(); ?>"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
  </body>
</html>