<?php
vc_map( array(
    "name" => __("Taranaki Physiotherapy Services"),
    "base" => "tp_services",
    "category" => __('Content'),
    'icon' => '',
    'description' => 'Taranaki Physiotherapy Services',
    'show_settings_on_create' => false
));
add_shortcode( 'tp_services', 'services' );
function services() {
    $html = '
    <div class="service-tiles-wrapper row">';
    foreach(getServices() as $service) {
        $imageid = getImageID($service->getFeatureImage());
        $img = wp_get_attachment_image_src($imageid, 'feature');
        $html .= '
        <div class="col-xs-12 col-sm-6 col-md-4 service-panel">
            <a href="' . $service->link() . '">
                <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $service->getTitle() . '" />
                </div>
                <div class="title">' . $service->getTitle() . '</div>
            </a>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}