<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email as SymfonyEmail;
use Symfony\Component\Mime\Part\DataPart;

class AdmissionInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    private const LOGO_CID = 'ict-logo@ict.com';

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $program,
        public readonly ?string $logoPath = null,
    ) {
        if ($this->logoPath) {
            $this->withSymfonyMessage(function (SymfonyEmail $message): void {
                $logo = DataPart::fromPath($this->logoPath, basename($this->logoPath));
                $logo->asInline()->setContentId(self::LOGO_CID);
                $message->addPart($logo);
            });
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nueva solicitud de admisión: {$this->program}",
            replyTo: [new Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admission-inquiry',
            with: [
                'applicantName' => $this->name,
                'applicantEmail' => $this->email,
                'applicantPhone' => $this->phone,
                'programName' => $this->program,
                'logoCid' => self::LOGO_CID,
                'hasLogo' => $this->logoPath !== null,
            ],
        );
    }
}
