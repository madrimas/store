<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/shirts")
     */
    public function showShirts()
    {
        return $this->render('default/shirts.html.twig');
    }
    /**
     * @Route("/shorts")
     */
    public function showShorts()
    {
        return new Response("Spodenki");
    }
    /**
     * @Route("/kits/home")
     */
    public function showHomeKits()
    {
        return $this->render('default/homeKits.html.twig');
    }
    /**
     * @Route("/kits/away")
     */
    public function showAwayKits()
    {
        return new Response("Zestawy wyjazdowe");
    }
    /**
     * @Route("/kits/third")
     */
    public function showThirdKits()
    {
        return new Response("Zestawy trzecie");
    }
    /**
     * @Route("/kits/training")
     */
    public function showTrainingKits()
    {
        return new Response("Zestawy terningowe");
    }
    /**
     * @Route("/accessories")
     */
    public function showAccessories()
    {
        return new Response("Akcesoria");
    }
    /**
     * @Route("/gadgets")
     */
    public function showGadgets()
    {
        return new Response("Gadżety");
    }
    /**
     * @Route("/balls")
     */
    public function showBalls()
    {
        return new Response("Piłki");
    }
    /**
     * @Route("/shoes")
     */
    public function showShoes()
    {
        return new Response("Buty");
    }
    /**
     * @Route("/about")
     */
    public function getAbout()
    {
        return new Response("O nas");
    }
    /**
     * @Route("/help")
     */
    public function getHelp()
    {
        return new Response("Doradztwo");
    }
    /**
     * @Route("/shipping")
     */
    public function getShipping()
    {
        return new Response("Dostawa");
    }
    /**
     * @Route("/payment")
     */
    public function getPayment()
    {
        return new Response("Płatność");
    }
    /**
     * @Route("/regulations")
     */
    public function getRegulations()
    {
        return new Response("Regulamin");
    }
    /**
     * @Route("/shoppingCart")
     */
    public function getShoppingCart()
    {
        return new Response("Koszyk");
    }
}