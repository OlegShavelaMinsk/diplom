<?php 

// директивы

/* параметры отладки */
ini_set('display_errors','Off'); 

include ("mysql.php");

session_start();
?>

<!DOCTYPE HTML>

<html>

<!--**********************************-->
<head>

<!-- ПОДКЛЮЧЕНИЕ СТИЛЕЙ / КОНФИГУРАЦИЯ -->
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style/main.css">
<script src="https://api-maps.yandex.ru/2.1/?apikey=1fa9deb5-11f9-4343-9d09-2730ef247d19&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
        ymaps.ready(init);
        function init(){
            var myMap = new ymaps.Map("map", {
                center: [53.53, 27.34],
                zoom: 8
                               
            });
        }

    </script>
<!-- ИМЯ САЙТА -->
<title> US4MEZ.com </title>

</head>   
<!--**********************************-->    


<!-- СОДЕРЖИМОЕ СТРАНИЦЫ -->
<!--**********************************--> 


<!-- HEADER СТРАНИЦЫ -->
<div class="header">
	<a href="index.php"><div class="header-Left"> <img src="style/images/logo-6.png" alt=""> </div></a>
	<div class="header-Center"> ДОСКА ОБЪЯВЛЕНИЙ </div>
	<div class="header-Right"> <a href="panel.php"> <img src="style/images/login.png" alt="" /> </a> </div>
</div>
<div class="search">
     <form action="search.php" method="post">
    <input type="search" placeholder="Поиск.." name="search">
    <button type="submit">Поиск</button>
  </form>
</div>

<!-- MAIN СТРАНИЦЫ -->
<div class='ad-Page'>

    <!-- БЛОК КАТЕГОРИЙ -->
    <div class="categories">
    	<div class="categories-Caption"> КАТЕГОРИИ </div>
    
    	<?php echo "<div class='categories-Name'><a href='index.php'> Все категории </a></div>"; ?>
    	
    	<!----- загрузка категорий ----->
    	<?php
    	$Reg_Connect = new ConnectDB();
    
    	if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM categories") ) )
    	{
    		$result = $Reg_Connect->Query("SELECT * FROM categories");
    		
    		while( $row = mysqli_fetch_array($result) ) 
    		{
    		  echo "<div class='categories-Name'>";
    		  
        		  echo "<a href='index.php?category_id={$row['category_id']}'>";
        		  
            		  echo "<span class='tooltip'>";
            		  
            		  echo ( $row['category_name'] );
            
            		  echo "<em>";
            
                      /* подсказка */
            
            		  echo ( $row['category_info'] );
            		  
            		  echo "<i></i></em></span>";
            	
            	  echo "</a>";
            	
    		  echo "</div>";
    		}  
    	}
    	else
    	{
    		echo "<div class='categories-Name'> У вас нет добавленных категорий. </div>";
    	}
    
    	$Reg_Connect->Close();
    	?>
    
    </div>
<!DOCTYPE html>
<html>
<head>
	<title>Поиск: <?php echo $_POST['search']; ?></title>
</head>
<body>

<h2>Поисковой запрос: <?php echo $_POST['search']; ?></h2>

<?php

ini_set('display_errors','Off'); 

session_start();

$db = mysqli_connect("localhost", "root", "", "us4mez") or die("Нет соединения с БД");
mysqli_set_charset($db, "utf8") or die("Не установлена кодировка соединения");

$search = $_POST['search'];

$sql = "SELECT * FROM `ads` WHERE `ad_caption` LIKE '%$search%' ";

$select = mysqli_query($db, $sql);

while ($select_while = mysqli_fetch_assoc($select)) {
	?>
	<br>
	<div class="result">
	<b><a href="ad.php?ad_id=<?php echo $select_while['ad_id']; ?>"><?php echo $select_while['ad_caption']; ?></a></b>
</div>
	<?php
}

?>



</body>
</html>