<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Log;

class SlackLanternController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function index(Request $request) {

        $content = $request->all();
        //Log::info(print_r($content));

        $formattedText = "";
        if (!empty($content['text'])) {
            $formattedText = $this->formatCommandText($content['text']);
        }

        $bobsBurgerDeal = [
            "text" => "<https://bobsburger.com/lantern|Bob's Burgers> - Houston St. (expires in 2 hours)",
            "fallback" => "$5 lunch including drinks at Bob\'s Burgers (expires in 2 hours)",
            "fields" => [[
                "title"=> "$5 Lunch special",
                "value"=> "Smoked Bacon Burger and Fries",
                "short"=> true
            ]],
            "color"=> "#F35A00",
            "image_url"=> "https://cdn.filestackcontent.com/CroTWMqEQYy488KUqVCi",
        ];

        $sushiDeal = [
            "text" => "<https://fujiyasushi.com/lantern|Fujiya Japanese Sushi> - Wurzbach Rd. (expires in 3 hours)",
            "fallback" => "$8 bento boxes at Fujiya Japanase Garden (expires in 3 hours)",
            "fields" => [[
                "title"=> "$8 Bento Boxes",
                "value"=> "Bento Boxes Sushi Combo",
                "short"=> true
            ]],
            "color"=> "#F35A00",
            "image_url"=> "https://cdn.filestackcontent.com/T6DkQxgXQrSVZwraK77P",
        ];

        $beerDeal = [
            "text" => "<https://theticketsa.com/lantern|The Ticket Bar> - Houston St. (expires in 2 hours)",
            "fallback" => "$2 beers (expires in 2 hours)",
            "fields" => [[
                "title"=> "$2 Draft Beers",
                "value"=> "All Domestic Beers are $2 from 4 to 7pm for Lantern members.",
                "short"=> true
            ]],
            "color"=> "#F35A00",
            "image_url"=> "https://cdn.filestackcontent.com/wjv8NPCEReO4eoSCxo1f",
        ];

        $pizzaDeal = [
            "text" => "<https://pizzapizzasa.com/lantern|Pizzaria> - Broadway St (expires in 24 hours)",
            "fallback" => "$8 pizza at Pizzaria (expires in 24 hours)",
            "fields" => [[
                "title"=> "$8 Pizza",
                "value"=> "1 Large 3 Toppings Pizza for $8 - Lantern members exclusive",
                "short"=> true
            ]],
            "color"=> "#F35A00",
            "image_url"=> "https://cdn.filestackcontent.com/ucjPBKqFSm28ABfQXCdt",
        ];

        $wineDeal = [
            "text" => "<https://nectarwinesa.com/lantern|Nectar> - Broadway St (expires in 5 hours)",
            "fallback" => "$4 wine at Nectar (expires in 5 hours)",
            "fields" => [[
                "title"=> "$4 Wine",
                "value"=> "Napa Valley Cabernet at $4 /glass - Lantern members exclusive",
                "short"=> true
            ]],
            "color"=> "#F35A00",
            "image_url"=> "https://cdn.filestackcontent.com/jDOciG3qQHW48CPU49Wq",
        ];

        $noDealsFound = [
            "text" => "<https://coactive.slackapps.host/lantern|Lantern App>",
            "fallback" => "No deals Found.",
            "fields" => [[
                "title"=> "No deals found.",
                "value"=> "Sorry, there are no deals available.  Please try another time.",
                "short"=> true
            ]],
            "color"=> "#F35A00"
        ];

        $specials = [];
        if (in_array($formattedText, [
            "now", "noon", "12pm", "1pm", "2pm", "3pm", "4pm"])) {
            array_push($specials, $bobsBurgerDeal);
            array_push($specials, $sushiDeal);
        }
        elseif (in_array($formattedText, [
            "tomorrow"])) {
            array_push($specials, $pizzaDeal);
            array_push($specials, $bobsBurgerDeal);
        }
        elseif (in_array($formattedText, [
            "4pm","5pm", "6pm", "7pm",
            "evening", "thisevening", "tonight"])) {

            array_push($specials, $beerDeal);
            array_push($specials, $wineDeal);
        }
        else {
            array_push($specials, $noDealsFound);
        }

        $toReturn = response()->json([
            "response_type" => "in_channel",
            "text" => "*Available Deals*",
            "attachments" => $specials
        ]);

        return $toReturn;
    }

    public function store(Request $request) {
        echo "posted";
        //Log::info("SlackLanternController POST called");

        $content = Request::all();
        //print_r($content);
    }

    private function formatCommandText($text) {
        $text = strtolower($text);
        $text = str_replace(" ", "", $text);
        return $text;
    }
}
