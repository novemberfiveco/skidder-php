<?php

namespace Skidder\SkidderBundle\Processor;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SessionRequestProcessor
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var string
     */
    private $token;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var string|object
     */
    private $user;

    /**
     * @var bool
     */
    private $logSessionToken;

    public function __construct(SessionInterface $session, TokenStorageInterface $tokenStorage, $logSessionToken = true)
    {
        $this->session         = $session;
        $this->tokenStorage    = $tokenStorage;
        $this->logSessionToken = $logSessionToken;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function processRecord(array $record)
    {
        if ($this->logSessionToken) {
            if (null === $this->token) {
                try {
                    $this->session->start();
                    $this->token = substr($this->session->getId(), 0, 8);
                } catch (\RuntimeException $e) {
                    $this->token = '????????';
                }
            }

            $record['data']['session_token'] = $this->token;
        }

        if (null === $this->user && $this->tokenStorage->getToken() && $this->tokenStorage->getToken()->getUser()) {
            if ($this->tokenStorage->getToken()->getUser() === 'anon.') {
                $this->user = $this->tokenStorage->getToken()->getUser();
            } else {
                $this->user = $this->tokenStorage->getToken()->getUser()->getId();
            }
        }

        $record['data']['user_id'] = $this->user;

        return $record;
    }
}