<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Order extends ORM {
    protected $has_many = array('order_container');
}
?>
