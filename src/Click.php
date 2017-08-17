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
 * Click class.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
class Click implements ClickInterface
{
    /** @var string */
    protected $clickId = '';

    /** @var string */
    protected $socialPlatform = '';

    /** @var string */
    protected $sharedUrl = '';

    /** @var string */
    protected $redirectUrl = '';

    /** @var array */
    protected $properties = [];

    /**
     * {@inheritdoc}
     */
    public function getClickId()
    {
        return $this->clickId;
    }

    /**
     * @param string $clickId
     *
     * @return $this
     */
    public function setClickId($clickId)
    {
        $this->clickId = $clickId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSocialPlatform()
    {
        return $this->socialPlatform;
    }

    /**
     * @param string $socialPlatform
     *
     * @return $this
     */
    public function setSocialPlatform($socialPlatform)
    {
        $this->socialPlatform = $socialPlatform;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSharedUrl()
    {
        return $this->sharedUrl;
    }

    /**
     * @param string $sharedUrl
     *
     * @return $this
     */
    public function setSharedUrl($sharedUrl)
    {
        $this->sharedUrl = $sharedUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @param string $redirectUrl
     *
     * @return $this
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     *
     * @return $this
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }
}
