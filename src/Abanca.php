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
    public function __constructor($key) {
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
    public function getSignature(Payment $payment) {
        return $payment->getSignature($this->key);
    }
}