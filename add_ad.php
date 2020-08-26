<?php 

// директивы

/* параметры отладки */
ini_set('display_errors','Off'); 

include ("mysql.php");
include ("list.php");
session_start();
?>

<!DOCTYPE HTML>

<html>

<!--**********************************-->
<head>

<!-- ПОДКЛЮЧЕНИЕ СТИЛЕЙ / КОНФИГУРАЦИЯ -->
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style/main.css">

<!-- Подключаем библиотеку jQuery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  

    <script>
$(function(){

    $('#mark').change(function(){
        var code = $(this).val();
        $('#model').load('list.php', {code: code}, function(){
            $('.model-select').fadeIn('slow');
        });

    });

});
    </script>   
<!-- ИМЯ САЙТА -->
<title> US4MEZ.com </title>

</head>   
<!--**********************************-->    


<!-- HEADER СТРАНИЦЫ -->
<div class="header">
	<a href="index.php"><div class="header-Left"> <img src="style/images/logo-6.png" alt=""> </div></a>
	<div class="header-Center"> ПАНЕЛЬ ДОБАВЛЕНИЯ ОБЪЯВЛЕНИЙ </div>
	<div class="header-Right"> <a href="panel.php"> <img src="style/images/login.png" alt="" /> </a> </div>
</div>


<!-- СОДЕРЖИМОЕ СТРАНИЦЫ -->
<!--**********************************--> 

<div class="add-Ad-Main"> 

    <form action="add_ad.php" form enctype="multipart/form-data" method="post">
    
    <div class="add-Ad-Main-Row"> <p>Название объявления: <br> <input type="text" name="caption" /></p>  </div>
    
    <div class="add-Ad-Main-Row"> <p>Текст объявления: <br> </p><textarea name="text" cols="40" rows="10"></textarea>  </div>
    
    <div class="add-Ad-Main-Row"> <p>Фото: <br> <input type="hidden" name="20000" value="30000" /><input name="userfile" type="file" /></p> </div>

<div class="add-Ad-Main-Row">
    <div class="add-Ad-Main-Row">
        <label for="name" class="add-Ad-Main-Row">Марка автомобиля</label>
        <div class="col-sm-6">
            <select class="form-control" name="mark" id="mark">
                <option disabled selected>Выберите марку автомобиля</option>
                <?php foreach($countries as $country): ?>
                <option value="<?=$country['id_mark']?>"><?=$country['mark_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="add-Ad-Main-Row">
        <label for="name" class="add-Ad-Main-Row">Модель автомобиля</label>
        <div class="col-sm-6">
            <select class="form-control" name="model" id="model">
            <option disabled selected>Выберите модель автомобиля</option>
            </select>
        </div>
    </div>
</div>

 <div class="add-Ad-Main-Row"> <p>Год выпуска: <br> <input type="text" name="year" /></p>  </div>
 <div class="add-Ad-Main-Row"> <p>Цена: <br> <input type="text" name="price" /></p>  </div>

<!-- <div class="chek">
      <span class="add-Ad-Main-Row">Коробка передач:</span>
     <p> <label class="container">МКПП
  <input type="checkbox" name="check[]" value="mkkp">
  <span class="checkmark"></span>
</label>

<label class="container">АКПП
  <input type="checkbox" name="check[]" value="akkp">
  <span class="checkmark"></span>
</label>
</p>
</div>
<div class="chek">
      <span class="add-Ad-Main-Row">Дополнительные функции:</span> 
      <p> <label class="container">Электроподъемники стекол
  <input type="checkbox" name="check1[]" value="mirror">
  <span class="checkmark"></span>
</label>
</p>

<p><label class="container">Литые диски
  <input type="checkbox" name="check1[]" value="rims">
  <span class="checkmark"></span>
</label>
</p>

<p><label class="container">Круиз контроль
  <input type="checkbox" name="check1[]" value="control">
  <span class="checkmark"></span>
</label>
</p>

<p><label class="container">Кожанный салон
  <input type="checkbox" name="check1[]" value="salon">
  <span class="checkmark"></span>
</label>
</p>

<p><label class="container">Громкая связь
  <input type="checkbox" name="check1[]" value="loud">
  <span class="checkmark"></span>
</label>
</p>

<p><label class="container">Парктроники
  <input type="checkbox" name="check1[]" value="parking">
  <span class="checkmark"></span>
</label>
</p>

</div> -->

 <div class="add-Ad-Main-Row"> <p>Адрес места просмотра: <br> <input type="text" name="adress" /></p>  </div>
    <!-- ВЫВОД ВЫПАДАЮЩИХ СПИСКОВ -->
    <?php
    
    $Reg_Connect = new ConnectDB();
    
    
    /* ТИП ОБЪЯВЛЕНИЯ */
    echo "<div class='add-Ad-Main-Row'> <p>Тип объявления: </br></p>";
    echo "<select name='type'>";
    
    if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM types") ) )
    	{
    		$result = $Reg_Connect->Query("SELECT * FROM types");
    		echo "<option value='0'>Выбрать</option>";
    		while( $row = mysqli_fetch_array($result) ) 
    		{
    		  echo "<option value={$row['type_id']}> {$row['type_name']} </option>";
    		}  
    	}
	
    echo "</select> </div>";
    
    
    /* КАТЕГОРИЯ ОБЪЯВЛЕНИЯ */
    echo "<div class='add-Ad-Main-Row'> <p>Категория объявления: </br></p>";
    echo "<select name='category'>";
    
    if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM categories") ) )
    	{
    		$result = $Reg_Connect->Query("SELECT * FROM categories");
    		echo "<option value='0'>Выбрать</option>";
    		while( $row = mysqli_fetch_array($result) ) 
    		{
    		  echo "<option value={$row['category_id']}> {$row['category_name']} </option>";
    		}  
    	}
	
    echo "</select> </div>";
    
/* Марка Автомобилей и Мотоциклов */
    echo "<div class='add-Ad-Main-Row'> <p>Тип двигателя: </br></p>";
    echo "<select name='engine'>";
    
    if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM engine") ) )
        {
            $result = $Reg_Connect->Query("SELECT * FROM engine");
            echo "<option value='0'>Выбрать</option>";
            while( $row = mysqli_fetch_array($result) ) 
            {

              echo "<option value={$row['ID']}> {$row['engine']} </option>";
            }  
        }
    
    echo "</select> </div>";

     echo "<div class='add-Ad-Main-Row'> <p>Тип коробки передач: </br></p>";
    echo "<select name='gear'>";
    
    if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM gear") ) )
        {
            $result = $Reg_Connect->Query("SELECT * FROM gear");
            echo "<option value='0'>Выбрать</option>";
            while( $row = mysqli_fetch_array($result) ) 
            {

              echo "<option value={$row['gear_id']}> {$row['gear']} </option>";
            }  
        }
    
    echo "</select> </div>";
    
    $Reg_Connect->Close();
    
    ?>
    <div class="add-Ad-Main-Row"> <p>Объем двигателя: <br> <input type="text" name="liters" /></p>  </div> 
    <p><input class="add-Ad-Main-Button" type="submit" name="button" value="Добавить"></p>
    </form>
    
    
    <?php
    if( isset($_POST['button']) )
    {
    	$Reg_Connect = new ConnectDB();
    	
    	$caption = $Reg_Connect->ProtectString($_POST['caption']);
    	$text =  $Reg_Connect->ProtectString($_POST['text']);
    	$type =  $Reg_Connect->ProtectString($_POST['type']);
    	$category =  $Reg_Connect->ProtectString($_POST['category']);
    	$mark = $Reg_Connect->ProtectString($_POST['mark']);
        $model = $Reg_Connect->ProtectString($_POST['model']);
        $year = $Reg_Connect->ProtectString($_POST['year']);
        $price = $Reg_Connect->ProtectString($_POST['price']);
        $adress = $Reg_Connect->ProtectString($_POST['adress']);
        $engine = $Reg_Connect->ProtectString($_POST['engine']);
        $liters = $Reg_Connect->ProtectString($_POST['liters']);
        $gear = $Reg_Connect->ProtectString($_POST['gear']);
        // получение ID пользователя
        if( mysqli_num_rows( $Reg_Connect->Query("SELECT * FROM authors WHERE author_login = '{$_SESSION['login']}' LIMIT 1") ) )
    	{
    		$result = $Reg_Connect->Query("SELECT * FROM authors WHERE author_login = '{$_SESSION['login']}' LIMIT 1");
    		
    		$author = mysqli_fetch_array($result)[0];
    	}
        
    
        if( !empty($caption) && !empty($text) && !empty($type) && !empty($category) && !empty($author) && !empty($mark) && !empty($model) && !empty($year) && 
            !empty($price) && !empty($adress) && !empty($engine) && !empty($liters) && !empty($gear) )
        {
        
            /* загрузка фото на сервер */
            if( isset($_FILES["userfile"]["name"]) )
        	{
        		/* директория загрузки изображений */
        		$directory = "style/ads_photos/";
        		/* максимальный размер изображения */
        		$max_photo_size = 10000;
        
        		$allowedExts = array("jpg", "jpeg", "gif", "png"); 
        		$extension = end( explode(".", $_FILES["userfile"]["name"]) ); 
        		
        		if ((($_FILES["userfile"]["type"] == "image/gif") 
        		    || ($_FILES["userfile"]["type"] == "image/jpeg") 
        		    || ($_FILES["userfile"]["type"] == "image/png") 
        		    || ($_FILES["userfile"]["type"] == "image/jpg")) 
        		    && ($_FILES["userfile"]["size"] < $max_photo_size * 2000* 2000) 
        		    && in_array($extension, $allowedExts)) 
        		{ 
        		    if ($_FILES["file"]["error"] > 0) 
        		    { 
        		        echo "<div class='add-Ad-Main-Info'> Не удалось прикрепить фото. </div></a>"; 
        		    } 
        		    else 
        		    { 
        	            /* создание уникального имени файла при загрузке на сервер */
        	            $photo = md5( microtime() . rand(0, 9999) ) . '.' . $extension;
        
        	            move_uploaded_file( $_FILES["userfile"]["tmp_name"], $directory . $photo ); 
        		    } 
        		} 
            	else 
            	{ 
            	    echo "<div class='add-Ad-Main-Info'> Не удалось прикрепить фото. </div></a>"; 
            	} 
        	}
                  
            /* добавление объявления */
            if( $Reg_Connect->WriteToTable("ads","ad_caption,ad_text,ad_photo,ad_type,ad_category,ad_author,mark_ad,model_ad,year_ad,price_ad,adress_ad,engine_ad,liters_ad, gear_ad", " '{$caption}', '{$text}', '{$photo}', '{$type}', '{$category}', '{$author}', '{$mark}', '{$model}', '{$year}', '{$price}', '{$adress}','{$engine}','{$liters}','{$gear}'") )
            {
                echo "<div class='add-Ad-Main-Info'> Объявление успешно добавлено. </div></a>";    
            }
            else
            {
                echo "<div class='add-Ad-Main-Info'> Не удалось добавить объявление. </div></a>";    
            }
        }
        else
        {
            echo "<div class='add-Ad-Main-Info'> Заполнены не все поля. </div></a>";      
        }
      
        $Reg_Connect->Close();
    } 
    ?>


</div>

<!--**********************************-->


<!-- FOOTER СТРАНИЦЫ -->
<div class="footer">
    <div class="footer-Center"> Powered by Oleg Shavela </div>
</div>

<!--**********************************--> 

</html>		