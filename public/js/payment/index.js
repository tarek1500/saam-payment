(function() {
	let form = document.querySelector('#payment-form');

	form.addEventListener('submit', (event) => {
		event.preventDefault();

		let formData = new FormData(form);
		let url = event.target.getAttribute('action');
		let method = event.target.getAttribute('method');

		fetch(url, {
			method,
			body: formData
		})
		.then(response => response.json())
		.then(response => {
			let scriptTag = document.createElement('script');
			let registerButton = form.querySelector('.register .btn');
			let paymentWidgets = document.querySelector('.paymentWidgets');

			paymentWidgets.scrollIntoView({
				behavior: 'smooth'
			});

			scriptTag.src = response.script_url;
			registerButton.disabled = true;

			document.body.appendChild(scriptTag);
			paymentWidgets.dataset.brands = formData.get('payment_option');
			paymentWidgets.setAttribute('action', response.shopperResultUrl);
		});
	});
})();