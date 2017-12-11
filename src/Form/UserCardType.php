<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 11/12/17
 * Time: 14:13
 */

namespace App\Form;


use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserCardType extends AbstractType
{
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
        $form = $event->getForm();
        $form->add('save', SubmitType::class, array('label' => 'Créer'));
    }

}