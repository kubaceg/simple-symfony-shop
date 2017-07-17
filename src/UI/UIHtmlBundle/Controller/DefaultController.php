<?php

namespace UIHtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UI\UIHtmlBundle\Form\CartType;
use UI\UIHtmlBundle\Model\CartItems;

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

        $arrayCollection = new CartItems($cartProducts);
        $form = $this->createForm(CartType::class, $arrayCollection, [
            'action' => $this->generateUrl('ui_html_cart_update'),
        ]);

        return $this->render('@UIHtml/Default/cart.html.twig',
            ['cartCount' => $cartCount, 'form' => $form->createView(), 'products' => $cartProducts]);
    }

    public function addToCartAction($productId)
    {
        $product = $this->get('shop.product_query')->getProductById($productId);
        $this->get('shop.cart_service')->addProductToCart($product);

        return $this->redirectToRoute('ui_html_homepage');
    }

    public function cartUpdateAction(Request $request)
    {
        $cartData = $request->get('cart');
        if (is_array($cartData)) {
            $cartService = $this->get('shop.cart_service');
            $productsToDelete = [];
            foreach ($request->get('cart')['items'] as $id => $item) {
                if ($item['delete'] == 1) {
                    $productsToDelete[] = $id;
                }
            }
            $cartService->removeProductsFromCart($productsToDelete);
        }

        return $this->redirectToRoute('ui_html_cart');
    }
}
