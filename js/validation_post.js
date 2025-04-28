document.addEventListener("DOMContentLoaded", function () {
	document.getElementById("title").addEventListener("input", function () {
		const title = this.value;
		const error = document.getElementById("title-error");
		error.textContent =
			title.length < 5 ? "Title must be at least 5 characters" : "";
	});

	document.getElementById("content").addEventListener("input", function () {
		const content = this.value;
		const error = document.getElementById("content-error");
		error.textContent =
			content.length < 10 ? "Content must be at least 10 characters" : "";
	});

	document.getElementById("image").addEventListener("change", function (e) {
		const file = e.target.files[0];
		const previewContainer = document.getElementById("image-preview");

		if (file) {
			const reader = new FileReader();

			reader.onload = function (e) {
				previewContainer.innerHTML = "";
				const text = document.createElement("p");
				text.className = "text-sm text-gray-400 mb-2";
				text.textContent = "Selected Image:";
				previewContainer.appendChild(text);
				const img = document.createElement("img");
				img.src = e.target.result;
				img.alt = "Selected Image";
				img.className = "max-w-xs rounded-lg border border-gray-700";
				img.id = "current-image";
				previewContainer.appendChild(img);
			};

			reader.readAsDataURL(file);
		}
	});
});
