<?php

class SocketConnection
{
	
  public static function _event_socket_create()
    {   
        $host = config('param.SocketConnection.host');
        $password =config('param.SocketConnection.password');
        $port = config('param.SocketConnection.port');

        try {
            $esl = new EventSocket();
            if ($esl->connect($host, $port, $password)) {
                return $esl->reset_fp();
            }else{
                return false;
            }    
        } catch (Exception $e) {
            return false;    
        }        
        
    }

    public static function _event_socket_request($fp, $cmd) 
    {
        try {
            $esl = new EventSocket($fp);
            $result = $esl->request($cmd);
            $esl->reset_fp();
            return $result;
        }  catch (Exception $e) {
            return false;    
        }   
    }

	
}
