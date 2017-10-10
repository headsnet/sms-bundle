<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\Controller;

use Headsnet\SmsBundle\DependencyInjection\Api\EsendexApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EsendexApiController
 *
 * See https://www.esendex.com/developertools/pushnotifications/gettingstarted
 */
class EsendexApiController extends Controller
{

	/**
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

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function optOutAction(Request $request): JsonResponse
	{
		$xml = simplexml_load_string($request->getContent());

		$success = $this->get(EsendexApi::class)->optOut(
		// @codingStandardsIgnoreStart
			$xml->MessageId->__toString(),
			$xml->From->__toString(),
			$xml->MessageText->__toString()
		// @codingStandardsIgnoreEnd
		);

		return new JsonResponse(['result' => $success]);
	}

}
