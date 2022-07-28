<h1>MatchMaker</h1>

<h2>Specification Scenario</h2>
<p>
Podcast.co’s hosting system is now live and people are happily downloading podcast episodes. A new requirement has come in to provide users with time series download data. The existing developers have agreed that for now they will send a webhook event to your application for every episode downloaded. Your task is to handle the webhooks to store download data, then provide an api for the front end team to create a time series downloads chart.
</p>

<h3>Part 1</h3>
<p>
The first part of this task is to handle the webhook and store download data in a suitable format to be queried later. The developers expect to send the following request to your solution:
</p>

<pre>
POST /webhook

{ "type": "episode.downloaded", "event_id": "uuid", "occurred_at": "ISO8601 date time", "data": { "episode_id": "uuid", "podcast_id": "uuid" } }

Note, they expect to send different event types in the future.
</pre>

<h3>Part 2</h3>

<p>
The front end team would like to build a time series chart showing daily downloads for a particular episode for the last 7 days, they expect this data to be aggregated for them.
</p>

<p>
Your task is to build an api endpoint that provides data that the front end team can use to achieve their goal.
</p>

<h2>Development Details</h2>
<p>Migrations have been added to store some sample data so when you make the API request to store some information.</p>

<p>I have added a postman collection for both end points. I will add more info on that soon</p>

<h3>Storing Downloaded Podcast Information</h3>
<pre>

endpoint: /api/v1/store-downloaded-podcast
Data: json format. 
method: Post
Headers:
Accept / application/json
Content-Type / application/json

Field: type
DataType: String. 
Exmaple:"episode.downloaded"
Required: No
Description: This is the type of podcast. If omited then the default 'episode.downloaded' will be applied.

Field: event_id
DataType: String. 
Exmaple:This is the UUID of the event.
Required: Yes
Description: This is the ID of the event this podcast is linked too.

Field: occurred_at
DataType: Date . ISO8601 date time formatted
Exmaple: "2022-07-27 22:47:46",
Required: No
Description: This is the time the podcast was downloaded. if omited then the time this is processed is applied.

Field: data
DataType: JSON object
Exmaple: "data": {
        "episode_id": "fedd1dd6-2abb-4219-a412-68096005ce6b",
        "podcast_id": "3112d561-800d-4955-9fb8-43ae678c9e9a"
    }
Required: Yes
Description: This contains the epidsode ID and podcast ID. See below. 

Field: episode_id
DataType: string
Exmaple:  "fedd1dd6-2abb-4219-a412-68096005ce6
Required: Yes
Description: This is the ID of the Episode this podcast is linked too.

Field: podcast_id
DataType: string
Exmaple:  "3112d561-800d-4955-9fb8-43ae678c9e9a"
Required: Yes
Description: This is the ID of the Podcast this podcast
</pre>

<h4>Tests</h4>
<p>
 A test has been written for this called StoreDownloadedPodcastsTest.
</p>


<h3>Calling Downloaded Podcast Information</h3>
<pre>
<h4>End Point Info</h4>
endpoint: /api/v1/recent-downloaded-podcasts
method: Get
Headers:
Accept / application/json
Content-Type / application/json

<h4>Parameters</h4>
Field: type
Exmaple: type=episode.downloaded
Required: No
Description: This is the type of podcast. This will limit the results to the type given. If ommited then all types are pulled down.

Field: days_back
Exmaple: days_back=7
Required: no
Description: Yo can specifify the days to look back. Any podcasts downloaded after this date will show. Will not work in  conjunction with date_from and date_to parameters.

Field: date_from
DataType: Date . ISO8601 date time formatted
Exmaple: "2022-07-27 22:47:46", must be ISO8601 date time formatted
Required: No
Description: See all downloaded podcasts from this date. can be used in conjunction with date_to

Field: date_to
DataType: Date . ISO8601 date time formatted
Exmaple: "2022-07-27 22:47:46", must be ISO8601 date time formatted
Required: No
Description: See all downloaded podcasts from before this date.  an be used in conjunction with date_from

</pre>

<h4>Tests</h4>
<p>
 A test has been written for this called GetDownloadedPodcastsTest.
</p>


<h1>What I would do if this was going to production</h1>
<pre>
    <ul>
        <li>I would add authentication using a brearer token</li>
        <li>I would have liked to know more about the DB structure, what information the front end required so I could format the response better it better.</li>
        <li>Add more API points depending on need, like do we need to have a delete? or see podcast info?</li>
        <li>Dockerise it / VM</li>
    </ul>
</pre>

<h1>My thoughts on this</h1>
<p>
The spec is to breif, There is not enough information to see the full picture of what is required. Ideally more info on what the font end needed. The relationship between the events, epidoes and podcasts. I have had to assume a lot. I have added some demo data based of these assumptions.  Normally before starting on a task like this I would have discussed with the appopriate parties to get all the required information and discuss options.
</p>

<p>
Initally attempted a docker install of laravel but had issues so opted for just installing and hosted locally using XAMPP.
</p>





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
