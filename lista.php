<?php
$sql = "SELECT `nev`,`leiras`,`ar`,`kep` FROM `termek`";
if($result = $conn->query($sql)){
    if($result->num_rows > 0){
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()){
            echo '<div class="card col-sm-3" style="width: 18rem; float:left; margin: 1rem">';
            if($row["kep"] != null){
                echo '<img src="uploads\\'.$row["kep"].'" class="card-img-top" alt="uploads\\'.$row["kep"].'">';
            }
            echo '<div class="card-body">
                    <h5 class="card-title">'.$row["nev"].'</h5>
                <p class="card-text">'.$row["leiras"].'</p>
                <p class="card-text">'.number_format($row["ar"],0,"."," ").' Ft</p>
              </div>
            </div>';
        }
        echo '</div>';
    }
} else {
    echo 'Sikertelen lekérdezés!';
}
?>


