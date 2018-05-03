<?php
require_once('modal/class.Base.php');
require_once('modal/class.Setting.php');
require_once('modal/class.Service.php');
require_once('modal/class.Staff.php');
require_once('modal/class.Partner.php');
require_once(STYLESHEETPATH . '/includes/wordpress-tweaks.php');
loadVCTemplates();
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'google_font_open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    wp_enqueue_style( 'google_font_ubuntu', 'https://fonts.googleapis.com/css?family=Ubuntu:400,700');
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick.css');
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
    wp_enqueue_script( 'waypoint', get_stylesheet_directory_uri() . '/js/noframework.waypoints.min.js');
    wp_enqueue_script('understap-theme', get_stylesheet_directory_uri() . '/js/theme.js?' . filemtime(get_stylesheet_directory() . '/js/theme.js'), array('jquery'));
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick.js');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
add_filter( 'vc_load_default_templates', 'p_vc_load_default_templates' ); // Hook in
function p_vc_load_default_template( $data ) {
    return array();
}
add_action('init', 'tp_register_menus');
function tp_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}

function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;

}
add_image_size( 'banner', 2000);
add_image_size( 'feature', 767, 563, true );
add_image_size( 'staff', 575, 575, true );
add_image_size( 'gallery', 767, 563, true );

function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM wp_posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function getServices() {
    $services = Array();
    $posts_array = get_posts([
        'post_type' => 'service',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
    ]);
    foreach ($posts_array as $post) {
        $service = new Service($post);
        $services[] = $service;
    }
    return $services;
}
function getStaffMembers()
{
    $staff_members = Array();
    $posts_array = get_posts([
        'post_type' => 'staff-member',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
    ]);
    foreach ($posts_array as $post) {
        $staff = new Staff($post);
        $staff_members[] = $staff;
    }
    return $staff_members;
}
function getPartners()
{
    $partners = Array();
    $posts_array = get_posts([
        'post_type' => 'partner',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
    ]);
    foreach ($posts_array as $post) {
        $partner = new Partner($post);
        $partners[] = $partner;
    }
    return $partners;
}
function partners() {
    $html = '
    <ul class="partners">';
    foreach(getPartners() as $partner) {
        $link = $partner->getURL();
        $target = "target='_blank'";
        if($link == '') {
            $link = 'javascript:;';
            $target = '';
        }
        $html .= '<li><a href="' . $link . '" ' . $target . '><img src="' . $partner->getLogo() . '" alt="' . $partner->getTitle() . '" /></a>';
    }
    $html .= '
    </ul>';

    return $html;
}
if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == "show_staff_bio") {
    $html = '';
    $staff = new Staff($_REQUEST['staffid']);
    $colid = $_REQUEST['colid'];
    ($staff->getContent() <> "") ? $bio = $staff->getContent() : $bio = '<p>Staff bio coming soon...</p>';
    $html .= '
    <div class="bio-content">
        <div class="close-me fa fa-times" onclick="closeStaffBio();"></div>
        <div class="col-xl-12">
            <h2>' . $staff->getTitle() . '</h2>';
            $html .= '
            <div class="bio">
                ' . $bio . '
            </div>
        </div>
    </div>';

    echo $html;
    exit;
}