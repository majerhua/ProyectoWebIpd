<?php

namespace PruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;





class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        

         $roles_user = ["ROLE_USER"];
         $roles_admin = ["ROLE_ADMIN"];
       ;

        $builder->add('username')
        ->add('email')
        ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
        ))
        ->add('areaIpd')

        /*->add( $builder->create('roles', ChoiceType::class, array(
                'label' => 'I am:',
                'mapped' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'ROLE_NORMAL' => 'Standard',
                    'ROLE_VIP' => 'VIP',
                )
              ))->addModelTransformer($transformer) ) */
        ->add('salvar',SubmitType::class)
        ->add('reset',ResetType::class);


    
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PruebaBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pruebabundle_user';
    }


}
