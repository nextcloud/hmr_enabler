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

		// Allow vue dev tool to work on Firefox.
		$csp->allowInlineScript(true);
		$csp->allowEvalScript(true);

		// Unblock HMR requests.
		$csp->addAllowedConnectDomain('*');
		$csp->addAllowedScriptDomain('*');

		$event->addPolicy($csp);
	}
}
