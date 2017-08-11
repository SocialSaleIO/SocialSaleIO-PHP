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
use SocialSaleIO\UrlGenerator;

/**
 * Url generator test class.
 *
 * @author Daniel Gorgan <danut007ro@gmail.com>
 */
class UrlGeneratorTest extends TestCase
{
    public function testHostIsMutable()
    {
        $urlGenerator = new UrlGenerator('app', new PayloadProcessor('key'));

        $urlGenerator->setHost('http://localhost');
        $this->assertEquals(
            'http://localhost',
            $urlGenerator->getHost()
        );
    }

    public function testGenerateClickUrl()
    {
        $payloadProcessor = $this->getMockBuilder('SocialSaleIO\PayloadProcessor')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $payloadProcessor
            ->expects($this->once())
            ->method('encode')
            ->with(array('_id' => 'id'))
            ->willReturn('encodedPayload')
        ;

        $urlGenerator = new UrlGenerator('appId', $payloadProcessor);
        $urlGenerator->setHost('http://localhost/');
        $this->assertEquals(
            'http://localhost/appId/socialPlatform/encodedPayload',
            $urlGenerator->generateClickUrl('socialPlatform', 'id', array())
        );
    }
}
