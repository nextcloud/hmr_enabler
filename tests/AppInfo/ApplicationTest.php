<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2021 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\HMREnabler\Tests\AppInfo;

use OC\Files\View;
use OCA\HMREnabler\AppInfo\Application;
use OCA\HMREnabler\Listener\LaxifyCSP;
use OCA\HMREnabler\Tests\TestCase;
use OCP\AppFramework\IAppContainer;
use OCP\IL10N;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class ApplicationTest
 *
 * @package OCA\HMREnabler\Tests\AppInfo
 */
class ApplicationTest extends TestCase {
	protected Application $app;
	protected IAppContainer $container;

	protected function setUp(): void {
		parent::setUp();
		$this->app = new Application();
		$this->container = $this->app->getContainer();
	}

	public function testContainerAppName(): void {
		$this->app = new Application();
		$this->assertEquals('hmr_enabler', $this->container->getAppName());
	}

	public static function queryData(): array {
		return [
			[IL10N::class],
			[View::class],

			// Listener
			[LaxifyCSP::class],
		];
	}

	#[DataProvider('queryData')]
	public function testContainerQuery(string $service, ?string $expected = null): void {
		if ($expected === null) {
			$expected = $service;
		}
		$this->assertInstanceOf($expected, $this->container->query($service));
	}
}
