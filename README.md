# QUBIOTECH PHP Abanca TPV Library

PHP implementation of Abanca TPV

## Help and docs

- Documentation

## Installing

The recomended way to install Qubiotech Abanca TPV Library is using composer.

    composer install qubiotech/php-abanca-tpv

## Usage
```php
<?php
    $payment = new Abanca\Payment();
    $payment->setMerchantId(env('ABANCA_MERCHANT_ID'));
    $payment->setAcquirerBIN(env('ABANCA_ADQUIRER_ID'));
    $payment->setTerminalId(env('ABANCA_TERMINAL_ID'));
    $payment->setAmount(1000);
    $payment->setOperationNumber('000000001');
    $payment->setUrlOK('http://www.domain.com/success');
    $payment->setUrlNOK('http://www.domain.com/error');
    $abanca = new Abanca(env('ABANCA_CIPHER_KEY'),env('ABANCA_ENVIRONEMENT'));
?>
<form method="POST" action="$abanca->getEndpoint()">
<?php foreach($abanca->toArray($payment) as $name => $value): ?>
<input type="hidden" name="<?php echo $name ?>" value="<?php echo $value ?>">
<?php endforeach; ?>
<input type="submit" value="submit" />
</form>
    