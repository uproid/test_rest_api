<?php

include_once 'models/author.php';

class db_authors {

    private $db;

    function __construct() {
        include_once 'mydb.php';
        $this->db = new MyDB();
    }

    /**
     * Add new Author to table
     * @param String $name
     * @param String $description
     */
    function newAuthor($name, $description) {
        $name = $this->db->sqi($name);
        $description = $this->db->sqi($description);

        $this->db->docommand("insert into "
                . " authors(author_name,description)"
                . " values('$name',N'$description')");
    }

    /**
     * edit an Author by id and other informations
     * @param int $id
     * @param String $name
     * @param String $description
     */
    function editAuthor($id, $name, $description) {
        $id = $this->db->sqi_int($id);
        $name = $this->db->sqi($name);
        $description = $this->db->sqi($description);

        $this->db->docommand("update authors "
                . " SET author_name='$name',description='$description' "
                . " WHERE id=$id");
    }

    /**
     * Get a list of authors
     * @return \author
     */
    function allAuthors() {
        $result = $this->db->select("SELECT * FROM authors ORDER BY author_name");
        $authors = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $authors[] = new author(
                    $row['id'], $row['author_name'], $row['description']
            );
        }

        return $authors;
    }

    /**
     * delete an author by id
     * @param int $id
     */
    function deleteAuthor($id) {
        $id = $this->db->sqi_int($id);
        $this->db->docommand("delete from authors where id=$id");
    }

    /**
     * get a author by id
     * @param type $id
     * @return \author
     */
    function getAuthor($id) {
        $id = $this->db->sqi_int($id);
        $result = $this->db->select("select * from authors where id=$id");
        if (mysqli_num_rows($result) == 0)
            return new author();
        $row = mysqli_fetch_assoc($result);
        return new author($row['id'], $row['author_name'], $row['description']);
    }

}
