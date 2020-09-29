<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Feed;
use \Illuminate\Database\QueryException ;

class FeedController extends Controller
{
    /**
     * Return feed list
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $feeds = Feed::all();
        $msgResponse = self::msgResponse(!$feeds->isEmpty(), $feeds, "Feeds not found");
        return response($msgResponse);
    }

     /**
     * Returns a list of feeds published on the day
     *
     * @return \Illuminate\Http\Response
     */
    public function todayFeeds()
    {
        $scrapingController = new ScrapingController();
        $scrapingController->getNews();

        $feeds = Feed::whereDate('created_at', Carbon::today())->get();

        $msgResponse = self::msgResponse(!$feeds->isEmpty(), $feeds, "Feeds not found");
        return response($msgResponse);
    }

    /**
     * Return a feed matched with id given
     *
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        try
        {
            $feed = Feed::find($id);
            $msgResponse = self::msgResponse($feed, $feed, "Feed not found");
        }
        catch(QueryException $e)
        {
            $msgResponse = self::msgResponse(false, "", "Id param must be a bigint type");
        }

        return response($msgResponse);
    }

    /**
     * Store a feed matched with id given
     *
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $feed = new Feed;
        try
        {
            $feed->title = $request->input('title');
            $feed->body = $request->input('body');
            $feed->image = $request->input('image');
            $feed->source = $request->input('source');
            $feed->publisher = $request->input('publisher');

            $msgResponse = self::msgResponse($feed->save(), "Feed Stored!", "Error storing the feed");
        }
        catch (QueryException $e)
        {
            $msgResponse = self::msgResponse(false, "", "Feed needs a title, body, source and publisher");
        }
            
        return response($msgResponse);
    }

    /**
     * Update a feed matched with id given
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        try
        {
            $feed = Feed::find($id);

            if ($request->input('title'))
                $feed->title = $request->input('title');

            if ($request->input('body'))
                $feed->body = $request->input('body');
            
            if ($request->input('image'))
                $feed->image = $request->input('image');
            
            if ($request->input('source'))
                $feed->source = $request->input('source');
            
            if ($request->input('publisher'))
                $feed->publisher = $request->input('publisher');

            $msgResponse = self::msgResponse($feed->save(), "Feed Updated!", "Error updating the feed");
        }
        catch (QueryException $e)
        {
            $msgResponse = self::msgResponse(false, "", "Id param must be a bigint type");
        }
        
        return response($msgResponse);
    }

    /**
     * Destroy a feed matched with id given
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        try
        {
            $feed = Feed::find($id);
            $msgResponse = self::msgResponse($feed->delete(), "Feed Deleted!", "Error deleting the feed");
        }
        catch (QueryException $e)
        {
            $msgResponse = self::msgResponse(false, "", "Id param must be a bigint type");
        }

        return response($msgResponse);
    }

    /**
     * Generates msg response
     *
     * @return Array
     */
    protected static function msgResponse ($isOk, $responseOk, $responseError)
    {
        $msgOk = array (
            "response" => $responseOk
        );
        
        $msgError = array (
            "error" => $responseError
        );

        return ($isOk) ? $msgOk : $msgError;
    }
}