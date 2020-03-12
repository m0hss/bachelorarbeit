<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class MenuController extends Controller
{

    /**
     * Menu
     *
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nbFonction = $em->getRepository('AppBundle:Fonction')->createQueryBuilder('c')->select('COUNT(c)')->getQuery(
        )->getSingleScalarResult();


        return $this->render(
            'AppBundle:Admin:menu.html.twig',
            array(
                'nbFonctions' => $nbFonction,
        ));

    }
}