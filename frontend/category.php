<?php
include_once 'rest_api.php';

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : -1; //if id=-1 then we make a new else edit an old category
$rest_api = new rest_api();

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') { // Edit or make a new Record
    $new_category = array(
        'id' => $id,
        'title' => $_REQUEST['title'],
        'description' => $_REQUEST['description'],
    );
    $res = $rest_api->getData($id > -1 ? 'edit_category' : 'new_category', $new_category);
    exit("<script>window.parent.CallFromParent('bookAlertModel','all_categories');</script>");
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') { // Delete recorde by id
    $delete_book = array(
        'id' => $id
    );
    $res = $rest_api->getData('delete_category', $delete_book);
    $id = -1;
    exit("<script>window.parent.CallFromParent('bookAlertModel','all_categories');</script>");
}

$title = "";
$description = "";

if ($id > -1) {
    $data = $rest_api->getData("get_category", array('id' => $id));
    if ($data && $data->code === 200) {
        $title = $data->data->title;
        $description = $data->data->description;
    }
}
?>
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
        <form method="post" action="category.php">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $id ?>"/>
                <div class="mb-3">
                    <label class="col-form-label">Title:</label>
                    <input name="title" type="text" value="<?= $title ?>" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Description:</label>
                    <textarea name="description" class="form-control" id="message-text"><?= $description ?></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name="action" value="save" class="btn btn-primary">Save</button>
                <?php if ($id > -1) { ?>
                    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                <?php } ?>
            </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    </body>
</html>
