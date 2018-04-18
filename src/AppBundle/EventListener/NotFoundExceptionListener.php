<?php

namespace AppBundle\EventListener;

use AppBundle\Exception\NotFoundInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class NotFoundExceptionListener
{
	const HEADER_EXCEPTION_CODE = 404;


	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		$exception = $event->getException();
		if(! $exception instanceof NotFoundInterface) {
			return;
		}

		$event->setResponse(new JsonResponse([
			'status' => 'rejected', 
			'message' => $exception->getMessage()
		], self::HEADER_EXCEPTION_CODE));
	}
}