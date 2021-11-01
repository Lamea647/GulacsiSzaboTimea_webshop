<?php
            $target_dir = "uploads/"; 
            if(filter_input(INPUT_POST,"feltoltes",FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
                  $name = $_FILES["kep"]["name"];
                  $tmp_name = $_FILES["kep"]["tmp_name"];
                  move_uploaded_file($tmp_name, "$target_dir/$name");
            }
?>

<?php
$hiba = false;
if(filter_input(INPUT_POST, "feltoltes", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
    $nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_STRING);
    $leiras = filter_input(INPUT_POST, "leiras", FILTER_SANITIZE_STRING);
    $ar= filter_input(INPUT_POST, "ar", FILTER_VALIDATE_INT);
    if($ar < 0){
          $hiba = true;
          $hibauzenet = 'Az ár nem lehet negatív szám!';
    }
    $kep = $_FILES["kep"]["name"];
    //filter_input(INPUT_POST, "kep", FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO `termek` (`nev`, `leiras`, `ar`, `kep`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nev, $leiras, $ar, $kep);
    if($stmt->execute()){
        echo '<div class="alert alert-success"><p>Sikeres feltöltés!</p></div>';  ;
        //header("Location: index.php?menu=home");
    } else {
        echo '<div class="alert alert-danger"><p>Sikertelen feltöltés!</p></div>';
    }
} 



?>

<form method="post" enctype="multipart/form-data">
      <div class="form-group">
            <label for="nev">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" maxlength="100" required value="<?php echo isset($nev)?$nev:""; ?>">
      </div>
      <div class="form-group">
            <label for="leiras">Leírás</label>
            <textarea class="form-control" id="leiras" name="leiras" maxlength="255" value="<?php echo isset($leiras)?$leiras:""; ?>"></textarea>
      </div>
      <div class="form-group">
            <label for="ar">Ár</label>
            <input type="number" class="form-control" id="ar" name="ar" maxlength="11" min="0" required value="<?php echo isset($ar)?$ar:""; ?>">
      </div>
      <?php if($hiba) echo '<p>'.$hibauzenet.'</p>';?>
      <div class="form-group">
            <label for="kep">Kép</label>
            <input type="file" class="form-control" id="kep" name="kep" maxlength="255" required value="<?php echo isset($kep)?$kep:""; ?>">
      </div>
    <button type="submit" class="btn btn-warning" name="feltoltes" value="true">Feltöltés</button>
    
</form>


