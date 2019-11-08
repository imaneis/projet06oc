<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content',TextareaType::class)
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
