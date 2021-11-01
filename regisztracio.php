<?php
if(filter_input(INPUT_POST, "regisztral", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
    $felhasznalo_nev = filter_input(INPUT_POST, "felhasznalo_nev", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $jelszo = password_hash(filter_input(INPUT_POST, "jelszo"), PASSWORD_BCRYPT);
    $teljes_nev = filter_input(INPUT_POST, "teljes_nev", FILTER_SANITIZE_STRING);
    $szuletesi_datum = filter_input(INPUT_POST, "szuletesi_datum", FILTER_SANITIZE_STRING);
    $iranyito_szam = filter_input(INPUT_POST, "iranyito_szam", FILTER_VALIDATE_INT);
    $varos = filter_input(INPUT_POST, "varos", FILTER_SANITIZE_STRING);
    $cim = filter_input(INPUT_POST, "cim", FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO `felhasznalo` (`felhasznalo_nev`, `email`, `jelszo`, `teljes_nev`, `szuletesi_datum`, `iranyito_szam`, `varos`, `cim`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiss", $felhasznalo_nev, $email, $jelszo, $teljes_nev, $szuletesi_datum , $iranyito_szam, $varos, $cim);
    if($stmt->execute()){
        echo '<div class="alert alert-success"><p>Sikeres regisztráció!</p></div>';
    } else {
        echo '<div class="alert alert-danger"><p>Sikertelen regisztráció!</p></div>';
    }
} 
?>

<script>
      function validalas() {
                let felhasznalo_nev = document.getElementById('felhasznalo_nev').value;
                let email = document.getElementById('email').value;
                let jelszo = document.getElementById('jelszo').value;
                let teljes_nev = document.getElementById('teljes_nev').value;
                let iranyito_szam = document.getElementById('iranyito_szam').value;
                iranyitoszam = parseInt(iranyitoszam);
                let varos = document.getElementById('varos').value;
                let cim = document.getElementById('cim').value;
                if (felhasznalo_nev.length > 30) {
                    alert("A felhasználónév maximum 30 karakter hosszú lehet.");
                    return false;
                }
                if (felhasznalo_nev.length > 255) {
                    alert("Az e-mail cím maximum 255 karakter hosszú lehet.");
                    return false;
                }
                if (jelszo.length > 100 || jelszo.length < 8) {
                    alert("A jelszó hossza legalább 8 és maximum 100 karakter lehet.");
                    return false;
                }
                let index = 0;
                while (isNaN(jelszo[index]) && index < jelszo.length) 
                {
                    index++;               
                }      
                if (index == jelszo.length) {
                    alert("A jelszó nem tartalmaz egyetlen számot sem.");
                    return false;
                }
                if (jelszo == jelszo.toLowerCase) {
                    alert("A jelszó nem tartalmaz nagybetűt.");
                    return false;
                }
                if (jelszo == jelszo.toUpperCase) {
                    alert("A jelszó nem tartalmaz kisbetűt.");
                    return false;
                }
                if (teljes_nev.length > 100) {
                    alert("A teljes név maximum 100 karakter hosszú lehet.");
                    return false;
                }
                if (iranyito_szam.length > 4) {
                    alert("Az irányítószám maximum 4 számjegyű lehet.");
                    return false;
                }
                if (varos > 50) {
                    alert("A város maximum 50 karakter hosszú lehet.");
                    return false;
                }
                if (cim > 255) {
                    alert("A cím maximum 255 karakter hosszú lehet.");
                    return false;
                }
                return true;
            }
</script>

<form onsubmit="return validalas();" method="post">
      <div class="form-group">
            <label for="felhasznalo_nev">Felhasználónév</label>
            <input type="text" class="form-control" id="felhasznalo_nev" name="felhasznalo_nev" maxlength="30" required value="<?php echo isset($felhasznalo_nev)?$felhasznalo_nev:""; ?>">
      </div>
      <div class="form-group">
            <label for="email">E-mail cím</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="255" required value="<?php echo isset($email)?$email:""; ?>">
      </div>
      <div class="form-group">
            <label for="jelszo">Jelszó</label>
            <input type="password" class="form-control" id="jelszo" name="jelszo" maxlength="100" required>
      </div>
      <div class="form-group">
            <label for="teljes_nev">Teljes név</label>
            <input type="text" class="form-control" id="teljes_nev" name="teljes_nev" maxlength="100" required value="<?php echo isset($teljes_nev)?$teljes_nev:""; ?>">
      </div>
      <div class="form-group">
            <label for="szuletesi_datum">Születési dátum</label>
            <input type="date" class="form-control" id="szuletesi_datum" name="szuletesi_datum" required value="<?php echo isset($szuletesi_datum)?$szuletesi_datum:""; ?>">
      </div>
      <div class="form-group">
            <label for="iranyito_szam">Irányítószám</label>
            <input type="number" class="form-control" id="iranyito_szam" name="iranyito_szam" maxlength="4" required value="<?php echo isset($iranyito_szam)?$iranyito_szam:""; ?>">
      </div>
      <div class="form-group">
            <label for="varos">Város</label>
            <input type="text" class="form-control" id="varos" name="varos" maxlength="50" required value="<?php echo isset($varos)?$varos:""; ?>">
      </div>
      <div class="form-group">
            <label for="cim">Cím</label>
            <input type="text" class="form-control" id="cim" name="cim" maxlength="255" required value="<?php echo isset($cim)?$cim:""; ?>">
      </div>
    <button type="submit" class="btn btn-warning" name="regisztral" value="true">Regisztráció</button>
</form>
<?php

