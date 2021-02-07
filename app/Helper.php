<?php

use App\Models\Info;
use App\Models\Setting;
use App\Models\State;
use App\Models\StateTranslation;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\Language;


/**
 * Get static Setting by it's key
 */
function getInfoByKey($key)
{
    return Info::where('infos_key', $key)->first();
}


/**
 * Get static Setting by it's key
 */
function getSettingByKey($key)
{
    return Setting::where('settings_key', $key)->first();
}


/**
 * Get Count
 */
function countRows($table)
{
    return $table::count();
}



/**
 * Make Slug for title
 */
function make_slug($string = null, $separator = "-") {
    if (is_null($string)) {
        return "";
    }

    // Remove spaces from the beginning and from the end of the string
    $string = trim($string);

    // Lower case everything
    // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
    $string = mb_strtolower($string, "UTF-8");;

    // Make alphanumeric (removes all other characters)
    // this makes the string safe especially when used as a part of a URL
    // this keeps latin characters and arabic charactrs as well
    $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);
    return $string;
}


/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function haversineGreatCircleDistance(
    $latitudeFrom,
    $longitudeFrom,
    $latitudeTo,
    $longitudeTo,
    $earthRadius = 6371000
) {
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}

function distanceBetweenCoordinates($lat1, $lon1, $lat2, $lon2, $unit)
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}


function fillCountries()
{
    $cs = \DB::table('api_countries')->get()->toArray();
    $localesLangs = Language::get()->pluck('locale')->toArray();

    foreach ($cs as $c) {

        $Nc = json_decode(json_encode($c, true), true);

        // $nCountry = Country::create(['code' =>  $c->code]);
        $nCountry = new Country();
        $nCountry->id = $c->id;
        $nCountry->code = $c->code;
        $nCountry->save();

        foreach ($localesLangs as $lang) {
            $getName = 'name_' . $lang;

            $nCT = new CountryTranslation();
            $nCT->country_id = $nCountry->id;
            $nCT->locale = $lang;
            $nCT->name = $Nc[$getName];
            $nCT->save();
        }
    }

    return true;
}


function fillCities()
{
    $cs = \DB::table('api_cities')->get()->toArray();
    $localesLangs = Language::get()->pluck('locale')->toArray();

    foreach ($cs as $c) {

        $Nc = json_decode(json_encode($c, true), true);

        $nCountry = State::create(['country_id' =>  $c->country_id]);

        foreach ($localesLangs as $lang) {
            $getName = 'name_' . $lang;

            $nCT = new StateTranslation();
            $nCT->state_id = $nCountry->id;
            $nCT->locale = $lang;
            $nCT->name = $Nc[$getName];
            $nCT->save();
        }
    }

    return true;
}
