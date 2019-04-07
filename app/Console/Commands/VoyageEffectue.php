<?php

namespace App\Console\Commands;

use App\Mail\SendAddTestimonialsMail;
use App\Models\ItemOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class VoyageEffectue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyage:effectue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envois un mail pour demander à l\'utilisateur de commenter son vol de la veille';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //Récupère la liste des itemOrder avec la relation mainOrder
        $itemsOrder = ItemOrder::with('mainOrder')->get();

        //itère sur la liste
        foreach ($itemsOrder as $itemOrder)
        {
            //si la date de son voyage était hier
            if($itemOrder->date_voyage->eq(Carbon::yesterday())){
                //On envoie un mail en utilisant la relation mainOrder et la relation user de mainOrder pour trouver le mail de l'utilisateur
                Mail::to($itemOrder->mainOrder->user->email)
                    ->bcc('jay.ayamee@gmail.com')
                    ->send(new SendAddTestimonialsMail($itemOrder));
            }
        }
    }
}
