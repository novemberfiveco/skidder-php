<?php

namespace NovemberFive\SkidderBundle\Processor;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SessionRequestProcessor
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string|object
     */
    private $user;

    /**
     * @param bool $logSessionToken
     */
    private $logSessionToken;

    public function __construct(private readonly SessionInterface $session, private readonly TokenStorageInterface $tokenStorage, private $logSessionToken = true)
    {
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
                } catch (\RuntimeException) {
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