<div class="flex flex-col m-8 text-white p-6 bg-[#262D34] mt-6 rounded-lg shadow-lg">
	<div class="flex items-center mb-4">
		<i class="fa-regular fa-edit mr-2 text-xl"></i>
		<h1 class="text-2xl font-bold">Edit Question</h1>
	</div>

	<!-- Edit Form -->
	<form method="POST" enctype="multipart/form-data" class="space-y-4 max-w-2xl bg-[#262D34] p-6 rounded-lg"
		id="editForm">
		<input type="hidden" name="action" value="update">
		<div>
			<label for="title" class="block mb-2 text-sm font-medium text-white">Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required id="title"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
			<span class="text-red-500 text-sm" id="title-error"></span>
		</div>

		<div>
			<label for="content" class="block mb-2 text-sm font-medium text-white">Content</label>
			<textarea name="content" required id="content" rows="6"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"><?php echo htmlspecialchars($post['content']); ?></textarea>
			<span class="text-red-500 text-sm" id="content-error"></span>
		</div>

		<div>
			<label for="image" class="block mb-2 text-sm font-medium text-white">Image</label>
			<input type="file" name="image" accept="image/*" id="image" class="block w-full text-sm text-white file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0 file:text-sm file:font-medium
                file:bg-blue-600 file:text-white hover:file:bg-blue-700
                bg-gray-700 border border-gray-600 rounded-lg cursor-pointer">

			<div id="image-preview" class="mt-4 p-2 bg-gray-800 rounded-lg">
				<?php if ($post['image_path']): ?>
				<p class="text-sm text-gray-400 mb-2">Current Image:</p>
				<img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Current Image"
					class="max-w-xs rounded-lg border border-gray-700" id="current-image">
				<?php endif; ?>
			</div>
		</div>

		<div>
			<label for="module_id" class="block mb-2 text-sm font-medium text-white">Module</label>
			<select name="module_id" required id="module_id"
				class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
				<?php foreach ($modules as $module): ?>
				<option value="<?php echo $module['module_id']; ?>"
					<?php echo $module['module_id'] == $post['module_id'] ? 'selected' : ''; ?>>
					<?php echo htmlspecialchars($module['module_name']); ?>
				</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="flex mt-6">
			<a href="index.php" type="button"
				class="text-blue-500 mr-4 hover:text-white border border-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
				Cancel
			</a>
			<button type="submit"
				class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
				Update
			</button>
			<a href="post_delete.php?id=<?php echo urlencode($post['post_id']); ?>"
				onclick="return confirm('Are you sure you want to delete this post?');"
				class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 inline-block">
				Delete
			</a>
		</div>
	</form>
</div>

<script src="js/validation_post.js"></script>