// const assets = [

//   "./",

//   "./public/assets/images/splashscreen/logo-rsud.png",

//   "./public/assets/images/logo-rsud.png",

//   "./manifest.json",

//   "./public/assets/css/bootstrap.min.css",

//   "./public/assets/css/icons.min.css",

//   "./public/assets/css/app.min.css",

//   "./public/assets/js/setting-pwa.js",

//   "./public/assets/libs/jquery/jquery.min.css",

//   "./public/assets/libs/sweetalert2/sweetalert2.min.css",

//   "./public/assets/libs/sweetalert2/sweetalert2.min.js",

//   "./public/assets/libs/toastr/build/toastr.min.css",

//   "./public/assets/libs/toastr/build/toastr.min.js",

//   "./public/assets/libs/bootstrap/js/bootstrap.bundle.min.js",

//   "./public/assets/libs/metismenu/metisMenu.min.js",

//   "./public/assets/libs/node-waves/waves.min.js",

//   "./public/assets/libs/simplebar/simplebar.min.js",

//   "./public/assets/js/app.js",

//   "./public/assets/libs/moment/moment.js",

//   "./public/assets/libs/moment/locale/id.js",

//   "./public/assets/js/script/global_script.js",

// ];



// let cache_name = "CSSD Online";

// self.addEventListener("install", function (e) {

//   console.log("installing...");

//   e.waitUntil(

//     caches.open(cache_name)

//       .then(function (cache) {

//         return cache.addAll(assets);

//       })

//       .catch((err) => console.log(err))

//   );

// });



// self.addEventListener("activate", (e) => {

//   e.waitUntil(

//     caches.keys().then((keyList) => {

//       return Promise.all(

//         keyList.map((key) => {

//           if (key !== cache_name) {

//             return caches.delete(key);

//           }

//         })

//       );

//     })

//   );

// });



// self.addEventListener("fetch", (e) => {

//   e.respondWith(

//     caches.match(e.request).then((r) => {

//       console.log("[Service Worker] Fetching resource: " + e.request.url);

//       return (

//         r ||

//         fetch(e.request).then((response) => {

//           return caches.open(cache_name).then((cache) => {

//             console.log(

//               "[Service Worker] Caching new resource: " + e.request.url

//             );

//             cache.put(e.request, response.clone());

//             return response;

//           });

//         })

//       );

//     })

//   );

// });
var CACHE_NAME = 'cssd-online';
var urlsToCache = [
  '/'
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});
