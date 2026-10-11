<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TrainingQuestionnaireMail extends Mailable
{
    public array $answers;

    public array $questions;

    public string $submittedAt;

    public function __construct(array $answers)
    {
        $this->answers = $answers;
        $this->questions = config('training.questions');
        $this->submittedAt = now('Asia/Riyadh')->format('Y/m/d H:i');
    }

    public function build(): self
    {
        return $this
            ->from(config('training.from.address'), config('training.from.name'))
            ->replyTo($this->answers['email'], $this->answers['name'])
            ->subject('استكمال إجراءات التدريب | '.$this->answers['name'])
            ->view('emails.training-questionnaire')
            ->text('emails.training-questionnaire-text');
    }
}
