<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_P2c Extends ORM
{
	protected $_belongs_to = array(
	'cat' => array(
		'model' => 'categorie',
		'foreign_key' => 'category_id',
		)
	);

 	protected $_has_many = array(
      'product'    => array(
               'model'       => 'product',
               'foreign_key' => 'id',
           )
    );		
		

}


?>
