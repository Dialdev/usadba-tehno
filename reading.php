
<?
	$html = implode('', file('site.kml'));
	//$text = htmlspecialchars(iconv('windows-1251', 'utf-8', $html));
	$text = htmlspecialchars(iconv('windows-1251', 'utf-8', stristr($html, '<kml')));;

	var_dump($text);


?>


