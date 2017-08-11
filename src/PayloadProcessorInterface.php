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
 * Payload processor interface.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
interface PayloadProcessorInterface
{
    /**
     * Sign and encode a payload.
     *
     * @param array $payload
     *
     * @return string
     */
    public function encode(array $payload);

    /**
     * Decode and verify signature of a payload.
     *
     * @param string $encodedPayload
     *
     * @throws InvalidFormatException
     * @throws InvalidSignatureException
     * @throws InvalidContentException
     *
     * @return array
     */
    public function decode($encodedPayload);
}
