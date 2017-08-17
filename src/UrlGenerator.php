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
 * Url generator class.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
class UrlGenerator implements UrlGeneratorInterface
{
    /** @var string */
    protected $appId;

    /** @var PayloadProcessorInterface */
    protected $payloadProcessor;

    /** @var string */
    protected $host = 'https://socialsale.io/_click';

    /**
     * ClickUrlGenerator constructor.
     *
     * @param string $appId
     * @param PayloadProcessorInterface $payloadProcessor
     */
    public function __construct($appId, PayloadProcessorInterface $payloadProcessor)
    {
        $this->appId = $appId;
        $this->payloadProcessor = $payloadProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function generateClickUrl(ClickInterface $click)
    {
        $options = $click->getProperties();
        $this->addValue($options, '_id', $click->getClickId());
        $this->addValue($options, '_platform', $click->getSocialPlatform());
        $this->addValue($options, '_sharedUrl', $click->getSharedUrl());
        $this->addValue($options, '_redirectUrl', $click->getRedirectUrl());

        $encodedPayload = $this->payloadProcessor->encode($options);

        return rtrim($this->host, '/')."/{$this->appId}.$encodedPayload";
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Add a named value to options array
     *
     * @param array $options
     * @param string $name
     * @param string $value
     */
    protected function addValue(array &$options, $name, $value)
    {
        if (strval($value)) {
            $options[$name] = $value;
        } else {
            unset($options[$name]);
        }
    }
}
