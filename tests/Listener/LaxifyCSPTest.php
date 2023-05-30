<?php

declare(strict_types=1);
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Joas Schilling <coding@schilljs.com>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\HMREnabler\Tests\Listener;

use OC\Security\CSP\ContentSecurityPolicyManager;
use OCA\HMREnabler\AppInfo\Application;
use OCA\HMREnabler\Tests\TestCase;
use OCP\EventDispatcher\IEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class LaxifyCSPTest
 *
 * @package OCA\HMREnabler\Tests\Listener
 */
class EmailNotificationTest extends TestCase {
	/** @var Application */
	protected $app;

	/** @var EventDispatcherInterface */
	private $dispatcher;

	/** @var ContentSecurityPolicyManager */
	private $contentSecurityPolicyManager;

	/** @var IAppContainer */
	protected $container;

	protected function setUp(): void {
		parent::setUp();
		$this->app = new Application();
		$this->container = $this->app->getContainer();

		$this->dispatcher = \OC::$server->query(IEventDispatcher::class);
		$this->contentSecurityPolicyManager = new ContentSecurityPolicyManager($this->dispatcher);
	}

	public function testCSPAreTweaked(): void {
		$csp = $this->contentSecurityPolicyManager->getDefaultPolicy()->buildPolicy();

		$this->assertStringContainsString("script-src 'self' *", $csp);
		$this->assertStringContainsString("connect-src 'self' *", $csp);
	}
}
