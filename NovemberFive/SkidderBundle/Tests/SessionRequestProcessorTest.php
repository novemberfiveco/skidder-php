<?php

namespace NovemberFive\SkidderBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionRequestProcessor extends KernelTestCase
{

    /**
     * @var \appTestDebugProjectContainer
     */
    private $container;

    public function setUp()
    {
        //start the symfony kernel
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    /**
     * Test session Request without user
     */
    public function testSessionRequest()
    {
        // get session
        $session = $this->container->get('session');
        // start session
        $session->start();

        // expected result
        $expected = array(
            'data' => array(
                'session_token' => substr($session->getId(), 0, 8),
                'user_id'       => null,
            ),
        );

        $sessionRequestProcessor = $this->container->get('skidder.processor.session_request');
        $result                  = $sessionRequestProcessor->processRecord(array());

        $this->assertEquals($expected, $result);
    }


}