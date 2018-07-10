<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Article Extends ORM
{

 	protected $_belongs_to = array(
      'cat'    => array(
               'model'       => 'categorie',
               'foreign_key' => 'category_id',
           )
    );

}

?>
