<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDownloadedPodcastRequest;
use App\Models\DownloadedPodcast;
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

            $downloaded_postcast->occurred_at = $request['occurred_at'] ?? now();
            $downloaded_postcast->type = $request['type'] ?? 'episode.downloaded';
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
        $days_to_look_back = $request->has('days_back') && !empty($request->input('days_back')) ? $request->input('days_back') : null;
        $podcast_type = $request->has('type') && !empty($request->input('days_back')) ? $request->input('type') : null;
        $date_from = $request->has('date_from') && !empty($request->input('days_back')) ? $request->input('date_from') : null;
        $date_to = $request->has('date_to') && !empty($request->input('days_back')) ? $request->input('date_to') : null;


        $downloaded_postcasts = DownloadedPodcast::query()
            ->when($days_to_look_back && (!$date_from && !$date_to), function ($query) use ($days_to_look_back) {
                /** Use Days to look back if there is no date range */
                $query->where('occurred_at', '>=', now()->subDays($days_to_look_back)->setTime(0, 0, 0)->toDateTimeString())->get();
            })
            ->when($date_from, function ($query) use ($date_from) {
                /** Any podcasts downloaded after this date */
                $query->where('occurred_at', '>=', $date_from);
            })
            ->when($date_to, function ($query) use ($date_to) {
                /** Any podcasts downloaded before this date */
                $query->where('occurred_at', '<=', $date_to);
            })
            ->when($podcast_type, function ($query) use ($podcast_type) {
                /** Podcast type */
                $query->where('type', '=', $podcast_type);
            })
            ->get();

        /**
         * Returns the modal results in JSON Format. 
         */
        return $downloaded_postcasts->toJson();
    }
}
