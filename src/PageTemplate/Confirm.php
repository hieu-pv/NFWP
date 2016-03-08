<?php

namespace App\PageTemplate;

use App\Email\Email;
use App\Models\Order;
use App\Models\Transaction;
use Exception;
use NFWP\Models\NFUser;
use NFWP\PageTemplate\NFPageTemplate;
use StripeAPI;

class Confirm extends NFPageTemplate
{
    public $name = 'NF Ticket Confirmation Page';

    public function __construct()
    {
        $this->view  = __DIR__ . '/../Resources/views';
        $this->cache = __DIR__ . '/../Resources/cache';
        parent::__construct();
    }

    public function view()
    {
        global $post;
        try {
            if (!isset($_GET['token']) || $_GET['token'] == '') {
                throw new Exception("Token not found", 0);
            }
            $transaction = Transaction::where('token', $_GET['token'])->where('stripe_action_id', '')->first();
            if (!isset($transaction)) {
                $check_token = Transaction::where('token', $_GET['token'])->first();
                if (isset($check_token)) {
                    $this->render('page_templates.request_accepted', ['post' => $post]);
                } else {
                    throw new Exception("Token does not match", 0);
                }
            } else {
                $order       = new Order($transaction->order_id);
                $customer_id = $order->user_id;
                $customer    = NFUser::find($customer_id);
                $charge      = [
                    'amount'      => $transaction->amount,
                    'currency'    => get_woocommerce_currency(),
                    'description' => 'Complete charge for ' . $customer->__get('user_email'),
                    'customer'    => $customer->__get(NF_TICKET_USER_META_KEY),
                ];
                $stripe   = new StripeAPI;
                $response = $stripe->charge($charge);
                if (!$response->status == 'succeeded') {
                    throw new Exception("Can not proccess to checkout", 0);
                } else {
                    $transaction->stripe_action_id = $response->id;
                    $transaction->save();
                    $data = [
                        'post'     => $post,
                        'amount'   => $transaction->amount / 100,
                        'currency' => get_woocommerce_currency_symbol(),
                    ];
                    $order->update_status('confirmed', __('Confirmed', 'woocommerce'));
                    $email = new Email;
                    $email->sendFinalConfirmation($customer);
                    $this->render('page_templates.confirm', $data);
                }
            }

        } catch (Exception $e) {
            $data = [
                'post' => $post,
                'e'    => $e,
            ];
            $this->render('page_templates.error', $data);
        }
    }
}
