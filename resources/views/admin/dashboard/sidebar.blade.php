<aside class="admin-sidebar" role="navigation" aria-label="Admin sidebar">
    <!-- Sidebar Header with Logo & Toggle -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-512x512.png') }}" alt="Ulixai">
            <span class="sidebar-logo-text">Ulixai</span>
        </div>
        <button id="sidebarToggle" class="sidebar-toggle" aria-label="Toggle sidebar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Overview -->
        <div class="nav-section">
            <p class="nav-section-title">Vue d'ensemble</p>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               data-tooltip="Dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <path d="M9 22V12h6v10"/>
                </svg>
                <span class="nav-item-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.messages') }}"
               class="nav-item {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"
               data-tooltip="Messages">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
                <span class="nav-item-text">Messages</span>
            </a>
        </div>

        <!-- Operations -->
        <div class="nav-section">
            <p class="nav-section-title">Opérations</p>
            <a href="{{ route('admin.users') }}"
               class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}"
               data-tooltip="Utilisateurs">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <span class="nav-item-text">Utilisateurs</span>
            </a>
            <a href="{{ route('admin.missions') }}"
               class="nav-item {{ request()->routeIs('admin.missions*') ? 'active' : '' }}"
               data-tooltip="Missions">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12h6M9 16h6"/>
                </svg>
                <span class="nav-item-text">Missions</span>
            </a>
            <a href="{{ route('admin.disputes') }}"
               class="nav-item {{ request()->routeIs('admin.disputes') ? 'active' : '' }}"
               data-tooltip="Litiges">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <span class="nav-item-text">Litiges</span>
            </a>
        </div>

        <!-- Finance -->
        <div class="nav-section">
            <p class="nav-section-title">Finance</p>
            <a href="{{ route('admin.accounting.index') }}"
               class="nav-item {{ request()->routeIs('admin.accounting*') ? 'active' : '' }}"
               data-tooltip="Comptabilité">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                </svg>
                <span class="nav-item-text">Comptabilité</span>
            </a>
            <a href="{{ route('admin.transactions') }}"
               class="nav-item {{ request()->routeIs('admin.transactions*') ? 'active' : '' }}"
               data-tooltip="Transactions">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
                <span class="nav-item-text">Transactions</span>
            </a>
        </div>

        <!-- Growth & Marketing -->
        <div class="nav-section">
            <p class="nav-section-title">Croissance</p>
            <a href="{{ route('admin.seo.index') }}"
               class="nav-item {{ request()->routeIs('admin.seo*') ? 'active' : '' }}"
               data-tooltip="SEO & Analytics">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 20V10M12 20V4M6 20v-6"/>
                </svg>
                <span class="nav-item-text">SEO & Analytics</span>
            </a>
            <a href="{{ route('admin.press') }}"
               class="nav-item {{ request()->routeIs('admin.press*') ? 'active' : '' }}"
               data-tooltip="Presse">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a2 2 0 01-2 2z"/>
                    <path d="M2 6h4M10 6h8M10 10h8M10 14h4"/>
                </svg>
                <span class="nav-item-text">Presse</span>
            </a>
        </div>

        <!-- Content & Catalog -->
        <div class="nav-section">
            <p class="nav-section-title">Contenu</p>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"
               data-tooltip="Catégories">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
                </svg>
                <span class="nav-item-text">Catégories</span>
            </a>
            @if(auth()->guard('admin')->user() && method_exists(auth()->guard('admin')->user(), 'hasAdminRole') && auth()->guard('admin')->user()->hasAdminRole('super_admin'))
            <a href="{{ route('admin.countries.index') }}"
               class="nav-item {{ request()->routeIs('admin.countries*') ? 'active' : '' }}"
               data-tooltip="Pays">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="2" y1="12" x2="22" y2="12"/>
                    <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                </svg>
                <span class="nav-item-text">Pays</span>
            </a>
            @endif
            <a href="{{ route('admin.faqs.index') }}"
               class="nav-item {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}"
               data-tooltip="FAQ">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <span class="nav-item-text">FAQ</span>
            </a>
            <a href="{{ route('admin.badges') }}"
               class="nav-item {{ request()->routeIs('admin.badges*') ? 'active' : '' }}"
               data-tooltip="Badges">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="7"/>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                </svg>
                <span class="nav-item-text">Badges</span>
            </a>
        </div>

        <!-- Partenariats & Affiliation -->
        <div class="nav-section">
            <p class="nav-section-title">Partenariats</p>
            <a href="{{ route('admin.affiliates.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.affiliates*') ? 'active' : '' }}"
               data-tooltip="Programme d'affiliation">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <span class="nav-item-text">Affiliation</span>
            </a>
            <a href="{{ route('admin.partnerships') }}"
               class="nav-item {{ request()->routeIs('admin.partnerships') ? 'active' : '' }}"
               data-tooltip="Demandes de partenariat">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/>
                    <line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
                <span class="nav-item-text">Partenariats</span>
            </a>
            <a href="{{ route('admin.applications') }}"
               class="nav-item {{ request()->routeIs('admin.applications') ? 'active' : '' }}"
               data-tooltip="Candidatures">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                    <path d="M9 12h6M9 16h6"/>
                </svg>
                <span class="nav-item-text">Candidatures</span>
            </a>
        </div>

        <!-- Settings & Security -->
        <div class="nav-section">
            <p class="nav-section-title">Paramètres</p>
            <a href="{{ route('admin.roles-permissions') }}"
               class="nav-item {{ request()->routeIs('admin.roles-permissions') ? 'active' : '' }}"
               data-tooltip="Rôles & Permissions">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                <span class="nav-item-text">Rôles & Permissions</span>
            </a>
            <a href="{{ route('admin.settings') }}"
               class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
               data-tooltip="Paramètres">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
                </svg>
                <span class="nav-item-text">Paramètres</span>
            </a>
        </div>

        <!-- Tools -->
        <div class="nav-section">
            <p class="nav-section-title">Outils</p>
            <a href="{{ route('admin.w-map-view') }}"
               class="nav-item {{ request()->routeIs('admin.w-map-view') ? 'active' : '' }}"
               data-tooltip="Carte mondiale">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <span class="nav-item-text">Carte mondiale</span>
            </a>
            <a href="{{ route('admin.bug-reports') }}"
               class="nav-item {{ request()->routeIs('admin.bug-reports') ? 'active' : '' }}"
               data-tooltip="Bug Reports">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                    <path d="M10 14l2 2 4-4"/>
                </svg>
                <span class="nav-item-text">Bug Reports</span>
            </a>
            <a href="{{ route('admin.fake-content-generation') }}"
               class="nav-item {{ request()->routeIs('admin.fake*') ? 'active' : '' }}"
               data-tooltip="Fake Data">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                <span class="nav-item-text">Fake Data</span>
            </a>
        </div>
    </nav>
</aside>
