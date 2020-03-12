<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Form;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
// entities
use AppBundle\Entity\Stage;
//formType
use AppBundle\Form\StageType;


class StageController extends Controller
{
    public function listeStagesAction()
    {
        $departement = $this->getUser()->getDepartement();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Stage')->listeStage($departement);
        $etudiantsEnStage = $em->getRepository('AppBundle:Stage')->etudiantsEnStage($departement);
        return $this->render(
            'AppBundle:Admin/Stage:gestion_stages.html.twig',
            array(
                'entities' => $entities,
                'etudiantsEnStage'=>$etudiantsEnStage
            )
        );
    }


    public function voirAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Stage')->find($id);
        $view = $this->renderView(
            'AppBundle:Admin/Stage:voir.html.twig',
            array(
                'entity' => $entity,
            )
        );
        $response = new JsonResponse(
            array(
                'view' => $view,

            )
        );

        return $response;

    }

    public function getErrorMessages(\Symfony\Component\Form\Form $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }


    public function demanderAction(Request $request)
    {
        $entity = new Stage();

        $form = $this->createForm(new StageType(), $entity);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();


                return $this->redirectToRoute('demander_satage_ok');
            }

        }
        return $this->render(
            '@App/Admin/Stage/demander.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    public function demanderOkAction()
    {
        return $this->render('@App/Admin/Stage/demander-ok.html.twig');
    }

    public function supprimerAction(Request $request, Stage $entity)
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

    public function validerAction(Request $request, Stage $entity)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $entity->setValider(true);
            $entity->setTraiter(true);
            $em->flush();
            //envoi email
            $this->get('session')->getFlashBag()->add('success', 'Le stage est validé.');
            $response = new JsonResponse();

            return $response;
        }
    }

    public function refuseAction(Request $request, Stage $entity)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setTraiter(true);
            $em->flush();
            //envoi email
            $this->get('session')->getFlashBag()->add('success', 'Le stage est réfusé.');
            $response = new JsonResponse();

            return $response;
        }
    }
}