<?php
/**
 * Copyright © MagedIn. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Tiago Sampaio <tiago.sampaio@magedin.com>
 */
declare(strict_types = 1);

namespace MagedIn\ViewProductPage\Block\Adminhtml\Catalog\Product\Edit;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Url as ProductUrl;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ViewProduct
 *
 * @package MagedIn\ViewProductPage\Block\Adminhtml\Catalog\Product\Edit
 */
class ViewProduct extends Generic
{
    /**
     * @var ProductUrl
     */
    private $productUrl;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

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
    public function getButtonData()
    {
        return [
            'label' => __('View Product Page'),
            'on_click' => sprintf("window.open('%s');", $this->getProductUrl()),
            'class' => 'secondary',
            'sort_order' => 1
        ];
    }

    /**
     * @param   string|null $routePath
     * @param   array|null $routeParams
     *
     * @return string
     */
    public function getProductUrl()
    {
        /** @var Product | ProductInterface $product */
        $product = $this->getProduct();
        $product->setStoreId($this->storeManager->getDefaultStoreView()->getId());
        return $this->productUrl->getProductUrl($product);
    }
}
