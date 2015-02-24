<?php

/*
|--------------------------------------------------------------------------
| Application Helpers
|--------------------------------------------------------------------------
|
| Here is where you can register all of the helpers for an application.
|
*/

class Helper {
    /**
     * The cdn url generator.
     * @param  String $filePath - the relative path of assets file path
     * @return the url of assets file path
     */
    public static function cdn($filePath) {
        if( !Config::get('app.cdn') ) {
            return $filePath;
        }

        $cdnDomain   = self::getCdnDomain($filePath);
        return self::getCdnUrl($cdnDomain, $filePath);
    }

    /**
     * Use File Extension to get the domain of CDN.
     * @param  String $filePath - the relative path of assets file path
     * @return the domain of the CDN server
     */
    public static function getCdnDomainUrl($filePath)  {
        $cdnDomain   = self::getCdnDomain($filePath);
        return '//' . rtrim($cdnDomain, '/');
    }

    /**
     * Use File Extension to get the domain of CDN.
     * @param  String $filePath - the relative path of assets file path
     * @return the domain of the CDN server
     */
    private static function getCdnDomain($filePath) {
        $cdnSettings = Config::get('app.cdn');
        $assetName   = basename($filePath);

        foreach( $cdnSettings as $fileExt => $cdnDomain ) {
            if( preg_match('/^.*\.('.$fileExt.')$/i', $assetName) ) {
                return $cdnDomain;
            }
        }

        $cdnDomain   = $cdnSettings['default'];
        return $cdnDomain;
    }

    /**
     * Get the url of assets files.
     * @param  String $cdnDomain - the domain of CDN server
     * @param  String $filePath  - the relative path of assets file path
     * @return the url of assets file path
     */
    private static function getCdnUrl($cdnDomain, $filePath) {
        return  '//' . rtrim($cdnDomain, '/') . '/' . ltrim($filePath, '/');
    }
}