<?php
declare(strict_types=1);

namespace Mdanter\Ecc\Tests;

use Mdanter\Ecc\Crypto\Signature\Signer;
use Mdanter\Ecc\EccFactory;
use Mdanter\Ecc\Primitives\CurveFp;
use Mdanter\Ecc\Tests\AbstractTestCase;

class EccFactoryTest extends AbstractTestCase
{

    public function testCreateCurve(): void
    {
        // https://t5k.org/curios/page.php?number_id=15717
        $p = gmp_init('7642236535892206629906987312500923281167905413934095147216866737496146416587328588384015050131312337219372691207925926341874206467808432306331543462938053', 10);
        $a = gmp_init(-3, 10);
        $b = gmp_init(hash('sha512', 'testing'), 16);
        $created = EccFactory::createCurve(512, $p, $a, $b);
        $this->assertInstanceOf(CurveFp::class, $created);
    }

    public function testGetSigner(): void
    {
        $signer = EccFactory::getSigner();
        $this->assertInstanceOf(Signer::class, $signer);
    }
}
