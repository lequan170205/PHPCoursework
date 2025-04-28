<div class="flex flex-col m-8 text-white p-6 bg-[#262D34] mt-6 rounded-lg shadow-lg">
	<div class="flex items-center mb-4">
		<i class="fas fa-users mr-2 text-xl"></i>
		<h1 class="text-2xl font-bold">Manage Users</h1>
	</div>

	<form method="POST" class="space-y-4 mb-6 max-w-md bg-[#262D34] p-6 rounded-lg">
		<div>
			<label for="username" class="block mb-2 text-sm font-medium text-white">Username</label>
			<input type="text" name="username" required id="username"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
			<span class="text-red-500 text-sm" id="username-error"></span>
		</div>

		<div>
			<label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
			<input type="email" name="email" required id="email"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
			<span class="text-red-500 text-sm" id="email-error"></span>
		</div>

		<div>
			<label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
			<input type="password" name="password" required id="password"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
			<span class="text-red-500 text-sm" id="password-error"></span>
		</div>

		<button type="submit" name="add_user"
			class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
			Add User
		</button>
	</form>

	<h2 class="text-xl font-semibold mb-4">User List</h2>
	<div class="overflow-x-auto">
		<table class="w-full border-collapse rounded-lg">
			<thead>
				<tr class="bg-gray-800">
					<th class="p-3 text-left">Username</th>
					<th class="p-3 text-left">Email</th>
					<th class="p-3 text-left">Admin</th>
					<th class="p-3 text-left">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr class="border-t border-gray-700">
					<td class="p-3"><?php echo htmlspecialchars($user['username']); ?></td>
					<td class="p-3"><?php echo htmlspecialchars($user['email']); ?></td>
					<td class="p-3"><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
					<?php if ($user['user_id'] != $_SESSION['user_id']): ?>
					<td class="p-3">
						<a href="user_manage.php?delete=<?php echo $user['user_id']; ?>"
							class="text-red-500 hover:text-red-400 hover:underline"
							onclick="return confirm('Are you sure?')">
							<i class="fa-solid fa-trash mr-1"></i>Delete
						</a>
					</td>
					<?php else: ?>
					<td class="p-3 text-gray-500">N/A</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="flex mt-4">
		<a href="index.php" type="button"
			class="text-blue-500 mr-4 hover:text-white border border-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
			Back
		</a>
	</div>
</div>

<script src="js/validation_user.js"></script>