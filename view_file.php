
<?php
if (isset($_GET['result'])) {
    $image = htmlspecialchars($_GET['result']);
    
        echo "<img src='$image' alt='Test Result' 
        style='width: 100vh; height: 100vh; object-fit: cover; object-position: center;'>";
} else {
    echo "<h3>No image selected.</h3>";
}
?>
