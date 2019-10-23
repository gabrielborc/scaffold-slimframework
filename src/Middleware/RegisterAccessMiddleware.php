<?php 

namespace App\Middleware;

class RegisterAccessMiddleware 
{
    public function __invoke($request, $response, $next) {   
        $logger = new \App\Config\HandlerLog();

        $data_log = [];
        $data_log["method"] = $request->getMethod();
        $uri = $request->getUri();
        $data_log["uri"] = $uri->getScheme() . "://". $uri->getHost() . $uri->getPath() . $uri->getQuery();
        $data_log["IP"] = $_SERVER['REMOTE_ADDR'];
    
        $bodyContents = $request->getBody()->getContents();
        if ($bodyContents === "") {
            $data_log["body"] = $_POST;
        } else {
            $data_log["body"] =  $bodyContents;
        }
    
        if (count($request->getUploadedFiles()) > 0) {
            foreach ($request->getUploadedFiles() as $file) {
                $data_log["files"][] = [
                    "name" => $file->getClientFilename(),
                    "type" => $file->getClientMediaType(),
                    "size" => $file->getSize()
                ];
            }
        }
        
        $logger->registerLog('Acesso', $data_log);

        $response = $next($request, $response);    
        return $response;
    } 
}