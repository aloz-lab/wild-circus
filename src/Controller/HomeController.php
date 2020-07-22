<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     * @return Response
     */
    public function index() :Response
    {
        return $this->render('/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function contact(Request $request, MailerInterface $mailer) :Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                //->from('mafomation.life@gmail.com')
                //->to($contact->getEmail())
                //->cc('mafomation.life@gmail.com')
                ->from($this->getParameter('mailer_from'))
                ->to('newuser@example.com')
                ->subject($contact->getObject())
                ->htmlTemplate('notification.html.twig')
                ->context(['contact' => $contact]);
            $mailer->send($email);
            /*$this->addFlash('success', 'Votre mail a bien été envoyé !');*/

            return $this->redirectToRoute('home_index');
        }

        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}