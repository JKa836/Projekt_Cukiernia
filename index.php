<?php
include_once 'header.php';
$translationsIndex = getTranslations($_SESSION["lang"], "index");
?>

<section class="hero">
    <div class="hero-content">
        <h2><?= $translationsIndex["welcome"] ?></h2>
        <p><span><?= $translationsIndex["shop_description"] ?></span></p>
        <a href="testshop.php" class="button"><?= $translationsIndex["go_to_shop"] ?></a>
    </div>
</section>

<?php
include_once 'top10.php';
?>

<?php
include_once 'footer.php';
?>
