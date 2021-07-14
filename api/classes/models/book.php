<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of books
 *
 * @author asus
 */
class books {

    public $id = 0;
    public $title = '';
    public $description = '';
    public $author = null;
    public $isbn = '000-00-00000-00-0';

    public function __construct($id = 0, $title = '', $description = '', $author = null, $category = null, $isbn = '') {
        $this->id = (int) $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->category = $category;
        $this->isbn = $isbn;
    }

}
