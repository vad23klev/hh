<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Expert Extends ORM
{

	protected $_has_one = array(
      'user'    => array(
               'model'       => 'user',
               'foreign_key' => 'user_id',
           )	   
    );

}

?>
