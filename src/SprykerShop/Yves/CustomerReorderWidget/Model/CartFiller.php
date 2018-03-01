<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Model;

use ArrayObject;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\CustomerReorderWidget\Dependency\Client\CustomerReorderWidgetToCartClientInterface;

class CartFiller implements CartFillerInterface
{
    /**
     * @var \SprykerShop\Yves\CustomerReorderWidget\Dependency\Client\CustomerReorderWidgetToCartClientInterface
     */
    protected $cartClient;

    /**
     * @var \SprykerShop\Yves\CustomerReorderWidget\Model\ItemFetcherInterface
     */
    protected $itemsFetcher;

    /**
     * @var \SprykerShop\Yves\CustomerReorderWidget\Model\QuoteWriterInterface
     */
    protected $quoteWriter;

    /**
     * @param \SprykerShop\Yves\CustomerReorderWidget\Dependency\Client\CustomerReorderWidgetToCartClientInterface $cartClient
     * @param \SprykerShop\Yves\CustomerReorderWidget\Model\ItemFetcherInterface $itemsFetcher
     * @param \SprykerShop\Yves\CustomerReorderWidget\Model\QuoteWriterInterface $quoteWriter
     */
    public function __construct(
        CustomerReorderWidgetToCartClientInterface $cartClient,
        ItemFetcherInterface $itemsFetcher,
        QuoteWriterInterface $quoteWriter
    ) {
        $this->cartClient = $cartClient;
        $this->itemsFetcher = $itemsFetcher;
        $this->quoteWriter = $quoteWriter;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return void
     */
    public function fillFromOrder(OrderTransfer $orderTransfer): void
    {
        $items = $this->itemsFetcher->getAll($orderTransfer);
        $quoteTransfer = $this->quoteWriter->write($orderTransfer);

        $this->updateCart($quoteTransfer, $items);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param int[] $idOrderItems
     *
     * @return void
     */
    public function fillSelectedFromOrder(OrderTransfer $orderTransfer, array $idOrderItems): void
    {
        $items = $this->itemsFetcher->getByIds($orderTransfer, $idOrderItems);
        $quoteTransfer = $this->quoteWriter->write($orderTransfer);

        $this->updateCart($quoteTransfer, $items);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ItemTransfer[] $orderItems
     *
     * @return void
     */
    protected function updateCart(QuoteTransfer $quoteTransfer, array $orderItems): void
    {
        $cartChangeTransfer = new CartChangeTransfer();
        $cartChangeTransfer->setQuote($quoteTransfer);
        $orderItemsObject = new ArrayObject($orderItems);
        $cartChangeTransfer->setItems($orderItemsObject);

        $quoteTransfer = $this->cartClient->addValidItems($cartChangeTransfer);

        $this->cartClient->storeQuote($quoteTransfer);
    }
}
