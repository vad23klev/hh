<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Useratt Extends ORM
{

	protected $_belongs_to = array(
      'user'  => array(
               'model'       => 'user',
               'foreign_key' => 'user_id',
          )
    );
	
	protected $_has_many = array(
      'u2cs'    => array(
               'model'       => 'u2c',
               'foreign_key' => 'user_id',
           )
    );



}


?>
