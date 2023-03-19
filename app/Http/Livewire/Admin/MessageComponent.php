<?php

namespace App\Http\Livewire\Admin;

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use App\Notifications\SendMailNotification;
use Bavix\Wallet\Test\Models\Item;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class MessageComponent extends Component
{
    public $title, $body,$channel, $group, $shop_id,$active, $send_time;
    public $channels = ['firebase','email','sms'];
    public $editMode= false;
    public $search = '';
    public $perPage = 15;

    public function mount($shop=null)
    {
        $this->shop_id = $shop;
    }
    public function render()
    {
        if ($this->shop_id)
        {
            $items = Message::where('shop_id', $this->shop_id)->latest()->simplePaginate($this->perPage);
        }else{
            $items = Message::search($this->search)
                ->latest()
                ->simplePaginate($this->perPage);
        }
        return view('livewire.admin.message-component',[
            'items'=> $items
        ]);
    }

    public function sendFirebase($mess)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAB5uVMxc:APA91bF2M7w-Ro_aQuygimoO8_fOLBHkwXt2IGykUeTgq4XJF5vFS6zu9o4IGm5F-OWFfGlALB3OThWo8cNufH8A-hsWsH6feM-g4-jpmVWppL144mNF5-JE33eS8AX8EPaXcLBMK-EI';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $mess['title'],
                "body" =>  $mess['body'],
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }

    public function resetAll()
    {
        $this->body ='';
        $this->title ='';
        $this->channel ='';
    }

    public function edit($item)
    {
        $this->body =$item['body'];
        $this->title =$item['title'];
        $this->channel =$item['channel'];
        $this->active =$item['id'];
        $this->editMode =  true;
    }

    public function save()
    {
        if ($this->editMode == true)
        {
            $mess = Message::find($this->active);
        }else{
            $mess = new Message();
        }


        $mess->title = $this->title;
        $mess->channel = $this->channel;
        $mess->body = $this->body;
        $mess->send_time = $this->send_time;
        if ($this->shop_id)
        {
            $mess->shop_id = $this->shop_id;
        }
        $mess->save();
        $this->resetAll();
        $this->emit('created');
    }

    public function sendSms($mess)
    {

        $users = User::where('type','customer')->where('status','active')->get();
        Notification::send($users, new NewMessageNotification($mess['body']));
    }

    public function send($item)
    {
        foreach ($item['channel']  as $channel)
        {
            if ($channel == 'email')
            {
                $this->sendEmail($item);
            }
            if ($channel == 'firebase')
            {
                $this->sendFirebase($item);
            }
            if ($channel == 'sms')
            {
                $this->sendSms($item);
            }
        }



        $this->emit('message','Messages Queued');
    }

    public function sendEmail($mess)
    {
        $users = User::where('type','customer')->get();
        Notification::send($users, new SendMailNotification($mess['body']));
    }
}
