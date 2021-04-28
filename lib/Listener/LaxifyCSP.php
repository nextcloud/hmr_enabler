<?php

namespace OCA\HMREnabler\Listener;

use OCP\Security\CSP\AddContentSecurityPolicyEvent;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\AppFramework\Http\ContentSecurityPolicy;

class LaxifyCSP implements IEventListener {
	public function handle(Event $event): void {
		if (!($event instanceof AddContentSecurityPolicyEvent)) {
			return;
		}

		$csp = new ContentSecurityPolicy();
		$csp->addAllowedConnectDomain('*');
		$csp->addAllowedScriptDomain('*');

		$event->addPolicy($csp);
	}
}
