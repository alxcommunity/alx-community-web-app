<?php
namespace App\Actions\Alxcommunity;
use App\Models\Media as med;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Media
{
     
     static public function create($files, $upload_path, $parent, $url = null)
     {
          $assests = [];
          if(!is_array($files) && !$url){
               $files = array($files);
          }
          else if ($url) {
               try {
                    $file = file_get_contents($files);
                    $name = substr($files, strrpos($files, '/') + 1);
                    $file_ext = (explode('.', explode('?', $name)[0])[1]);
                    $newName = Str::uuid().'.'.$file_ext;

                    $media = new med();
                    $path = Storage::disk('public_uploads')->put($upload_path.'/'.$newName, $file);
                    if (!$path) return false;
                    $picPath = $upload_path.'/'.$newName;

                    $media->mediaable()->associate($parent);
                    $media->path = $picPath;
                    $media->save();
                    array_push($assests, $picPath);
                    return $assests;

               } catch(Exception $e) {
                    return $e;
               }
          }
          foreach ($files as $image) {
              $media = new med();
              $path = Storage::disk('public_uploads')->put($upload_path, $image);
              if (!$path) return false;  
              $media->mediaable()->associate($parent);
              $media->path = $path;
              $media->save();
              array_push($assests, $path);
          }
          return $assests;
     }
}
