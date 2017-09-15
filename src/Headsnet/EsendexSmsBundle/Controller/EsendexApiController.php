<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Controller;

use Headsnet\EsendexSmsBundle\DependencyInjection\Api\EsendexApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EsendexApiController
 *
 * See https://www.esendex.com/developertools/pushnotifications/gettingstarted
 *
 * @Route("/api/esendex")
 */
class EsendexApiController extends Controller
{

	/**
	 * @Route("/delivery-notify", name="esendex_delivery_notify")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function deliveryNotifyAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexApi::class)->acknowledgeDeliveryNotification(
			// @codingStandardsIgnoreStart
			$xml->MessageId->__toString()
			// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

	/**
	 * @Route("/delivery-error", name="esendex_delivery_error")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function deliveryErrorAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexApi::class)->logDeliveryError(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

	/**
	 * @Route("/message-received", name="esendex_message_received")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function messageReceivedAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexApi::class)->saveReceivedMessage(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString(),
			$xml->From->__toString(),
			$xml->MessageText->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

}
