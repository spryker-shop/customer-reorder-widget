<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Model;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderReaderInterface
{
    public function getOrderTransfer(int $idSalesOrder): OrderTransfer;

    public function hasIncompatibleItems(OrderTransfer $orderTransfer): bool;
}
