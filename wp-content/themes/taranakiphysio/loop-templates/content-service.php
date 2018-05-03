<?php
$service = new Service($post);
$banner_imageid = getImageID($service->getBanner());
$banner_img = wp_get_attachment_image_src($banner_imageid, 'banner');

$f_imageid = getImageID($service->getFeatureImage());
$f_img = wp_get_attachment_image_src($f_imageid, 'feature');

$cta_title = 'Suffering from ';
if($service->id() == 89) $cta_title .= 'a ';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="inside-banner-wrapper">
        <img src="<?=$banner_img[0]?>" alt="<?=$service->getTitle()?>" />
    </div>
    <div class="spacer-50"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1><?=$service->getTitle()?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <?=$service->getContent()?>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="gallery-wrapper">
                    <?php
                    foreach($service->getGalleryImages() as $gallery_image) {
                        $g_imageid = getImageID($gallery_image);
                        $g_img = wp_get_attachment_image_src($g_imageid, 'gallery');
                        echo '<div><img src="' . $g_img[0] . '" alt="" /></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="spacer-100"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-lg-1 col-lg-3 offset-xl-1 col-xl-3 cta-wrapper-1">
                <div class="image-wrapper">
                    <img src="<?=$f_img[0]?>" alt="<?=$service->getTitle()?>" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7 col-xl-7 cta-wrapper-2">
                <div class="inner-wrapper">
                    <div class="title"><?=$cta_title . $service->getTitle()?>?</div>
                    <hr />
                    <p>Our specialised practitioners can help you out.</p>
                    <p><strong>No referral required, call us to <a href="/contact/">book an appointment.</a></strong></p>
                </div>
            </div>
        </div>
        <div class="spacer-100"></div>
        <div class="row">
            <div class="col-xl-12">
                <div class="h2-wrapper">
                    <h2>More Services</h2>
                </div>
            </div>
            <div class="col-xl-12 more-services-wrapper">
                <ul>
                    <?php
                    foreach(getServices() as $other_service) {
                        if($other_service->id() <> $service->id()) {
                            $osf_imageid = getImageID($other_service->getFeatureImage());
                            $osf_img = wp_get_attachment_image_src($osf_imageid, 'feature');
                            echo '<li><a href="' . $other_service->link() . '"><img src="' . $osf_img[0] . '" alt="' . $other_service->getTitle() . '" /><span>' . $other_service->getTitle() . '</span></a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <footer class="entry-footer">
        <?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article>

