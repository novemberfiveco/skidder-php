<?php

namespace NovemberFive\SkidderBundle\Tests;

use NovemberFive\SkidderBundle\Processor\RequestIdProcessor;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestIdProcessorTest extends KernelTestCase
{
    /**
     * @var Prophet
     */
    protected $prophet;


    public function setUp()
    {
        $this->prophet              = new Prophet();
    }

    /**
     * Test process request with request ID
     */
    public function testProcessRequestWithHeader()
    {
        $request            = $this->prophesize(Request::class);
        $headerbag          = $this->prophesize(HeaderBag::class);
        $requestStack       = $this->prophesize(RequestStack::class);

        $headerbag->get('x-Request-ID')->shouldBeCalled()->willReturn('1111');
        $request->headers   = $headerbag;

        $requestStack->getCurrentRequest()->shouldBeCalled()->willReturn($request);

        $requestIdProcessor = new RequestIdProcessor($requestStack->reveal(), 'x-Request-ID');

        $expected = array(
            'data' => array(
                'request_id' => '1111'
            )
        );

        $result             = $requestIdProcessor->processRequest(array());

        $this->assertEquals($expected, $result);
    }

    /**
     * Test process request without request ID
     */
    public function testProcessRequestWithoutHeader()
    {
        $headerbag          = $this->prophesize(HeaderBag::class);
        $requestStack       = $this->prophesize(RequestStack::class);

        $headerbag->get('x-Request-ID')->shouldNotBeCalled();
        $requestStack->getCurrentRequest()->shouldNotBeCalled();

        $requestIdProcessor = new RequestIdProcessor($requestStack->reveal(), null);

        $expected           = array();
        $result             = $requestIdProcessor->processRequest(array());

        $this->assertEquals($expected, $result);
    }

    /**
     * Test process request without current request
     */
    public function testProcessRequestWithoutCurrentRequest()
    {
        $headerbag          = $this->prophesize(HeaderBag::class);
        $requestStack       = $this->prophesize(RequestStack::class);

        $headerbag->get('x-Request-ID')->shouldNotBeCalled();
        $requestStack->getCurrentRequest()->shouldBeCalled()->willReturn(null);

        $requestIdProcessor = new RequestIdProcessor($requestStack->reveal(), 'x-Request-ID');

        $expected           = array();
        $result             = $requestIdProcessor->processRequest(array());

        $this->assertEquals($expected, $result);
    }
}
