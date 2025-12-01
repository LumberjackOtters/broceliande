<?php

namespace App\Menu;

// use App\Entity\Blog;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RequestStack;

final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function mainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_home']);

        // access services from the container!
        // $em = $this->container->get('doctrine')->getManager();
        // // findMostRecent and Blog are just imaginary examples
        // $blog = $em->getRepository(Blog::class)->findMostRecent();

        $menu->addChild('Latest Blog Post', [
            'route' => 'app_groups'
            // 'routeParameters' => ['id' => 2]
        ]);

        // create another menu item
        $menu->addChild('About Me', ['route' => 'app_home']);
        // you can also add sub levels to your menus as follows
        // $menu['About Me']->addChild('Edit profile', ['route' => 'edit_profile']);

        // ... add more children

        return $menu;
    }
}