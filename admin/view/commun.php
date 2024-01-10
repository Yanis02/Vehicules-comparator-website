<?php
class Commun{
    public function head($title, $description)
 {
 ?>
  <!DOCTYPE html>
  <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
            <title><?php echo $title ?></title>
            <meta name="description" content=<?php echo $description ?> />
            
            <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="styles.css">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  </head>
    <?php
}
public function footer (){
    ?>
    </html>
    <?php
}
public function displayCard($imageSrc, $cardTitle, $buttonText, $id) {
    $card = '<div class="card" style="width: 18rem;">';
    
    $cardImage = '<img class="card-img-top" src="' . $imageSrc . '" alt="Card Image">';

    $cardBody = '<div class="card-body">';

    $cardTitleElement = '<h5 class="card-title">' . $cardTitle . '</h5>';

    $button = '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailVehicule&idVehicule=' . $id . '">' . $buttonText . '</a>';

    $cardBody .= $cardTitleElement . $button;

    $card .= $cardImage . $cardBody . '</div></div>';

    // Output the card
    echo $card;
}
}
?>