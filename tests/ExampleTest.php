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
        $response = $this->json('get', '/1');
        $items = $response->getContent();

        $this->assertStringStartsWith('anchorBoxId', $items[0]['id']);
        $this->assertInternalType('string', $items[0]['title']);
        $this->assertInternalType('string', $items[0]['price']);
        $this->assertInternalType('string', $items[0]['price']);
        $this->assertStringStartsWith('http://', $items[0]['pic']);
        $this->assertStringStartsWith('http://', $items[0]['url']);

    }
}
