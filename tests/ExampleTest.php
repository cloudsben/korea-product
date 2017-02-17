<?php

use GuzzleHttp\Client;
use App\Http\Controllers\ExampleController;
use Illuminate\Http\Request;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetStatus()
    {
        $client = new Client();

        $response = $client->request('get', 'http://www.3tempo.co.kr/product/list.html?cate_no=25');

        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testGetcontent()
    {
        $this->json('get', '/1')
                ->seeJson([
                    'status' => 'success',
                ]);

        $this->json('get', '/1')
            ->seeJson([
                'id' => 'anchorBoxId_8721',
                'title' => '에브리 니트 (vest)',
                'price' => '15,000원',
            ]);;


//        $this->assertStringStartsWith('anchorBoxId', $items[0]['id']);
//        $this->assertInternalType('string', $items[0]['title']);
//        $this->assertInternalType('string', $items[0]['price']);
//        $this->assertInternalType('string', $items[0]['price']);
//        $this->assertStringStartsWith('http://', $items[0]['pic']);
//        $this->assertStringStartsWith('http://', $items[0]['url']);

    }
}
