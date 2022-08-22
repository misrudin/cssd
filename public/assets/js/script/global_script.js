const request_xhr = async (url, method = "GET", dataPost = null) => {
	const config = {
		url: url,
		method: method,
		cache: "no-cache",
		body: dataPost,

	}
	const response = await fetch(url, config);
	if (response.ok) {
		return response.json();
	} else {
		return Promise.reject({
			status: response.status,
			statusText: response.statusText,
			responseText: response.text()
		})
	}
}

if ('serviceWorker' in navigator) {
	window.addEventListener('load', function() {
	  navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
		// Registration was successful
		console.log('ServiceWorker registration successful with scope: ', registration.scope);
	  }, function(err) {
		// registration failed :(
		console.log('ServiceWorker registration failed: ', err);
	  });
	});
  }

