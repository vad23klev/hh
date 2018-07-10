<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_User Extends ORM
{
	protected $_has_one = array(
        'uatt' => array(
            'model' => 'useratt',
            'foreign_key' => 'user_id',
            ),
        );
}


?>
