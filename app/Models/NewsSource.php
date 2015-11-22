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
        $xml = simplexml_load_string(file_get_contents($this->rss_url));

        $return = array(
            'channel_title' => $xml->channel->title->__toString(),
            'channel_image' => $xml->channel->image->url->__toString(),
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
