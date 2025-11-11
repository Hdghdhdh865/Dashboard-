<?PHP
try {
$pdo =new pdo ("mysql:host=localhost;dbname=php blog","root","");
}
catch(Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}






?>