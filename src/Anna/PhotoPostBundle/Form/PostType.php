<?php

namespace Anna\PhotoPostBundle\Form;

use Anna\PhotoPostBundle\Entity\Post;
use Anna\PhotoPostBundle\Entity\Date;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('description')
                ->add('image', FileType::class, array('data_class' => null))
                ->add('vote', ChoiceType::class, array(
                    'choices'  => array(
                        '0' => 0,
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5
                    ),))    
                // ->add(  'dates', CollectionType::class, array(
                //         'entry_type'   => DatesType::class,
                //         'entry_options'=> [
                //             'label' => false
                //         ],
                //         'by_reference' => false,
                //         'error_bubbling'=>true,
                //         "allow_add" => true,
                //         "allow_delete" => true,
                //         "prototype"=>true,
                //         'required'=>false,
                //         'mapped' =>false
                //         )
                // )
                ->add('createdAt')->add('updatedAt');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'anna_photopostbundle_post';
    }


}
