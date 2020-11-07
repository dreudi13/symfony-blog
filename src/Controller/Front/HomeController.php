<?php
declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


/**
* @Route("/", name="front_home")
 */
class HomeController
{
    private Environment $renerder;

    private ArticleRepository $articleRepository;

    public function __construct(Environment $renerder, ArticleRepository $articleRepository)
    {
        $this->renerder = $renerder;
        $this->articleRepository = $articleRepository;
    }

    public function __invoke(): Response
    {
        $articles = $this->articleRepository->listAllArticlesInDescendingOrder();

        return new Response(
            $this->renerder->render('front/home.html.twig', [
                'articles' => $articles,
            ])
        );
    }
}
