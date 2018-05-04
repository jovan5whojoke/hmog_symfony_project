<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/products")
 */
class ProductController extends Controller
{

    /**
     * @Route("/", name="list_products")
     */
    public function listProducts(ProductRepository $repository): Response
    {
        return $this->render('products/list.html.twig', [
            'products' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create_product")
     * @param Request $request
     * @return Response
     */
    public function addUser(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('list_products');
        }

        return $this->render('products/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_product")
     *
     */
    public function edit(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('list_products');
        }

        return $this->render('products/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
