<?php
return array(
    /** set your paypal credential **/
    'client_id' =>'AYDAgb3tYM7t9zGx4S2VZExFQ6DKx5iDU8zgfHQzGXnlRaPFTDO3K4XPkrttcToKaygfgFY5WoIkGF1E',
    'secret' => 'EOTGmWledo0iUQD9Q9e8oP150d8YIZLIfL_45SMQJPdhn-BAoMvgN-6biObl2bBHQLGpKls-iq7w0nz_',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);