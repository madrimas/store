<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Away;
use AppBundle\Entity\Home;
use AppBundle\Entity\Shirts;
use AppBundle\Entity\Shorts;
use AppBundle\Entity\Third;
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
        $away = $this->getDoctrine()
            ->getRepository(Away::class)
            ->findAll();

        return $this->render('default/awayKits.html.twig', array('viewAwayKits' => $away));
    }

    /**
     * @Route("/kits/third")
     */
    public function showThirdKits()
    {
        $third = $this->getDoctrine()
            ->getRepository(Third::class)
            ->findAll();

        return $this->render('default/thirdKits.html.twig', array('viewThirdKits' => $third));
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
     * @Route("/shoppingCart", name="shoppingCart")
     */
    public function getShoppingCart()
    {
        return new Response("Zakup udany!");
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function getEdit()
    {
        return $this->render('default/edit.html.twig');
    }

    /**
     * @Route("/getShirtToCart")
     * @param Request $request
     * @return Response
     */
    public function getShirtToCart(Request $request)
    {
        $shirtsID = 1;
        $em = $this->getDoctrine()->getManager();
        $shirts = $em->getRepository(Shirts::class)->find($shirtsID);

        $shirt = new Shirts();
        $shirt->setName($shirts->getName());
        $shirt->setQuantity(1);
        $shirt->setPrice($shirts->getPrice());

        $form = $this->createFormBuilder($shirt)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Kup!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form['quantity']->getData();
            $shirt->setQuantity($data);
            $shirts->setQuantity($shirts->getQuantity() - $shirt->getQuantity());

            $em->persist($shirts);
            $em->flush();

            return $this->redirectToRoute('shoppingCart');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/getShortsToCart")
     * @param Request $request
     * @return Response
     */
    public function getShortsToCart(Request $request)
    {
        $shortsID = 1;
        $em = $this->getDoctrine()->getManager();
        $shorts = $em->getRepository(Shorts::class)->find($shortsID);

        $short = new Shorts();
        $short->setName($shorts->getName());
        $short->setQuantity(1);
        $short->setPrice($shorts->getPrice());

        $form = $this->createFormBuilder($short)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Kup!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form['quantity']->getData();
            $short->setQuantity($data);
            $shorts->setQuantity($shorts->getQuantity() - $short->getQuantity());

            $em->persist($shorts);
            $em->flush();

            return $this->redirectToRoute('shoppingCart');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/getHomeToCart")
     * @param Request $request
     * @return Response
     */
    public function getHomeToCart(Request $request)
    {
        $homeID = 1;
        $em = $this->getDoctrine()->getManager();
        $homeKits = $em->getRepository(Home::class)->find($homeID);

        $homeKit = new Home();
        $homeKit->setName($homeKits->getName());
        $homeKit->setQuantity(1);
        $homeKit->setPrice($homeKits->getPrice());

        $form = $this->createFormBuilder($homeKit)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Kup!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form['quantity']->getData();
            $homeKit->setQuantity($data);
            $homeKits->setQuantity($homeKits->getQuantity() - $homeKit->getQuantity());

            $em->persist($homeKits);
            $em->flush();

            return $this->redirectToRoute('shoppingCart');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/getAwayToCart")
     * @param Request $request
     * @return Response
     */
    public function getAwayToCart(Request $request)
    {
        $awayID = 1;
        $em = $this->getDoctrine()->getManager();
        $awayKits = $em->getRepository(Away::class)->find($awayID);

        $awayKit = new Away();
        $awayKit->setName($awayKits->getName());
        $awayKit->setQuantity(1);
        $awayKit->setPrice($awayKits->getPrice());

        $form = $this->createFormBuilder($awayKit)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Kup!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form['quantity']->getData();
            $awayKit->setQuantity($data);
            $awayKits->setQuantity($awayKits->getQuantity() - $awayKit->getQuantity());

            $em->persist($awayKits);
            $em->flush();

            return $this->redirectToRoute('shoppingCart');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/getThirdToCart")
     * @param Request $request
     * @return Response
     */
    public function getThirdToCart(Request $request)
    {
        $thirdID = 1;
        $em = $this->getDoctrine()->getManager();
        $thirdKits = $em->getRepository(Third::class)->find($thirdID);

        $thirdKit = new Third();
        $thirdKit->setName($thirdKits->getName());
        $thirdKit->setQuantity(1);
        $thirdKit->setPrice($thirdKits->getPrice());

        $form = $this->createFormBuilder($thirdKit)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Kup!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form['quantity']->getData();
            $thirdKit->setQuantity($data);
            $thirdKits->setQuantity($thirdKits->getQuantity() - $thirdKit->getQuantity());

            $em->persist($thirdKits);
            $em->flush();

            return $this->redirectToRoute('shoppingCart');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

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

    public function awayCreateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $away = new Away();
        $away->setName('Wyjazdowy');
        $away->setQuantity(50);
        $away->setPrice(249);

        $em->persist($away);
        $em->flush();

        return new Response('Saved new awayKits with ID ' . $away->getId());
    }

    /**
     * @Route("/add")
     */
    public function thirdCreateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $third = new Third();
        $third->setName('Trzeci');
        $third->setQuantity(25);
        $third->setPrice(349);

        $em->persist($third);
        $em->flush();

        return new Response('Saved new thirdKits with ID ' . $third->getId());
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
        $shirts = $em->getRepository(Shirts::class)->find($shirtsID);

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

    /**
     * @Route("/edit/updateAwayKits")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getUpdateAwayKits(Request $request)
    {
        $awayID = 1;
        $em = $this->getDoctrine()->getManager();
        $away = $em->getRepository(Away::class)->find($awayID);

        $form = $this->createFormBuilder($away)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Zaktualizuj'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create the user

            $em->persist($away);
            $em->flush();

            return $this->redirectToRoute('edit');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit/updateThirdKits")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getUpdateThirdKits(Request $request)
    {
        $thirdID = 1;
        $em = $this->getDoctrine()->getManager();
        $third = $em->getRepository(Third::class)->find($thirdID);

        $form = $this->createFormBuilder($third)
            ->add('name', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Zaktualizuj'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create the user

            $em->persist($third);
            $em->flush();

            return $this->redirectToRoute('edit');
        }

        return $this->render('default/update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}