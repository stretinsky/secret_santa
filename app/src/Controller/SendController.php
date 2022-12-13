<?php 

namespace App\Controller;

use App\Service\ShuffleService;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendController extends AbstractController
{
    /**
     * @Route("/send", methods={"POST"})
     */
    public function index(Request $request, MailerInterface $mailer, ShuffleService $shuffleService)
    {
        // знаю так делать плохо, но в $request->request->all() пустой
        // stackoverflow говорит использовать https:// вместо http://
        $data = json_decode($request->getContent(), true);
        $mails = $shuffleService->getMails($data);

        foreach ($mails as $mail) {
            $email = (new Email())
                ->from('company@company.com')
                ->to($mail['email'])
                ->subject($mail['subject'])
                ->html($mail['message'])
                ->priority(Email::PRIORITY_HIGH);

            $mailer->send($email);
        }

        return new JsonResponse(['success' => true]);
    }   
}