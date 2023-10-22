<?php

declare(strict_types=1);

namespace HwPlugin\CustomerLogin\Plugin;

use HwPlugin\CustomerLogin\Model\ResourceModel\AccountRepository;
use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Exception\InvalidEmailOrPasswordException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class CustomerLogin
{
    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;
    /**
     * @var RemoteAddress
     */
    private RemoteAddress $remote;

    public function __construct(
        AccountRepository $accountRepository,
        RemoteAddress $remote
    ) {
        $this->accountRepository = $accountRepository;
        $this->remote = $remote;
    }

    /**
     * @param AccountManagement $subject
     * @param $username
     * @param $password
     * @return array|null
     * @throws InvalidEmailOrPasswordException
     * @throws \Zend_Db_Statement_Exception
     */
    public function beforeAuthenticate(AccountManagement $subject, $username, $password): ?array
    {
        $ip_address = $this->remote->getRemoteAddress();

        if ($this->accountRepository->validation($ip_address)) {
            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
        }
        return null;
    }
}
