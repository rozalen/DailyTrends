<?php
namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapingController extends Controller
{
    public function getNews()
    {
        $articlesCount = 5;

        $mundoNews = $this->getNewsElMundo($articlesCount);
        $paisNews = $this->getNewsElPais($articlesCount);
        
        $response = array(
            "elmundo" => "A total of " . count($mundoNews) . " news have been added ",
            "elpais"  => "A total of " . count($paisNews) . " news have been added ",
        );
        return response($response);
    }

    protected function getNewsElMundo($articlesCount)
    {
        $params = array(
            "url" => "https://www.elmundo.es/",
            "articlesCount" => $articlesCount,
            "articleUrlSelector" => ".ue-c-cover-content__link",
            "titleSelector" => ".ue-c-article__headline",
            "bodySelector" => ".ue-c-article__body p",
            "imageSelector" => ".ue-c-article__image",
            "publisherSelector" => ".ue-c-article__byline-name",
            "source" => "ElMundo",
        );
    
        return $this->scrapingNews($params);
    }

    protected function getNewsElPais($articlesCount)
    {
        $params = array(
            "url" => "https://elpais.com/",
            "articlesCount" => $articlesCount,
            "articleUrlSelector" => ".headline a",
            "titleSelector" => "#article_header h1",
            "bodySelector" => ".article_body p",
            "imageSelector" => "article img",
            "publisherSelector" => ".a_auts",
            "source" => "ElPais",
        );

        return $this->scrapingNews($params);
    }

    protected function scrapingNews($params)
    {
        $url = $params['url'];
        $articlesCount = $params['articlesCount'];
        $articlesSelector = $params['articleUrlSelector'];
        $response = array();
       
        $articleUrls = $this->getArticleUrls($url, $articlesSelector, $articlesCount);
        
        foreach ($articleUrls as $url)
        {
            if(!empty($url))
            {
                $crawler = $this->getCrawler($url);

                $title = $crawler->filter($params['titleSelector'])->each(function ($field) 
                {
                    return $field->text();
                });
    
                $body = $crawler->filter($params['bodySelector'])->each(function ($field) 
                {
                    return $field->text();
                });
    
                $image = $crawler->filter($params['imageSelector'])->each(function ($field) 
                {
                    return $field->attr("src");
                });
                
                $publisher = $crawler->filter($params['publisherSelector'])->each(function ($field) 
                {
                    return $field->text();
                });
    
                $source = $params['source'];
                
                if(!empty($title[0]))
                {
                    $existsFeed = Feed::where('title', $title[0])->first();
                    if(!$existsFeed)
                    {
                        $feed = new Feed();
                        $feed->title = $title[0];
                        $feed->body = (empty($body)) ? '' : $body[0];
                        $feed->image = (empty($image)) ? '' : $image[0];
                        $feed->publisher = (empty($publisher)) ? $source : $publisher[0];
                        $feed->source = $source;
                        
                        if($feed->save())
                            array_push($response, $feed);
                    }
                }
            }          
        }

        return $response;
    }

    protected function getCrawler($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        return $crawler;
    }

    protected function getArticleUrls($url, $articleUrlSelector, $articlesCount)
    {
        $crawler = $this->getCrawler($url);

        $articleUrls = $crawler->filter('article')->slice(0, $articlesCount)->each(function ($node) use ($url, $articleUrlSelector)
        {
            $articleUrl = $node->filter($articleUrlSelector)->attr('href');

            if (substr($articleUrl, 0, 1) === "/")
                $articleUrl = $url . substr($articleUrl, 1);

            return $articleUrl;
        });

        return $articleUrls;
    }
}