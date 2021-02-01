<!-- Partiamo da questo array di hotel.
https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Avremo un file PHP con il nostro “database” e un file con tutta la logica. -->

<!-- Attraverso un parametro GET da inserire direttamente nell'url (uno alla
volta), filtrare gli hotel che hanno un parcheggio, numero minimo di
stelle o massima lontananza dal centro.
Se non c'è un filtro, visualizzare come in precedenza tutti gli hotel -->

<?php
include __DIR__ . "/database.php";

$parking = $_GET["parking"];
$vote = $_GET["vote"];
$distance = $_GET["distance"];

$filteredArray = [];

if (isset($parking)) {
  foreach ($hotels as $item) {
    if ($item["parking"] == true) {
      $filteredArray[] = $item;
    }
  }
} elseif (isset($vote)) {
  foreach ($hotels as $item) {
    if ($item["vote"] >= $vote) {
      $filteredArray[] = $item;
    }
  }
} elseif (isset($distance)) {
  foreach ($hotels as $item) {
    if ($item["distance_to_center"] <= $distance) {
      $filteredArray[] = $item;
    }
  }
} else {
  $filteredArray = $hotels;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <table class="table">

    <thead>
      <tr>
        <?php foreach ($filteredArray[0] as $key => $value) {
        ?>
          <td>
            <h4 class="text-center"><?php echo $key; ?></h4>
          </td>
        <?php } ?>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($filteredArray as $hotel) {
      ?>
        <tr>
          <?php
          foreach ($hotel as $key => $data) {
          ?>
            <td class="text-center">
              <?php if ($key == "parking") {
                if ($data == 1) {
                  echo "YES";
                } else {
                  echo "NO";
                }
              } else {
                echo $data;
              } ?>
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </tbody>
    
  </table>
</body>

</html>