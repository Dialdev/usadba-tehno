<?
//��������� ���������� Bitrix
define("NO_KEEP_STATISTIC", true);
//���������� ������
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//������������� ��� ������ ��� xml ��������
header('Content-Type: application/xml; charset=utf-8');


$array_pages = array();

//������� ��������� ��������: ������
$array_pages[] = array(
   	'NAME' => '������� ��������',
   	'URL' => '/',
);
$array_pages[] = array(
   	'NAME' => '�������',
   	'URL' => '/catalog/',
);
$array_pages[] = array(
   	'NAME' => '���� ��������',
   	'URL' => '/shops/',
);
$array_pages[] = array(
	'NAME' => '�����',
   	'URL' => '/catalog/sale/',
);
$array_pages[] = array(
   	'NAME' => '� ��������',
   	'URL' => '/about/',
);
$array_pages[] = array(
   	'NAME' => '�������',
   	'URL' => '/news/',
);
$array_pages[] = array(
   	'NAME' => '������',
   	'URL' => '/articles/',
);
$array_pages[] = array(
	'NAME' => '�������������',
   	'URL' => '/brands/',
);
$array_pages[] = array(
   	'NAME' => '��� ������� �����',
   	'URL' => '/make-order/',
);
$array_pages[] = array(
   	'NAME' => '��������',
   	'URL' => '/delivery/',
);
$array_pages[] = array(
   	'NAME' => '������� ������',
   	'URL' => '/payments/',
);
$array_pages[] = array(
   	'NAME' => '��������� �����',
   	'URL' => '/service-center/',
);
//������� ��������� ��������: �����


$array_iblocks_id = array('6', '7', '1', '12', '8'); //ID ����������, ������� � �������� ������� ������� � ����� �����
if(CModule::IncludeModule("iblock"))
{
	foreach($array_iblocks_id as $iblock_id)
	{
		//������ ��������
   		$res = CIBlockSection::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE" => "Y"
	      	),
      		false,
    		array(
    		"ID",
    		"NAME",
    		"SECTION_PAGE_URL",
    		"TIMESTAMP_X"
    	));
   		while($ob = $res->GetNext())
   		{
			$array_pages_iblock[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $ob['SECTION_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X']
			);
   		}
		//������ ���������
   		$res = CIBlockElement::GetList(
	      	array(),
	      	Array(
	         	"IBLOCK_ID" => $iblock_id,
	         	"ACTIVE_DATE" => "Y",
	         	"ACTIVE" => "Y"
	      	),
      		false,
      		false,
    		array(
    		"ID",
    		"NAME",
    		"DETAIL_PAGE_URL",
    		"TIMESTAMP_X"
    	));
   		while($ob = $res->GetNext())
   		{
			$array_pages_iblock[] = array(
			   	'NAME' => $ob['NAME'],
			   	'URL' => $ob['DETAIL_PAGE_URL'],
			   	'LASTMOD' => $ob['TIMESTAMP_X']
			);
   		}
	}
}

//������ XML ��������: ������
//echo '<pre>'; print_r($array_pages); echo '</pre>';
$xml_content = '';
$xml_content_iblock = '';
$dateformat = 'Y-m-d';
$site_url = 'https://'.$_SERVER['HTTP_HOST'];
$quantity_elements = 0;
foreach($array_pages as $v){
	$quantity_elements++;
	if ($quantity_elements == 1){
		$priority = 1;
	} else {
		$priority = 0.8;
	}
	$page_url = mb_substr( $v['URL']."index.php", 1);
	$lastmod = date($dateformat, filemtime($page_url));
	$xml_content.='
		<url>
			<loc>'.$site_url.$v['URL'].'</loc>
			<lastmod>'.$lastmod.'</lastmod>
			<priority>'.$priority.'</priority>
		</url>
	';
}
foreach($array_pages_iblock as $v){
	$quantity_elements++;
	$priority = 0.6;
	$lastmod = date($dateformat, MakeTimeStamp($v['LASTMOD'], "DD.MM.YYYY"));
	$xml_content_iblock.='
		<url>
			<loc>'.$site_url.$v['URL'].'</loc>
			<lastmod>'.$lastmod.'</lastmod>
			<priority>'.$priority.'</priority>
		</url>
	';
}
$quantity_elements = 0;


//������ XML ��������: �����

// reading from site.kml
$html = implode('', file('site.kml'));
$text = htmlspecialchars(iconv('windows-1251', 'utf-8', stristr($html, '<kml')));;


//������� ��������
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
	'.$text.''.$xml_content.''.$xml_content_iblock.'
</urlset>
';
?>