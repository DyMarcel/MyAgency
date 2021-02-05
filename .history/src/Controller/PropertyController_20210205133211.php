<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;



class PropertyController extends AbstractController
{
    /**
     * @var propertyRepository
     */
    private $repository;
    /**
     * @var entityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {   
                /*création du formulaire de recherche*/
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        
                /* recupére les property et les affiche dans une pagination*/

        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);   
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);


        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
            'id' => $property->getId(),
            'slug' => $property->getSlug()
            ], 301  );
        }
        return $this->render('property/show.html.twig', [
            'property' =>$property,
            'current_menu'=> 'properties',
            'form' => $form->createView()
        ]);
    }
    
}