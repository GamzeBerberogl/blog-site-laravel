<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_post')
                    ->with([
                        'postTitle' => $this->post->title,
                        'postUrl' => url('/posts/'.$this->post->id),
                    ])
                    ->subject('New Post Published: ' . $this->post->title);
    }
}
