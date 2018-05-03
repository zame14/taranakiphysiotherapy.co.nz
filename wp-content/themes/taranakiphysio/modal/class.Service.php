<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/2018
 * Time: 9:17 PM
 */
class Service extends TPBase
{
    public function getBanner()
    {
        return $this->getPostMeta('banner-image');
    }
    public function getFeatureImage()
    {
        return $this->getPostMeta('feature-image');
    }
    public function getGalleryImages()
    {
        $gallery = Array();
        $field = get_post_meta($this->id());
        foreach($field['wpcf-gallery-images'] as $image) {
            $gallery[] = $image;
        }
        return $gallery;
    }
}