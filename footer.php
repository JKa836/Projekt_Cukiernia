<?php
$translationsFooter = getTranslations($_SESSION["lang"], "footer");
?>
<footer class="footer">
    <div class="container-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php echo $translationsFooter["Contact"]; ?></h3>
                <p><?php echo $translationsFooter["Phone"]; ?>: 123-456-789</p>
                <p><?php echo $translationsFooter["Email"]; ?>: kontakt@cukiernia.pl</p>
                <p><?php echo $translationsFooter["Address"]; ?>: ul. Słodkiej 10, 00-000 Miasteczko</p>
            </div>
            <div class="footer-section">
                <h3><?php echo $translationsFooter["Opening Hours"]; ?></h3>
                <p><?php echo $translationsFooter["Monday - Friday"]; ?>: 9:00 - 18:00</p>
                <p><?php echo $translationsFooter["Saturday"]; ?>: 10:00 - 15:00</p>
                <p><?php echo $translationsFooter["Sunday"]; ?>: <?php echo $translationsFooter["Closed"]; ?></p>
            </div>
            <div class="footer-section">
                <h3><?php echo $translationsFooter["Links"]; ?></h3>
                <ul>
                    <li><a href="index.php"><?php echo $translationsFooter["Home"]; ?></a></li>
                    <li><a href="testshop.php"><?php echo $translationsFooter["Our Products"]; ?></a></li>
                    <li><a href="onas.php"><?php echo $translationsFooter["About Us"]; ?></a></li>
                    <li><a href="regulamin.php"><?php echo $translationsFooter["Terms and Conditions"]; ?></a></li>
                    <li><a href="polityka.php"><?php echo $translationsFooter["Privacy Policy"]; ?></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 <?php echo $translationsFooter["Online Bakery"]; ?>. <?php echo $translationsFooter["All rights reserved."]; ?></p>
        </div>
    </div>
</footer>
</body>
</html>