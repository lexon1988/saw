<?php


if($_GET['reset']<>""){

setcookie("type","");
setcookie("cat1","");
setcookie("cat2","");
setcookie("cat3","");

header("Location:index.php");
}



if($_GET['type']<>""){

//КУКИСЫ СОРТИРОВЩИКА ***НЕ УДАЛЯТЬ***
setcookie("type",$_GET['type']);
setcookie("cat1",$_GET['cat1']);
setcookie("cat2",$_GET['cat2']);
setcookie("cat3",$_GET['cat3']);


header("Location:index.php");
	
}







include('classes/class.php');

$db=new Database();
$headerr=new Headerr();



$headerr->headerrs("SaaWok  - инструмент взаимодействия потребителя и поставщика","Портал представляет из себя инструмент, выявляющий очевидную потребность в конкретных товарах и услугах","Частные объявления, товары и услуги, инструмент для покупателя, инструмент поставщика, объявления Казахстан","utf-8");
$headerr->user_bar();


$user_id=$_COOKIE['id'];

?>


<script type="text/javascript">
  <!--
  if (screen.width <= 800) {
    window.location = "mobile/";
  }
  //-->
</script>


<?php

echo "



<div class='content Scontainer'>

<table>
	<tr>
		<td class='sorting_td' valign='top'>

		<div style='heigth:100%; width:100%;'>

			<div class='search_sidebar shadow2' id='right_block'>";

			include("tools/search_sidebar/index/index.php");
			
			
			
			echo "</div>
			";
			
			include("sow.html");
			
			echo "
		
		<div align='center'>
		<div class='light_link'><a href='http://saawok.com/terms/' title='Правила'>Правила</a> | <a href='http://saawok.com/hello/' title='Инструкция'>Инструкция</a></div></div>			
	
		</div>
		";
	
	//левый банер
	if(file_exists('banners/1.txt')){
		
		echo file_get_contents("banners/1.txt");
		
	}
	

	echo "
	
</td>

<td class='content_td' valign=top width=100%>

";

include("tools/settings/index.php");
	
echo "


";


	
	//средний банер
	if(file_exists('banners/2.txt')){
		
		echo file_get_contents("banners/2.txt");
		
	}



echo "

<div class='grid' >
	
";



include("ads.php");

echo "


</div>



</td>

";


	//левый банер
	if(file_exists('banners/3.txt')){
		
		echo file_get_contents("banners/3.txt");
		
	}


echo "
</tr>
</table>

<div id='show_more' class='show_style'>Загрузить ещё</div>

</div>

";



?>





<script>
$(document).ready(function() {


	var page=1;
	

	// Each time the user scrolls
	$(window).scroll(function() {

		if (parseInt($(window).scrollTop()) == $(document).height() - $(window).height()) {		
		
		
		
			$.ajax({
				
				type: 'POST',
				data: ({
					
					page: page
				
				
				}),
				
				url: 'page.php',
				dataType: 'html',
				success: function(html) {
				
					page=page+1;
					$('.grid').append(html);
				
				}
			});
		}
	

	});

	
	
	
$('#show_more').bind('click', function(){

	

 
	$.ajax({
				
				type: 'POST',
				data: ({
					
					page: page
				
				
				}),
				
				url: 'page.php',
				dataType: 'html',
				success: function(html) {
				
					page=page+1;
					$('.grid').append(html);
				
				}
			});
	
	
	
	
	
});




});




</script>
<div id="toTop">&nbsp; </div>
<script type="text/javascript">
    $(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function() {
            $('body,html').animate({scrollTop:0},800);

        });
    });
    /*var mainmenu=$(".main_menu_a");
    mainmenu.click(function() {
      //scrollTo($(this).attr('href'));
      $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
      }, 800);
      return false;
    });*/
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter40574985 = new Ya.Metrika({
                    id:40574985,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/40574985" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90032950-1', 'auto');
  ga('send', 'pageview');

</script>

<!— Rating@Mail.ru counter —>
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "2850706", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div style="position:absolute;left:-10000px;">
<img src="//top-fwz1.mail.ru/counter?id=2850706;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
</div></noscript>
<!— //Rating@Mail.ru counter —>

<!— Top100 (Kraken) Counter —>
<script>
    (function (w, d, c) {
    (w[c] = w[c] || []).push(function() {
        var options = {
            project: 4460789
        };
        try {
            w.top100Counter = new top100(options);
        } catch(e) { }
    });
    var n = d.getElementsByTagName("script")[0],
    s = d.createElement("script"),
    f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src =
    (d.location.protocol == "https:" ? "https:" : "http:") +
    "//st.top100.ru/top100/top100.js";

    if (w.opera == "[object Opera]") {
    d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(window, document, "_top100q");
</script>
<noscript><img src="//counter.rambler.ru/top100.cnt?pid=4460789"></noscript>
<!— END Top100 (Kraken) Counter —>

<?php
if($ads_count<12){
	
	echo "
	
		<script>
	
			$('#show_more').hide();
		
		</script>
	
	";
}

?>




<?php





$headerr->footerr();


?>
