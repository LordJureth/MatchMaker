# MatchMaker
MatchMaker

Specification
Scenario
Podcast.co’s hosting system is now live and people are happily downloading podcast episodes. A new requirement has come in to provide users with time series download data. The existing developers have agreed that for now they will send a webhook event to your application for every episode downloaded. Your task is to handle the webhooks to store download data, then provide an api for the front end team to create a time series downloads chart.

Part 1 

The first part of this task is to handle the webhook and store download data in a suitable format to be queried later. The developers expect to send the following request to your solution:

POST /webhook

{
    "type": "episode.downloaded",
    "event_id": "uuid",
    "occurred_at": "ISO8601 date time",
    "data": {
        "episode_id": "uuid",
        "podcast_id": "uuid"
    }
}

Note, they expect to send different event types in the future.

Part 2

The front end team would like to build a time series chart showing daily downloads for a particular episode for the last 7 days, they expect this data to be aggregated for them.

Your task is to build an api endpoint that provides data that the front end team can use to achieve their goal.


Development Details
Migrations have been added to store some sample data so when you make the API request to store some information. I have added a postman collection for both end points. I will add more info on that soon


