<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, Response};

use AppBundle\UberPigeon\Order;

class DefaultController extends Controller
{
    private $order;

    // ------------------------------------------------------------------------

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @Route("/", name="getOrder")
     */
    public function getOrderAction(Request $request)
    {
        $order = $this->order->receiveOrder(
            $request->get('distance'),
            new \DateTime($request->get('deadline'))
        );

        return new Response(json_encode($order));
    }
}
