<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Value Extends ORM
{

	 protected $_belongs_to = array(
      'option1'    => array(
               'model'       => 'option',
               'foreign_key' => 'option_id',
           )
    );


}


?>
