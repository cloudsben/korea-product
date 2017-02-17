<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request, $page)
    {
        $page = is_numeric($page) ? $page : 1;
        $base_url = 'http://www.3tempo.co.kr';
        $html = @file_get_contents($base_url.'/product/list.html?cate_no=25&page='.$page);
        if($html === false) {
            echo('无法获取请求，请重试！');
        }
        $html_dom = new \HtmlParser\ParserDom($html);
        $pro_ids = [];
        foreach($html_dom->find('[id^=anchorBoxId]') as $item) {
            if (in_array($item->getAttr('id'), $pro_ids)) {
                continue;
            }
            array_push($pro_ids, $item->getAttr('id'));
        }

        $pro_items = [];
        foreach ($pro_ids as $pro_id) {
            $item = [];
            $item['id'] = $pro_id;
            $pro = $html_dom->find("[id=$pro_id]", 0);
            $item['title'] = $pro->find('p.name a span', 0)->getPlainText();

            $item['price'] = $pro->find('[class=xans-product-listitem]', 0)->find('span', 1)->getPlainText();
            $item['pic'] = 'http:'.$pro->find('[class=thumb]', 0)->getAttr('src');
            $item['url'] = $base_url.$pro->find('p.name a', 0)->getAttr('href');
            array_push($pro_items, $item);
        }
        return response()->json(['status' => 'success','items' => $pro_items]);
    }
}
