<form method="POST" enctype="multipart/form-data" id="profileForm">
	<div class="flex flex-col m-8 text-white p-6 bg-[#262D34] mt-6 rounded-lg shadow-lg w-[60%]">
		<div class="flex items-center">
			<i class="fa-regular fa-circle-user mr-2 text-xl"></i>
			<div>Account preferences</div>
		</div>
		<div class="flex mt-8">
			<img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="User Avatar" id="avatarPreview"
				class="w-25 h-25 mr-8 rounded-full object-cover" />
			<div class="flex flex-col justify-center">
				<input type="file" name="avatar" id="avatar-upload" accept="image/*" class="hidden">
				<label for="avatar-upload"
					class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 cursor-pointer">
					<i class="fa-regular mr-2 fa-image"></i>Change
				</label>
			</div>
		</div>
		<div class="flex mt-4">
			<div class="w-1/2">
				<div class="my-4">
					<label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
					<input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo htmlspecialchars($user['username']); ?>" type="text" id="username" name="username">
				</div>
				<div>
					<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
					<input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
				</div>
				<div class="my-4">
					<label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
					<input type="password" id="current_password" name="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
				</div>
				<div class="my-4">
					<label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
					<input type="password" id="new_password" name="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
				</div>
				<div class="my-4">
					<label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
					<input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
				</div>
			</div>
		</div>
		<div class="mb-4">
			<?php 
            if (!empty($error)) {
                echo $error;
            }
            if (!empty($success)) {
                echo $success;
            }
            ?>
		</div>
		<div class="flex mt-4">
			<a href="index.php" type="button"
				class="text-blue-700 mr-4 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Cancel</a>
			<button type="submit"
				class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
		</div>
	</div>
</form>

<script>
document.getElementById('avatar-upload').addEventListener('change', function(e) {
	const file = e.target.files[0];
	if (file) {
		const reader = new FileReader();
		reader.onload = function(e) {
			document.getElementById('avatarPreview').src = e.target.result;
		};
		reader.readAsDataURL(file);
	}
});
</script>