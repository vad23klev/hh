<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-07-10 14:12:57 --- ERROR: ErrorException [ 1 ]: Uncaught TypeError: Argument 1 passed to Kohana_Kohana_Exception::handler() must be an instance of Exception, instance of Error given in C:\xampp\htdocs\html\system\classes\kohana\kohana\exception.php:88
Stack trace:
#0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main}
  thrown ~ SYSPATH\classes\kohana\kohana\exception.php [ 88 ]
2018-07-10 14:12:57 --- STRACE: ErrorException [ 1 ]: Uncaught TypeError: Argument 1 passed to Kohana_Kohana_Exception::handler() must be an instance of Exception, instance of Error given in C:\xampp\htdocs\html\system\classes\kohana\kohana\exception.php:88
Stack trace:
#0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main}
  thrown ~ SYSPATH\classes\kohana\kohana\exception.php [ 88 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-07-10 14:52:46 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 14:52:46 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:15:28 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:15:28 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:16:16 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:16:16 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:16:17 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:16:17 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:16:19 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:16:19 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:16:21 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:16:21 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:16:36 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:16:36 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:19:15 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:19:15 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:19:19 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:19:19 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:20:59 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:20:59 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 15:59:04 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 15:59:04 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:00:29 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 16:00:29 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:00:30 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 16:00:30 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:00:31 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 16:00:31 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:04:00 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 16:04:00 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:11:05 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2018-07-10 16:11:05 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(360): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}
2018-07-10 16:15:23 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 109 ]
2018-07-10 16:15:23 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 109 ]
--
#0 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db('infokwfm_faq')
#1 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(172): Kohana_Database_MySQL->connect()
#2 C:\xampp2\htdocs\html\modules\database\classes\kohana\database\mysql.php(361): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(1504): Kohana_Database_MySQL->list_columns('categories')
#4 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(392): Kohana_ORM->list_columns(true)
#5 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(337): Kohana_ORM->reload_columns()
#6 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(246): Kohana_ORM->_initialize()
#7 C:\xampp2\htdocs\html\modules\orm\classes\kohana\orm.php(37): Kohana_ORM->__construct(NULL)
#8 C:\xampp2\htdocs\html\application\classes\controller\common.php(33): Kohana_ORM::factory('categorie')
#9 [internal function]: Controller_Common->before()
#10 C:\xampp2\htdocs\html\system\classes\kohana\request\client\internal.php(103): ReflectionMethod->invoke(Object(Controller_Catalog))
#11 C:\xampp2\htdocs\html\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#12 C:\xampp2\htdocs\html\system\classes\kohana\request.php(1138): Kohana_Request_Client->execute(Object(Request))
#13 C:\xampp2\htdocs\html\index.php(112): Kohana_Request->execute()
#14 {main}