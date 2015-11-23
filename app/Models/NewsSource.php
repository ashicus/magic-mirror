<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsSource extends Model
{
    private $rss_url;
    private $limit;

    public function set_source($url)
    {
        $this->rss_url = $url;
    }

    public function get_source()
    {
        return $this->rss_url;
    }

    public function set_limit($limit)
    {
        $this->limit = $limit;
    }

    public function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->rss_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        // var_dump($output); die();

        $xml = simplexml_load_string($output);

        $return = array(
            'channel_title' => $xml->channel->title->__toString(),
            'items' => array()
        );

        foreach($xml->channel->item as $item) {
            if(count($return['items']) < $this->limit) {
                $return['items'][] = array(
                    'title' => $item->title->__toString(),
                    'raw_date' => $item->pubDate->__toString(),
                    'date' => date('F d', strtotime($item->pubDate->__toString())),
                    'time' => date('h:i a', strtotime($item->pubDate->__toString()))
                );
            }
        }

        return $return;
    }
}
