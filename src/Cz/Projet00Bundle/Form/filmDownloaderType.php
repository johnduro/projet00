<?php

namespace Cz\Projet00Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class filmDownloaderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',           'text')
            ->add('type',           'choice', array(
                'choices' => array(
                    "film" => "film",
                    "serie" => "série",
                    "jeux video" => "jeux vidéos")))
            ->add('file',           'file')
            ->add('comment',        'textarea')
            ->add('Telecharger',           'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cz\Projet00Bundle\Entity\filmDownloader'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cz_projet00bundle_filmdownloader';
    }
}
