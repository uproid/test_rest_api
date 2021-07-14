<?php

/*
 * Library API Test
 */
include_once 'classes/db_books.php';
include_once 'classes/db_categories.php';
include_once 'classes/db_authors.php';

/**
 * Controller will managing all requests from client and gives the right answer
 *
 * @author Farhad Ziaee
 */
class Controller {

    // API key is security hash code for validate true client
    private $API_KEY = "APIKEY_HASH";
    // Version API Machin
    private $API_VERSION = "0.0.1";
    // All Request endpoints API
    private $actions = array(
        'NEW_BOOK', //  Making a record in books table
        'DELETE_BOOK', //  Delete a record from books table
        'GET_ALL_BOOKS', //  Send all records to client from books table
        'GET_BOOK', //  Send only one record to client by ID from books table
        'EDIT_BOOK', //  Edit a Recotd in books table by new informations
        'NEW_CATEGORY', //  Make a record in categories table
        'DELETE_CATEGORY', //  Delete a record from categories table
        'GET_ALL_CATEGORIES', //  Send all records from categories table
        'EDIT_CATEGORY', //  Edit a Recotd in categories table by new informations            
        'NEW_AUTHOR', //  Make a record in author table
        'DELETE_AUTHOR', //  Delete a record from author table
        'GET_ALL_AUTHORS', //  Send all records from author table
        'EDIT_AUTHOR', //  Edit a Recotd in author table by new informations  
        'GET_CATEGORY', //  Send only one record to client by ID from categories table
        'GET_AUTHOR'                //  Send only one record to client by ID from author table
    );

    /*
     * First Function that shod run in API page
     * when you receive a request from the client then you must call this to start API Controller
     */

    function execute() {
        if (!isset($_REQUEST['apikey']) || $_REQUEST['apikey'] !== $this->API_KEY)
            return $this->respons(null, "Error API KEY", 403);

        if (!isset($_REQUEST['action']) || !in_array($_REQUEST['action'], $this->actions))
            return $this->respons(null, "The request is not valid", 401);

        $action = strtolower($_REQUEST['action']);
        $this->$action();
    }

    /*
     *              ERROR CODE LISTES
     * 200	OK			The request was successfully completed.
     * 201	Created			A new resource was successfully created.
     * 400	Bad Request		The request was invalid.
     * 401	Unauthorized		The request did not include an authentication token or the authentication token was expired.
     * 403	Forbidden		The client did not have permission to access the requested resource.
     * 404	Not Found		The requested resource was not found.
     * 405	Method Not Allowed	The HTTP method in the request was not supported by the resource. For example, the DELETE method cannot be used with the Agent API.
     * 409	Conflict		The request could not be completed due to a conflict. For example,  POST ContentStore Folder API cannot complete if the given file or folder name already exists in the parent location.
     * 500	Internal Server Error	The request was not completed due to an internal error on the server side.
     * 503	Service Unavailable	The server was unavailable.
     */

    /**
     * @return array you receive an array of data and other info in the client in return
     * @param array $output is a array from the Data for the client
     * @param string $message maybe you want send a message for app client
     * @param type $code error the codes of answer status
     * 
     */
    function respons($output, $message = "", $code = 200) {
        $api_result = array(
            "version" => $this->API_VERSION,
            "method" => $_SERVER['REQUEST_METHOD'],
            "code" => $code,
            "message" => $message ? $message : "The result is Okey...",
            "timestamp" => time(),
            "data" => $output
        );

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        echo json_encode($api_result);
        exit();
    }

    /*
     * Send all records to client from books table
     */

    function get_all_books() {
        $db_books = new db_books();
        $this->respons($db_books->allBooks());
    }

    /*
     *  Making a record in books table
     */

    function new_book() {
        if (!isset($_REQUEST['title']) || $_REQUEST['title'] == '')
            return $this->respons(null, "Error: the title of the book is empty", 400);

        $db_books = new db_books();
        $db_books->newBook($_REQUEST['title'], $_REQUEST['isbn'], $_REQUEST['author_id'], $_REQUEST['category_id'], $_REQUEST['description']);
        $this->respons(null, "The book added to database.", 201);
    }

    /*
     * Edit a Recotd in books table by new informations
     */

    function edit_book() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] == '')
            return $this->respons(null, "Error: Enter your ID", 400);

        if (!isset($_REQUEST['title']) || $_REQUEST['title'] == '')
            return $this->respons(null, "Error: the title of the book is empty", 400);

        $db_books = new db_books();
        $db_books->editBook($_REQUEST['id'], $_REQUEST['title'], $_REQUEST['isbn'], $_REQUEST['author_id'], $_REQUEST['category_id'], $_REQUEST['description']);
        $this->respons(null, "The book updated in the database.", 200);
    }

    /*
     * Send only one record to client by ID from books table
     */

    function get_book() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your ID book", 400);

        $db_book = new db_books();
        $book = $db_book->getBook($_REQUEST['id']);
        if ($book)
            return $this->respons($book);
        return $this->respons(null, "the book not funded.", 404);
    }

    /*
     * Delete a record from books table
     */

    function delete_book() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your book ID", 400);

        $db_book = new db_books();
        $db_book->deleteBook($_REQUEST['id']);
        return $this->respons(null, "the book deleted...");
    }

    /*
     * Make a record in categories table
     */

    function new_category() {
        if (!isset($_REQUEST['title']) || $_REQUEST['title'] == '')
            return $this->respons(null, "Error: the title of the book is empty", 400);

        $db_categories = new db_categories();
        $db_categories->newCategory($_REQUEST['title'], $_REQUEST['description']);
        $this->respons(null, "The category added to database.", 201);
    }

    /*
     * Edit a Recotd in categories table by new informations
     */

    function edit_category() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] == '')
            return $this->respons(null, "Error: Enter your ID", 400);

        if (!isset($_REQUEST['title']) || $_REQUEST['title'] == '')
            return $this->respons(null, "Error: the title of the category is empty", 400);

        $db_categories = new db_categories();
        $db_categories->editCategory($_REQUEST['id'], $_REQUEST['title'], $_REQUEST['description']);
        $this->respons(null, "The category updated in the database.", 200);
    }

    /*
     * Delete a record from categories table
     */

    function delete_category() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your category ", 400);

        $db_categories = new db_categories();
        $db_categories->deleteCategory($_REQUEST['id']);
        return $this->respons(null, "the category deleted...");
    }

    /*
     * Send all records from categories table
     */

    function get_all_categories() {
        $db_categories = new db_categories();
        $this->respons($db_categories->allCategories());
    }

    /*
     * Send only one record to client by ID from categories table
     */

    function get_category() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your category ID", 400);
        $db_categories = new db_categories();
        $this->respons($db_categories->getCategory($_REQUEST['id']));
    }

    /*
     * Send only one record to client by ID from author table
     */

    function get_author() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your author ID", 400);
        $db_authors = new db_authors();
        $this->respons($db_authors->getAuthor($_REQUEST['id']));
    }

    /*
     * Send all records from author table
     */

    function get_all_authors() {
        $db_authors = new db_authors();
        $this->respons($db_authors->allAuthors());
    }

    /*
     * Make a record in author table
     */

    function new_author() {
        if (!isset($_REQUEST['author_name']) || $_REQUEST['author_name'] == '')
            return $this->respons(null, "Error: the author_name is empty", 400);

        $db_authors = new db_authors();
        $db_authors->newAuthor($_REQUEST['author_name'], $_REQUEST['description']);
        $this->respons(null, "The author added to database.", 201);
    }

    /*
     * Edit a Recotd in author table by new informations  
     */

    function edit_author() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] == '')
            return $this->respons(null, "Error: Enter your ID", 400);

        if (!isset($_REQUEST['author_name']) || $_REQUEST['author_name'] == '')
            return $this->respons(null, "Error: the author_name is empty", 400);

        $db_authors = new db_authors();
        $db_authors->editAuthor($_REQUEST['id'], $_REQUEST['author_name'], $_REQUEST['description']);
        $this->respons(null, "The author updated in the database.", 200);
    }

    /*
     * Delete a record from author table
     */

    function delete_author() {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '')
            return $this->respons(null, "Please enter your ID author", 400);

        $db_authors = new db_authors();
        $db_authors->deleteAuthor($_REQUEST['id']);
        return $this->respons(null, "the author deleted...", 200);
    }

}
