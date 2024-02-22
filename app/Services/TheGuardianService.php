<?php
    namespace App\Services;
 
    use App\Interfaces\NewsListInterface;
    use Ixudra\Curl\Facades\Curl;
    use Illuminate\Support\Carbon;
     
    class TheGuardianService implements NewsListInterface {
     
        public function getList($search)
        {
            $response = Curl::to('https://content.guardianapis.com/search')
            ->withData( array( 'q' => $search, 'api-key' => 'test' ) )
            ->get();

            $data = json_decode($response);
            $news_results = [];

            foreach($data->response->results as $d)
            {
                $news['title'] = $d->webTitle;
                $news['url'] = $d->webUrl;
                $news['type'] = $d->type;
                $news['publish_date'] = Carbon::parse($d->webPublicationDate)->format('d-m-Y');
                $news['section_id'] = $d->sectionId;
                $news['section_name'] = $d->sectionName;
                array_push($news_results, $news);
            }            
            
            return $news_results;
        }

     
    }