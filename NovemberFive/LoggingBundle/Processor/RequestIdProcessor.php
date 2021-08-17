<?php
/**
 * This file is part of LoggingBundle.
 *
 * (c) 2018 November Five BVBA
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace NovemberFive\LoggingBundle\Processor;
use Symfony\Component\HttpFoundation\RequestStack;


/**
 * @package NovemberFive\LoggingBundle\Processor
 */
class RequestIdProcessor
{
    private $requestStack;
    private $requestHeader;

    /**
     * @param RequestStack $requestStack
     * @param string|null $requestHeader
     */
    public function __construct(RequestStack $requestStack, $requestHeader)
    {
        $this->requestStack     = $requestStack;
        $this->requestHeader    = $requestHeader;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function processRequest(array $record)
    {
        if (null !== $this->requestHeader) {
            $currentRequest = $this->requestStack->getCurrentRequest();

            if (null !== $currentRequest) {
                $record['data']['request_id'] = $currentRequest->headers->get($this->requestHeader);
            }
        }

        return $record;
    }


}