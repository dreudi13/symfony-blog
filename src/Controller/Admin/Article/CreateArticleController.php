<?php
declare(strict_types=1);

namespace App\Controller\Admin\Article;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Environment;

/**
 * @Route("/admin/article", name="admin_article_create", methods={"GET", "POST"})
 */
class CreateArticleController
{
    private Environment $renerder;

    private FormFactoryInterface $formFactory;

    private EntityManagerInterface $manager;

    private RouterInterface $router;

    public function __construct(
        Environment $renerder,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $manager,
        RouterInterface $router,
        CsrfTokenManagerInterface $csrfToken
    ) {
        $this->renerder = $renerder;
        $this->formFactory = $formFactory;
        $this->manager = $manager;
        $this->router = $router;
        $this->csrfToken = $csrfToken;
    }

    public function __invoke(Request $request): Response
    {
        $articleForm = $this->formFactory->create(ArticleType::class, new Article)->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $this->manager->persist($articleForm->getData());
            $this->manager->flush();

            return new RedirectResponse($this->router->generate('front_home'));
        }

        return new Response(
            $this->renerder->render('admin/article/create.html.twig', [
                'article_form' => $articleForm->createView(),
            ])
        );
    }
}
