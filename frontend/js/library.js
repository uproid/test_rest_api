$(document).ready(function () {
    all_books();
});

function addNewRecord(){
    var tab = $(".btn-check:checked").attr('id');
    switch (tab) {
        case "btnradio_books":
            showBook(-1);
            break;
        case "btnradio_categories":
            showCategory(-1);
            break;
        case "btnradio_authors":
            showAuthor(-1);
            break;
        default:
            showBook(-1);
            break;
    }
}

function all_books() {
    api("GET_ALL_BOOKS", null, function (data) {
        var items = data.data;
        $("#table_content").html("");
        $("#table_head").html('<tr><th scope="col">#</th><th scope="col">Title</th><th scope="col">Author</th><th scope="col">Category</th><th scope="col">Description</th><th>Action</th></tr>');
        var i = 0;
        items.forEach(function (value) {
            i++;
            var category_title = value.category.title === undefined ? "" : value.category.title;
            var author_name = value.author.author_name === undefined ? "" : value.author.author_name;
            $("#table_content").append("<tr><th>" + i + "</th><td>" + value.title + "</td><td>" + author_name + "</td><td>" + category_title + "</td><td>" + value.description.substring(0, 50) + "</td><td><button onclick='showBook(" + value.id + ")' class='material-icons btn btn-primary btn-sm'>edit</button></td></tr>");
        });

    });
}

function all_categories() {
    api("GET_ALL_CATEGORIES", null, function (data) {
        var items = data.data;
        $("#table_content").html("");
        $("#table_head").html('<tr><th scope="col">#</th><th scope="col">Title</th><th scope="col">Description</th><th>Action</th></tr>');
        var i = 0;
        items.forEach(function (value) {
            i++;
            $("#table_content").append("<tr><th>" + i + "</th><td>" + value.title + "</td><td>" + value.description.substring(0, 50) + "</td><td><button onclick='showCategory(" + value.id + ")' class='material-icons btn btn-primary btn-sm'>edit</button></td></tr>");
        });

    });
}

function all_authors() {
    api("GET_ALL_AUTHORS", null, function (data) {
        var items = data.data;
        $("#table_content").html("");
        $("#table_head").html('<tr><th scope="col">#</th><th scope="col">Author Name</th><th scope="col">Description</th><th>Action</th></tr>');
        var i = 0;
        items.forEach(function (value) {
            i++;
            $("#table_content").append("<tr><th>" + i + "</th><td>" + value.author_name + "</td><td>" + value.description.substring(0, 50) + "</td><td><button onclick='showAuthor(" + value.id + ")'  class='material-icons btn btn-primary btn-sm'>edit</button></td></tr>");
        });

    });
}

function showBook(id) {
    $("#iframe_book").attr('src', "book.php?id=" + id);
    $("#bookAlertModel").modal('show');
    $("#iframe_book").height(600);
}

function showCategory(id) {
    $("#iframe_book").attr('src', "category.php?id=" + id);
    $("#bookAlertModel").modal('show');
    $("#iframe_book").height(300);
}

function showAuthor(id) {
    $("#iframe_book").attr('src', "author.php?id=" + id);
    $("#bookAlertModel").modal('show');
    $("#iframe_book").height(300);
}

function api(action, params, onload) {
    var url = "http://localhost/LibraryAPI/api/index.php?apikey=APIKEY_HASH&action=" + action;
    if (params !== null) {
        params.forEach(function (value, key, map) {
            url += "&" + key + "value";
        });
    }
    progress(true);
    $.getJSON(url, function (data) {
        onload(data);
    }).always(function () {
        progress(false);
    });
}

function progress(show) {
    if (!show)
        $("#progress").fadeOut();
    else
        $("#progress").show();
}

function CallFromParent(id, call) {
    $("#" + id).modal('hide');
    window[call]();
}





