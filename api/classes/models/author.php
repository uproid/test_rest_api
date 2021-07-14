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
class author {

    public $author_name = 'Unknown';
    public $description = '';
    public $id = 0;

    public function __construct($id = 0, $author_name = 'Unknown', $description = '') {
        $this->author_name = $author_name ?? "";
        $this->description = $description ?? "";
        $this->id = $id;
    }

}
