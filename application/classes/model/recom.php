<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Recom Extends ORM
{
		protected $_belongs_to = array(
		'owner' => array(
            'model' => 'useratt',
            'foreign_key' => 'owner_id',
            ),	
        );
		
		protected $_has_one = array(
		'expert' => array(
            'model' => 'useratt',
            'foreign_key' => 'expert_id',
            ),	
        );		
}


?>
