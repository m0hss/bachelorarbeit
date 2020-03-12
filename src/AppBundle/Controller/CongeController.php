<?php
namespace AppBundle\Controller;

use AppBundle\Entity\EtatConge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
// entities
use AppBundle\Entity\Conge;

//formType
use AppBundle\Form\CongeType;
use AppBundle\Form\CongeEditType;

class CongeController extends Controller
{


    public function listeDemandesCogesAction()
    {
        $departement = $this->getUser()->getDepartement();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Conge')->listeDemandesConge($departement);
        $employesEnConge = $em->getRepository('AppBundle:Conge')->listeEmployesEnConge($departement);

        return $this->render(
            'AppBundle:Admin/Conge:gestion_conges.html.twig',
            array(
                'entities' => $entities,
                'employesEnConge' => $employesEnConge,

            )
        );
    }



    /* Actions pour les employés */

    public function congesAction()
    {
        return $this->render('AppBundle:Admin/Conge:conges.html.twig');
    }

    public function demanderAction(Request $request)
    {
        //$securityContext = $this->container->get('security.context');

        $user = $this->getUser();
        $securityContext = $this->container->get('security.context');
        $em = $this->getDoctrine()->getManager();
        $conge = new Conge();
        $etat = $em->getRepository('AppBundle:EtatConge')->find(1);

        $form = $this->createForm(new CongeType($securityContext), $conge);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $conge->setDemandeur($user);
                $conge->setEtat($etat);
                $em->persist($conge);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Demande envoyé.');

                return $this->redirect($this->generateUrl('admin_mes_conges'));
            }
        }
    }

    public function modifierAction(Request $request, Conge $conge)
    {

        $securityContext = $this->container->get('security.context');
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CongeEditType($securityContext), $conge);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em->persist($conge);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Modification terminé.');

                return $this->redirect($this->generateUrl('admin_mes_conges'));
            }
        }
        return $this->render('@App/Admin/Conge/modifier.html.twig', array(
            'form'=> $form->createView(),
        ));
    }

    public function mesCongesAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Conge')->mesConge($user);

        return $this->render(
            'AppBundle:Admin/Conge:mes_conges.html.twig',
            array(
                'entities' => $entities,

            )
        );
    }

    public function mesDemandesRemplacementAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Conge')->findBy(array('remplaceur' => $user), array('id' => 'DESC'));

        return $this->render(
            'AppBundle:Admin/Conge:mes_demandes_remplacement.html.twig',
            array(
                'entities' => $entities,
            )
        );
    }

    public function formDemandeAction()
    {
        $securityContext = $this->container->get('security.context');
        $form = $this->createForm(new CongeType($securityContext));

        return $this->render(
            'AppBundle:Admin/Conge:demander.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * @ParamConverter("conge", options={"mapping": {"id_conge":"id"}})
     * @ParamConverter("etatConge", options={"mapping": {"id_etat":"id"}})
     */
    public function etatAction(Request $request, Conge $conge, EtatConge $etatConge)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $conge->setEtat($etatConge);

            $em->flush();
            $response = new JsonResponse();

            return $response;
        }
    }

    public function supprimerAction(Request $request, Conge $entity)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Suppresion avec succées.');
            $response = new JsonResponse();
            return $response;
        }
    }

    public function verifierAction(Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $typeConge = $request->query->get('typeConge');


        $type = $em->getRepository('AppBundle:TypeConge')->find($typeConge);

        $total = $em->getRepository('AppBundle:Conge')->verifier($user, $typeConge);
        $rest = $type->getNbJours()-$total;

        $view = $this->renderView('@App/Admin/Conge/verification.html.twig', array(
            'total' => $total,
            'type'=>$type,


        ));
        $response = new JsonResponse(array('ok' => $view, 'total'=>$total, 'rest'=>$rest));
        return $response;

    }

}