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
use AppBundle\Entity\TypeConge;
//formType
use AppBundle\Form\TypeCongeType;


class TypeCongeController extends Controller
{

    public function listeAction(Request $request)
    {
        $form = $this->createForm(new TypeCongeType());

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TypeConge')->findBy(array(), array('id'=>'DESC'));
        
        return $this->render('AppBundle:Admin/TypeConge:liste.html.twig', array(
                'entities' => $entities,
                'form' => $form->createView(),
            )
        );
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


    public function creerAction(Request $request)
    {
        $entity = new TypeConge();

        $form = $this->createForm(new TypeCongeType(), $entity);
        if ($request->isXmlHttpRequest()) {
            if ($request->getMethod() == 'POST') {
                $form->handleRequest($request);

                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('success', 'TypeConge est ajouté.');
                    $response = new JsonResponse();
                    return $response;
                }
                else{
                    $view = $this->renderView(
                        'AppBundle:Admin:erreurs-form.html.twig', array(
                            'data' => $this->getErrorMessages($form),
                        )
                    );
                    $response = new JsonResponse(array(
                        'view' => $view,
                        'result' => 0,
                        'message' => 'Formulaire non nvalide',
                    ));
                    return $response;
                }
            }
       }

    }


    public function modifierAction(TypeConge $entity,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new TypeCongeType(), $entity);

        if ($request->isXmlHttpRequest() and $request->getMethod() == 'GET') {
            $view = $this->renderView('@App/Admin/TypeConge/form.html.twig', array(
                'form' => $form->createView(),
                'id' => $entity->getId()
            ));
            $response = new JsonResponse(array('view' => $view));
            return $response;

        }
        if ($request->getMethod() == 'POST') {
            if ($request->isXmlHttpRequest()) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $em->persist($entity);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Modification est terminé.');
                    $response = new JsonResponse();
                    return $response;
                }
                else{
                    $view = $this->renderView(
                        'AppBundle:Admin:erreurs-form.html.twig', array(
                            'data' => $this->getErrorMessages($form),
                        )
                    );
                    $response = new JsonResponse(array(
                        'view' => $view,
                        'result' => 0,
                        'message' => 'Formulaire non nvalide',
                    ));
                    return $response;
                }
            }
        }

    }


    public function supprimerAction(Request $request, TypeConge $entity)
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


}