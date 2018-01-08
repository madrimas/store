<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use AppBundle\Entity\Shirts;
use AppBundle\Entity\Shorts;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Koszulki;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/homepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/homepage")
     */
    public function showHomepage()
    {

        return $this->render('default/homepage.html.twig');
    }

    /**
     * @Route("/shirts")
     */
    public function showShirts()
    {
        $shirts = $this->getDoctrine()
            ->getRepository(Shirts::class)
            ->findAll();

        return $this->render('default/shirts.html.twig', array('viewShirts' => $shirts));
    }

    /**
     * @Route("/shorts")
     */
    public function showShorts()
    {
        $shorts = $this->getDoctrine()
            ->getRepository(Shorts::class)
            ->findAll();

        return $this->render('default/shorts.html.twig', array('viewShorts' => $shorts));
    }

    /**
     * @Route("/kits/home")
     */
    public function showHomeKits()
    {
        $home = $this->getDoctrine()
            ->getRepository(Home::class)
            ->findAll();

        return $this->render('default/homeKits.html.twig', array('viewHomeKits' => $home));
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
     * @Route("/shoppingCart")
     */
    public function getShoppingCart()
    {
        return new Response("Koszyk");
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function getEdit()
    {
        return $this->render('default/edit.html.twig');
    }

    /**
     * @Route("/add")
     */
    public function shirtsCreateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shirts = new Shirts();
        $shirts->setName('Koszulka');
        $shirts->setQuantity(100);
        $shirts->setPrice(199);

        $em->persist($shirts);
        $em->flush();

        return new Response('Saved new shirts with ID ' . $shirts->getId());
    }


    public function shortsCreateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shorts = new Shorts();
        $shorts->setName('Spodenki');
        $shorts->setQuantity(10);
        $shorts->setPrice(99);

        $em->persist($shorts);
        $em->flush();

        return new Response('Saved new shorts with ID ' . $shorts->getId());
    }

    public function homeCreateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $home = new Home();
        $home->setName('Domowe');
        $home->setQuantity(20);
        $home->setPrice(299);

        $em->persist($home);
        $em->flush();

        return new Response('Saved new homeKits with ID ' . $home->getId());
    }

    /**
     * @Route("/edit/updateShirts")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getUpdateShirts(Request $request)
    {
        $shirtsID = 1;
        $em = $this->getDoctrine()->getManager();
        $shirts = $em->getRepository(Koszulki::class)->find($shirtsID);

        $form = $this->createFormBuilder($shirts)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Zaktualizuj'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create the user

            $em->persist($shirts);
            $em->flush();

            return $this->redirectToRoute('edit');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit/updateShorts")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getUpdateShorts(Request $request)
    {
        $shortsID = 1;
        $em = $this->getDoctrine()->getManager();
        $shorts = $em->getRepository(Shorts::class)->find($shortsID);

        $form = $this->createFormBuilder($shorts)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Zaktualizuj'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create the user

            $em->persist($shorts);
            $em->flush();

            return $this->redirectToRoute('edit');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit/updateHomeKits")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getUpdateHomeKits(Request $request)
    {
        $homeID = 1;
        $em = $this->getDoctrine()->getManager();
        $home = $em->getRepository(Home::class)->find($homeID);

        $form = $this->createFormBuilder($home)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Zaktualizuj'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create the user

            $em->persist($home);
            $em->flush();

            return $this->redirectToRoute('edit');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}