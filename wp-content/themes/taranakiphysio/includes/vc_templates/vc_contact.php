<?php
vc_map( array(
    "name" => __("Taranaki Physiotherapy Contact Details"),
    "base" => "tp_contact",
    "category" => __('Content'),
    'icon' => '',
    'description' => 'Taranaki Physiotherapy Contact Details',
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Clinic"),
            "param_name" => "clinic",
            "value" => Array('Inglewood', 'Stratford')
        ),
    )
));
add_shortcode( 'tp_contact', function ($atts) {
    $args = vc_map_get_attributes('tp_contact', $atts);
    $clinic = $args['clinic'];

    ($clinic == "Inglewood") ? $id = 30 : $id = 31;

    $setting = new Setting($id);

    $html = '
    <div class="contact-details-wrapper">
        <h2>' . $setting->getTitle() . '</h2>
        <address>' . $setting->getAddress() . '</address>
        <a href="tel:' . formatPhoneNumber($setting->getPhone()) . '" class="ph"><span class="fa fa-phone-square"></span>' . $setting->getPhone() . '</a>
        <a href="mailto:' . $setting->getEmail() . '" class="email"><span class="fa fa-envelope-square"></span>' . $setting->getEmail() . '</a>
    </div>';

    return $html;
} );