var CHANGE_ATTACHMENT_NAME = 'Изменить название';
var SAVE_ATTACHMENT_NAME   = 'Сохранить';

/**
 * Загружаем файл договора
 *
 * @param string_id
 */
function upload_agreement(string_id)
{
    outphoto('file' + string_id,'outfile' + string_id);
    switchAgreementControls(true);
}

/**
 * @TODO: разобраться с ID-шниками файлов
 */

/**
 * Удаляем файл договора
 */
function remove_agreement()
{
    // Название
    $('#outfile477').html('');

    // Сбрасываем элемент
    var $file = $('#file477');
    $file.val('');

    // На всякий случай
    if ($file.length && 'files' in $file[0]) {
        $file[0].files.length = 0;
    }

    switchAgreementControls(false);
}

/**
 * @param flag
 */
function switchAgreementControls(flag)
{
    if (flag) {
        $('#remove_agreement_button').show();
        $('#add_agreement_button').hide();
        $('#agreement-file-icon_container').removeClass('hidden');
    } else {
        $('#remove_agreement_button').hide();
        $('#add_agreement_button').show();
        $('#agreement-file-icon_container').addClass('hidden');
    }
}

function addAttacment(fileID, fileInfoID, deleteID)
{
    outphoto(fileID, fileInfoID);
    $('#' + deleteID).show();

    var $container = $(this).parents('.oferta-file-group:first');
    var fileName = '';

    try {
        fileName = $('#' + fileID)[0].files[0].name;
    } catch (e) {

    }

    $container.find('.editable_name_value').val(fileName);

    $container.find('.btn-change_name').removeClass('hidden');
    $container.find('td.file-icon_container').removeClass('hidden');

    $('.fileinput-button', $container).addClass('hidden');

    // Добавляем кнопку загрузки, если нет следующего "файла"
    if ($container.nextAll('.oferta-file-group').length === 0) {
        addFile1();
    }
}

function addAttacmentByID(fileID, fileInfoID, deleteID, elemID)
{
    outphoto(fileID, fileInfoID);
    $('#' + deleteID).show();

    var $container = $(this).parents('.oferta-file-group:first');
    var fileName = '';

    try {
        fileName = $('#' + fileID)[0].files[0].name;
    } catch (e) {

    }
	$('#' + elemID).parent().find('.oferta-file-group .tohide').addClass('out');
    $container.find('.editable_name_value').val(fileName);

    $container.find('.btn-change_name').removeClass('hidden');
    $container.find('td.file-icon_container').removeClass('hidden');

    $('.fileinput-button', $container).addClass('hidden');

    // Добавляем кнопку загрузки, если нет следующего "файла"
    if ($container.nextAll('.oferta-file-group').length === 0) {
        addFile1(elemID);		
		//$container.nextAll('.oferta-file-group').find('input[type=submit]').removeClass('hidden');
    } 
	$('#' + elemID).parent().find('input[type=submit]').removeClass('hidden');	
	
}




/**
 * Кнопка выполняет два действия:
 * открывает на редактирование и сохраняет отредактированное имя
 */
function changeAttachmentName()
{
    var $this = $(this);
    var $container = $this.parents('.oferta-file-group:first');
    var $iText = $container.find('.editable_name_value');
    var $visibleFileNameElement = $container.find('.attachment_editable_name');

    if ($iText.is(':hidden')) {
        $visibleFileNameElement.addClass('hidden');

        $iText.removeClass('hidden');

        $this.find('span').html(SAVE_ATTACHMENT_NAME);

        $container.find('.btn-remove_attachment').addClass('hidden');
        $container.find('.btn-leave_changename').removeClass('hidden');
    } else {
        var newFileName = $iText.val();
        $visibleFileNameElement.html(newFileName).removeClass('hidden');

        $iText.addClass('hidden');

        $this.find('span').html(CHANGE_ATTACHMENT_NAME);

        $container.find('.btn-remove_attachment').removeClass('hidden');
        $container.find('.btn-leave_changename').addClass('hidden');
    }
}
//Для списка файлов
function changeAttachmentNameList()
{
    var $this = $(this);
    var $container = $this.parents('tr');
    var $iText = $container.find('.editable_name_value1');
    var $visibleFileNameElement = $container.find('.attachment_editable_name1');

    if ($iText.is(':hidden')) {
        $visibleFileNameElement.addClass('hidden');

        $iText.removeClass('hidden');

        $this.find('span').html(SAVE_ATTACHMENT_NAME);

		$container.find('.editable_name_container1 a').addClass('hidden');
        $container.find('.btn-remove_attachment1').addClass('hidden');
        $container.find('.btn-leave_changename').removeClass('hidden');
    } else {
        var newFileName = $iText.val();
        $visibleFileNameElement.html(newFileName).removeClass('hidden');
		$container.find('.editable_name_container1 a').text(newFileName);
        $iText.addClass('hidden');
		$this.find('span').html(CHANGE_ATTACHMENT_NAME);
		$container.find('.editable_name_container1 a').removeClass('hidden');
        $container.find('.btn-remove_attachment1').removeClass('hidden');
        $container.find('.btn-leave_changename').addClass('hidden');
    }
}



/**
 * Отменяем редактирование имени файла
 */
function leaveChangeAttachmentNameDialog()
{
    var $this = $(this);
    var $container = $this.parents('.oferta-file-group:first');
    var $iText = $container.find('.editable_name_value');
    var $visibleFileNameElement = $container.find('.attachment_editable_name');

    var oldFileName = $visibleFileNameElement.html();
    $iText.val(oldFileName);

    $visibleFileNameElement.removeClass('hidden');

    $iText.addClass('hidden');

    $container.find('.btn-change_name').find('span').html(CHANGE_ATTACHMENT_NAME);

    $container.find('.btn-remove_attachment').removeClass('hidden');
    $container.find('.btn-leave_changename').addClass('hidden');


}
//Для списка файлов
function leaveChangeAttachmentNameDialogList()
{
    var $this = $(this);
    var $container = $this.parents('tr');
    var $iText = $container.find('.editable_name_value1');
    var $visibleFileNameElement = $container.find('.attachment_editable_name');
		
    var oldFileName = $container.find('.editable_name_container1 a').text();
    $iText.val(oldFileName);
	$container.find('.btn-change_name').find('span').html(CHANGE_ATTACHMENT_NAME);
    $visibleFileNameElement.removeClass('hidden');

    $iText.addClass('hidden');

    $container.find('.btn-leave_changename').addClass('hidden');
	$container.find('.editable_name_container1 a').removeClass('hidden');


}


