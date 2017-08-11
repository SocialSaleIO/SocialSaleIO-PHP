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

use SocialSaleIO\Exception\InvalidContentException;
use SocialSaleIO\Exception\InvalidFormatException;
use SocialSaleIO\Exception\InvalidSignatureException;

/**
 * Payload processor class.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
class PayloadProcessor implements PayloadProcessorInterface
{
    /** @var string */
    protected $key;

    /**
     * Payload constructor.
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(array $payload)
    {
        $p2 = base64_encode(json_encode($payload));
        $p1 = base64_encode(hash_hmac('sha256', $p2, $this->key, true));

        return $p1 . '.' . $p2;
    }

    /**
     * {@inheritdoc}
     */
    public function decode($encodedPayload)
    {
        $payloadParts = explode('.', $encodedPayload, 2);
        if (2 !== count($payloadParts)) {
            throw new InvalidFormatException('Invalid format of payload');
        }

        if (base64_decode($payloadParts[0]) !== hash_hmac('sha256', $payloadParts[1], $this->key, true)) {
            throw new InvalidSignatureException('Payload has invalid signature');
        }

        $payload = json_decode(base64_decode($payloadParts[1]), true);
        if (!is_array($payload)) {
            throw new InvalidContentException('Decoded payload is invalid');
        }

        return $payload;
    }
}
