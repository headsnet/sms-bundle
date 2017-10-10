<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\Controller;

use Headsnet\SmsBundle\DependencyInjection\EventDispatcher\EsendexEventDispatcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EsendexController
 *
 * See https://www.esendex.com/developertools/pushnotifications/gettingstarted
 */
class EsendexController extends Controller
{

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function deliveryNotifyAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexEventDispatcher::class)->acknowledgeDeliveryNotification(
			// @codingStandardsIgnoreStart
			$xml->MessageId->__toString()
			// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function deliveryErrorAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexEventDispatcher::class)->logDeliveryError(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function messageReceivedAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexEventDispatcher::class)->saveReceivedMessage(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString(),
			$xml->From->__toString(),
			$xml->MessageText->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function optOutAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexEventDispatcher::class)->optOut(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString(),
			$xml->From->__toString(),
			$xml->MessageText->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

}
