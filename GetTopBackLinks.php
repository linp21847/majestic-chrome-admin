<?php

/*
 * Version 0.9.3
 *
 * Copyright (c) 2011, Majestic-12 Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *   1. Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *   2. Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *   3. Neither the name of the Majestic-12 Ltd nor the
 *      names of its contributors may be used to endorse or promote products
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL Majestic-12 Ltd BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

// NOTE: The code below is specifically for the GetTopBackLinks API command.
//       For other API commands, the arguments required may differ.
//       Please refer to the Majestic SEO Developer Wiki for more information
//       regarding other API commands and their arguments.

require_once 'majesticseo-external-rpc/APIService.php';


$endpoint = "GetTopPages";

echo("\n***********************************************************" .
    "*****************");

echo("\n\nEndpoint: $endpoint\n");

if("http://enterprise.majesticseo.com/api_command" == $endpoint) {
    echo("\n\nThis program is hard-wired to the Enterprise API.");
    echo("\n\nIf you do not have access to the Enterprise API, " .
        "change the endpoint to: \nhttp://developer.majesticseo.com/api_command.");
} else {
    echo("\n\nThis program is hard-wired to the Developer API " .
        "and hence the subset of data \nreturned will be substantially " .
        "smaller than that which will be returned from \neither the " .
        "Enterprise API or the Majestic SEO website.");

    echo "\n\nTo make this program use the Enterprise API, change " .
        "the endpoint to: \nhttp://enterprise.majesticseo.com/api_command.";
}

echo("\n\n***********************************************************" .
    "*****************");

echo("\n\n\nThis example program will return key information about \"index items\"." .
        "\n\nThe following must be provided in order to run this program: " .
        "\n1. API key \n2. List of items to query" .
        "\n\nPlease enter your API key:\n");

$app_api_key = "B253E4A6CF4798EFB631225CCE98C37F";

echo("\nPlease enter a URL, domain or subdomain to query:\n");

$itemToQuery = "www.digitalocean.com";

$parameters = array();
$parameters["MaxSourceURLs"] = 10;
$parameters["URL"] = $itemToQuery;
$parameters["GetUrlData"] = 1;
$parameters["MaxSourceURLsPerRefDomain"] = 1;
$parameters["datasource"] = "fresh";

$api_service = new APIService($app_api_key, $endpoint);
$response = $api_service->executeCommand("GetTopBackLinks", $parameters);

if($response->isOK() == "true") {
    $results = $response->getTableForName("URL");
    foreach($results->getTableRows() as $row) {
        echo("\nURL: ".$row['SourceURL']);
        echo("\nACRank: ".$row['ACRank']."\n");
    }

    if("http://developer.majesticseo.com/api_command" == $endpoint) {
        echo("\n\n***********************************************************" .
            "*****************");

        echo("\n\nEndpoint: " . $endpoint);

        echo("\n\nThis program is hard-wired to the Developer API " .
            "and hence the subset of data \nreturned will be substantially " .
            "smaller than that which will be returned from \neither the " .
            "Enterprise API or the Majestic SEO website.");

        echo("\n\nTo make this program use the Enterprise API, change " .
            "the endpoint to: \nhttp://enterprise.majesticseo.com/api_command.");

        echo("\n\n***********************************************************" .
            "*****************\n");
    }
} else {
    echo("\nERROR MESSAGE:");
    echo("\n" . $response->getErrorMessage());

    echo("\n\n\n***********************************************************" .
        "*****************");

    echo("\n\nDebugging Info:");
    echo("\n\n  Endpoint: \t" . $endpoint);
    echo("\n  API Key: \t" . $app_api_key);

    if("http://enterprise.majesticseo.com/api_command" == $endpoint) {
        echo("\n  Is this API Key valid for this Endpoint?");

        echo("\n\n  This program is hard-wired to the Enterprise API.");

        echo("\n\n  If you do not have access to the Enterprise API, " .
            "change the endpoint to: \n  http://developer.majesticseo.com/api_command.\n");
    }

    echo("\n***********************************************************" .
        "*****************\n");
}

?>
