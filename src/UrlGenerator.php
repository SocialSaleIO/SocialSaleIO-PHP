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
    public function generateClickUrl($socialPlatform, $id, array $options = [])
    {
        $options['_platform'] = (string) $socialPlatform;
        $options['_id'] = (string) $id;

        $encodedPayload = $this->payloadProcessor->encode($options);

        return rtrim($this->host, '/')."/{$this->appId}/$encodedPayload";
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
}
