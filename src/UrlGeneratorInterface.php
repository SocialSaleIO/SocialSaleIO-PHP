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
 * Url generator interface.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
interface UrlGeneratorInterface
{
    /**
     * Generate url for click
     *
     * @param string $socialPlatform
     * @param string $id
     * @param array $options
     *
     * @return string
     */
    public function generateClickUrl($socialPlatform, $id, array $options = array());
}
