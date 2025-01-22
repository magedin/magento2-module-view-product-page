<?php
/**
 * MagedIn Technology
 *
 * Do not edit this file if you want to update this module for future new versions.
 *
 * @category  MagedIn
 * @copyright Copyright (c) 2025 MagedIn Technology.
 *
 * @author    MagedIn Support <support@magedin.com>
 */
declare(strict_types=1);

namespace MagedIn\ViewProductPage\Block\Adminhtml\Catalog\Product\Edit;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Url as ProductUrl;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Store\Model\StoreManagerInterface;

class ViewProduct extends Generic
{
    /**
     * @var ProductUrl
     */
    private ProductUrl $productUrl;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    public function __construct(
        Context $context,
        Registry $registry,
        ProductUrl $productUrl,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $registry);
        $this->productUrl = $productUrl;
        $this->storeManager = $storeManager;
    }

    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('View on Storefront'),
            'on_click' => sprintf("window.open('%s');", $this->getProductUrl()),
            'class' => 'secondary',
            'sort_order' => 1,
        ];
    }

    /**
     * @return string
     */
    public function getProductUrl(): string
    {
        /** @var Product | ProductInterface $product */
        $product = $this->getProduct();
        $product->setStoreId($this->storeManager->getDefaultStoreView()->getId());
        return $this->productUrl->getProductUrl($product);
    }
}
