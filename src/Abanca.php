<?php

namespace Qubiotech\TPV;

use Qubiotech\TPV\Abanca\Payment;

class Abanca {

    /**
     * Service endpoint
     *
     * @var string
     */
    protected $endpoint = 'http://tpv.ceca.es:8000/cgi-bin/tpv';

    /**
     * encryption key
     *
     * @var string
     */
    protected $key = '';

    /**
     * Main constructor
     *
     * @param string $key encryption key
     */
    public function __construct($key) {
        $this->key = $key;
    }

    /**
     * Returns the url to the payment gateway
     *
     * @return string
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     * Returns the signature
     *
     * @param Payment $payment
     * @return string
     */
    public function toArray(Payment $payment) {
        return array_merge(
            $payment->toArray(),
            ['Cadena_sha1' => $payment->getSignature($this->key)]
        );
    }
}