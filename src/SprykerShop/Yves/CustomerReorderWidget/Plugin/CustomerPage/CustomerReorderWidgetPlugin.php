<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\CustomerPage\Dependency\Plugin\CustomerReorderWidget\CustomerReorderWidgetPluginInterface;

/**
 * @deprecated Use {@link \SprykerShop\Yves\CartReorderPage\Widget\CartReorderWidget} instead.
 *
 * @method \SprykerShop\Yves\CustomerReorderWidget\CustomerReorderWidgetFactory getFactory()
 */
class CustomerReorderWidgetPlugin extends AbstractWidgetPlugin implements CustomerReorderWidgetPluginInterface
{
    public function initialize(OrderTransfer $orderTransfer, ?ItemTransfer $itemTransfer = null): void
    {
        $this->addParameter('order', $orderTransfer);
        $this->addParameter('item', $itemTransfer);
        $this->addParameter('availability', $this->getItemAvailability($itemTransfer));
    }

    public static function getName(): string
    {
        return static::NAME;
    }

    public static function getTemplate(): string
    {
        return '@CustomerReorderWidget/views/customer-reorder/customer-reorder.twig';
    }

    protected function getItemAvailability(?ItemTransfer $itemTransfer = null): bool
    {
        if (!$itemTransfer) {
            return false;
        }

        $availability = $this->getFactory()
            ->createAvailabilityChecker()
            ->checkBySalesItem($itemTransfer);

        return $availability;
    }
}
