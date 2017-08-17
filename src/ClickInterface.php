<?php

/*
 * This file is part of SocialSaleIO.
 *
 * (c) Daniel Gorgan <danut007ro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialSaleIO;

/**
 * Click interface.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
interface ClickInterface
{
    /**
     * Get click id.
     *
     * @return string
     */
    public function getClickId();

    /**
     * Get social platform name.
     *
     * @return string
     */
    public function getSocialPlatform();

    /**
     * Get url to be shared.
     *
     * @return string
     */
    public function getSharedUrl();

    /**
     * Get url to which user is redirected.
     *
     * @return string
     */
    public function getRedirectUrl();

    /**
     * Get extra properties for click.
     *
     * @return array
     */
    public function getProperties();
}
