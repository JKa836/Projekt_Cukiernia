<?php
    include_once 'header.php';
?>

<?php if (isset($user))?>
<div class="container">      
    <section class="userInfo">
        <h2>Imię</h2>
        <p><?= htmlspecialchars($user["Imie"])?></p>
        <h2>Nazwisko</h2>
        <p><?= htmlspecialchars($user["Nazwisko"])?></p>
        <h2>Email</h2>
        <p><?= htmlspecialchars($user["Email"])?></p>
        <div>
            <a href="edituser.php">Edytuj dane</a>
        </div>    
        <div>
            <a href="changepasswd.php">Zmień hasło</a>    
        </div> 
        <div>
            <a href="#">Twoje zamówienia</a>
        </div> 
    </section>
</div>
<?php
    include_once 'footer.php';
?>