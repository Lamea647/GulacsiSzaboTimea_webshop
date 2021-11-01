<?php
if(filter_input(INPUT_POST, "belepes", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
    $felhasznalo_nev = filter_input(INPUT_POST, "felhasznalo_nev", FILTER_SANITIZE_STRING);
    $jelszo = filter_input(INPUT_POST, "jelszo");
    $sql = 'SELECT `jelszo` FROM `felhasznalo` WHERE `felhasznalo_nev`=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $felhasznalo_nev );
    $stmt->execute();
    
    $result = $stmt->get_result();
    if(password_verify($jelszo, $result->fetch_assoc()["jelszo"])){
        echo '<div class="alert alert-success"><p>Sikeres bejelentkezés!</p></div>';
        $result = $conn->query('SELECT * FROM `felhasznalo` WHERE `felhasznalo_nev`= "'.$felhasznalo_nev.'";');
        $_SESSION['user'] = $result->fetch_assoc();
        $_SESSION['login'] = true;
        //header("Location: index.php?menu=bejelentkezes");
    } else {
        echo '<div class="alert alert-danger"><p>Sikertelen bejelentkezés!</p></div>';  
    }
}
?>
<form method="POST">
      <div class="form-group">
            <label for="felhasznalo_nev">Felhasználónév</label>
            <input type="text" class="form-control" id="felhasznalo_nev" name="felhasznalo_nev" required>
      </div>
      <div class="form-group">
            <label for="jelszo">Jelszó</label>
            <input type="password" class="form-control" id="jelszo" name="jelszo" required>
      </div>
    <button type="submit" class="btn btn-warning" name="belepes" value="true">Belépés</button>
</form>
<?php


