<?php

namespace UIHtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $products = $this->get('shop.product_query')->getAllProducts();
        $cartCount = $this->get('shop.cart_service')->countProductsInCart();

        return $this->render('@UIHtml/Default/list.html.twig', ['products' => $products, 'cartCount' => $cartCount]);
    }

    public function cartAction()
    {
        $cartProducts = $this->get('shop.cart_service')->getCartProducts();
        $cartCount = $this->get('shop.cart_service')->countProductsInCart();

        return $this->render('@UIHtml/Default/cart.html.twig', ['products' => $cartProducts, 'cartCount' => $cartCount]);
    }

    public function addToCartAction($productId)
    {
        $product = $this->get('shop.product_query')->getProductById($productId);
        $this->get('shop.cart_service')->addProductToCart($product);

        return $this->redirectToRoute('ui_html_homepage');
    }

    public function removeFromCartAction($productId)
    {
        $this->get('shop.cart_service')->removeProductFromCart($productId);

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
