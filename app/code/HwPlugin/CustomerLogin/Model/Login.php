<?php

namespace HwPlugin\CustomerLogin\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Login extends AbstractModel implements IdentityInterface
{
    /**
     * No route page id.
     */
    const NOROUTE_ENTITY_ID = 'no-route';

    /**
     * Entity Id
     */
    const ENTITY_ID = 'entity_id';

    /**
     * CustomerLogin Login cache tag.
     */
    const CACHE_TAG = 'hwplugin_customerlogin_login';

    /**
     * @var string
     */
    protected $_cacheTag = 'hwplugin_customerlogin_login';

    /**
     * @var string
     */
    protected $_eventPrefix = 'hwplugin_customerlogin_login';

    /**
     * Dependency Initialization
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceModel\Login::class);
    }

    /**
     * Load object data.
     *
     * @param int $id
     * @param string|null $field
     * @return $this
     */
    public function load($id, $field = null): static
    {
        if ($id === null) {
            return $this->noRoute();
        }
        return parent::load($id, $field);
    }

    /**
     * No Route
     *
     * @return $this
     */
    public function noRoute(): static
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    /**
     * Get Identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get Id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set Id
     *
     * @param int $id
     * @return Login
     */
    public function setId($id): Login
    {
        return $this->setData(self::ENTITY_ID, $id);
    }
}
