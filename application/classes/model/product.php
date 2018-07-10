<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Product Extends ORM
{
 
 	protected $_has_many = array(
      'cat2prod'    => array(
               'model'       => 'cat2prod',
               'foreign_key' => 'product_id',
           ),
		'feeds'    => array(
               'model'       => 'feed',
               'foreign_key' => 'product_id',
        )
    );

 	protected $_has_one = array(
		'owner'    => array(
               'model'       => 'useratt',
               'foreign_key' => 'user_id',
        )
    );

	
}


?>
