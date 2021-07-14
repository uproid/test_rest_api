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
class category {

    public $title = 'Unknown';
    public $description = '';
    public $id = 0;

    public function __construct($id = 0, $title = 'Unknown', $description = '') {
        $this->title = $title ?? "";
        $this->description = $description ?? "";
        $this->id = $id;
    }

}
