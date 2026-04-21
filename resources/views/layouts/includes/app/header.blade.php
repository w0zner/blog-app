        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('home') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                {{-- <flux:tooltip :content="__('Repository')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="folder-git-2"
                        href="https://github.com/laravel/livewire-starter-kit"
                        target="_blank"
                        :label="__('Repository')"
                    />
                </flux:tooltip>
                <flux:tooltip :content="__('Documentation')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open-text"
                        href="https://laravel.com/docs/starter-kits#livewire"
                        target="_blank"
                        :label="__('Documentation')"
                    />
                </flux:tooltip> --}}
            </flux:navbar>

            @auth
                <x-desktop-user-menu />
            @else
                <flux:navbar class="space-x-0.5 rtl:space-x-reverse">
                    <flux:dropdown>
                        <flux:navbar.item
                            icon="user"
                            icon-trailing="chevron-down"
                            class="h-10 [&>div>svg]:size-5 cursor-pointer"
                        >
                            {{-- {{ __('Acceder') }} --}}
                        </flux:navbar.item>

                        <flux:menu>
                            <flux:menu.item :href="route('login')" wire:navigate icon="arrow-right-start-on-rectangle">
                                {{ __('Login') }}
                            </flux:menu.item>

                            <flux:menu.item :href="route('register')" wire:navigate icon="user-plus">
                                {{ __('Registrarse') }}
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </flux:navbar>

                {{-- <flux:navbar class="space-x-0.5 rtl:space-x-reverse">
                    <flux:tooltip :content="__('Login')" position="bottom">
                        <flux:navbar.item
                            class="h-10 [&>div>svg]:size-5"
                            icon="user"
                            :href="route('login')"
                            wire:navigate
                            :label="__('Login')"
                        />
                    </flux:tooltip>
                </flux:navbar> --}}
            @endauth
        </flux:header>