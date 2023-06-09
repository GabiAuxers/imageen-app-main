'use strict';

// CODELAB: Update cache names any time any of the cached files change.
const CACHE_NAME = 'static-cache-v1';

// CODELAB: Add list of files to cache here.
const FILES_TO_CACHE = [
];

self.addEventListener('install', (evt) => {
  console.log('[ServiceWorker] Install');
  // CODELAB: Precache static resources here.
  evt.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('[ServiceWorker] Pre-caching offline page');
      return cache.addAll(FILES_TO_CACHE);
    })
  );
  self.skipWaiting();
});


self.addEventListener('activate', (evt) => {
  console.log('[ServiceWorker] Activate');
  // CODELAB: Remove previous cached data from disk.
evt.waitUntil(
    caches.keys().then((keyList) => {
      return Promise.all(keyList.map((key) => {
        if (key !== CACHE_NAME) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
);
  self.clients.claim();
});

self.addEventListener('fetch', function(event) {
  //console.log('[ServiceWorker] Fetch '+event.request.url);
  if (!event.request.url.includes("/puntos/")) {
    //console.log('[ServiceWorker] No considerada');
    return;
  }
  console.log('[ServiceWorker] Mirando caché para '+event.request.url);
  event.respondWith(
    caches.open(CACHE_NAME).then(function(cache) {
      return cache.match(event.request).then(function (response) {
        return response || fetch(event.request).then(function(response) {
          cache.put(event.request, response.clone());
          return response;
        });
      });
    })
  );
});

/*self.addEventListener('fetch', (evt) => {
	console.log('[ServiceWorker] Fetch', evt.request.url);
  	// CODELAB: Add fetch event handler here.
	if (evt.request.mode !== 'navigate') {
  		// Not a page navigation, bail.
  		return;
	}
	evt.respondWith(
    	fetch(evt.request)
        	.catch(() => {
          	return caches.open(CACHE_NAME)
            .then((cache) => {
            	return cache.match('/default.php');
            });
        })
	);
});*/
