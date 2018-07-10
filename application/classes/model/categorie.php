<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Categorie Extends ORM
{
protected $has_many = array('categorie'=>array('model'=>'categorie','foreign_key' => 'category_id'));
protected $sorting = array('sort' => 'asc', 'id' => 'asc');

 	protected $_belongs_to = array(
      'cat'    => array(
               'model'       => 'categorie',
               'foreign_key' => 'category_id',
           )
    );

 	protected $_has_many = array(
      'news'    => array(
               'model'       => 'new',
               'foreign_key' => 'category_id',
           )
    );

	
}

?>
