<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
   require "dbfunctions.php";

     /**
  * Hakee kaikki pelit taulusta test_games
  */
 function getAllGames() {
    $pdo = connect();
    $sql = "SELECT * FROM test_games";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
} 
   /**
  * Palauttaa tietyn pelin
  */
  function getGameById($id) {
    $pdo = connect();
    $sql = "SELECT * FROM test_games WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $game = $stm->fetch(PDO::FETCH_ASSOC);
    return $game;
} 
function insertNewGame($name, $company, $release) {
    $pdo = connect();
    $sql = "INSERT INTO test_games (`name`, company, `release`) VALUES (?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $company, $release]);
    return $ok;
}

function updateGame($name, $company, $release, $id) {
    $pdo = connect();
    $sql = "UPDATE test_games SET `name`=?, company=?, `release`=? WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $company, $release, $id]);
    return $ok;
} 

/**
  * Poistaa pelin jonka gameid on $id
  */
  function deleteGame($id) {
    $pdo = connect();
    $sql = "DELETE FROM test_games WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}  

    function getGameByYear($release) {
        $pdo = connect();
        $sql = "SELECT * FROM test_games WHERE `release` = :release";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':release', $release, PDO::PARAM_INT);
        $stm->execute();
        $games = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $games;
    }
    $games = getAllGames();
    foreach ($games as $game) {
      echo $game["name"] . " " . $game["company"] . " " . $game["release"] .
           "<a href='./index.php?deletedid=" . $game["gameid"] . "'>Remove</a>" .
           "<a href='./muokkaus.php?editedid=" . $game["gameid"] . "'>muokkaa</a><br>";
    }
     
    if (isset($_GET["deletedid"])) {
      $id = $_GET["deletedid"];
      $ok = deleteGame($id); // Poistaa pelin tietokannasta
      // Ohjataan käyttäjä takaisin alkuperäiselle sivulle, jotta muutos näkyy
      header("Location: ./index.php");
      exit();
    }
     
     
     
    ?>
</ul>  
</body>
</html>