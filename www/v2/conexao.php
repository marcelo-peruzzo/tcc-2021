    <?php
 
    $servername = "187.60.210.22";
    $user = "amperdev";
    $pass = "senha@DEV21";
    $database = "bdampernet";

    $conn = new mysqli($servername, $user, $pass, $database);
    mysqli_set_charset($conn,"utf8");

    if ($conn -> connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
      $auto1 = "SET @@auto_increment_increment=1;";
      mysqli_query($conn, $auto1);
    }
   
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/v2';

?>