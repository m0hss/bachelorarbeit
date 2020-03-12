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
use UserBundle\Entity\User as Employe;
//formType
use AppBundle\Form\EmployeType;
use AppBundle\Form\EmployeEditType;
use AppBundle\Form\EmployeEditMdpType;
use AppBundle\Form\EmployeRechercheType;

class EmployeController extends Controller
{

    public function rechercheAction(Request $request)
    {
        $form = $this->createForm(new EmployeRechercheType());

        $em = $this->getDoctrine()->getManager();

        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');
        $username = $request->query->get('username');
        $sexe = $request->query->get('sexe');
        $cin = $request->query->get('cin');
        $fonction = $request->query->get('fonction');
        $departement = $request->query->get('departement');

        $entities = $em->getRepository('UserBundle:User')->recherche(
            $nom,
            $prenom,
            $username,
            $sexe,
            $cin,
            $fonction,
            $departement
        );

        if ($request->isXmlHttpRequest()) {
            $view = $this->renderView(
                'AppBundle:Admin/Employe:liste.html.twig',
                array(
                    'entities' => $entities,
                    'form' => $form->createView(),
                )
            );
            $response = new JsonResponse(array('ok' => $view));

            return $response;
        }

        return $this->render(
            'AppBundle:Admin/Employe:liste.html.twig',
            array(
                'entities' => $entities,
                'form' => $form->createView(),
            )
        );

    }

    public function listeAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $entities = $em->getRepository('UserBundle:User')->find(1);
        //$user->addRole('ROLE_ADMIN');
        //$em->flush($user);

        $form = $this->createForm(new EmployeRechercheType());

        $entities = $em->getRepository('UserBundle:User')->liste();

        return $this->render(
            'AppBundle:Admin/Employe:liste.html.twig',
            array(
                'entities' => $entities,
                'form' => $form->createView(),
            )
        );
    }

    public function voirAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UserBundle:User')->find($id);
        $form = $this->createForm(new EmployeEditType(), $entity);
        $form_mdp = $this->createForm(new EmployeEditMdpType(), $entity);

        return $this->render(
            'AppBundle:Admin/Employe:voir.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
                'form_mdp' => $form_mdp->createView(),
            )
        );
    }


    public function creerAction(Request $request)
    {
        $entity = new Employe();

        $form = $this->createForm(new EmployeType(), $entity);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Employe est ajouté.');

                return $this->redirectToRoute('admin_employe_liste');
            }
        }

        return $this->render(
            '@App/Admin/Employe/ajouter.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    public function supprimerAction(Request $request, Employe $entity)
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

    public function activerAction(Request $request, Employe $employe)
    {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            if (false === $employe->isLocked()) {
                $employe->setLocked(true);
            } else {
                $employe->setLocked(false);
            }
            $em->flush();
            $response = new JsonResponse();

            return $response;
        }
    }

    public function modifierAction(Employe $entity, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new EmployeEditType(), $entity);
        $form_mdp = $this->createForm(new EmployeEditMdpType(), $entity);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Modification est terminé.');

                return $this->redirectToRoute(
                    'admin_employe_voir',
                    array(
                        'id' => $entity->getId(),
                    )
                );
            } else {
                return $this->render(
                    'AppBundle:Admin/Employe:modifier.html.twig',
                    array(
                        'entity' => $entity,
                        'id' => $entity->getId(),
                        'form' => $form->createView(),
                        'form_mdp' => $form_mdp->createView(),
                    )
                );
            }

        }

        return $this->render(
            'AppBundle:Admin/Employe:modifier.html.twig',
            array(
                'entity' => $entity,
                'id' => $entity->getId(),
                'form' => $form->createView(),
                'form_mdp' => $form_mdp->createView(),
            )
        );
    }

    public function modifierMdpAction(Employe $entity, Request $request)
    {
        $form = $this->createForm(new EmployeEditType(), $entity);
        $form_mdp = $this->createForm(new EmployeEditMdpType(), $entity);

        if ($request->getMethod() == 'POST') {
            $form_mdp->handleRequest($request);
            if ($form_mdp->isValid()) {
                $userManager = $this->get('fos_user.user_manager');
                $userManager->updateUser($entity);

                $this->get('session')->getFlashBag()->add('success', 'Modification est terminé.');

                return $this->redirectToRoute(
                    'admin_employe_voir',
                    array(
                        'id' => $entity->getId(),
                    )
                );
            } else {

                return $this->render(
                    'AppBundle:Admin/Employe:modifier.html.twig',
                    array(
                        'entity' => $entity,
                        'id' => $entity->getId(),
                        'form' => $form->createView(),
                        'form_mdp' => $form_mdp->createView(),
                    )
                );
            }
        }

    }


}