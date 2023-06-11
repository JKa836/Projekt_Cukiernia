<?php include_once 'header.php';
$translationsRegulamin = getTranslations($_SESSION["lang"], "regulamin");
?>

<div class="container">
    <h1 class="page-title"><?php echo $translationsRegulamin['page_title']; ?></h1>

    <h2 class="section-title"><?php echo $translationsRegulamin['general_provisions_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['general_provisions_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['general_provisions_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['general_provisions_content'][2]; ?></li>
        <li><?php echo $translationsRegulamin['general_provisions_content'][3]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['purchase_rules_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['purchase_rules_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][2]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][3]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][4]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][5]; ?></li>
        <li><?php echo $translationsRegulamin['purchase_rules_content'][6]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['payment_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['payment_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['payment_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['payment_content'][2]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['complaints_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['complaints_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['complaints_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['complaints_content'][2]; ?></li>
        <li><?php echo $translationsRegulamin['complaints_content'][3]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['final_provisions_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['final_provisions_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['final_provisions_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['final_provisions_content'][2]; ?></li>
        <li><?php echo $translationsRegulamin['final_provisions_content'][3]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['privacy_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['privacy_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['privacy_content'][1]; ?></li>
        <li><?php echo $translationsRegulamin['privacy_content'][2]; ?></li>
        <li><?php echo $translationsRegulamin['privacy_content'][3]; ?></li>
    </ol>

    <h2 class="section-title"><?php echo $translationsRegulamin['copyright_title']; ?></h2>
    <ol class="section-content">
        <li><?php echo $translationsRegulamin['copyright_content'][0]; ?></li>
        <li><?php echo $translationsRegulamin['copyright_content'][1]; ?></li>
    </ol>
</div>

<?php include_once 'footer.php'; ?>