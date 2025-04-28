<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
	<div class="max-w-md w-full space-y-8">
		<div class="text-center">
			<h1 class="text-2xl font-bold text-white mb-2">Sign Up</h1>
			<p class="text-gray-400">Create your account</p>
		</div>

		<form method="POST" class="mt-8 space-y-6 bg-gray-800 p-6 rounded-xl shadow-xl border border-gray-700">
			<div>
				<label for="username" class="block text-sm font-medium text-gray-300">Username</label>
				<div class="mt-1 relative">
					<input id="username" name="username" type="text" required
						class="w-full p-3 border border-gray-700 rounded-lg bg-gray-750 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
					<span class="text-red-400 text-sm mt-1 block" id="username-error"></span>
				</div>
			</div>

			<div>
				<label for="email" class="block text-sm font-medium text-gray-300">Email</label>
				<div class="mt-1 relative">
					<input id="email" name="email" type="email" required
						class="w-full p-3 border border-gray-700 rounded-lg bg-gray-750 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
					<span class="text-red-400 text-sm mt-1 block" id="email-error"></span>
				</div>
			</div>

			<div>
				<label for="password" class="block text-sm font-medium text-gray-300">Password</label>
				<div class="mt-1">
					<input id="password" name="password" type="password" required
						class="w-full p-3 border border-gray-700 rounded-lg bg-gray-750 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
					<span class="text-red-400 text-sm mt-1 block" id="password-error"></span>
				</div>
			</div>

			<div class="pt-2">
				<button type="submit"
					class="group relative w-full flex justify-center py-3 px-4 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02]">
					Sign Up
				</button>
			</div>

			<div class="text-center mt-4 pt-4 border-t border-gray-700">
				<p class="text-gray-400">Already have an account?
					<a href="login.php"
						class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Login</a>
				</p>
			</div>
		</form>
	</div>
</div>
<script src="js/validation_signup.js"></script>