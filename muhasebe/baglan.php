<?php
try {
	$baglan = new PDO("mysql:host=localhost;dbname=muhasebe;charset=utf8", "Sahra", "1234");
	$baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Bağlantı Hatası : " . $e->getMessage() . "<br>";
}
