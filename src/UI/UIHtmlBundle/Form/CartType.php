<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace UI\UIHtmlBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UI\UIHtmlBundle\Model\CartItems;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('items', CollectionType::class, array(
            'entry_type' => CartItemClass::class,
        ));

        $builder->add('submit', SubmitType::class, [
            'label' => 'Update cart',
            'attr' => ['class' => 'btn btn-success']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CartItems::class,
        ));
    }
}