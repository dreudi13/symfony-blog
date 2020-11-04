<?php
declare(strict_types=1);

namespace App\Controller\Front\Home;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
* @Route("/", name="front_home")
 */
class IndexController
{
    private Environment $renerder;

    public function __construct(Environment $renerder)
    {
        $this->renerder = $renerder;
    }

    public function __invoke(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return new Response(
            $this->renerder->render('front/home/index.html.twig', compact('articles'))
        );
    }
}
