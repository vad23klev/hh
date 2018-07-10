<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Page Extends ORM
{
protected $has_many = array('SubPage','categorie');
}

?>
