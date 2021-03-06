"use strict";
self.addEventListener( 'install', function( e ) {
	e.waitUntil(
		caches.open( 'marksimple' ).then( function( cache ) {
			return cache.addAll( [
				'./',
				'./index.php',
				'./index.php?homescreen=1',
				'./?homescreen=1',
				'./css/normalize.min.css',
				'./css/main.css',
				'./css/default.css',
				'./js/main.js',
				'./js/highlight.pack.js'
			] );
		} )
	);
} );

self.addEventListener( 'fetch', function( event ) {
	console.log( event.request.url );
	event.respondWith(
		caches.match( event.request ).then( function( response ) {
			return response || fetch( event.request );
		} )
	);
} );

onmessage = function( event ) {
	importScripts( './js/highlight.pack.js' );
	var result = self.hljs.highlightAuto( event.data );
	postMessage( result.value );
}