<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InstagramScraper\Instagram;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

class InstagramController extends Controller
{

    private $ig;
    private $console;
    private $username;

    function __construct()
    {
        $console = new ConsoleOutput();
        $this->console = $console;
        $ig = Instagram::withCredentials(new \GuzzleHttp\Client(), '', '', null);
        $ig->loginWithSessionId(env('INSTAGRAM_SESSION_ID'));
        $this->ig = $ig;
        set_time_limit(3600);
        $this->username = request()->username;
    }

    private function consoleLog($message): void
    {
        $this->console->write($message);
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
        $username = $this->username;
        return response()->json([
            'result' => $this->ig->getAccountInfo($username)->getProfilePicUrlHd()
        ]);
    }

    private function getId($username)
    {
        return $this->ig->getAccountInfo($username)->getId();
    }

    private function getFollowers($username, $total = 20)
    {
        $accountId = $this->getId($username);

        $resultFollowers = $this->ig->getFollowers($accountId, $total, $total);

        return $resultFollowers;
    }

    private function getFollowings($username, $total = 20)
    {
        $accountId = $this->getId($username);

        $resultFollowing = $this->ig->getFollowing($accountId, $total, $total);

        return $resultFollowing;
    }

    function followFromFollowersUser(Request $req)
    {

        $validasi = Validator::make($req->all(), [
            'username' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validasi->errors()
            ]);
        }

        $username = $this->username;
        $nextPage = request()->next_page ? request()->next_page : '';
        $count = request()->count ? request()->count : 20;
        $pageSize = request()->page_size ? request()->page_size : 20;

        $accountId = $this->getId($username);

        $followers = $this->ig->getPaginateFollowers($accountId, $count, $pageSize, true, $nextPage);

        $userIds = collect($followers['accounts'])->map(fn ($f) => $f['id']);

        foreach ($userIds as $id) {
            $this->ig->follow($id);
            $this->consoleLog("FOLLOWED ID $id");
            sleep(1);
        }

        return response()->json([
            'result' => 'success',
            'next_page' => $followers['nextPage']
        ]);
    }

    function checkNotFollback(Request $req)
    {
        $validasi = Validator::make($req->all(), [
            'username' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validasi->errors()
            ]);
        }

        $totalCompare = request()->total ? request()->total : 20;

        $followers = $this->getFollowers($this->username, $totalCompare);
        $followings = $this->getFollowings($this->username, $totalCompare);

        $notFollback = [];
        foreach ($followings as $following) {
            $isFollback = false;
            foreach ($followers as $follower) {
                if ($follower['id'] === $following['id']) {
                    $isFollback = true;
                    break;
                }
            }

            if (!$isFollback) {
                array_push($notFollback, $following);
            }
        }

        return response()->json([
            'not_follback_users' => $notFollback
        ]);
        // $followingIds = collect($followings)->map(fn() => [
        //     'id'
        // ]);
    }

    function getHighlights()
    {
        return $this->ig->getAccountInfo('rezaawp7')->getUserStories();
    }

    function followersAndFollowings()
    {
        $username = $this->username;

        return response()->json([
            'followers' => $this->getFollowers($username),
            'followings' => $this->getFollowings($username)
        ]);
    }
}
