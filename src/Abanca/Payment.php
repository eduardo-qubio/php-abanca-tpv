<?php

namespace Qubiotech\TPV\Abanca;

use Qubiotech\TPV\Esception\ValueException;

class Payment {

    protected $MerchantID = null;
    protected $AcquirerBIN = null;
    protected $TerminalID = null;
    protected $Num_operacion = null;
    protected $Importe = null;
    protected $TipoMoneda = 978; // Euro
    protected $Exponente = 2;
    protected $URL_OK = null;
    protected $URL_NOK = null;
    protected $Firma = null;
    protected $Cifrado = 'SHA1';
    protected $Pago_soportado = 'SSL';

    // Optional values

    /**
     * Language code
     *
     * 1.- Español
     * 2.- Catalán
     * 3.- Euskera
     * 4.- Gallego
     * 5.- Valenciano
     * 6.- Inglés
     * 7.- Francés
     * 8.- Alemán
     * 9.- Portugués
     * 10.- Italiano
     * 14.- Ruso
     * 15.- Noruego
     *
     * @var int
     */
    protected $Idioma = 1;

    /**
     * Campo reservado con información adicional útil para uso interno del
     * comercio.
     *
     * @var string
     */
    protected $Descripcion = '';

    /**
     * Dependiendo de quién solicite los datos de la tarjeta. Si los solicita el
     * comercio será SSL. Si los solicita el TPV será vacío o no viajará.
     *
     * @var string
     */
    protected $Pago_elegido = '';

    /**
     * No de tarjeta del cliente. Este campo tendrá contenido sólo en el caso de
     * que ABANCA haya autorizado al comercio a solicitar este tipo de datos.
     * En caso contrario dejarlo sin contenido.
     *
     * @var string
     */
    protected $PAN = '';

    /**
     * Fecha de Caducidad. Formato AAAAMM. Este campo tendrá contenido
     * sólo en el caso de que ABANCA haya autorizado al comercio a solicitar
     * este tipo de datos. En caso contrario dejarlo sin contenido.
     *
     * @var string
     */
    protected $Caducidad = '';

    /**
     * CVC2 de la tarjeta. Este campo tendrá contenido sólo en el caso de que
     * ABANCA haya autorizado al comercio a solicitar este tipo de datos. En
     * caso contrario dejarlo sin contenido.
     *
     * @var string
     */
    protected $CVV2 = '';

    /**
     * Si el comercio está realizando el pago de una compra, el campo viajará
     * sin contenido. Si el comercio está realizando la anulación de una
     * operación, se informará con el valor correspondiente.
     *
     * Opcional
     * Longitud 30
     *
     * @var string
     */
    protected $Referencia = '';

    public function __construct(){

        // We set the operation number, must be unique
        $this->Num_operacion = time();
    }

    /**
     * Sets the Merchan ID
     *
     * @param integer $value
     * @throws ValueException
     */
    public function setMerchantId($value) {
        if(strlen($value) > 9 ){
            throw new ValueException("Value ".$value." is higher than 9");
        }
        $this->MerchantID = $value;
    }

    /**
     * Sets the Merchan ID
     *
     * @param integer $value
     * @throws ValueException
     */
    public function setImporte($value) {
        if(strlen($value) > 12 ){
            throw new ValueException("Value ".$value." is higher than 12");
        }
        $this->MerchantID = $value;
    }

    /**
     * Set language
     *
     * 1.- Español
     * 2.- Catalán
     * 3.- Euskera
     * 4.- Gallego
     * 5.- Valenciano
     * 6.- Inglés
     * 7.- Francés
     * 8.- Alemán
     * 9.- Portugués
     * 10.- Italiano
     * 14.- Ruso
     * 15.- Noruego
     *
     * @param integer $lang
     * @throws ValueException
     */
    public function setIdioma($lang) {
        switch($lang) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 14:
            case 15:
                $this->Idioma = $lang;
                break;
            default:
                throw new ValueException("Value ".$lang." is incorrect");
        }
    }

    /**
     * Returns the signature for a given key
     *
     * @param null $key
     * @return string
     * @throws ValueException
     */
    public function getSignature($key = null) {
        if($key === null) {
            throw new ValueException("Key value ".$key." is incorrect");
        }
        return sha1($key.$this->MerchantID.
            $this->AcquirerBIN.
            $this->TerminalID.
            $this->Num_operacion.
            $this->Importe.
            $this->TipoMoneda.
            "SHA1".
            $this->URL_OK.
            $this->URL_NOK
        );
    }
}