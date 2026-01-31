<?php

namespace Spatie\GoogleTagManager;

use Illuminate\Contracts\View\View;
use Spatie\GoogleTagManager\Exceptions\ApiKeyNotSetException;

class ScriptViewCreator
{
    public function __construct(
        protected GoogleTagManager $googleTagManager,
    ) {}

    public function create(View $view): void
    {
        if ($this->googleTagManager->isEnabled() && empty($this->googleTagManager->id())) {
            throw new ApiKeyNotSetException;
        }

        $view
            ->with('enabled', $this->googleTagManager->isEnabled())
            ->with('id', $this->googleTagManager->id())
            ->with('domain', $this->googleTagManager->gtmScriptDomain())
            ->with('nonceEnabled', $this->googleTagManager->isNonceEnabled())
            ->with('dataLayer', $this->googleTagManager->getDataLayer())
            ->with('pushData', $this->googleTagManager->getPushData());
    }
}
