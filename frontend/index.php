<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library Test API</title>
        <meta name="theme-color" content="#ff0066" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>

        <div class="container-xxl my-md-4 bd-layout">
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <!--Tabs-->
                        <div class="btn-group" role="group">
                            <input onclick="all_books()" type="radio" class="btn-check" name="btnradiotab" id="btnradio_books" autocomplete="off" checked>
                            <label class="btn btn-outline-dark" for="btnradio_books">Books</label>

                            <input onclick="all_categories()" type="radio" class="btn-check" name="btnradiotab" id="btnradio_categories" autocomplete="off">
                            <label class="btn btn-outline-dark" for="btnradio_categories">Categories</label>

                            <input onclick="all_authors()" type="radio" class="btn-check" name="btnradiotab" id="btnradio_authors" autocomplete="off">
                            <label class="btn btn-outline-dark" for="btnradio_authors">Authors</label>
                        </div>
                        <button onclick="addNewRecord()" class='material-icons btn btn-primary btn-sm'>add</button>
                    </div>
                    <!--spinner bar-->
                    <div class="col-2">
                        <div class="d-flex justify-content-center container-m ">
                            <div id="progress" class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <!--Tables for results-->
            <div><h2>List Of Books</h2></div>
            <hr/>
            <table class="table">
                <thead id="table_head">
                </thead>
                <tbody id="table_content">
                </tbody>
            </table>
        </div>

        <!--- Dialog --->
        <div class="modal fade" id="bookAlertModel" tabindex="-1" aria-labelledby="BookallertModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 0;margin: 0;">
                        <iframe style="padding: 0;margin: 0;width: 100%;height: 600px" id="iframe_book" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!------->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="js/library.js" type="text/javascript"></script>
    </body>
</html>
