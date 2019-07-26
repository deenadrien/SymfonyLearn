<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index()
    {
        $property = new Property();
        $property->setTitle('Belle maison')
            ->setPrice(245000)
            ->setRooms(4)
            ->setBedrooms(3)
            ->setDescription('Nulla facilisi. Praesent tempor eros et tempus tristique. Aliquam auctor lectus vulputate scelerisque molestie. Integer ac arcu non augue viverra ultrices. Vestibulum eleifend convallis enim, eu mollis justo interdum vel. Suspendisse scelerisque dictum blandit. Morbi pharetra tincidunt enim, in egestas turpis scelerisque et. Sed faucibus dui non ultricies egestas. Nullam pulvinar quam luctus nisi iaculis, a imperdiet odio dignissim. Vestibulum pharetra, turpis a imperdiet elementum, urna tortor finibus eros, ac ultricies mauris libero in felis.
            Sed velit risus, tincidunt et molestie sed, iaculis ut sem. Maecenas id dapibus libero, ac egestas magna. Suspendisse vitae nulla vitae quam dapibus imperdiet. Integer nec mi eu nisi fermentum accumsan ac sit amet magna. Mauris lorem justo, gravida congue ultricies eget, sollicitudin in neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut neque dui, placerat ut malesuada vel, tristique sed ex. Donec sed urna justo. Ut sodales libero in justo mattis mattis. Phasellus id ligula non velit fringilla varius. Donec in condimentum arcu. Phasellus imperdiet neque vel massa porta sagittis. Nunc quis feugiat nunc, vitae fermentum massa. Cras maximus sapien eget ipsum accumsan placerat.')
            ->setSurface(150)
            ->setFloor(0)
            ->setHeat(1)
            ->setCity('Teteghem')
            ->setAddress('Rue Jean Moulin')
            ->setPostalCode('59229');

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();
    
        $property = $this->repository->findAllVisible();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'controller_name' => 'PropertyController',
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */

     public function show(Property $property, string $slug)
     {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'controller_name' => 'PropertyController',
            'property' => $property
        ]);
     }
    
}
