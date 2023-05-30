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

namespace OCA\HMREnabler\Tests\AppInfo;

use OC\Files\View;
use OCA\HMREnabler\AppInfo\Application;
use OCA\HMREnabler\Listener\LaxifyCSP;
use OCA\HMREnabler\Tests\TestCase;
use OCP\IL10N;

/**
 * Class ApplicationTest
 *
 * @package OCA\HMREnabler\Tests\AppInfo
 */
class ApplicationTest extends TestCase {
	/** @var Application */
	protected $app;

	/** @var IAppContainer */
	protected $container;

	protected function setUp(): void {
		parent::setUp();
		$this->app = new Application();
		$this->container = $this->app->getContainer();
	}

	public function testContainerAppName(): void {
		$this->app = new Application();
		$this->assertEquals('hmr_enabler', $this->container->getAppName());
	}

	public function queryData(): array {
		return [
			[IL10N::class],
			[View::class],

			// Listener
			[LaxifyCSP::class],
		];
	}
	
	/**
	 * @dataProvider queryData
	 * @param string $service
	 * @param string $expected
	 */
	public function testContainerQuery(string $service, ?string $expected = null): void {
		if ($expected === null) {
			$expected = $service;
		}
		$this->assertInstanceOf($expected, $this->container->query($service));
	}
}
