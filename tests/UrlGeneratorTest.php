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
use SocialSaleIO\Click;
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
            ->getMock();

        $payloadProcessor
            ->expects($this->at(0))
            ->method('encode')
            ->with([])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->at(1))
            ->method('encode')
            ->with(['_id' => 'clickId'])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->at(2))
            ->method('encode')
            ->with(['_platform' => 'platform'])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->at(3))
            ->method('encode')
            ->with(['_sharedUrl' => 'sharedUrl'])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->at(4))
            ->method('encode')
            ->with(['_redirectUrl' => 'redirectUrl'])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->at(5))
            ->method('encode')
            ->with(['k1' => 'v1', 'k2' => 'v2'])
            ->willReturn('encodedPayload');

        $payloadProcessor
            ->expects($this->exactly(6))
            ->method('encode');

        $urlGenerator = new UrlGenerator('appId', $payloadProcessor);
        $urlGenerator->setHost('http://localhost/');

        $click = new Click();
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );

        $click = new Click();
        $click->setClickId('clickId');
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );

        $click = new Click();
        $click->setSocialPlatform('platform');
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );

        $click = new Click();
        $click->setSharedUrl('sharedUrl');
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );

        $click = new Click();
        $click->setRedirectUrl('redirectUrl');
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );

        $click = new Click();
        $click->setProperties(['k1' => 'v1', 'k2' => 'v2']);
        $this->assertEquals(
            'http://localhost/appId.encodedPayload',
            $urlGenerator->generateClickUrl($click)
        );
    }
}
