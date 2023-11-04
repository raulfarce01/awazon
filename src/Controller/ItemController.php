<?php

namespace App\Controller;

use App\Entity\Coment;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/item/{id}', name: 'app_item')]
    public function index($id): Response
    {
        $item = $this->em->getRepository(Item::class)->find($id);

        $coments = $this->em->getRepository(Coment::class)->findComents($id);

        return $this->render('item/index.html.twig', [
            'item' => $item,
/*             'custom_item' => $custom_item,
 */         'coments' => $coments
        ]);
    }

    #[Route('/insert/item', name:'insert_item')]
    public function insert()
    {
        $desc = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quidem atque aspernatur recusandae? Maxime, minus ex! Sint dolor velit voluptatibus accusantium nemo beatae harum adipisci, dicta totam obcaecati sapiente eius.";
        $item = new Item("Segundo insert", "M", 9.99, "BNA", $desc); 



        $this->em->persist($item);
        $this->em->flush();

        return new JsonResponse(["success"=> true]);
    }

    #[Route('/update/item/{id}', name:'update_item')]
    public function update($id)
    {
        $desc = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quidem atque aspernatur recusandae? Maxime, minus ex!";
        $item = $this->em->getRepository(Item::class)->find($id);

        $item->setDescription($desc);
        $item->setPrice(5.99);
        $this->em->flush();

        return new JsonResponse(["success"=> true]);
    }

    #[Route('/remove/item/{id}', name:'remove_item')]
    public function remove($id)
    {
    
        $item = $this->em->getRepository(Item::class)->find($id);
        $this->em->remove($item);
        $this->em->flush();

        return new JsonResponse(["success"=> true]);
    }
}
