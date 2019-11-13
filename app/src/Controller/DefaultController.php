<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/contact", name="submit_contact_form", methods={"POST"})
     */
    public function submitContactForm(Request $request)
    {
        $post = $request->request;

        $name = $post->get('name');
        $email = $post->get('email');
        $subject = $post->get('subject');
        $message = $post->get('message');

        $headers = 'From: ' . $name . ' <' . $email . ">\r\n" . 'Reply-To: ' . $email;

        mail('me@abgeo.dev', $subject, $message, $headers);

        return $this->redirectToRoute('contact');
    }
}
