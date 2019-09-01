<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('author')
            ->add('image1',FileType::class,array('data_class'=> null, 'label' => 'Image'))
            ->add('image2',FileType::class,array('data_class'=> null, 'label' => 'Image'))
            ->add('image3',FileType::class,array('data_class'=> null, 'label' => 'Image'))
            ->add('image4',FileType::class,array('data_class'=> null, 'label' => 'Image'))
            ->add('video');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
