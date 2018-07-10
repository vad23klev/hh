<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Job Extends ORM
{
	protected $_has_one = array(
      'expert'    => array(
               'model'       => 'expert',
               'foreign_key' => 'product_id',
           )
    );

}


?>
