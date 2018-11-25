<?php
namespace App\Controller;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Created by PhpStorm.
 * User: Amine
 * Date: 21/11/2018
 * Time: 22:17
 */
class HomeController
{
    /**
     * @var Environment
     */
    private $_twig;

    public function __construct(Environment $twig)
    {
        $this->_twig = $twig;

    }

    /**
     * @param PropertyRepository $propertyRepository
     * @return Response
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findLatest();
        return new Response($this->_twig->render('pages/home.html.twig',
            ['properties'=>$properties]));
    }
}