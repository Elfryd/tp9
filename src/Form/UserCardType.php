<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:13
 */

namespace App\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class UserCardType extends AbstractType
{
    private $user;

    /**
     * UserCardType constructor.
     * @param TokenStorage $token
     */
    public function __construct(TokenStorage $token)
    {
        $this->user = $token->getToken()->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actionPoint', IntegerType::class)
            ->add('attack', IntegerType::class)
            ->add('defence', IntegerType::class)
            ->addEventListener( FormEvents::PRE_SET_DATA,
                array($this, 'preSetData') );
    }

    public function preSetData(FormEvent $event) {
        $cardUser = $event->getData();
        $cardUser->setUser($this->user);
        $form = $event->getForm();
        $form->add('save', SubmitType::class, array('label' => 'Créer'));
    }

}