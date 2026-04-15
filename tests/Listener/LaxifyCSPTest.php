<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2021 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\HMREnabler\Tests\Listener;

use OC\Security\CSP\ContentSecurityPolicyManager;
use OCA\HMREnabler\AppInfo\Application;
use OCA\HMREnabler\Tests\TestCase;
use OCP\AppFramework\IAppContainer;
use OCP\EventDispatcher\IEventDispatcher;

/**
 * Class LaxifyCSPTest
 *
 * @package OCA\HMREnabler\Tests\Listener
 */
class LaxifyCSPTest extends TestCase {
	protected Application $app;
	private IEventDispatcher $dispatcher;
	private ContentSecurityPolicyManager $contentSecurityPolicyManager;
	protected IAppContainer $container;

	protected function setUp(): void {
		parent::setUp();
		$this->app = new Application();
		$this->container = $this->app->getContainer();

		$this->dispatcher = \OCP\Server::get(IEventDispatcher::class);
		$this->contentSecurityPolicyManager = new ContentSecurityPolicyManager($this->dispatcher);
	}

	public function testCSPAreTweaked(): void {
		$csp = $this->contentSecurityPolicyManager->getDefaultPolicy()->buildPolicy();

		$this->assertStringContainsString("script-src 'self' *", $csp);
		$this->assertStringContainsString("connect-src 'self' *", $csp);
	}
}
