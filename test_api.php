<?php
$token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzVhNmRjNDYwNDUxZGUyNGYyNDgxYjBkMGU3ZjUzZjQ3OTYzNTY5ZjUyZDY2ODkyYTJjZjBiMjAzNzM4Yzk1YjlkZGFmMTkxZmZkNDMzZTgiLCJpYXQiOjE3NzY3NTI3MzEuODk0MDQ0LCJuYmYiOjE3NzY3NTI3MzEuODk0MDQ4LCJleHAiOjE4MDgyODg3MzEuODcxNzM0LCJzdWIiOiIyNzIiLCJzY29wZXMiOltdfQ.y0xftZSylpNnX1cn87A-1M8Sjry4760EWqw95k9q8nccVJmkOIFvl2G1LifGuDdHzk8Ltd6gFRM2hkgKQjDy7TMYXKwyTrocfkS2wpZrZY-ARMrkwQhKXkN7aIyurnRXeA3J3SuXv9_EIsqjUmsm7MoURHDs1umk_62TQ4ZL2dKoZmSkem8xDzvfQY4f98Mx1ktSYD56luUOaWF45daCD3O-g1y9NOfGgvzVKOd0mS44JQu6McyrsKN_JPTNByoKf7fSUpbZMRRJiH4AXSR7P7Op-aeWkNyM9pV6HBVvMFmrUqW1hzM8SWU7txRNcbpLqrGY_ztONcZdeJSVENls1Q";
$opts = [ 'http' => [ 'header' => "Authorization: " . $token . "\r\nAccept: */*\r\n" ] ];
$ctx = stream_context_create($opts);

// Fetch a single Variabel ID from the new endpoint. In my old test I did /msvar?length=1 which 404'd.
// Let's use the one in HomeController: https://dna.web.bps.go.id/api/metadata/msvar?length=1 (wait, in HomeController index it uses $msvar_api. Let me check what that is.)
$res = file_get_contents("https://dna.web.bps.go.id/api/metadata/msvar", false, $ctx);
$data = json_decode($res, true);
if (!empty($data['result']['data'][0]['id'])) {
    $id = $data['result']['data'][0]['id'];
    $detailRes = file_get_contents("https://dna.web.bps.go.id/api/metadata/msvar/detail/" . $id, false, $ctx);
    print_r(json_decode($detailRes, true));
}
