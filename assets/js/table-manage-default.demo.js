/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 1.6.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.6/admin/
*/

var handleDataTableDefault = function() {
	"use strict";
    
    if ($('.data-table').length !== 0) {
        $('.data-table').DataTable({"order": [[ 4, "desc" ]],"oLanguage": {
							"sProcessing":   "Подождите...",
							"sLengthMenu":   "Показать _MENU_ записей",
							"sZeroRecords":  "Записи отсутствуют.",
							"sInfo":         "Записи с _START_ до _END_ из _TOTAL_ записей",
							"sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
							"sInfoFiltered": "(отфильтровано из _MAX_ записей)",
							"sInfoPostFix":  "",
							"sSearch":       "Поиск:",
							"sUrl":          "",
							"oPaginate": {
								"sFirst": "Первая",
								"sPrevious": "Предыдущая",
								"sNext": "Следующая",
								"sLast": "Последняя"
							}
						}});
    }
};

var TableManageDefault = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableDefault();
        }
    };
}();