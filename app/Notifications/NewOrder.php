<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use ExcitedCat\WechatNotification\WechatChannel;

class NewOrder extends Notification
{
    use Queueable;

    public $data;
    public $color;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
        $this->color = '#173177'
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WechatChannel::class];
    }

    public function toWechat($notifiable)
    {
        $data = $this->data;

        $notice = [
            'templateId' => '9QvJcvZNqaLgpuN4YGvXqi-8OLJkhzJZpddsc******',
            'url' => 'https://your-domain.com/',
            'data'        => [
                'first'    => '订单已创建成功',
                'keyword1' => $data->order_id,
                'keyword2' => $data->product_name,
                'keyword3' => $data->price,
                'remark'   => '订单创建成功，我们正在安排发货...'
            ]
        ];

        return $notice;
    }
}
