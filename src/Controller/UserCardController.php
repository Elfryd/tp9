<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:36
 */

namespace App\Controller;

use App\AppEvent;
use App\Entity\UserCard;
use App\Form\UserCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserCardController extends Controller
{
    /**
     * @return Response
     * @Route("/userCard/new/{cardId}", name="userCard_add")
     * function edit
     * @param $cardId
     * @param Request $request
     */
    public function new_($cardId, Request $request) { //persist
        $userCard = $this->get(\App\Entity\UserCard::class);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userCardEvent = $this->get('app.userCard.event');
            echo dump($userCardEvent);
            $userCardEvent->setUserCard($userCard);
            $userCardEvent->setCard($cardId);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_ADD, $userCardEvent);
            return $this->redirectToRoute('userCard_index');
        }
        return $this->render('UserCard/form.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/userCard/edit/{id}", name="UserCard_edit")
     * function edit
     * @param $id
     * @param Request $request
     */
    public function edit($id, Request $request) {
        $userCard = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->find($id);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userCardEvent = $this->get('app.userCard.event');
            $userCardEvent->setUserCard($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_EDIT, $userCardEvent);
            return $this->redirectToRoute('userCard_index');
        }
        return $this->render('UserCard/form.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/userCard/delete/{id}", name="UserCard_delete")
     * function edit
     * @param $id
     * @param Request $request
     */
    public function delete($id, Request $request) {
        $userCard = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->find($id);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userCardEvent = $this->get('app.userCard.event');
            $userCardEvent->setUserCard($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_DELETE, $userCardEvent);
            return $this->redirectToRoute('userCard_index');
        }
        return $this->render('UserCard/form.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/userCard", name="userCard_index")
     * function edit
     * @param Request $request
     */
    public function index(Request $request) {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userCards = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->findBy(array('user' => $user));
        return $this->render('UserCard/index.html.twig',array('UserCards' => $userCards));
    }

//    /**
//     * @return Response
//     * @Route("/userCard/delete/{id}", name="userCard_delete")
//     * function edit
//     * @param $id
//     * @param Request $request
//     */
//    public function index($id, Request $request) {
//        $userCard = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->find($id);
//        $form = $this->createForm(UserCardType::class, $userCard);
//        $form->handleRequest($request);
//        if($form->isSubmitted() && $form->isValid())
//        {
//            $userCardEvent = $this->get('app.userCard.event');
//            $userCardEvent->setUserCard($userCard);
//            $dispatcher = $this->get('event_dispatcher');
//            $dispatcher->dispatch(AppEvent::USER_CARD_DELETE, $userCardEvent);
//            return $this->redirectToRoute('app_userCard_index');
//        }
//        return $this->render('userCard/userCard_edit.html.twig',array('form' => $form->createView()));
//    }
}