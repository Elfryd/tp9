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
    public function new_(Request $request) { //persist
        $userCard = $this->get(\App\Entity\UserCard::class);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userCardEvent = $this->get('app.userCard.event');
            $userCardEvent->setUserCard($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_ADD, $userCardEvent);
            return $this->redirectToRoute('app_userCard_index');
        }
        return $this->render('userCard/userCard_new.html.twig',array('form' => $form->createView()));
    }

    public function edit($id, Request $request) {
        $userCard = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->find($id);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userCardEvent = $this->get('app.userCard.event');
            $userCardEvent->setPlayer($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_EDIT, $userCardEvent);
            return $this->redirectToRoute('app_userCard_index');
        }
        return $this->render('userCard/userCard_edit.html.twig',array('form' => $form->createView()));
    }

    public function index() { //list
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Player::class);
        $tabPlayers = $repo->findAll();
        return $this->render('userCard/userCard_index.html.twig',array('tabPlayers' => $tabPlayers));
    }

    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Player::class);
        $userCard = $repo->find($id);
        return $this->render('userCard/userCard_show.html.twig',array('userCard' => $userCard));
    }
}