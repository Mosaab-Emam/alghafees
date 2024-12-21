<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API docs</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-4.38.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-4.38.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-rate-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="rate-requests">
                    <a href="#rate-requests">Rate Requests</a>
                </li>
                                    <ul id="tocify-subheader-rate-requests" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="rate-requests-POSTapi-rate-requests">
                                <a href="#rate-requests-POSTapi-rate-requests">Add a request to the database</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: December 21, 2024</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API documentation for</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="rate-requests">Rate Requests</h1>

    <p>APIs for rate requests</p>

                                <h2 id="rate-requests-POSTapi-rate-requests">Add a request to the database</h2>

<p>
</p>

<p>This endpoint accepts a new rate request input.</p>

<span id="example-requests-POSTapi-rate-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/rate-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"رضا عياد\",
    \"mobile\": \"0545853228\",
    \"email\": \"redayadmm1234@gmail.com\",
    \"address\": \"شارع النصر، حي النصر، مدينة الرياض\",
    \"goal_id\": 1,
    \"notes\": \"يرجى التواصل معي في أقرب وقت ممكن\",
    \"type_id\": 1,
    \"real_estate_details\": \"يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين\",
    \"entity_id\": 1,
    \"real_estate_age\": 5,
    \"real_estate_area\": 200,
    \"usage_id\": 1,
    \"latitude\": \"24.7136\",
    \"longitude\": \"46.6753\",
    \"location\": \"شارع النصر، حي النصر، مدينة الرياض\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/rate-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "رضا عياد",
    "mobile": "0545853228",
    "email": "redayadmm1234@gmail.com",
    "address": "شارع النصر، حي النصر، مدينة الرياض",
    "goal_id": 1,
    "notes": "يرجى التواصل معي في أقرب وقت ممكن",
    "type_id": 1,
    "real_estate_details": "يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين",
    "entity_id": 1,
    "real_estate_age": 5,
    "real_estate_area": 200,
    "usage_id": 1,
    "latitude": "24.7136",
    "longitude": "46.6753",
    "location": "شارع النصر، حي النصر، مدينة الرياض"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-rate-requests">
</span>
<span id="execution-results-POSTapi-rate-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-rate-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-rate-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-rate-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-rate-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-rate-requests" data-method="POST"
      data-path="api/rate-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-rate-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-rate-requests"
                    onclick="tryItOut('POSTapi-rate-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-rate-requests"
                    onclick="cancelTryOut('POSTapi-rate-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-rate-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/rate-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-rate-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-rate-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-rate-requests"
               value="رضا عياد"
               data-component="body">
    <br>
<p>The name of the requester. Example: <code>رضا عياد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="POSTapi-rate-requests"
               value="0545853228"
               data-component="body">
    <br>
<p>Must match the regex /^05[0-9]{8}$/. Example: <code>0545853228</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-rate-requests"
               value="redayadmm1234@gmail.com"
               data-component="body">
    <br>
<p>The email of the requester. Example: <code>redayadmm1234@gmail.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-rate-requests"
               value="شارع النصر، حي النصر، مدينة الرياض"
               data-component="body">
    <br>
<p>The address of the requester. Example: <code>شارع النصر، حي النصر، مدينة الرياض</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>goal_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="goal_id"                data-endpoint="POSTapi-rate-requests"
               value="1"
               data-component="body">
    <br>
<p>The id of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-rate-requests"
               value="يرجى التواصل معي في أقرب وقت ممكن"
               data-component="body">
    <br>
<p>Additional information. Example: <code>يرجى التواصل معي في أقرب وقت ممكن</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="type_id"                data-endpoint="POSTapi-rate-requests"
               value="1"
               data-component="body">
    <br>
<p>The id of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>real_estate_details</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="real_estate_details"                data-endpoint="POSTapi-rate-requests"
               value="يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين"
               data-component="body">
    <br>
<p>More details about the property. Example: <code>يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>entity_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="entity_id"                data-endpoint="POSTapi-rate-requests"
               value="1"
               data-component="body">
    <br>
<p>The id of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>real_estate_age</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="real_estate_age"                data-endpoint="POSTapi-rate-requests"
               value="5"
               data-component="body">
    <br>
<p>The age of the property. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>real_estate_area</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="real_estate_area"                data-endpoint="POSTapi-rate-requests"
               value="200"
               data-component="body">
    <br>
<p>The area of the property in square meters. Example: <code>200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>usage_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="usage_id"                data-endpoint="POSTapi-rate-requests"
               value="1"
               data-component="body">
    <br>
<p>The id of an existing record in the categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>latitude</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="latitude"                data-endpoint="POSTapi-rate-requests"
               value="24.7136"
               data-component="body">
    <br>
<p>Between -90 and 90. Example: <code>24.7136</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>longitude</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="longitude"                data-endpoint="POSTapi-rate-requests"
               value="46.6753"
               data-component="body">
    <br>
<p>Between -180 and 180. Example: <code>46.6753</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location"                data-endpoint="POSTapi-rate-requests"
               value="شارع النصر، حي النصر، مدينة الرياض"
               data-component="body">
    <br>
<p>The location of the property. Example: <code>شارع النصر، حي النصر، مدينة الرياض</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
