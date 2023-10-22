<?php

declare(strict_types=1);

namespace HwPlugin\CustomerLogin\Observer;

use HwPlugin\CustomerLogin\Model\ResourceModel\AccountRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerLogoutObserver implements ObserverInterface
{
    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $customerId = $observer->getEvent()->getData('customer')->getId();

        $this->accountRepository->delete((int)$customerId);
    }
}
