<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $originalName;

    public function uploadFile($file = "file", $directory = "uploads",$keep_original_name = false, $use_timestamp = false, $contentType = 'image/jpeg')
    {
        return $this->uploadToLocal($file, $directory, $keep_original_name, null);
    }

    /**
     * 获取要上传的文件：可以是File/字段名/URL
     * @param $var
     * @return array|null|UploadedFile
     * @throws Exception
     */
    private function getFile($var)
    {
        if ($var instanceof UploadedFile) {
            return $var;
        }
        if (is_string($var)) {
            $request = app('request');
            if ($request->hasFile($var)) {
                return $request->file($var);
            }
            // it's a local file
            if ($this->doesLocalObjectExist($var)) {
                // TODO:get path from the Storage Facade
                $var = $this->urlPath($var);
                $full_path = public_path($var);
            } else {
                if (!$this->isUrl($var)) {
                    return null;
                }
                $tmp_folder = 'uploads/tmp';
                $tmp_path = public_path($tmp_folder);
                if (!file_exists($tmp_path)) {
                    $old = umask(0);
                    if (!@mkdir($tmp_path, 0777, true) && !is_dir($tmp_path)) {
                        throw new \Exception("Failed to make directory:$tmp_path");
                    }
                    umask($old);
                }

                set_time_limit(0);
                $full_path = public_path($tmp_folder . '/' . uniqid('', false) . basename($var));
                $content = @file_get_contents($var);
                if ($content !== false) {
                    file_put_contents($full_path, $content);
                } else {
                    throw new Exception("Failed to get content from $var");
                }
            }
            //File::mimeType($full_path)
            return new UploadedFile($full_path, basename($var), finfo_file(finfo_open(FILEINFO_MIME_TYPE), $full_path));
        }
    }

    /**
     * Upload to Local Storage
     * @param $file_field
     * @param $folder
     * @param $keep_original_name
     * @param null $filename
     * @return mixed
     * @throws \Exception
     */
    public function uploadToLocal($file_field, $folder, $keep_original_name, $filename = null)
    {
        $file = $this->getFile($file_field);
        if (!($file instanceof UploadedFile)) {
            return null;
        };
        $extension = $file->getClientOriginalExtension();
        if (!$filename) {
            if ($keep_original_name) {
                $filename = $file->getClientOriginalName();
            } else {
                $filename = uniqid('', false) . "." . $extension;
            }
        } else {
            $filename .= $extension ? ".$extension" : '';
        }

        if ($folder) {
            if (strpos($folder, 'uploads') === false) {
                $folder = "uploads/$folder";
            }
        } else {
            $folder = 'uploads';
        }
        $folder_abs_path = public_path($folder);
        if (!file_exists($folder_abs_path)) {
            $old = umask(0);
            if (!@mkdir($folder_abs_path, 0777, true) && !is_dir($folder_abs_path)) {
                throw new \Exception("Failed to make directory:$folder_abs_path");
            }
            umask($old);
        }
        $save_as = $folder_abs_path . '/' . $filename;
        $file_path = $folder .'/'. $filename;
        $this->putLocalObject($save_as, $file->getRealPath());
        $this->deleteTmpFile($file);
//        return "/$save_as"; // 斜杠/非常重要
        return url()->to($file_path);// 多个系统需要查看上传到Local的文件
    }

    /**
     * Returns the original file extension.
     *
     * It is extracted from the original file name that was uploaded.
     * Then it should not be considered as a safe value.
     *
     * @return string The extension
     */
    public function getClientOriginalExtension()
    {
        return pathinfo($this->originalName, PATHINFO_EXTENSION);
    }

    /**
     * 本地文件是否存在
     * @param $path
     * @return mixed
     */
    public function doesLocalObjectExist($path)
    {
        $path = $this->urlPath($path);
        if ($this->storageAvailable()) {
            return Storage::disk('local')->has($path);
        } else {
            return file_exists(public_path($path));
        }
    }

    /**
     * URL To Path
     * @param $url
     * @return mixed
     */
    public function urlPath($url)
    {
        if ($this->isUrl($url)) {
            return parse_url($url, PHP_URL_PATH);
        }
        return $url;
    }

    /**
     * URL To Path
     * @param $url
     * @return mixed
     */
    private function isUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            return true;
        }
    }

    /**
     * Storage是否可用
     * @return mixed
     */
    private static function storageAvailable()
    {
        return class_exists(Storage::class);
    }

    /**
     * 上传到本地
     * @param $save_as
     * @param $original_path
     */
    private function putLocalObject($save_as, $original_path)
    {
//        if ($this->storageAvailable()) {
//            Storage::disk('local')->put($save_as, file_get_contents($original_path));
//        } else {
//            file_put_contents(public_path($save_as), file_get_contents($original_path));
//        }
        $file_contents = file_get_contents($original_path);
        $img = Image::make($file_contents);

        // save file as jpg with medium quality
        $img->save($save_as, 60);
    }

    /**
     * 删除临时文件
     * @param $file
     */
    private function deleteTmpFile(UploadedFile $file)
    {
        $path = $file->getRealPath();
        if (strpos($path, 'tmp') !== false) {
            Log::warning('Deleting temp file:', [$path]);
            @unlink($path);
        }
    }
}
