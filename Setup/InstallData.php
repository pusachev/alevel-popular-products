<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\PopularProducts\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;

/**
 * Class InstallData
 * @package ALevel\Attributes\Setup
 */
class InstallData implements InstallDataInterface
{
    /** @var EavSetupFactory  */
    private $eavSetupFactory;

    /** @var EavSetup */
    private $eavSetup;

    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory\
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;

    }

    /** {@inheritDoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $removeAttributeCode = ['is_popular'];

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        foreach ($removeAttributeCode as $attributeCode) {
            $eavSetup->removeAttribute(Product::ENTITY, $attributeCode);
        }

        $this->createIsPopularAttribute($setup);

        $setup->endSetup();
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function createIsPopularAttribute(ModuleDataSetupInterface $setup)
    {
        $this->getEavSetup($setup)
             ->addAttribute(
                Product::ENTITY,
                'is_popular',
                [
                    'group' => 'General', //Means that we add an attribute to the attribute group “General”, which is present in all attribute sets.
                    'type' => 'int', //varchar means that the values will be stored in the catalog_eav_varchar table.
                    'label' => 'Is Popular', //A label of the attribute (that is, how it will be rendered in the backend and on the frontend).
                    'input' => 'boolean',
                    'source' => '', // provides a list of options
                    'frontend' => '', //defines how it should be rendered on the frontend
                    'backend' => '', //allows you to perform certain actions when an attribute is loaded or saved. In our example, it will be validation.
                    'required' => false,
                    'sort_order' => 50,
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL, // defines the scope of its values (global, website, or store)
                    'is_used_in_grid' => true, //is used in admin product grid
                    'is_visible_in_grid' => true, // is visibile column in admin product grid
                    'is_filterable_in_grid' => true, // is used for filter in admin product grid
                    'visible' => true, //A flag that defines whether an attribute should be shown on the “More Information” tab on the frontend
                    'is_html_allowed_on_front' => false, //Defines whether an attribute value may contain HTML
                    'visible_on_front' => true, // A flag that defines whether an attribute should be shown on product listing
                ]
            );
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @return EavSetup
     */
    private function getEavSetup(ModuleDataSetupInterface $setup)
    {
        if (null === $this->eavSetup) {
            $this->eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        }

        return $this->eavSetup;
    }
}
