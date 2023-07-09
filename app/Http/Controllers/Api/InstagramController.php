<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InstagramScraper\Instagram;


class InstagramController extends Controller
{

    private $ig;

    function __construct()
    {
        $ig = Instagram::withCredentials(new \GuzzleHttp\Client(), '', '', null);
        $ig->loginWithSessionId(env('INSTAGRAM_SESSION_ID'));
        $this->ig = $ig;
    }

    function getMediaPhotoByUrl()
    {
        $url = request()->link;
        $image = $this->getMediaByUrl($url)->getImageHighResolutionUrl();
        return response()->json([
            'result' => $image
        ]);
    }

    private function getMediaByUrl($url)
    {
        $url = explode("/", $url)[4];

        $media = $this->ig->getMediaByCode($url);

        return $media;
    }

    function getProfilePicture()
    {
        $username = request()->username;
        return response()->json([
            'result' => $this->ig->getAccountInfo($username)->getProfilePicUrlHd()
        ]);
    }

    private function getId($username)
    {
        return $this->ig->getAccountInfo($username)->getId();
    }

    private function getFollowers($username)
    {
        $accountId = $this->getId($username);

        $resultFollowers = $this->ig->getFollowers($accountId, 100, 100);

        return $resultFollowers;
    }

    private function getFollowings($username)
    {
        $accountId = $this->getId($username);

        $resultFollowing = $this->ig->getFollowing($accountId, 100, 100);

        return $resultFollowing;
    }

    function getHighlights()
    {
        return $this->ig->getAccountInfo('rezaawp7')->getUserStories();
    }

    function followersAndFollowings()
    {
        $username = request()->username;

        return response()->json([
            'followers' => $this->getFollowers($username),
            'followings' => $this->getFollowings($username)
        ]);
    }
}
