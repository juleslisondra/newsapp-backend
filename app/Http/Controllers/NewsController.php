<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsSearchRequest;
use App\Interfaces\NewsListInterface;
use App\Services\TheGuardianService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsList;

    public function __construct(NewsListInterface $newsList) { 
        $this->newsList = $newsList;
    }

    /**
     * Search for news.
     */
    public function search(NewsSearchRequest $request)
    {
        $data = $request->validated();
        
        $search = $this->newsList->getList($data['search']);
        // $search = (new TheGuardianService())->getList($data['search']);
        // dd($search);

        return response()->json([
            "status" => true,
            "message" => "News data",
            "search" => $search
        ]);

        // return response()->json(['message' => 'Bookmark updated successfully']);
    }
}
