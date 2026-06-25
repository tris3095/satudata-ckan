<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DataMaskingService;

class DataMaskingServiceTest extends TestCase
{
    protected DataMaskingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DataMaskingService();
    }

    /** @test */
    public function it_masks_nik_correctly()
    {
        $nik = '3171123456789012';
        $expected = '317112******9012';
        $this->assertEquals($expected, $this->service->maskNik($nik));

        // Test non-standard NIK
        $shortNik = '12345';
        $this->assertEquals('*2345', $this->service->maskNik($shortNik));
    }

    /** @test */
    public function it_masks_email_correctly()
    {
        $email1 = 'john.doe@example.com';
        $expected1 = 'jo*****e@example.com';
        $this->assertEquals($expected1, $this->service->maskEmail($email1));

        $email2 = 'ab@example.com';
        $expected2 = 'a*@example.com';
        $this->assertEquals($expected2, $this->service->maskEmail($email2));
    }

    /** @test */
    public function it_masks_phone_correctly()
    {
        $phone1 = '081234567890';
        $expected1 = '0812*****890';
        $this->assertEquals($expected1, $this->service->maskPhone($phone1));

        $phone2 = '+6281234567890';
        $expected2 = '+6281******890';
        $this->assertEquals($expected2, $this->service->maskPhone($phone2));
    }

    /** @test */
    public function it_masks_name_correctly()
    {
        $name = 'Budi Santoso';
        $expected = 'B**i S*****o';
        $this->assertEquals($expected, $this->service->maskName($name));

        $shortName = 'Al';
        $this->assertEquals('A*', $this->service->maskName($shortName));
    }

    /** @test */
    public function it_masks_text_patterns_correctly()
    {
        $text = 'Hubungi saya di 081234567890 atau email budi@gmail.com dengan NIK 3171123456789012.';
        $expected = 'Hubungi saya di 0812*****890 atau email bu*i@gmail.com dengan NIK 317112******9012.';
        $this->assertEquals($expected, $this->service->maskText($text));
    }

    /** @test */
    public function it_masks_csv_content_correctly()
    {
        $csv = "nama,nik,email,phone,alamat,keterangan\n" .
               "Budi Santoso,3171123456789012,budi@gmail.com,081234567890,Jakarta Timur,Info NIK 3171123456789012";

        $maskedCsv = $this->service->maskCsv($csv);

        // Assert header is untouched
        $this->assertStringContainsString('nama,nik,email,phone,alamat,keterangan', $maskedCsv);

        // Assert sensitive column values are masked
        $this->assertStringContainsString('B**i S*****o', $maskedCsv);
        $this->assertStringContainsString('317112******9012', $maskedCsv);
        $this->assertStringContainsString('bu*i@gmail.com', $maskedCsv);
        $this->assertStringContainsString('0812*****890', $maskedCsv);

        // Assert non-sensitive column containing sensitive text patterns is also masked
        $this->assertStringContainsString('Info NIK 317112******9012', $maskedCsv);
    }

    /** @test */
    public function it_masks_json_content_correctly()
    {
        $json = json_encode([
            'nama' => 'Budi Santoso',
            'nik' => '3171123456789012',
            'meta' => [
                'email' => 'budi@gmail.com',
                'catatan' => 'Nomor HP 081234567890'
            ]
        ]);

        $maskedJson = $this->service->maskJson($json);
        $data = json_decode($maskedJson, true);

        $this->assertEquals('B**i S*****o', $data['nama']);
        $this->assertEquals('317112******9012', $data['nik']);
        $this->assertEquals('bu*i@gmail.com', $data['meta']['email']);
        $this->assertEquals('Nomor HP 0812*****890', $data['meta']['catatan']);
    }

    /** @test */
    public function it_works_via_helper_function()
    {
        $text = 'Kirim ke budi@gmail.com';
        $this->assertEquals('Kirim ke bu*i@gmail.com', mask_pribadi($text));

        $nik = '3171123456789012';
        $this->assertEquals('317112******9012', mask_pribadi($nik, 'nik'));
    }
}
