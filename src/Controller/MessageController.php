<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function message(Request $request)
    {
        $message = new Post();
        //Itt épül fel a kapcsolat form
        $form = $this->createFormBuilder($message)
            ->add('name', TextType::class, ['label' => 'Név:'])
            ->add('email', EmailType::class, ['label' => 'E-mail:'])
            ->add('message', TextareaType::class, ['label' => 'Üzenet:'])
            ->add('send', SubmitType::class, ['label' => 'Küldés'])
            ->getForm();


        $form->handleRequest($request);

        //A Küldés gombra kattintva fut le
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success','Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.');
            //Nincs szükség a hiba üzenetre, mivel required az összes input mező
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}