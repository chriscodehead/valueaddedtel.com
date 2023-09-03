@include('partials.head')

<body class="nk-body npc-crypto bg-white has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @include('partials.sidebar')
            @include('partials.header')

            <div class="nk-content nk-content-fluid">
                @if(!$user->isAdmin)
                    @include('modals.no-pin')
                @endif
                <div class="container-xl wide-lg">
                    @yield('contents')
                </div>
            </div>

            @if($user->isAdmin == 0)
                @include('modals.upgrade_with_wallet')
                @include('modals.delete-trans')
                @include('modals.delete-history')
                @include('modals.topup')
                @include('modals.modal-confirm')
                @include('modals.withdrawal-modal')
            @endif
                @include('modals.profile_update')

            @stack('modals')

            @include('partials.footer')
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
    </div>
    <!-- app-root @e -->
    @include('partials.scripts')
</body>

</html>
