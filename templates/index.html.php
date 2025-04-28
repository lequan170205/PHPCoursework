<div class="w-full min-h-screen bg-gradient-to-b from-gray-900 to-gray-950 py-12 px-4">
	<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
		<?php foreach ($posts as $post): ?>	
			<div class="group h-full">
				<a href="post_detail.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
					<div
						class="h-full flex flex-col bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-700/50 overflow-hidden hover:shadow-blue-500/10 hover:border-blue-500/30 transition-all duration-300">
						<!-- Image container with gradient -->
						<div class="relative w-full h-56 overflow-hidden">
							<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
								src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post image">
							<div
								class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-70">
							</div>

							<!-- Module badge positioned over image -->
							<div class="absolute bottom-4 left-4 z-10">
								<span	
									class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-blue-600/80 text-blue-100 backdrop-blur-sm shadow-lg">
									<?php echo htmlspecialchars($post['module_name']); ?>
								</span>
							</div>

							<div class="absolute top-4 right-4 z-10 flex items-center gap-2">
								<?php if ($post['user_id'] == $_SESSION['user_id'] || $_SESSION['is_admin']): ?>
								<button id="dropdownButton-<?php echo $post['post_id']; ?>"
									data-dropdown-toggle="dropdown-<?php echo $post['post_id']; ?>"
									class="p-2 bg-gray-900/60 backdrop-blur-sm rounded-full text-gray-400 hover:text-blue-400 hover:bg-gray-800/80 focus:outline-none transition-all duration-200"
									type="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round">
										<circle cx="12" cy="12" r="1"></circle>
										<circle cx="12" cy="5" r="1"></circle>
										<circle cx="12" cy="19" r="1"></circle>
									</svg>
								</button>

								<div id="dropdown-<?php echo $post['post_id']; ?>"
									class="hidden z-10 w-36 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
									<ul class="py-1 text-sm text-gray-200"
										aria-labelledby="dropdownButton-<?php echo $post['post_id']; ?>">
										<li>
											<a href="post_edit.php?id=<?php echo $post['post_id']; ?>"
												class="block px-4 py-2 hover:bg-gray-700 flex items-center">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
													viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
													stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-blue-400">
													<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
													<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
												</svg>
												Edit
											</a>
										</li>
										<li>
											<a href="post_delete.php?id=<?php echo $post['post_id']; ?>"
												onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.');"
												class="block w-full text-left px-4 py-2 hover:bg-gray-700 flex items-center">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
													viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
													stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-red-400">
													<path d="M3 6h18"></path>
													<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
													<path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
													<line x1="10" y1="11" x2="10" y2="17"></line>
													<line x1="14" y1="11" x2="14" y2="17"></line>
												</svg>
												Delete
											</a>
										</li>
									</ul>
								</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Content section - now a clickable link to the post -->
						<a href="post_detail.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
							<div class="flex flex-col flex-grow p-5 no-underline">
								<!-- Title -->
								<h2
									class="text-xl font-bold text-white tracking-tight mb-3 group-hover:text-blue-300 transition-colors duration-200">
									<?php echo htmlspecialchars($post['title']); ?>
								</h2>

								<!-- User info and engagement -->
								<div class="mt-auto pt-4 border-t border-gray-700/50">
									<div class="flex items-center justify-between">
										<!-- Author info -->
										<div class="flex items-center">
											<?php if (isset($post['avatar']) && $post['avatar']): ?>
											<div class="relative">
												<img src="<?php echo htmlspecialchars($post['avatar']); ?>" alt="User Avatar"
													class="w-10 h-10 rounded-full object-cover border-2 border-blue-500 shadow-md">
											</div>
											<?php endif; ?>

											<div class="ml-3">
												<div class="font-medium text-white">
													<?php echo htmlspecialchars($post['username']); ?>
												</div>
												<div class="text-xs text-gray-400">
													<?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<script>
document.querySelectorAll('[id^="dropdownButton-"]').forEach(button => {
  button.addEventListener('click', (e) => {
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>