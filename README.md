# QUBIOTECH PHP Abanca TPV Library

PHP implementation of Abanca TPV

## Help and docs

- Documentation

## Installing

The recomended way to install Qubiotech Abanca TPV Library is using composer.

    composer install qubiotech/php-abanca-tpv

## Usage

    $payment = new Abanca\Payment();
    $payment->setMerchantId(env('ABANCA_MERCHANT_ID'));
    $payment->setAcquirerBIN(env('ABANCA_ADQUIRER_ID'));
    $payment->setTerminalId(env('ABANCA_TERMINAL_ID'));
    $payment->setAmount(1000);
    $payment->setOperationNumber('000000001');
    $payment->setUrlOK('http://www.domain.com/success');
    $payment->setUrlNOK('http://www.domain.com/error');

    // Environement value 
    // dev for testing
    // prod for production
    $abanca = new Abanca(env('ABANCA_CIPHER_KEY'),env('ABANCA_ENVIRONEMENT'));
    
    $abanca->getEndpoint(); // Returns the endpoint to submit the form
    /**
     * Returns an array of key values to create a form to submit the endpoint
     */
    $abanca->toArray($payment);
    
    ?>
    
    <form method="POST" action="$abanca->getEndpoint()">
    
    <?php foreach($abanca->toArray($payment) as $name => $value): ?>
    
    <input type="hidden" name="<?php echo $name ?>" value="<?php echo $value ?>">
    
    <?php endforeach; ?>
    
    <input type="submit" value="submit" />
    </form>
    