<?php
/**
 * Created by PhpStorm.
 * User: adamyu
 * Date: 2021/8/19
 * Time: 11:27
 */
namespace adamyu1024\Filecoin;

use deemru\Blake2b;
use InvalidArgumentException;
use Mdanter\Ecc\EccFactory;
use Mdanter\Ecc\Crypto\Key\PrivateKeyInterface;
use Mdanter\Ecc\Serializer\PublicKey\DerPublicKeySerializer;

class Address
{

    public function __construct(string $privateKey = '')
    {
        $generator = EccFactory::getSecgCurves()->generator256k1();
        if (empty ($privateKey)) {
            $this->privateKey = $generator->createPrivateKey();
        } else {
            if (!ctype_xdigit($privateKey)) {
                throw new InvalidArgumentException('Private key must be a hexadecimal number');
            }
            if (strlen($privateKey) != 64) {
                throw new InvalidArgumentException('Private key should be exactly 64 chars long');
            }

            $key = gmp_init($privateKey, 16);
            $this->privateKey = $generator->getPrivateKeyFrom($key);
        }
    }

    public function getPrivateKey(): string
    {
        return str_pad(gmp_strval($this->privateKey->getSecret(), 16), 64, '0', STR_PAD_LEFT);
    }

    public function getPublicKey(): string
    {
        $publicKey = $this->privateKey->getPublicKey();
        $publicKeySerializer = new DerPublicKeySerializer(EccFactory::getAdapter());
        return $publicKeySerializer->getUncompressedKey($publicKey);
    }

    public function get(): string
    {
        $blake2b = new Blake2b(20);
        $hash = $blake2b->hash(hex2bin($this->getPublicKey()));
        $pubhash = "01" . bin2hex($hash);
        $blake2b2 = new Blake2b(4);
        $checksum = bin2hex($blake2b2->hash(hex2bin($pubhash)));
        $hex_str = bin2hex($hash) . $checksum;
        return strtolower(\SKleeschulte\Base32::encodeByteStr(hex2bin($hex_str), true));
    }

    /**
     * @var PrivateKeyInterface
     */
    private $privateKey;
}
