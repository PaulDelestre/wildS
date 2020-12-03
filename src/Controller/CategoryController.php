<?php
 // src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/categories", name="category_")
 */

class CategoryController extends AbstractController
{
    /**
      * @Route("/", name="index")
      */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)   
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
      * @Route("/{categoryName}", methods={"GET"}, name="show")
      */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findOneBy(['name' => $categoryName]);

        var_dump($category);

        $programs = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findBy(
            ['Category' => $category->getId()],
            ['id' => 'DESC'],
            3
        );

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name : '.$categoryName.' found in category table.'
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);
    }
}
