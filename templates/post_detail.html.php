<div class="w-full min-h-screen bg-gradient-to-b from-gray-900 to-gray-950 py-12 px-4">
	<div class="max-w-4xl mx-auto mb-6">
        <a href="index.php" class="inline-flex items-center px-4 py-2 bg-gray-900/60 backdrop-blur-sm text-gray-200 hover:bg-gray-800 hover:text-blue-300 rounded-lg shadow-md border border-gray-700/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500" aria-label="Back to post list">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            Back
        </a>
    </div>
    <div class="max-w-4xl mx-auto bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-700/50 p-8">
        <!-- Post image -->
        <div class="relative w-full h-96 mb-6">
            <img class="w-full h-full object-cover rounded-lg" src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post image">
            <div class="absolute bottom-4 left-4 z-10">
                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-blue-600/80 text-blue-100 backdrop-blur-sm shadow-lg">
                    <?php echo htmlspecialchars($post['module_name']); ?>
                </span>
            </div>
        </div>
        
        <!-- Post title -->
        <h1 class="text-3xl font-bold text-white mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>
        
        <!-- Post content (assuming a content field exists) -->
        <?php if (isset($post['content'])): ?>
        <div class="prose prose-invert max-w-none text-gray-300 mb-8">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>
        <?php endif; ?>
        
        <!-- User info and date -->
        <div class="flex items-center justify-between border-t border-gray-700/50 pt-4">
            <div class="flex items-center">
                <?php if (isset($post['avatar']) && $post['avatar']): ?>
                <img src="<?php echo htmlspecialchars($post['avatar']); ?>" alt="User Avatar" class="w-12 h-12 rounded-full object-cover border-2 border-blue-500 shadow-md">
                <?php endif; ?>
                <div class="ml-4">
                    <div class="font-medium text-white"><?php echo htmlspecialchars($post['username']); ?></div>
                    <div class="text-sm text-gray-400"><?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>