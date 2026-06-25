<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Infographic;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Services\CkanService;
use App\Services\SumselNewsService;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Services\GeoportalService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    protected SumselNewsService $newsService;
    protected CkanService $ckan;
    protected GeoportalService $geoportal;

    public function __construct(SumselNewsService $newsService, CkanService $ckan, GeoportalService $geoportal)
    {
        $this->newsService = $newsService;
        $this->ckan = $ckan;
        $this->geoportal = $geoportal;
    }

    public function index()
    {
        $banner = Banner::active()
            ->orderBy('id', 'DESC')
            ->get();
        $news = $this->newsService->getNews();
        $groups = $this->ckan->listGroups(true);

        $records = $this->geoportal->getAll();
        $infografis = Infographic::orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
        $infographics = Infographic::orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('home', compact('banner', 'news', 'groups', 'infographics', 'infografis', 'records'));
    }

    public function groups($groups)
    {

        $page = request()->get('page', 1);
        $perPage = 10;
        $keyword = request()->get('fq:groups', $groups);


        $data = $this->ckan->groupDatasets($page, $perPage, $groups);

        return view('dataset.datagroup', [
            'items' => $data['items'],
            'total' => $data['total'],

        ]);
    }

    public function metadata(Request $request)
    {
        $data_geospasial = null;
        $data_berita = null;
        $data_infografis = null;
        $data_kategorigallery = null;
        $data_gallery = null;
        $collectionData = null;
        $paginationData = null;
        try {
            $id = $request->id;
            $page = $request->get('page', 1);
            $perPage = 10;
            $mskeg_api = "https://dna.web.bps.go.id/api/metadata/mskeg/search?province=16&city=1600&length=1000";

            $msvar_api = "https://dna.web.bps.go.id/api/metadata/msvar/search?province=16&city=1600&length=10";
            $msind_api = "https://dna.web.bps.go.id/api/metadata/msind/search?province=16&city=1600&length=100";
            $token_key = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzVhNmRjNDYwNDUxZGUyNGYyNDgxYjBkMGU3ZjUzZjQ3OTYzNTY5ZjUyZDY2ODkyYTJjZjBiMjAzNzM4Yzk1YjlkZGFmMTkxZmZkNDMzZTgiLCJpYXQiOjE3NzY3NTI3MzEuODk0MDQ0LCJuYmYiOjE3NzY3NTI3MzEuODk0MDQ4LCJleHAiOjE4MDgyODg3MzEuODcxNzM0LCJzdWIiOiIyNzIiLCJzY29wZXMiOltdfQ.y0xftZSylpNnX1cn87A-1M8Sjry4760EWqw95k9q8nccVJmkOIFvl2G1LifGuDdHzk8Ltd6gFRM2hkgKQjDy7TMYXKwyTrocfkS2wpZrZY-ARMrkwQhKXkN7aIyurnRXeA3J3SuXv9_EIsqjUmsm7MoURHDs1umk_62TQ4ZL2dKoZmSkem8xDzvfQY4f98Mx1ktSYD56luUOaWF45daCD3O-g1y9NOfGgvzVKOd0mS44JQu6McyrsKN_JPTNByoKf7fSUpbZMRRJiH4AXSR7P7Op-aeWkNyM9pV6HBVvMFmrUqW1hzM8SWU7txRNcbpLqrGY_ztONcZdeJSVENls1Q";

            $client = new Client();
            if ($id == 1) {
                try {
                    $response = $client->request('GET', $mskeg_api, [
                        'headers' => [
                            'Accept' => '*/*',
                            'Authorization' => $token_key,
                        ],
                        'timeout' => 30,
                    ]);
                    $body = $response->getBody()->getContents();
                    $status_code = $response->getStatusCode();
                    $data = json_decode($body, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        if (isset($data['result']) && isset($data['result']['data'])) {
                            $allData = $data['result']['data'];

                            // Sort globally descending by tahun
                            usort($allData, function ($a, $b) {
                                $yearA = $a['tahun'] ?? 0;
                                $yearB = $b['tahun'] ?? 0;
                                return $yearB <=> $yearA;
                            });

                            $total = count($allData);
                            $collectionData = array_slice($allData, ($page - 1) * $perPage, $perPage);

                            $paginationData = [
                                'current_page' => (int)$page,
                                'last_page' => ceil($total / $perPage),
                                'total' => $total,
                                'per_page' => $perPage,
                            ];
                        }
                    }
                    $titleData = 'METADATA KEGIATAN';
                } catch (RequestException $e) {
                    if ($e->hasResponse()) {
                        echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                    } else {
                        echo "Request Error: " . $e->getMessage();
                    }
                }
            }
            if ($id == 2) {
                try {
                    $client = new Client([
                        'verify' => false,
                        'timeout' => 30,
                        'curl' => [
                            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        ]
                    ]);
                    $response = $client->request('GET', $msvar_api, [
                        'headers' => [
                            'Accept' => 'application/json, text/plain, */*',
                            'Authorization' => $token_key,
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',

                            'Connection' => 'keep-alive',
                        ],
                    ]);

                    $body = $response->getBody()->getContents();
                    $status_code = $response->getStatusCode();
                    $data = json_decode($body, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        if (isset($data['result']) && isset($data['result']['data'])) {
                            $allData = $data['result']['data'];
                            usort($allData, function ($a, $b) {
                                $yearA = $a['tahun'] ?? 0;
                                $yearB = $b['tahun'] ?? 0;
                                return $yearB <=> $yearA;
                            });

                            $total = count($allData);
                            $collectionData = array_slice($allData, ($page - 1) * $perPage, $perPage);

                            $paginationData = [
                                'current_page' => (int)$page,
                                'last_page' => ceil($total / $perPage),
                                'total' => $total,
                                'per_page' => $perPage,
                            ];
                        }
                    }
                    $titleData = 'METADATA VARIABEL';
                } catch (RequestException $e) {
                    if ($e->hasResponse()) {
                        echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                    } else {
                        echo "Request Error: " . $e->getMessage();
                    }
                }
            }
            if ($id == 3) {
                try {
                    $response = $client->request('GET', $msind_api, [
                        'headers' => [
                            'Accept' => '*/*',
                            'Authorization' => $token_key,
                        ],
                        'timeout' => 30,
                    ]);
                    $body = $response->getBody()->getContents();
                    $status_code = $response->getStatusCode();
                    $data = json_decode($body, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        if (isset($data['result']) && isset($data['result']['data'])) {
                            $allData = $data['result']['data'];

                            // Sort globally descending by submission_period
                            usort($allData, function ($a, $b) {
                                $yearA = $a['submission_period'] ?? 0;
                                $yearB = $b['submission_period'] ?? 0;
                                return $yearB <=> $yearA;
                            });

                            $total = count($allData);
                            $collectionData = array_slice($allData, ($page - 1) * $perPage, $perPage);

                            $paginationData = [
                                'current_page' => (int)$page,
                                'last_page' => ceil($total / $perPage),
                                'total' => $total,
                                'per_page' => $perPage,
                            ];
                        }
                    }
                    $titleData = 'METADATA INDIKATOR';
                } catch (RequestException $e) {
                    if ($e->hasResponse()) {
                        echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                    } else {
                        echo "Request Error: " . $e->getMessage();
                    }
                }
            }
            if (empty($collectionData)) {
                throw new \Exception('Data metadata kosong atau tidak ditemukan pada collectionData.');
            }
            return view("metadata.index", compact('collectionData', 'titleData', 'paginationData'))->with("title", get_defined_vars());
        } catch (QueryException $e) {
            return redirect()->route('beranda');
        }
    }
    public function vdetailmetadata(Request $request, $jenis)
    {
        $mskeg_api = "https://dna.web.bps.go.id/api/metadata/mskeg/detail/" . $request->id;
        $msvar_api = "https://dna.web.bps.go.id/api/metadata/msvar/detail/" . $request->id;
        $msind_api = "https://dna.web.bps.go.id/api/metadata/msind/detail/" . $request->id;
        $msvar_under_mskeg_api = "https://dna.web.bps.go.id/api/metadata/msvar/under/" . $request->id;
        $dataKegiatan = "https://sirusa.web.bps.go.id/metadata/export?id=" . md5($request->id);

        $msind_under_mskeg_api = "https://dna.web.bps.go.id/api/metadata/msind/under/" . $request->id;
        // $token_key = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTVkYmUzNWNjZDkwYjUyYzA3YjU1NzY1ODM3YjUwZTQ2M2UxZGU4MmZkYjVmMjA3NzdjYmFhMTMyNTMzYmQ0MWVjNGZjNmVkYmQ4YTZjYWEiLCJpYXQiOjE3MTYzNDI5OTUuNDIwNDM3LCJuYmYiOjE3MTYzNDI5OTUuNDIwNDQzLCJleHAiOjE3NDc4Nzg5OTUuMzg5ODY1LCJzdWIiOiIxMjgiLCJzY29wZXMiOltdfQ.e3FQwOhWhojlweHgWmSgbPpIhui-CjHnHNXJY2CGzcjUrzykcRrrlmpDCzRx1NlH9giLqH6KpDsA1XAdDniL1_ptP6HY5PCKKsmR9Blpk2CNLqMtT7q3UsVfaUOKyIcf7FSuAjVNrVPbDuqdyWRvsJjtqsKIeTG1YxR7hrcoPvpBVV0zSSHA9wR0liseCnUjOk-SIcr-lsV-P7_EH6NYexqFeK5LCaKAoLxwvjqHeBCtagvSfxcZX2XxabzMmeDyK5TcbYS7XIYM4AhKhlIT7paRy-iaMRuv4ZH8z7X4P-xMW4rXiBSFI4pTndiQBjj8l9zUOG4u3yG7w8HPHxZ3MtNgeUyvtk4z5zk0px-D785uMbB24U5LsOShXuqYZ0XW_70KWfGc4lIHu99bq5KbUXG3t6nlkyO4QTrIdXQRUJ0f-FrgvR8Z98bDqHZIPB6B-LF-UdMH8HKyNlTpcxFLkcFGk0GCCOyeHD806dEPDlrRO35V7SwY-mqXSLalJhoiaMTpJAzn8KIuaG_YSYQuFEB7UOTJmDNHWZqO8hGo83rYYeDJTGWD0b5wqQIkfznx4yo7x1ibaaq2pffIOuOqhY-ZU-P6ZApog85wSw27qHvRwVvdvLRjIM6jtMVztBDcrxR5F5w_xMEUEojWR4pHfKdAI0qr8D40X4lt19AEzdk";
        // $token_key = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZWJhYWMyMTY0ZWEzNGVhZDViY2Q4Mjc4NWI5OTA0ZmQ0ODgxZTA5NWI1MGVmNDQ1MTZmZGQ4NGQ5MjQ2NzRkYWM0MDZiOTZmNjgzMjI4ZjgiLCJpYXQiOjE3NDE5Mzk1ODguNTQ0NzEzLCJuYmYiOjE3NDE5Mzk1ODguNTQ0NzE4LCJleHAiOjE3NzM0NzU1ODguMDYxMjgzLCJzdWIiOiIxMjgiLCJzY29wZXMiOltdfQ.fQXS9V8aTfM2DYqWr4Iuk6caRtoM7ePFt185ymS_APmYlLCt2_B9sEhQ-IB1cdnmPZhRQ4_PhqahAm2NZo3-qvhBg2AfUvy32KAe_mSrZaeae8Zf_4dkZQ9yCgsdO3gM6oRlWzFutRPqIJx7E3rYEEG-iE_dUa9yjwunnR8IHtT8bx7D1p2DPelCqkrXftXeIowHcEaMZP-CqM4RWatuZxitNZow4jAjyR3vuAatgdq0P0LVUdnT_WpUCWAv9zE5jcB1y3TX-dj5jBplrFLbVft2QB0Kf39k55r2sFOF8BXt2gJVK48tN0eA0FBZW6Bd4pBFkrgx-tTMM_XnS35dKA";
        $token_key = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzVhNmRjNDYwNDUxZGUyNGYyNDgxYjBkMGU3ZjUzZjQ3OTYzNTY5ZjUyZDY2ODkyYTJjZjBiMjAzNzM4Yzk1YjlkZGFmMTkxZmZkNDMzZTgiLCJpYXQiOjE3NzY3NTI3MzEuODk0MDQ0LCJuYmYiOjE3NzY3NTI3MzEuODk0MDQ4LCJleHAiOjE4MDgyODg3MzEuODcxNzM0LCJzdWIiOiIyNzIiLCJzY29wZXMiOltdfQ.y0xftZSylpNnX1cn87A-1M8Sjry4760EWqw95k9q8nccVJmkOIFvl2G1LifGuDdHzk8Ltd6gFRM2hkgKQjDy7TMYXKwyTrocfkS2wpZrZY-ARMrkwQhKXkN7aIyurnRXeA3J3SuXv9_EIsqjUmsm7MoURHDs1umk_62TQ4ZL2dKoZmSkem8xDzvfQY4f98Mx1ktSYD56luUOaWF45daCD3O-g1y9NOfGgvzVKOd0mS44JQu6McyrsKN_JPTNByoKf7fSUpbZMRRJiH4AXSR7P7Op-aeWkNyM9pV6HBVvMFmrUqW1hzM8SWU7txRNcbpLqrGY_ztONcZdeJSVENls1Q";

        $client = new Client();
        $titleData = 'METADATA';
        if ($jenis == 1) {
            try {
                $response = $client->request('GET', $mskeg_api, [
                    'headers' => [
                        'Accept' => '*/*',
                        'Authorization' => $token_key,
                    ],
                    'timeout' => 30,
                ]);
                $body = $response->getBody()->getContents();
                $status_code = $response->getStatusCode();
                $data = json_decode($body, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data['result'])) {
                        $collectionData = $data['result'];
                    }
                }
                $response2 = $client->request('GET', $msvar_under_mskeg_api, [
                    'headers' => [
                        'Accept' => '*/*',
                        'Authorization' => $token_key,
                    ],
                    'timeout' => 30,
                ]);
                $body2 = $response2->getBody()->getContents();
                $status_code2 = $response2->getStatusCode();
                $data2 = json_decode($body2, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data2['result'])) {
                        $collectionData2 = $data2['result'];
                    }
                }
                $response3 = $client->request('GET', $msind_under_mskeg_api, [
                    'headers' => [
                        'Accept' => '*/*',
                        'Authorization' => $token_key,
                    ],
                    'timeout' => 30,
                ]);
                $body3 = $response3->getBody()->getContents();
                $status_code3 = $response3->getStatusCode();
                $data3 = json_decode($body3, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data3['result'])) {
                        $collectionData3 = $data3['result'];
                    }
                }
                $titleData = 'METADATA KEGIATAN';
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                } else {
                    echo "Request Error: " . $e->getMessage();
                }
            }
        }
        if ($jenis == 2) {
            try {
                $response = $client->request('GET', $msvar_api, [
                    'headers' => [
                        'Accept' => '*/*',
                        'Authorization' => $token_key,
                    ],
                    'timeout' => 30,
                ]);
                $body = $response->getBody()->getContents();
                $status_code = $response->getStatusCode();

                $data = json_decode($body, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data['result'])) {
                        $collectionData = $data['result'];
                    }
                }
                $titleData = 'METADATA VARIABEL';
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                } else {
                    echo "Request Error: " . $e->getMessage();
                }
            }
        }
        if ($jenis == 3) {
            try {
                $response = $client->request('GET', $msind_api, [
                    'headers' => [
                        'Accept' => '*/*',
                        'Authorization' => $token_key,
                    ],
                    'timeout' => 30,
                ]);
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);
                $data = json_decode($body, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    if (isset($data['result'])) {
                        $collectionData = $data['result'];
                    }
                }
                $titleData = 'METADATA INDIKATOR';
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    echo "HTTP Error: " . $e->getResponse()->getStatusCode() . " " . $e->getResponse()->getReasonPhrase();
                } else {
                    echo "Request Error: " . $e->getMessage();
                }
            }
        }

        if (empty($collectionData)) {
            $collectionData = [];
        } else {
            // Jika API mengembalikan array index [0] (seperti msvar/detail dan msind/detail)
            if (isset($collectionData[0]) && is_array($collectionData[0])) {
                $collectionData = $collectionData[0];
            }

            // Flatten nested arrays to strings so Blade doesn't throw htmlspecialchars error
            foreach ($collectionData as $key => $value) {
                if (is_array($value)) {
                    if (empty($value)) {
                        $collectionData[$key] = '-';
                    } elseif (isset($value[0]['awal']) && isset($value[0]['akhir'])) {
                        $collectionData[$key] = $value[0]['awal'] . ' s/d ' . $value[0]['akhir'];
                    } elseif (isset($value[0]) && is_string($value[0])) {
                        $collectionData[$key] = implode(', ', $value);
                    } else {
                        $collectionData[$key] = json_encode($value);
                    }
                }
            }
        }
        return view('metadata.show', get_defined_vars());
    }
}
