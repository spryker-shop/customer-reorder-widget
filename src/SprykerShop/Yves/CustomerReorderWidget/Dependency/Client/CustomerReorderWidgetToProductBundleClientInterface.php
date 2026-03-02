<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Dependency\Client;

use Generated\Shared\Transfer\QuoteTransfer;

interface CustomerReorderWidgetToProductBundleClientInterface
{
    public function getItemsWithBundlesItems(QuoteTransfer $quoteTransfer): array;
}
