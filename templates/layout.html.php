<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo htmlspecialchars($title); ?></title>
	<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
	<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-[#1d252c] font-sans">
	<?php if (isset($_SESSION['user_id'])): ?>
	<nav class="bg-[#262D34] p-4 text-white shadow-lg">
		<div class="container mx-auto flex justify-between items-center">
			<a href="index.php" class="text-lg font-bold tracking-tight">Student Q&A</a>
			<div class="space-x-6 flex items-center">
				<a href="post_add.php" class="hover:text-blue-200"><i class="fas fa-plus"></i> Add Post</a>
				<?php if ($_SESSION['is_admin']): ?>
				<a href="user_manage.php" class="hover:text-blue-200"><i class="fas fa-users"></i> Manage Users</a>
				<?php else: ?>
				<a href="contact.php" class="hover:text-blue-200"><i class="fas fa-envelope"></i> Contact</a>
				<?php endif; ?>
				<a href="module_manage.php" class="hover:text-blue-200"><i class="fas fa-book"></i> Modules</a>
				<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button" class='cursor-pointer'>
					<img src="<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="User Avatar"
						class="w-10 h-10 mr-2 rounded-full" />
				</button>

				<!-- Dropdown menu -->
				<div id="dropdown"
					class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
						<li>
							<a href="profile.php"
								class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
						</li>
						<li>
							<a href="logout.php"
								class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
								out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<?php endif; ?>
	<main class="w-full"><?php echo $output; ?></main>
</body>

</html>