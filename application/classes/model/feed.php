<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Feed Extends ORM
{
	protected $_has_one = array(
      'useratt'    => array(
               'model'       => 'useratt',
               'foreign_key' => 'user_id',
           )
    );
	protected $_has_many = array(
      'like'    => array(
               'model'       => 'like',
               'foreign_key' => 'feed_id',
           )
    );
	
}

?>
