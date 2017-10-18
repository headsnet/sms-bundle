<?php
declare(strict_types=1);

namespace Headsnet\Sms;

use Headsnet\Sms\Exception\SmsSenderException;
use Headsnet\Sms\Dispatcher\DispatcherInterface;
use Headsnet\Sms\Model\Interfaces\SmsResultItemInterface;
use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;
use Headsnet\Sms\Model\SmsMessage;
use Headsnet\Sms\Renderer\RendererInterface;
use Headsnet\SmsBundle\Event\SmsSendEvent;
use Headsnet\SmsBundle\SmsEvents;
use Headsnet\SmsBundle\SmsStatus;
use SplPriorityQueue;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class SmsSender is actually an SMS broker, which sends (forwards) SMS
 * messages to the DispatchService
 */
class SmsSender implements QueueableSmsSenderInterface
{
	/**
	 * @var DispatcherInterface
	 */
	private $dispatcher;

    /**
     * @var RendererInterface
     */
    private $renderer;

	/**
	 * @var SplPriorityQueue
	 */
	private $queue;

	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;

	/**
	 * Constructor.
	 *
	 * @param DispatcherInterface      $dispatcher
	 * @param RendererInterface        $renderer
	 * @param EventDispatcherInterface $eventDispatcher
	 */
    public function __construct(
    	DispatcherInterface $dispatcher,
	    RendererInterface $renderer,
	    EventDispatcherInterface $eventDispatcher
    )
    {
        $this->dispatcher = $dispatcher;
        $this->renderer = $renderer;
        $this->queue = new SplPriorityQueue();
	    $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function enqueue(SmsMessage $smsMessage)
    {
        $message = $this->renderer->render($smsMessage);
        $this->queue->insert($message, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function send(SmsMessage $smsMessage)
    {
        try
        {
            $message = $this->renderer->render($smsMessage);

            return $this->doSend($message);
        }
        catch(\Exception $e)
        {
            throw new SmsSenderException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendDispatchMessage(TransformedSmsMessageInterface $message)
    {
        try
        {
	        return $this->doSend($message);
        }
        catch(\Exception $e)
        {
            throw new SmsSenderException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendFirstFromQueue()
    {
        if ($this->queue->isEmpty())
        {
            throw new SmsSenderException('SMS Sender queue is empty.');
        }

        $message = $this->queue->extract();

	    $this->dispatcher->send($message);
    }

    /**
     * {@inheritdoc}
     */
    public function sendAllFromQueue()
    {
        while (!$this->queue->isEmpty())
        {
            $this->sendFirstFromQueue();
        }
    }

	/**
	 * @param TransformedSmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 */
	private function doSend(TransformedSmsMessageInterface $message)
	{
		$result = $this->dispatcher->send($message);

		$event = new SmsSendEvent(
			$result->getId(), SmsStatus::STATUS_SENT, $result->getRecipient(), $result->getMessage()
		);
		$this->eventDispatcher->dispatch(SmsEvents::SENT, $event);

		return $result;
    }

}
