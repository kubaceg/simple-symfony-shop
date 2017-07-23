<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace UI\UIHtmlBundle\Form;


use ShopBundle\ReadModel\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemClass extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('qty', IntegerType::class, [
            'label' => 'Qty'
        ]);

        $builder->add('delete', CheckboxType::class, [
            'mapped' => false,
            'label' => 'Delete',
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CartItem::class,
        ));
    }
}