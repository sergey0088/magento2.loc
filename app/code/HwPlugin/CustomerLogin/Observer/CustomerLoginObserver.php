<?php

namespace HwPlugin\CustomerLogin\Observer;

use HwPlugin\CustomerLogin\Model\ResourceModel\AccountRepository;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerLoginObserver implements ObserverInterface
{
    /**
     * @var AccountRepository
     */
    protected AccountRepository $accountRepository;
    /**
     * @var RemoteAddress
     */
    protected RemoteAddress $remote;

    public function __construct(
        AccountRepository $accountRepository,
        RemoteAddress     $remote
    ) {
        $this->accountRepository = $accountRepository;
        $this->remote = $remote;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $customerId = $observer->getEvent()->getData('customer')->getId();

        $ip_address = $this->remote->getRemoteAddress();

        $this->accountRepository->save($customerId, $ip_address);
    }
}
