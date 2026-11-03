<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AWS extends Controller
{

    private $BUCKET = "bucket-poisson-2025";
    private $REGION = "ap-southeast-1";
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'filename' => 'required',
                'folder' => 'required',
                'team_id' => 'required'
            ]);

            $file = pathinfo($request->input('filename'));

            if (!isset($file['extension'])) throw new \Exception('no extension file');

            // generate random name and make key
            $folder = $request->input('folder');
            $team_id = $request->input('team_id');
            $filename = $folder . '-' . $team_id . '-' . Str::random(10) . '.' . $file['extension'];
            $key = "{$folder}/{$team_id}/";

            // AWS
            $client = new S3Client([
                'version' => 'latest',
                'region' => $this->REGION,
            ]);

            $bucket = $this->BUCKET;

            $formInputs = [
                // 'acl' => 'public-read',
                'key' => $key . $filename,
                'success_action_status' => "201"
            ];

            $options = [
                // ['acl' => 'public-read'],
                ['bucket' => $bucket],
                ['starts-with', '$key', $key],
                ['success_action_status' => "201"]
            ];

            $postObject = new \Aws\S3\PostObjectV4(
                $client,
                $bucket,
                $formInputs,
                $options,
            );

            $data = [
                'url' => $postObject->getFormAttributes(),
                'fields' => $postObject->getFormInputs()
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function getPresignedUrl($path)
    {
        $s3Client = new S3Client([
            'region'  => $this->REGION,
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $cmd = $s3Client->getCommand('GetObject', [
                'Bucket' => $this->BUCKET,
                'Key'    => $path
            ]);

            $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');

            return (string) $request->getUri();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
