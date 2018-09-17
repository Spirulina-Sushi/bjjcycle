<?php
namespace App\Form;

use App\Entity\Position;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class)
        ->add('email', EmailType::class)
        ->add('Password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ))
        ->add('joinDate', DateType::class, array(
            'label' => 'Join Date'))
        ->add('m_sesh_per_week', IntegerType::class, array(
            'label' => 'Maintenance',
            'data' =>'1'
            ))
        ->add('m_sesh_per_variant', IntegerType::class, array(
            'label' => 'Maintenance',
            'data' =>'1'
        ))
        ->add('f_sesh_per_week', IntegerType::class, array(
            'label' => 'Focus',
            'data' =>'1'
        ))
        ->add('f_sesh_per_variant', IntegerType::class, array(
            'label' => 'Focus',
            'data' =>'1'
        ))
        ->add('currentPositionGround', EntityType::class, array(
            'label' => 'Current Starting Position',
            'class' => Position::class,
            //'choices' => $name->getName()
        ))
        ->add('currentPositionStanding', EntityType::class, array(
            'label' => 'Current Starting Position',
            'class' => Position::class,
            //'choices' => $name->getName()
        ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}