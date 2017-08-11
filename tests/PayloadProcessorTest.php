<?php

/*
 * This file is part of SocialSaleIO.
 *
 * (c) Daniel Gorgan <danut007ro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialSaleIO\Tests;

use PHPUnit\Framework\TestCase;
use SocialSaleIO\PayloadProcessor;

/**
 * Payload processor test class.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
class PayloadProcessorTest extends TestCase
{
    public function testEncode()
    {
        $payloadProcessor = new PayloadProcessor('key');
        $this->assertEquals(
            '4JMp5eStEVJZyCXShH4XMWXRFmnABSId0FPVmYHauI8=.eyJrZXkiOiJ2YWx1ZSJ9',
            $payloadProcessor->encode(array('key' => 'value'))
        );
    }

    /**
     * @expectedException \SocialSaleIO\Exception\InvalidFormatException
     */
    public function testDecodeFormatException()
    {
        $payloadProcessor = new PayloadProcessor('key');
        $payloadProcessor->decode('oops');
    }

    /**
     * @expectedException \SocialSaleIO\Exception\InvalidSignatureException
     */
    public function testDecodeSignatureException()
    {
        $payloadProcessor = new PayloadProcessor('key');
        $payloadProcessor->decode('4JMp5eStEVJZyCXShH4XMWXRFmnABSId0FPVmYHauI8=.eyJrZXkiOiJ3cm9uZyJ9');
    }

    /**
     * @expectedException \SocialSaleIO\Exception\InvalidContentException
     */
    public function testDecodeContentException()
    {
        $payloadProcessor = new PayloadProcessor('key');
        $payloadProcessor->decode('XJID3yP13nj6urGqU5vA5/a3aqhExwU8Eti80p6Gp5o=.InBsbSI=');
    }

    public function testDecode()
    {
        $payloadProcessor = new PayloadProcessor('key');
        $this->assertEquals(
            array('key' => 'value'),
            $payloadProcessor->decode('4JMp5eStEVJZyCXShH4XMWXRFmnABSId0FPVmYHauI8=.eyJrZXkiOiJ2YWx1ZSJ9')
        );
    }
}
