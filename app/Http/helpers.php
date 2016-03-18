<?php

/*
|--------------------------------------------------------------------------
| Application Helpers
|--------------------------------------------------------------------------
|
| Here is where you can register all of the helpers for an application.
|
*/

/**
 * The cdn url generator.
 * @param  String $filePath - the relative path of assets file path
 * @return the url of assets file path
 */
function cdn($filePath) {
    if( !Config::get('app.cdn') ) {
        return $filePath;
    }

    $cdnDomain   = getCdnDomain($filePath);
    return getCdnUrl($cdnDomain, $filePath);
}

/**
 * Use File Extension to get the domain of CDN.
 * @param  String $filePath - the relative path of assets file path
 * @return the domain of the CDN server
 */
function getCdnDomainUrl($filePath)  {
    $cdnDomain   = getCdnDomain($filePath);
    return '//' . rtrim($cdnDomain, '/');
}

/**
 * Use File Extension to get the domain of CDN.
 * @param  String $filePath - the relative path of assets file path
 * @return the domain of the CDN server
 */
function getCdnDomain($filePath) {
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
function getCdnUrl($cdnDomain, $filePath) {
    return  '//' . rtrim($cdnDomain, '/') . '/' . ltrim($filePath, '/');
}
