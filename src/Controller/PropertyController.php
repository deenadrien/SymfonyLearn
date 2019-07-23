<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */

    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index()
    {
        /*$property = new Property();
        $property->setTitle('Première annonce')
            ->setPrice(200000)
            ->setRooms(4)
            ->setBedrooms(3)
            ->setDescription('Une description')
            ->setSurface(70)
            ->setFloor(5)
            ->setHeat(1)
            ->setCity('Dunkerque')
            ->setAddress('Place de la République')
            ->setPostalCode('59640');

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();*/

        $property = $this->repository->findAll();

        dump($property);

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'controller_name' => 'PropertyController',
        ]);
    }
}
