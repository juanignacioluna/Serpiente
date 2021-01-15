<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpClient\HttpClient;

use App\Entity\Jugador;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController{


    /**
      * @Route("/nuevoPuntaje/{nombre}/{puntaje}")
    */
    public function nuevoPuntaje(string $nombre, int $puntaje): Response{


        $entityManager = $this->getDoctrine()->getManager();

        $jugador = $this->getDoctrine()
            ->getRepository(Jugador::class)
            ->findOneBy(['nombre' => $nombre]);

        if(!$jugador){

            $jugador = new Jugador();
            $jugador->setNombre($nombre);
            $jugador->setUltimoPuntaje($puntaje);
            $jugador->setMejorPuntaje($puntaje);

            $entityManager->persist($jugador);

            $entityManager->flush();

        }else{

            $jugador->setUltimoPuntaje($puntaje);
            $entityManager->flush();

            if($puntaje > $jugador->getMejorPuntaje()){

                $jugador->setMejorPuntaje($puntaje);
                $entityManager->flush();

            }

        }

        $jugadores = $this->getDoctrine()->getRepository(Jugador::class)->findAll();



        $arrayJugadores = array();

        foreach($jugadores as $jugador) {
             $arrayJugadores[] = array(
                 'id' => $jugador->getId(),
                 'nombre' => $jugador->getNombre(),
                 'ultimoPuntaje' => $jugador->getUltimoPuntaje(),
                 'mejorPuntaje' => $jugador->getMejorPuntaje(),
             );
        }



        return new JsonResponse($arrayJugadores);

    }


}