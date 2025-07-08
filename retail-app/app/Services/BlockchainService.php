<?php

namespace App\Services;

use Web3\Web3;
use Web3p\EthereumTx\Transaction;
use App\Models\Sale;

class BlockchainService
{
    protected $web3;
    protected $defaultAccount;

    public function __construct()
    {
        $this->web3 = new Web3(config('blockchain.rpc_url'));
        $this->defaultAccount = config('blockchain.default_account');
    }

    public function registerSale(Sale $sale)
    {
        $senderAddress = env('GANACHE_SENDER_ADDRESS');

        $this->web3->eth->sendTransaction([
            'from' => $senderAddress,
            'to' => $this->defaultAccount,
            'value' => '0x0',
            'data' => '0x' . bin2hex(json_encode($sale->toArray())),
        ], function ($err, $tx) {
            if ($err) {
                throw new \Exception("Transaction error: " . $err->getMessage());
            }
        });
    }
}
