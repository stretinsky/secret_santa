<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ShuffleService
{
    public function getMails(array $persons)
    {
        $mails = [];

        shuffle($persons);

        for ($i = 1; $i < count($persons) + 1; $i++) {

            $santa = $persons[$i - 1];

            if ($i == count($persons)) {
                $recipient = $persons[0];
            } else {
                $recipient = $persons[$i];
            }
            
            $mails[] = [
                'email' => $santa['email'],
                'subject' => "Тайный Санта",
                'message' => "<p>Привет, {$santa['name']}. С наступающим тебя новым годом. Ты должен поздравить {$recipient['name']}.</p>"
            ];
        }

        return $mails;
    }
}
