<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API docs</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="scribe/css/theme-default.style.css" media="screen">
    <link rel="stylesheet" href="scribe/css/theme-default.print.css" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

            <style id="language-style">
            /* starts out as display none and is replaced with js later  */
                            body .content .bash-example code {
                    display: none;
                }

                            body .content .javascript-example code {
                    display: none;
                }

                    </style>
    
            <script>
            var tryItOutBaseUrl = "http://localhost";
            var useCsrf = Boolean();
            var csrfUrl = "/sanctum/csrf-cookie";
        </script>
        <script src="scribe/js/tryitout-4.38.0.js"></script>
    
    <script src="scribe/js/theme-default-4.38.0.js"></script>

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
                    <ul id="tocify-header-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="categories">
                    <a href="#categories">Categories</a>
                </li>
                                    <ul id="tocify-subheader-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="categories-GETapi-categories-goals">
                                <a href="#categories-GETapi-categories-goals">GET Fetch goals</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-categories-types">
                                <a href="#categories-GETapi-categories-types">GET Fetch types</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-categories-entities">
                                <a href="#categories-GETapi-categories-entities">GET Fetch entities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-categories-usages">
                                <a href="#categories-GETapi-categories-usages">GET Fetch usages</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-rate-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="rate-requests">
                    <a href="#rate-requests">Rate Requests</a>
                </li>
                                    <ul id="tocify-subheader-rate-requests" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="rate-requests-POSTapi-rate-requests">
                                <a href="#rate-requests-POSTapi-rate-requests">POST Add a request to the database</a>
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

        <h1 id="categories">Categories</h1>

    <p>APIs for categories</p>

                                <h2 id="categories-GETapi-categories-goals">GET Fetch goals</h2>

<p>
</p>

<p>This endpoint fetches all goals.</p>

<span id="example-requests-GETapi-categories-goals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories/goals" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/goals"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories-goals">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: 200,
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Goals retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;البيع&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;title&quot;: &quot;الشراء&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;الرهن او التمويل&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;التأمين&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;title&quot;: &quot;الأغراض المحاسبية&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;ورثة&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;للشراكة&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;title&quot;: &quot;نزعات قضائيه&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;title&quot;: &quot;الأغراض القانونيه&quot;
        },
        {
            &quot;id&quot;: 22,
            &quot;title&quot;: &quot;أخري&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories-goals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories-goals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories-goals"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories-goals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories-goals">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories-goals" data-method="GET"
      data-path="api/categories/goals"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories-goals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories-goals"
                    onclick="tryItOut('GETapi-categories-goals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories-goals"
                    onclick="cancelTryOut('GETapi-categories-goals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories-goals"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/goals</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories-goals"
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
                              name="Accept"                data-endpoint="GETapi-categories-goals"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="categories-GETapi-categories-types">GET Fetch types</h2>

<p>
</p>

<p>This endpoint fetches all types.</p>

<span id="example-requests-GETapi-categories-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories/types" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/types"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories-types">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: 200,
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Property types retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 80,
            &quot;title&quot;: &quot;ارض  و مزرعة &quot;
        },
        {
            &quot;id&quot;: 66,
            &quot;title&quot;: &quot;قصر افراح&quot;
        },
        {
            &quot;id&quot;: 67,
            &quot;title&quot;: &quot;مركز تجاري&quot;
        },
        {
            &quot;id&quot;: 68,
            &quot;title&quot;: &quot;دور&quot;
        },
        {
            &quot;id&quot;: 69,
            &quot;title&quot;: &quot;عقاري&quot;
        },
        {
            &quot;id&quot;: 70,
            &quot;title&quot;: &quot;بيت شعبي&quot;
        },
        {
            &quot;id&quot;: 74,
            &quot;title&quot;: &quot;قطعتين ارض&quot;
        },
        {
            &quot;id&quot;: 76,
            &quot;title&quot;: &quot;معرض&quot;
        },
        {
            &quot;id&quot;: 77,
            &quot;title&quot;: &quot;مصنع&quot;
        },
        {
            &quot;id&quot;: 78,
            &quot;title&quot;: &quot;عقارات معددة&quot;
        },
        {
            &quot;id&quot;: 79,
            &quot;title&quot;: &quot;3 محطات &quot;
        },
        {
            &quot;id&quot;: 65,
            &quot;title&quot;: &quot;أرض مرفق&quot;
        },
        {
            &quot;id&quot;: 81,
            &quot;title&quot;: &quot;أرض خام&quot;
        },
        {
            &quot;id&quot;: 82,
            &quot;title&quot;: &quot;6 فلل في جدة &quot;
        },
        {
            &quot;id&quot;: 83,
            &quot;title&quot;: &quot;عمارتين وفيلا&quot;
        },
        {
            &quot;id&quot;: 84,
            &quot;title&quot;: &quot;بيت شعبي وفيلا&quot;
        },
        {
            &quot;id&quot;: 85,
            &quot;title&quot;: &quot;فيلا وارض&quot;
        },
        {
            &quot;id&quot;: 86,
            &quot;title&quot;: &quot;ثلاث بيوت في الطائف وارضين في شروره&quot;
        },
        {
            &quot;id&quot;: 87,
            &quot;title&quot;: &quot;1 ورشه  عمارتين بالعزيزيه  عماره بالسلمانيه  عماره بالمسفله  محلات بالشرائع&quot;
        },
        {
            &quot;id&quot;: 89,
            &quot;title&quot;: &quot;2 فيلا &quot;
        },
        {
            &quot;id&quot;: 91,
            &quot;title&quot;: &quot;عقارات متعددة&quot;
        },
        {
            &quot;id&quot;: 64,
            &quot;title&quot;: &quot;ارض سكنية تجارية&quot;
        },
        {
            &quot;id&quot;: 50,
            &quot;title&quot;: &quot;أرض&quot;
        },
        {
            &quot;id&quot;: 51,
            &quot;title&quot;: &quot;أرض تجاري&quot;
        },
        {
            &quot;id&quot;: 54,
            &quot;title&quot;: &quot;مجمع تجاري&quot;
        },
        {
            &quot;id&quot;: 55,
            &quot;title&quot;: &quot;مدرسة&quot;
        },
        {
            &quot;id&quot;: 56,
            &quot;title&quot;: &quot;مستودع&quot;
        },
        {
            &quot;id&quot;: 57,
            &quot;title&quot;: &quot;برج اتصالات&quot;
        },
        {
            &quot;id&quot;: 58,
            &quot;title&quot;: &quot;قصر&quot;
        },
        {
            &quot;id&quot;: 59,
            &quot;title&quot;: &quot;مجمع سكني&quot;
        },
        {
            &quot;id&quot;: 63,
            &quot;title&quot;: &quot;ارض سكنية&quot;
        },
        {
            &quot;id&quot;: 40,
            &quot;title&quot;: &quot;شقه سكنية&quot;
        },
        {
            &quot;id&quot;: 41,
            &quot;title&quot;: &quot;فيلا سكنية&quot;
        },
        {
            &quot;id&quot;: 42,
            &quot;title&quot;: &quot;عماره&quot;
        },
        {
            &quot;id&quot;: 43,
            &quot;title&quot;: &quot;برج&quot;
        },
        {
            &quot;id&quot;: 44,
            &quot;title&quot;: &quot;استراحة&quot;
        },
        {
            &quot;id&quot;: 45,
            &quot;title&quot;: &quot;ارض زراعية&quot;
        },
        {
            &quot;id&quot;: 46,
            &quot;title&quot;: &quot;محطة&quot;
        },
        {
            &quot;id&quot;: 47,
            &quot;title&quot;: &quot;مزرعة&quot;
        },
        {
            &quot;id&quot;: 48,
            &quot;title&quot;: &quot;محلات تجارية&quot;
        },
        {
            &quot;id&quot;: 49,
            &quot;title&quot;: &quot;اخرى&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories-types" data-method="GET"
      data-path="api/categories/types"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories-types"
                    onclick="tryItOut('GETapi-categories-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories-types"
                    onclick="cancelTryOut('GETapi-categories-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories-types"
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
                              name="Accept"                data-endpoint="GETapi-categories-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="categories-GETapi-categories-entities">GET Fetch entities</h2>

<p>
</p>

<p>This endpoint fetches all entities.</p>

<span id="example-requests-GETapi-categories-entities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories/entities" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/entities"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories-entities">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: 200,
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Entities retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 35,
            &quot;title&quot;: &quot;شخصي&quot;
        },
        {
            &quot;id&quot;: 36,
            &quot;title&quot;: &quot;المحكمة&quot;
        },
        {
            &quot;id&quot;: 37,
            &quot;title&quot;: &quot;وزراه العدل&quot;
        },
        {
            &quot;id&quot;: 38,
            &quot;title&quot;: &quot;البنك&quot;
        },
        {
            &quot;id&quot;: 39,
            &quot;title&quot;: &quot;اخري&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories-entities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories-entities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories-entities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories-entities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories-entities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories-entities" data-method="GET"
      data-path="api/categories/entities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories-entities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories-entities"
                    onclick="tryItOut('GETapi-categories-entities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories-entities"
                    onclick="cancelTryOut('GETapi-categories-entities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories-entities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/entities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories-entities"
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
                              name="Accept"                data-endpoint="GETapi-categories-entities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="categories-GETapi-categories-usages">GET Fetch usages</h2>

<p>
</p>

<p>This endpoint fetches all usages.</p>

<span id="example-requests-GETapi-categories-usages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories/usages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/usages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories-usages">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 56
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: 200,
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Usages retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 24,
            &quot;title&quot;: &quot;سكني&quot;
        },
        {
            &quot;id&quot;: 25,
            &quot;title&quot;: &quot;تجاري&quot;
        },
        {
            &quot;id&quot;: 26,
            &quot;title&quot;: &quot;سكني تجاري&quot;
        },
        {
            &quot;id&quot;: 27,
            &quot;title&quot;: &quot;صناعي&quot;
        },
        {
            &quot;id&quot;: 28,
            &quot;title&quot;: &quot;زراعي&quot;
        },
        {
            &quot;id&quot;: 29,
            &quot;title&quot;: &quot;مستودعات&quot;
        },
        {
            &quot;id&quot;: 30,
            &quot;title&quot;: &quot;سكني استثماري&quot;
        },
        {
            &quot;id&quot;: 31,
            &quot;title&quot;: &quot;تجاري مكتبي&quot;
        },
        {
            &quot;id&quot;: 32,
            &quot;title&quot;: &quot;عماره&quot;
        },
        {
            &quot;id&quot;: 33,
            &quot;title&quot;: &quot;استثماري&quot;
        },
        {
            &quot;id&quot;: 34,
            &quot;title&quot;: &quot;اخري&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories-usages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories-usages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories-usages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories-usages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories-usages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories-usages" data-method="GET"
      data-path="api/categories/usages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories-usages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories-usages"
                    onclick="tryItOut('GETapi-categories-usages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories-usages"
                    onclick="cancelTryOut('GETapi-categories-usages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories-usages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/usages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories-usages"
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
                              name="Accept"                data-endpoint="GETapi-categories-usages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="rate-requests">Rate Requests</h1>

    <p>APIs for rate requests</p>

                                <h2 id="rate-requests-POSTapi-rate-requests">POST Add a request to the database</h2>

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
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
