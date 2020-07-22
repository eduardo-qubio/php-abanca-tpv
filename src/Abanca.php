<?php

namespace Qubiotech\TPV;

use Qubiotech\TPV\Abanca\Payment;

class Abanca {

    /**
     * Service endpoint
     *
     * @var string
     */
    protected $endpoint_dev = 'https://tpv.ceca.es/tpvweb/tpv/compra.action';

    /**
     * Service endpoint
     *
     * @var string
     */
    protected $endpoint_prod = 'https://pgw.ceca.es/tpvweb/tpv/compra.action';

    /**
     * encryption key
     *
     * @var string
     */
    protected $environement = '';

    /**
     * encryption key
     *
     * @var string
     */
    protected $key = '';

    /**
     * Main constructor
     *
     * @param string $environement
     * @param string $key encryption key
     */
    public function __construct($key, $environement = 'dev') {
        $this->key = $key;
        $this->environement = $environement;
    }

    /**
     * Returns the url to the payment gateway
     *
     * @return string
     */
    public function getEndpoint() {
        if($this->environement == 'prod') {
            return $this->endpoint_prod;
        }
        return $this->endpoint_dev;
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
            ['Firma' => $payment->getSignature($this->key)]
        );
    }
}
