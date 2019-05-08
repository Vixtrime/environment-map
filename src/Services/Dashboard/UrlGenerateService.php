<?php


namespace App\Services\Dashboard;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UrlGenerateService extends AbstractController
{

    private $router,
        $routes = ['dashboard_main', 'registration'],
        $urlArray = [];


    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }


    public function GenerateUrlArray()
    {
        foreach ($this->routes as $route) {
            $this->urlArray[$route] = $this->router->generate($route, [], UrlGeneratorInterface::ABSOLUTE_URL);
        }
        return $this->urlArray;
    }
}
