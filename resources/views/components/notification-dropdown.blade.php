<div x-data="{ 
    open: false,
    count: 0,
    notifications: [],
    loading: false,
    error: null,
    init() {
        this.fetchNotifications();
        // Refresh notifications every 30 seconds
        setInterval(() => this.fetchNotifications(), 30000);
    },
    fetchNotifications() {
        this.loading = true;
        fetch('{{ route('notifications.unseen') }}')
            .then(response => response.json())
            .then(data => {
                this.notifications = data.documents;
                this.count = data.count;
                this.error = null;
            })
            .catch(error => {
                this.error = '{{ __('Failed to load notifications') }}';
                console.error('Error:', error);
            })
            .finally(() => {
                this.loading = false;
            });
    }
}" class="relative">
    <button 
        @click="open = !open" 
        class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none"
        :disabled="loading"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span 
            x-show="count > 0" 
            x-text="count" 
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
        ></span>
    </button>

    <div 
        x-show="open" 
        @click.away="open = false" 
        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50"
        x-cloak
        style="display: none;"
    >
        <div class="divide-y divide-gray-100">
            <template x-if="error">
                <div class="py-4 text-center text-red-500" x-text="error"></div>
            </template>
            
            <template x-if="!error && notifications.length === 0">
                <div class="py-4 text-center text-gray-500">
                    {{ __('No new notifications') }}
                </div>
            </template>

            <template x-if="!error && notifications.length > 0">
                <div>
                    <template x-for="doc in notifications" :key="doc.id">
                        <a :href="'{{ url('documents') }}/' + doc.id" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3 w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900" x-text="doc.file_type.name"></p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('From') }}: <span x-text="doc.from_department.name"></span>
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        {{ __('By') }}: <span x-text="doc.creator.name"></span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </template>
                    
                    <a href="{{ route('notifications.index') }}" class="block bg-gray-50 text-center py-2 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('View All Notifications') }}
                    </a>
                </div>
            </template>
        </div>
    </div>
</div>
