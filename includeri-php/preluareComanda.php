<?php

  session_start();

  include 'dbconnection.php';

  $sql = "SELECT COUNT(idComanda) AS nrComenzi FROM comenzi WHERE statusComanda = '1';";

  if(!mysqli_query($conn, $sql))
  {
    echo 'Eroare: ' . $sql;
    echo '<br>Descriere:' . mysqli_error($conn);
    exit();
  }
  else
  {
    $rezultat  = mysqli_query($conn, $sql);
    $nrComenzi = mysqli_fetch_assoc($rezultat);

    for($i = 1; $i <= $nrComenzi; $i++)
    {
      if(isset($_POST["preluareComanda".$i]))
      {
        $idComanda = $_POST["nrBon"];

        $sql = "UPDATE comenzi SET statusComanda = '2', idAngajat = '" . $_SESSION["idPersonal"] . "' WHERE idComanda = '$idComanda';";

        if(!mysqli_query($conn, $sql))
        {
          echo 'Eroare: ' . $sql;
          echo '<br>' . mysqli_error($conn);
          exit();
        }
        else
        {
          header("Location: ../comenzi.php?comandaPreluata");
          exit();
        }
      }
    }

    header("Location: ../comenzi.php");
    exit();
  }
