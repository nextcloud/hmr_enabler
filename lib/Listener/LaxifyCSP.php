<?php

namespace OCA\HMREnabler\Listener;

use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;

/**
 * @template-implements IEventListener<Event>
 */
class LaxifyCSP implements IEventListener {

	public function handle(Event $event): void {
		if (!($event instanceof AddContentSecurityPolicyEvent)) {
			return;
		}

		$csp = new ContentSecurityPolicy();

		// Allow vue dev tool to work on Firefox.
		$csp->allowEvalScript(true);

		// Unblock HMR requests.
		$csp->addAllowedConnectDomain('*');
		$csp->addAllowedScriptDomain('*');

		$event->addPolicy($csp);
	}
}
