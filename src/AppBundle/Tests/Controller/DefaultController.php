<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultController extends WebTestCase
{
    public function translationAction($nom)
    {
        return $this->render('AppBundle:Tests/Default:index.html.twig', array(
            'nom' => $nom
        ));
    }



}
