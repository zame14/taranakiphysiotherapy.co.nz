<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
$setting_ing = new Setting(30);
$setting_strat = new Setting(31);
?>
<section id="partners">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <?=partners()?>
            </div>
        </div>
    </div>
</section>
<footer id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-5 col-lg-4 offset-xl-1 col-xl-4 footer-col-1">
                <h3><?=get_bloginfo('name')?></h3>
                <h4>Inglewood</h4>
                <address><?=$setting_ing->getAddress()?></address>
                <a href="tel:<?=formatPhoneNumber($setting_ing->getPhone())?>"><?=$setting_ing->getPhone()?></a>
                <a href="mailto:<?=$setting_ing->getEmail()?>"><?=$setting_ing->getEmail()?></a>
                <hr />
                <h4>Stratford</h4>
                <address><?=$setting_strat->getAddress()?></address>
                <a href="tel:<?=formatPhoneNumber($setting_strat->getPhone())?>"><?=$setting_strat->getPhone()?></a>
                <a href="mailto:<?=$setting_strat->getEmail()?>"><?=$setting_strat->getEmail()?></a>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-3">
                <h3>Services</h3>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'fallback_cb' => '',
                        'menu_id' => 'footer-menu'
                    )
                );
                ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4 col-xl-4">
                <h3>Our Hours</h3>
                <?=$setting_ing->getHours()?>
                <div class="photographer-wrapper">
                    <a href="https://www.facebook.com/TobyBaldwinPhotography/" target="_blank"><img src="<?=get_stylesheet_directory_uri()?>/images/tobybaldwinphotography.png" alt="Toby Baldwin Photography" /><span>Photos by Toby Baldwin Photography</span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 offset-xl-1 col-xl-10">
                <a href="<?=get_page_link(131)?>" class="sitemap"><span class="fa fa-sitemap"></span>Sitemap</a>
            </div>
        </div>
    </div>
    <a class="top">
        <span class="fa fa-chevron-up"></span>
    </a>
</footer>
<section id="copyright">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                &copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?> <i>-</i> <span>Website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions Ltd</a></span>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>