<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Dependency\Client;

use Generated\Shared\Transfer\OrderTransfer;

interface CustomerReorderWidgetToSalesClientInterface
{
    public function getOrderDetails(OrderTransfer $orderTransfer): OrderTransfer;
}
