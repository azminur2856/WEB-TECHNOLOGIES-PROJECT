<?php
    // Check if email exists
    function isEmailExists($email) {
        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX")) {
            return false;
        }
    
        $mailServers = dns_get_record($domain, DNS_MX);
        usort($mailServers, function ($a, $b) {
            return $a['pri'] <=> $b['pri'];
        });
    
        $mailServerHost = $mailServers[0]['target'];
        $socket = @fsockopen($mailServerHost, 25, $errno, $errstr, 10);
        if (!$socket) {
            return false;
        }
    
        fgets($socket);
        fwrite($socket, "HELO " . gethostname() . "\r\n");
        fgets($socket);
    
        fwrite($socket, "MAIL FROM:<check@example.com>\r\n");
        fgets($socket);
    
        fwrite($socket, "RCPT TO:<$email>\r\n");
        $response = fgets($socket);
    
        fwrite($socket, "QUIT\r\n");
        fclose($socket);
    
        return strpos($response, "250") !== false;
    }
?>