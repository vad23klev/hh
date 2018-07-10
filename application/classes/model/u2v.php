<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_U2v Extends ORM
{
		protected $_belongs_to = array(
        'ved' => array(
            'model' => 'ved',
            'foreign_key' => 'ved_id',
            ),
		'user' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
            ),	
        );

}


?>
