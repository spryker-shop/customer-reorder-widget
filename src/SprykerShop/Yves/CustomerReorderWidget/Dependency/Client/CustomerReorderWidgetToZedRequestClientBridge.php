<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerReorderWidget\Dependency\Client;

class CustomerReorderWidgetToZedRequestClientBridge implements CustomerReorderWidgetToZedRequestClientInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedRequestClient
     */
    public function __construct($zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    public function addFlashMessagesFromLastZedRequest(): void
    {
        $this->zedRequestClient->addFlashMessagesFromLastZedRequest();
    }

    public function addResponseMessagesToMessenger(): void
    {
        $this->zedRequestClient->addResponseMessagesToMessenger();
    }
}
