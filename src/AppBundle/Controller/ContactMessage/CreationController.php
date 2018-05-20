<?php

namespace AppBundle\Controller\ContactMessage;


use AppBundle\Entity\ContactMessage;
use AppBundle\Form\Type\ContactMessage\ContactMessageCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createContactMessageAction(Request $request)
    {
        $contactMessage = new ContactMessage();

        $form = $this->createForm(ContactMessageCreationType::class, $contactMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactMessage);
            $em->flush();

            $form = $this->createForm(ContactMessageCreationType::class, new ContactMessage());
        }

        return $this->render('@Page/ContactMessage/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
