<?php

namespace App\Http\Controllers;

use App\QRCode;
use Illuminate\Http\Request;
use App\Barang;
use App\User;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $client;
    protected $folder_id;
    protected $service;
    protected $ClientId     = '27961289220-emh84e3h56ghlujv6g4ecc4at7q30fp9.apps.googleusercontent.com';
    protected $ClientSecret = 'p6SjEqrPXcztTf1cSiBgIg6Y';
    protected $refreshToken = '1/MOrgN7STPGrvV_IiFSbkBJ8lcXIF1SXdgQlGwrSJBbZKCEspHnTDxOTZQvjHpKlO';

    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setClientId($this->ClientId);
        $this->client->setClientSecret($this->ClientSecret);
        $this->client->refreshToken($this->refreshToken);
        $this->service = new \Google_Service_Drive($this->client);
        // we cache the id to avoid having google creating
        // a new folder on each time we call it,
        // because google drive works with 'id' not 'name'
        // & thats why u could have duplicated folders under the same name
        Cache::rememberForever('folder_id', function () {
            return $this->create_folder();
        });
        $this->folder_id = Cache::get('folder_id');
    }

    protected function create_folder()
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name'     => 'google_drive_folder_name',
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);
        $folder = $this->service->files->create($fileMetadata, ['fields' => 'id']);
        return $folder->id;
    }

    protected function remove_duplicated($file)
    {
        $response = $this->service->files->listFiles([
            'q' => "'$this->folder_id' in parents and name contains '$file' and trashed=false",
        ]);
        foreach ($response->files as $found) {
            return $this->service->files->delete($found->id);
        }
    }

    public function upload_files(Request $request)
    {
         $adapter    = new GoogleDriveAdapter($this->service, Cache::get('folder_id'));
        $filesystem = new Filesystem($adapter);
        // here we are uploading files from local storage
        // we first get all the files
        $files = Storage::files();
        // loop over the found files
        foreach ($files as $file) {
            // remove file from google drive in case we have something under the same name
            // comment out if its okay to have files under the same name
            $this->remove_duplicated($file);
            // read the file content
            $read = Storage::get($file);
            // save to google drive
            $filesystem->write($file, $read);
            // remove the local file
            Storage::delete($file);
        }
    }

    public function files_count()
    {
        $response = $this->service->files->listFiles([
            'q' => "'$this->folder_id' in parents and trashed=false",
        ]);
        return count($response->files);
    }

    public function index()
    {
        // $barang = Barang::all();
        // return response()->json($barang);

        return view ('scanner');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // QRCode::create($data);
        // $test['data'] = json_encode($data);
        // return response($test, 201);
         $service = new \Google_Service_Drive($this->gClient);
            $user=User::find(1);
            $this->gClient->setAccessToken(json_decode($user->access_token,true));
            if ($this->gClient->isAccessTokenExpired()) {
               
                // save refresh token to some variable
                $refreshTokenSaved = $this->gClient->getRefreshToken();
                // update access token
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);               
                // // pass access token to some variable
                $updatedAccessToken = $this->gClient->getAccessToken();
                // // append refresh token
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
                //Set the new acces token
                $this->gClient->setAccessToken($updatedAccessToken);
                
                $user->access_token=$updatedAccessToken;
                $user->save();                
            }
            
           $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => 'ExpertPHP',
                'mimeType' => 'application/vnd.google-apps.folder'));
            $folder = $service->files->create($fileMetadata, array(
                'fields' => 'id'));
            printf("Folder ID: %s\n", $folder->id);
               
            
            $file = new \Google_Service_Drive_DriveFile(array(
                            'name' => 'cdrfile.jpg',
                            'parents' => array($folder->id)
                        ));
            $result = $service->files->create($file, array(
              'data' => file_get_contents(public_path('images/myimage.jpg')),
              'mimeType' => 'application/octet-stream',
              'uploadType' => 'media'
            ));
            // get url of uploaded file
            $url='https://drive.google.com/open?id='.$result->id;
            dd($result);
                
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function show(QRCode $qRCode, $data)
    {
        $user = User::find($data);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function edit(QRCode $qRCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QRCode $qRCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QRCode  $qRCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QRCode $qRCode)
    {
        //
    }
}
