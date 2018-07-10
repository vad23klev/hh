<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Step Extends ORM
{
 	protected $_has_many = array(
      'cats'    => array(
               'model'       => 'categorie',
               'foreign_key' => 'step_id',
           )
    );
}

?>
