<div class="w-full min-h-screen bg-gradient-to-b from-gray-900 to-gray-950 py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-white">Manage Modules</h1>
        
        <?php if ($_SESSION['is_admin']): ?>
        <form method="POST" class="space-y-4 mb-8 bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-700/50 p-6 hover:shadow-blue-500/10 hover:border-blue-500/30 transition-all duration-300">
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Module Name</label>
                <input type="text" name="module_name" required
                    class="w-full p-3 bg-gray-700/80 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200"
                    id="module_name">
                <span class="text-red-400 text-sm mt-1 block" id="module-error"></span>
            </div>
            <button type="submit" name="add_module" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Module
            </button>
        </form>
        <?php endif; ?>
        
        <h2 class="text-xl font-semibold mb-4 text-blue-300">Module List</h2>
        
        <div class="bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-700/50 overflow-hidden hover:shadow-blue-500/10 hover:border-blue-500/30 transition-all duration-300">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-700/80 text-left">
                        <th class="p-4 text-gray-200 font-medium">Module Name</th>
                        <?php if ($_SESSION['is_admin']): ?>
                        <th class="p-4 text-gray-200 font-medium text-right">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                    <tr class="border-t border-gray-700/50 hover:bg-gray-700/30 transition-colors duration-200">
                        <td class="p-4 text-white"><?php echo htmlspecialchars($module['module_name']); ?></td>
                        <?php if ($_SESSION['is_admin']): ?>
                        <td class="p-4 text-right">
                            <a href="module_manage.php?delete=<?php echo $module['module_id']; ?>"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 transition-all duration-200"
                                onclick="return confirm('Are you sure you want to delete this module? This action cannot be undone.');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                Delete
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Empty state for when there are no modules -->
        <?php if (empty($modules)): ?>
        <div class="flex flex-col items-center justify-center py-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-gray-600 mb-4">
                <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                <path d="M6 8h.01M6 12h.01M6 16h.01M12 8h6M12 12h6M12 16h6"></path>
            </svg>
            <p class="text-gray-400">No modules found. Add your first module above.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="js/validation_module.js"></script>