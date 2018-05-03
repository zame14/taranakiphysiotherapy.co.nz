<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/2018
 * Time: 9:09 PM
 */
class Partner extends TPBase
{
    public function getLogo()
    {
        return $this->getPostMeta('logo');
    }
    public function getURL()
    {
        return $this->getPostMeta('partner-url');
    }
}