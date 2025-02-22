<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark">
            <a href="{{route('dashboard')}}">
                @if(get_option('app_logo'))
                    <img src="{{ route('private.files', ['filename' => get_option('app_logo')]) }}" alt="">
                @endif
            </a>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item @if($activeMenu == 'dashboard') active-state @endif">
                    <a class="nav-link" href="{{route('dashboard')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-home/>
                </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'categories') active-state @endif">
                    <a class="nav-link" href="{{route('categories.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-category/>
                </span>
                        <span class="nav-link-title">
					Categories
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'currencies') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-currency-dollar/>
                </span>
                        <span class="nav-link-title">
					Currencies
				</span>
                    </a>
                </li>
                <li class="nav-item @if($activeMenu == 'banks') active-state @endif">
                    <a class="nav-link" href="{{route('banks.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-building-bank"><path stroke="none"
                                                                                                       d="M0 0h24v24H0z"
                                                                                                       fill="none"/><path
                            d="M3 21l18 0"/><path d="M3 10l18 0"/><path d="M5 6l7 -3l7 3"/><path d="M4 10l0 11"/><path
                            d="M20 10l0 11"/><path d="M8 14l0 3"/><path d="M12 14l0 3"/><path d="M16 14l0 3"/></svg>
                </span>
                        <span class="nav-link-title">
					Banks
				</span>
                    </a>
                </li>
                <li class="nav-item @if($activeMenu == 'bank-accounts') active-state @endif">
                    <a class="nav-link" href="{{route('accounts.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-lock-dollar"><path stroke="none"
                                                                                                     d="M0 0h24v24H0z"
                                                                                                     fill="none"/><path
                            d="M13 21h-6a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10"/><path
                            d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/><path d="M8 11v-4a4 4 0 1 1 8 0v4"/><path
                            d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"/><path
                            d="M19 21v1m0 -8v1"/></svg>
                </span>
                        <span class="nav-link-title">
					Bank Accounts
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'balance-transfer') active-state @endif">
                    <a class="nav-link" href="{{route('transfer.balance')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-transfer"><path stroke="none"
                                                                                                  d="M0 0h24v24H0z"
                                                                                                  fill="none"/><path
                            d="M20 10h-16l5.5 -6"/><path d="M4 14h16l-5.5 6"/></svg>
                </span>
                        <span class="nav-link-title">
					Balance Transfer
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'debt-loan') active-state @endif">
                    <a class="nav-link" href="{{route('debts')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-loader-3/>
                </span>
                        <span class="nav-link-title">
					Debts/Loans
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'incomes') active-state @endif">
                    <a class="nav-link" href="{{route('incomes.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-copy-plus/>
                </span>
                        <span class="nav-link-title">
					Incomes
				</span>
                    </a>
                </li>
                <li class="nav-item @if($activeMenu == 'expenses') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-receipt-dollar/>
                </span>
                        <span class="nav-link-title">
					Expenses
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'budgets') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-calendar-dollar/>
                </span>
                        <span class="nav-link-title">
					Budgets
				</span>
                    </a>
                </li>
                <li class="nav-item @if($activeMenu == 'income-report') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><x-tabler-report/></span>
                        <span class="nav-link-title">Income Report</span>
                    </a>
                </li>
                <li class="nav-item @if($activeMenu == 'expense-report') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-report/>
                </span>
                        <span class="nav-link-title">
					Expense Report
				</span>
                    </a>
                </li>

                <li class="nav-item @if($activeMenu == 'calendar') active-state @endif">
                    <a class="nav-link" href="{{route('currencies.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-calendar/>
                </span>
                        <span class="nav-link-title">
					Calendar
				</span>
                    </a>
                </li>


                <li class="nav-item @if($activeMenu == 'languages') active-state @endif">
                    <a class="nav-link" href="{{route('languages.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    {{ svg('clarity-language-solid') }}
                </span><span class="nav-link-title">Languages</span>
                    </a>
                </li>


                <li class="nav-item @if($activeMenu == 'application-settings') active-state @endif">
                    <a class="nav-link" href="{{route('settings.index')}}">
				<span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-tabler-settings/>
                </span>
                        <span class="nav-link-title">
					Application Settings
				</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
