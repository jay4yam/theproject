<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 27/01/2019
 * Time: 12:58
 */

namespace App\Repositories;


use App\Models\Message;

class MessageRepository
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getAll()
    {
        return $this->message->with('compagnie')->paginate(10);
    }

    public function store(array $inputs)
    {
        $message = new Message();

        $this->save($message, $inputs);
    }

    private function save(Message $message, array $inputs)
    {
        \DB::transaction(function () use ($message, $inputs){

            $message->email = $inputs['email'];
            $message->visitor_ip = request()->ip();
            $message->message = $inputs['message'];
            $message->compagnie_id = $inputs['compagnie_id'];

            $message->save();

        });
    }
}