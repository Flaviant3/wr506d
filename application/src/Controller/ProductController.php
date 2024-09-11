<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
#[Route('/products', name: 'product_list')]
public function listProducts(): Response
{
return $this->render('product/list.html.twig', [
'title' => 'Liste des produits',
]);
}

#[Route('/product/{id}', name: 'product_view')]
public function viewProduct(Request $request, $id): Response
{
return $this->render('product/view.html.twig', [
'title' => 'Affichage du produit ' . $id,
'id' => $id,
]);
}
}
?>