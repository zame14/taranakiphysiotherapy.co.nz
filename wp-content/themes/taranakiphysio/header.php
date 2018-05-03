<?php
$container = get_theme_mod( 'understrap_container_type' );
$setting_ing = new Setting(30);
$setting_strat = new Setting(31);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">
    <section id="header">
        <a name="top"></a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 offset-xl-1 col-xl-10 mobile-nopadding">
                    <div class="logo-wrapper">
                        <?=the_custom_logo()?>
                    </div>
                    <div id="tp-menu-wrapper">
                        <div class="main-nav wrapper-fluid wrapper-navbar" id="wrapper-navbar">
                            <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                        'menu_class' => 'nav navbar-nav',
                                        'fallback_cb' => '',
                                        'menu_id' => 'main-menu'
                                    )
                                );
                                ?>
                            </nav>
                        </div>
                    </div>
                    <div class="phone-numbers-wrapper-mobile">
                        <ul>
                            <li class="ing"><a href="tel:<?=formatPhoneNumber($setting_ing->getPhone())?>"><span class="fa fa-phone"></span>inglewood</a></li><li class="strat"><a href="tel:<?=formatPhoneNumber($setting_strat->getPhone())?>"><span class="fa fa-phone"></span>stratford</a></li>
                        </ul>
                    </div>
                    <div class="phone-numbers-wrapper">
                        <ul>
                            <li><a href="tel:<?=formatPhoneNumber($setting_ing->getPhone())?>"><?=$setting_ing->getPhone()?></a> | <span>Inglewood</span></li>
                            <li><a href="tel:<?=formatPhoneNumber($setting_strat->getPhone())?>"><?=$setting_strat->getPhone()?></a> | <span>Stratford</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>