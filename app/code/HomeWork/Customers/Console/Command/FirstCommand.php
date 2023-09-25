<?php

declare(strict_types=1);

namespace HomeWork\Customers\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;

class FirstCommand extends Command
{
    private OrderCollectionFactory $orderCollectionFactory;
    private CollectionFactory $customerCollectionFactory;

    public function __construct(
        CollectionFactory      $customerCollectionFactory,
        OrderCollectionFactory $orderCollectionFactory,
        string                 $name = null
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('homework:first-command');
        $this->setDescription('my first command');

        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $customers = $this->customerCollectionFactory->create();

        foreach ($customers as $customer) {
            $orders = $this->orderCollectionFactory->create();
            $orders->addFieldToFilter('customer_id', $customer->getId());
            $output->write(
                'First name:         ' . $customer->getFirstname() . "\n" .
                'Last name:          ' . $customer->getLastname() . "\n" .
                'Registration date:  ' . $customer->getCreatedAt()  . "\n" .
                'Count of orders:    ' . $orders->getSize() . "\n" .
                '-----------------------------------------' . "\n");
        }

        return 0;
    }
}
