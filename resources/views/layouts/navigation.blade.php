<x-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.index')">
    {{ __('Blog') }}
</x-nav-link> 