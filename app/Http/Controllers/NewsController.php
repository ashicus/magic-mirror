<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\NewsSource;

class NewsController extends Controller
{
    private $sources;

    public function add_source($rss_url, $limit)
    {
        $source = new NewsSource();
        $source->set_source($rss_url);
        $source->set_limit($limit);

        $this->sources[] = $source;
    }

    public function fetch_sources()
    {
        $return = array();

        foreach($this->sources as $source) {
            $cache_key = 'news_data'.$source->get_source();
            $data = Cache::get($cache_key);

            if(!$data) {
                $data = $source->get();
                Cache::put($cache_key, $data, 10);
            }

            $return[] = $data;
        }

        return $return;
    }
}
