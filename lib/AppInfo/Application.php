<?php

namespace OCA\HMREnabler\AppInfo;

use OCA\HMREnabler\Listener\LaxifyCSP;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap {
	public const APP_ID = 'hmr_enabler';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
	
	public function register(IRegistrationContext $context): void {
		$context->registerEventListener(AddContentSecurityPolicyEvent::class, LaxifyCSP::class);
	}

	public function boot(IBootContext $context): void {
		$server = $this->getContainer()->getServer();
	}
}
