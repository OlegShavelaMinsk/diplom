<?php
/**
 *  Функция для получения перечня производителей автомобилей
 */
function getProducers() {
	
	// Подключаемся к СУБД MySQL
	connect();
	
	// Выбираем всех производителей из таблицы
	$sql = "SELECT * FROM `marks` ORDER BY `mark`";
	
	// Выполняем запрос
	$query = mysqli_query( $sql ) or die ( mysqli_error() );
	
	// Поместим данные, которые будет возвращать функция, в массив
	// Пока что он будет пустым
	$array = array();
	
	// Инициализируем счетчик
	$i = 0;
	
	while ( $row = mysqli_fetch_assoc( $query ) ) {
		
		$array[ $i ][ 'id_mark' ] = $row[ 'id_mark' ];				// Идентификатор производителя
		$array[ $i ][ 'mark_name' ] = $row[ 'mark_name' ];	// Имя производителя
		
		// После каждой итерации цикла увеличиваем счетчик
		$i++;
		
	}
	
	// Возвращаем вызову функции массив с данными
	return $array;
	
}

// Функция, которая выбирает модели автомодилей по переданному
// ей идентификатору производителя
function getModels( array $array ) {
	
	// Сохраняем идентификатор производителя из переданного массива
	$sProducerId = htmlspecialchars( trim ( $array[ 'mark_id' ] ) );
	
	// Подключаемся к MySQL
	connect();
	
	// Строка запроса из базы данных
	$sql = "SELECT `id`, `model` FROM `models` WHERE `mark_id` = '" . $sProducerId . "' ORDER BY `model`";
	
	// Выполняем запрос
	$query = mysqli_query( $sql ) or die ( mysqli_error() );
	
	// Поместим данные, которые будет возвращать функция, в массив
	// Пока что он будет пустым
	$array = array();
	
	// Инициализируем счетчик
	$i = 0;
	
	while ( $row = mysqlo_fetch_assoc( $query ) ) {
		
		$array[ $i ][ 'id' ] = $row[ 'id' ];		// Идентификатор модели
		$array[ $i ][ 'model' ] = $row[ 'model' ];	// Наименование модели
		
		// После каждой итерации цикла увеличиваем счетчик
		$i++;
		
	}
	
	// Возвращаем вызову функции массив с данными
	return $array;
	
}
?>