<?php
vc_map( array(
    "name" => __("Taranaki Physiotherapy Staff"),
    "base" => "tp_staff",
    "category" => __('Content'),
    'icon' => '',
    'description' => 'Taranaki Physiotherapy Staff Members',
    'show_settings_on_create' => false
));
add_shortcode( 'tp_staff', 'tpStaff' );
function tpStaff() {
    $i = 1;
    $html = '
    <div class="staff-wrapper row">';
    foreach(getStaffMembers() as $staff) {
        $imageid = getImageID($staff->getImage());
        $img = wp_get_attachment_image_src($imageid, 'staff');
        $html .= '
        <div class="col-xs-12 col-sm-6 col-sm-3 col-md-3 col-lg-3 staff" id="staff-' . $staff->id() . '">';
            if($staff->getEmail() <> "") {
                $html .= '<a href="mailto:' . $staff->getEmail() . '" class="fa fa-envelope"></a>';
            }
            $html .= '
            <div class="staff-inner-wrapper" data-id="' . $staff->id() . '" data-colid="' . $i . '">
               <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $staff->getTitle() . '" />    
               </div>
               <h2>' . $staff->getTitle() . '</h2>
               <p class="position">' . $staff->getPosition() . '</p>
               <img src="' . get_stylesheet_directory_uri() . '/images/loader.gif" alt="" class="loader" />
            </div>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}