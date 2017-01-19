<?php



include('classes/class.php');

$db=new Database();



$ads= $db->db_select("ads","WHERE status=2 order by id desc");





$fp = fopen("sitemap.xml", "w"); // Открываем файл в режиме записи 

$mytext = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset>"; // Исходная строка

$test = fwrite($fp, $mytext); // Запись в файл

fclose($fp); //Закрытие файла







for($i=0;$i<1000;$i++){

	

	if($ads[$i]['id']<>"")  {

		

		

		$fp = fopen("sitemap.xml", "a"); // Открываем файл в режиме записи 

		$mytext = "
<loc>http://saawok.com/ob.php?id=".$ads[$i]['id']."</loc>
<changefreq>always</changefreq>
"; // Исходная строка

		$test = fwrite($fp, $mytext); // Запись в файл

		fclose($fp); //Закрытие файла

		



	

	

	}

	

}









$fp = fopen("sitemap.xml", "a"); // Открываем файл в режиме записи 

$mytext = "</urlset>"; // Исходная строка

$test = fwrite($fp, $mytext); // Запись в файл

fclose($fp); //Закрытие файла









?>
