<?php 
function getConfig() {
	return array(
		'database' => array(
			'name' => 'visomes',
			'user' => 'root',
			'pwd'  => 'sysdba',
			'port' => 'sysdba'
		),
		'files' => array(
			'types' => array (
				['', 'noext', '', 'generic.png', 'Unknown file type'],

				'jpg' => 	['jpg', 'img', 'image/jpeg', 'image.png', 'Jpeg Image'],
				'jpeg' => 	['jpeg', 'img', 'image/jpeg', 'image.png', 'Jpeg Image'],
				'gif' => 	['gif', 'img', 'image/gif', 'image.png', 'GIF Image'],
				'png' => 	['png', 'img', 'image/png', 'image.png', 'PNG Image'],
				'jpe' => 	['jpe', 'img', 'image/jpeg', 'image.png', 'Jpeg Image'],
				'bmp' => 	['bmp', 'img', 'image/bitmap', 'image.png', 'Bitmap Image'],

				'txt' => 	['txt', 'txt', 'text/plain', 'txt.png', 'Text Document'],

				'doc' =>    ['doc', 'office', 'application/msword', 'doc.png', 'MS Word Document'],
				'wri' =>    ['wri', '', 'application/msword', 'doc.png', 'MS Word Document'],
				'xls' =>    ['xls', 'office', 'application/vnd.ms-excel', 'xls.png', 'MS Excel Document'],
				'pps' =>	['pps', 'office', 'application/vnd.ms-pps', 'presentation.png', 'MS Power Point Document'],
				'ppt' =>    ['ppt', 'office', 'application/vnd.ms-powerpoint', 'presentation.png', 'MS Power Point Document'],
				'docx' =>	['docx', 'office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'doc.png', 'MS Word Document'],
				'xlsx' =>	['xlsx', 'office', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xls.png', 'MS Excel Document'],
				'pptx' =>	['pptx', 'office', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'presentation.png', 'MS Power Point Document'],

				'pub' =>	['pub', '', 'application/x-mspublisher', 'textdoc.png', 'MS Publisher File'],

				'odp' =>  ['odp', 'ooffice', 'application/vnd.oasis.opendocument.presentation', 'presentation.png', 'OpenDocument Presentation'],
				'fodp' => ['fodp', 'ooffice', 'application/vnd.oasis.opendocument.presentation', 'presentation.png', 'OpenDocument Presentation'],
				'ods' =>  ['ods', 'ooffice', 'application/vnd.oasis.opendocument.spreadsheet', 'ssheet.png', 'OpenDocument Spreadsheet'],
				'fods' => ['fods', 'ooffice', 'application/vnd.oasis.opendocument.spreadsheet', 'ssheet.png', 'OpenDocument Spreadsheet'],
				'odt' =>  ['odt', 'ooffice', 'application/vnd.oasis.opendocument.text ', 'textdoc.png', 'OpenDocument Text'],
				'fodt' => ['fodt', 'ooffice', 'application/vnd.oasis.opendocument.text ', 'textdoc.png', 'OpenDocument Text'],
				'sxw' =>  ['sxw', 'ooffice', 'application/vnd.sun.xml.writer', 'txt.png', 'OpenOffice Text Document'],
				'sxc' =>  ['sxc', 'ooffice', 'application/vnd.sun.xml.calc', 'ssheet.png', 'OpenOffice Spreadsheet'],
				'sxi' =>  ['sxi', 'ooffice', 'application/vnd.sun.xml.impress', 'presentation.png', 'OpenOffice Presentation'],

				'pdf' =>	['pdf', '', 'application/pdf', 'pdf.png', 'Acrobat Reader Document']		
			),
			'iconfolder' => 'images/fico/',
			'homefolder' => 'users/'
		)
	);
}
?>