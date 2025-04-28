<div class="flex flex-col m-8 text-white p-6 bg-[#262D34] mt-6 rounded-lg shadow-lg">
	<div class="flex items-center mb-4">
		<i class="fa-regular fa-envelope mr-2 text-xl"></i>
		<h1 class="text-2xl font-bold">Contact Admin</h1>
	</div>

	<form method="POST" class="space-y-4 max-w-md bg-[#262D34] p-6 rounded-lg">
		<div>
			<label for="message" class="block mb-2 text-sm font-medium text-white">Message</label>
			<textarea name="message" required id="message" rows="5"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
			<span class="text-red-500 text-sm" id="message-error"></span>
		</div>

		<div class="flex mt-4">
			<a href="index.php" type="button"
				class="text-blue-500 mr-4 hover:text-white border border-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
				Cancel
			</a>
			<button type="submit"
				class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
				Send
			</button>
		</div>
	</form>
</div>

<script src="js/validation_contact.js"></script>