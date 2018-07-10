<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Ved Extends ORM
{
	
	protected $_has_many = array(
      'ved'    => array(
               'model'       => 'ved',
               'foreign_key' => 'ved_id',
           )
    );
	
}

?>
