<?php

include_once 'models/category.php';

class db_categories {

    private $db;

    function __construct() {
        include_once 'mydb.php';
        $this->db = new MyDB();
    }

    /**
     * add new Category to DB
     * @param String $title
     * @param String $description
     */
    function newCategory($title, $description) {
        $title = $this->db->sqi($title);
        $description = $this->db->sqi($description);

        $this->db->docommand("insert into "
                . "categories(title,description)"
                . "values('$title',N'$description')");
    }

    /**
     * Edit Category By ID and other informations
     * @param type $id
     * @param type $title
     * @param type $description
     */
    function editCategory($id, $title, $description) {
        $id = $this->db->sqi_int($id);
        $title = $this->db->sqi($title);
        $description = $this->db->sqi($description);

        $this->db->docommand("update categories "
                . "SET title='$title',description='$description' "
                . "WHERE id=$id");
    }

    /**
     * 
     * @return Array of Categories
     */
    function allCategories() {
        $result = $this->db->select("SELECT * FROM categories ORDER BY id");
        $categories = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = new category(
                    $row['id'], $row['title'], $row['description']
            );
        }

        return $categories;
    }

    /**
     * Delete one category by ID
     * @param type $id
     */
    function deleteCategory($id) {
        $id = $this->db->sqi_int($id);
        $this->db->docommand("delete from categories where id=$id");
    }

    /**
     * 
     * @param type $id
     * @return one Category Model
     */
    function getCategory($id) {
        $id = $this->db->sqi_int($id);
        $result = $this->db->select("select * from categories where id=$id");
        if (mysqli_num_rows($result) == 0)
            return new category();;
        $row = mysqli_fetch_assoc($result);
        return new category($row['id'], $row['title'], $row['description']);
    }

}
