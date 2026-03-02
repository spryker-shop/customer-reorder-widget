<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @deprecated {@link \SprykerShop\Yves\CustomerReorderWidget\Widget\CustomerReorderItemCheckboxWidget} instead.
 *
 * @method \SprykerShop\Yves\CustomerReorderWidget\CustomerReorderWidgetFactory getFactory()
 */
class CustomerReorderItemCheckboxWidget extends AbstractWidget
{
    public function __construct(?ItemTransfer $itemTransfer = null)
    {
        $this
            ->addParameter('item', $itemTransfer)
            ->addParameter('availability', $this->getItemAvailability($itemTransfer));
    }

    public static function getName(): string
    {
        return 'CustomerReorderItemCheckboxWidget';
    }

    public static function getTemplate(): string
    {
        return '@CustomerReorderWidget/views/customer-reorder/customer-reorder-item-checkbox.twig';
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
