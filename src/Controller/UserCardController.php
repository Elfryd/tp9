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
     * @Route("/user/new", name="app_user_new")
     */
    public function new_(Request $request) { //persist
        $user = $this->get(\App\Entity\UserCard::class);
        $form = $this->createForm(UserCardType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userEvent = $this->get('app.userCard.event');
            $userEvent->setPlayer($user);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::PLAYER_ADD, $userEvent);
            return $this->redirectToRoute('app_user_index');
        }
        return $this->render('user/user_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/user/edit/{id}", name="app_user_edit")
     */
    public function edit($id, Request $request) {
        $user = $this->getDoctrine()->getManager()->getRepository(\App\Entity\UserCard::class)->find($id);
        $form = $this->createForm(UserCardType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userEvent = $this->get('app.user.event');
            $userEvent->setPlayer($user);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USER_CARD_EDIT, $userEvent);
            return $this->redirectToRoute('app_user_index');
        }
        return $this->render('user/user_edit.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/user/index", name="app_user_index")
     */
    public function index() { //list
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Player::class);
        $tabPlayers = $repo->findAll();
        return $this->render('user/user_index.html.twig',array('tabPlayers' => $tabPlayers));
    }

    /**
     * @return Response
     * @Route("/user/show/{id}", name="app_user_show")
     */
    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Player::class);
        $user = $repo->find($id);
        return $this->render('user/user_show.html.twig',array('user' => $user));
    }
}