<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2021 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\HMREnabler\AppInfo;

use OCA\HMREnabler\Listener\LaxifyCSP;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;

/**
 * @psalm-api
 */
final class Application extends App implements IBootstrap {
	public const APP_ID = 'hmr_enabler';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	#[\Override]
	public function register(IRegistrationContext $context): void {
		$context->registerEventListener(AddContentSecurityPolicyEvent::class, LaxifyCSP::class);
	}

	#[\Override]
	public function boot(IBootContext $context): void {
	}
}
