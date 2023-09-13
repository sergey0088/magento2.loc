<?php
namespace HomeWork\Customers\Console\Command\FirstCommand;

/**
 * Interceptor class for @see \HomeWork\Customers\Console\Command\FirstCommand
 */
class Interceptor extends \HomeWork\Customers\Console\Command\FirstCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, ?string $name = null)
    {
        $this->___init();
        parent::__construct($customerCollectionFactory, $orderCollectionFactory, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        return $pluginInfo ? $this->___callPlugins('run', func_get_args(), $pluginInfo) : parent::run($input, $output);
    }
}
