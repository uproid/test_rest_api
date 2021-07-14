<?php

include_once 'models/book.php';
include_once 'db_authors.php';
include_once 'db_categories.php';

class db_books {

    private $db;

    function __construct() {
        include_once 'mydb.php';
        $this->db = new MyDB();
    }

    /**
     * 
     * @param String $title
     * @param String $isbn
     * @param int $author_id
     * @param int $category_id
     * @param String $description
     */
    function newBook($title, $isbn, $author_id, $category_id, $description) {
        $title = $this->db->sqi($title);
        $description = $this->db->sqi($description);
        $isbn = $this->db->sqi($isbn);
        $author_id = $this->db->sqi_int($author_id);
        $category_id = $this->db->sqi_int($category_id);

        $this->db->docommand("insert into "
                . "books(title,isbn,author_id,category_id,description)"
                . "values('$title','$isbn',$author_id,$category_id,N'$description')");
    }
    
    /**
     * 
     * @param int $id
     * @param String $title
     * @param String $isbn
     * @param int $author_id
     * @param int $category_id
     * @param String $description
     * @return Return the edited Book
     */
    function editBook($id,$title, $isbn, $author_id, $category_id, $description) {
        $title = $this->db->sqi($title);
        $id = $this->db->sqi_int($id);
        $description = $this->db->sqi($description);
        $isbn = $this->db->sqi($isbn);
        $author_id = $this->db->sqi_int($author_id);
        $category_id = $this->db->sqi_int($category_id);

        $this->db->docommand("UPDATE books"
                . " set title='$title',"
                . " isbn='$isbn',"
                . " author_id=$author_id,"
                . " category_id=$category_id,"
                . " description=N'$description'"
                . " where id=$id");
        return $this->getBook($id);
    }

    /**
     * Get all Books from DB
     * @return List Of books
     */
    function allBooks() {
        $result = $this->db->select("SELECT * FROM books ORDER BY id DESC");
        $books = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $db_authors = new db_authors();
            $author = $db_authors->getAuthor($row['author_id']);
            $db_categories = new db_categories();
            $category = $db_categories->getCategory($row['category_id']);
            
            $books[] = new books(
                    $row['id'], 
                    $row['title'], 
                    $row['description'], 
                    $author,
                    $category, 
                    $row['isbn']
            );
        }

        return $books;
    }
    
    /**
     * Get a book by ID
     * @param type $id
     * @return boolean|\books if Book is not founded = False
     */
    function getBook($id) {
        $id = $this->db->sqi_int($id);
        $result = $this->db->select("SELECT * FROM books where id=$id");

        if (mysqli_num_rows($result)==1) {
            $row = mysqli_fetch_assoc($result);
            $db_authors = new db_authors();
            $author = $db_authors->getAuthor($row['author_id']);
            $db_categories = new db_categories();
            $category = $db_categories->getCategory($row['category_id']);
            
            $book = new books(
                    $row['id'], 
                    $row['title'], 
                    $row['description'], 
                    $author,
                    $category, 
                    $row['isbn']
            );
            return $book;
        }

        return false;
    }

    /*
     * Delete a Book By ID
     */
    function deleteBook($id) {
        $id = $this->db->sqi_int($id);
        $this->db->docommand("delete from books where id=$id");
    }

}
