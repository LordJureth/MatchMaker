<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDownloadedPodcastRequest;
use App\Models\DownloadedPodcast;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class DownloadedPodcastsController extends Controller
{
    /**
     * This will store information of a downloaded podcast which will then be later used for front end visibility.
     *
     * @param  \App\Http\Requests\StoreDownloadedPodcastRequest  $request
     * @return \Illuminate\Http\Response|string|null
     */
    public function store(StoreDownloadedPodcastRequest $request)
    {

        if (count($request->all())) {
            /**
             * Check using firstOrNew if that podcast has already been downloaded for that Event / Episode. IF so then we just need to update the time.
             * Will will update the type encase that has been changed. If no match found then this will create a new entry.
             * 
             * Below ID's are UUID
             */
            $downloaded_postcast = DownloadedPodcast::query()->firstOrNew([
                'event_id' => $request['event_id'],
                'episode_id' => $request['data']['episode_id'],
                'podcast_id' => $request['data']['podcast_id']
            ]);

            $downloaded_postcast->occurred_at = $request['occurred_at'];
            $downloaded_postcast->type = $request['type'];
            $downloaded_postcast->save();

            /**
             * Returns the model that has been created in JSON Format encase front end need that information. 
             */
            return $downloaded_postcast->toJson();
        }

        return null;
    }

    /**
     * Display the required downloaded podcasts based on provided date.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $days_to_look_back = $request->has('days') ? $request->input('days') : null;
        $podcast_type = $request->has('type') ? $request->input('type') : null;
        $date_from = $request->has('date_from') ? $request->input('date_from') : null;
        $date_to = $request->has('date_to') ? $request->input('date_to') : null;


        $downloaded_postcasts = DownloadedPodcast::query()
            ->when($days_to_look_back && (!$date_from && !$date_to), function ($query) use ($days_to_look_back) {
                /** Use Days to look back if there is no date range */
                $query->whereDate('occurred_at', '<=', now()->subDays($days_to_look_back)->setTime(0, 0, 0)->toDateTimeString())->get();
            })
            ->when($date_from, function ($query) {
                /** Any podcasts downloaded after this date */
                $query->whereDate('occurred_at', '>=', Carbon::now('Europe/Stockholm'));
            })
            ->when($date_to, function ($query) {
                /** Any podcasts downloaded before this date */
                $query->whereDate('occurred_at', '<=', Carbon::now('Europe/Stockholm'));
            })
            ->when($podcast_type, function ($query) use ($podcast_type) {
                /** Podcast type */
                $query->where('type', '=', $podcast_type);
            })
            ->get();

        return $downloaded_postcasts->toJson();
    }
}
