<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - ULIXAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    @stack('head')

    <style>
        /* ═══════════════════════════════════════════════════════════════
           ADMIN DESIGN SYSTEM 2026 - Professional & Modern
           ═══════════════════════════════════════════════════════════════ */

        :root {
            /* Primary Colors */
            --admin-primary: #3B82F6;
            --admin-primary-dark: #2563EB;
            --admin-primary-light: #DBEAFE;

            /* Neutrals */
            --admin-bg: #F9FAFB;
            --admin-card: #FFFFFF;
            --admin-border: #E5E7EB;
            --admin-border-light: #F3F4F6;
            --admin-text: #111827;
            --admin-text-secondary: #4B5563;
            --admin-text-muted: #6B7280;
            --admin-text-light: #9CA3AF;

            /* Semantic Colors */
            --admin-success: #10B981;
            --admin-success-light: #D1FAE5;
            --admin-warning: #F59E0B;
            --admin-warning-light: #FEF3C7;
            --admin-danger: #EF4444;
            --admin-danger-light: #FEE2E2;
            --admin-info: #8B5CF6;
            --admin-info-light: #EDE9FE;

            /* Sidebar Dark Blue */
            --sidebar-bg: #0F172A;
            --sidebar-bg-hover: #1E293B;
            --sidebar-text: #CBD5E1;
            --sidebar-text-muted: #64748B;
            --sidebar-border: #1E293B;
            --sidebar-active-bg: rgba(59, 130, 246, 0.15);
            --sidebar-active-text: #60A5FA;

            /* Layout */
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --header-height: 64px;

            /* Transitions */
            --transition-fast: 150ms ease;
            --transition-normal: 300ms ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            margin: 0;
            line-height: 1.5;
        }

        /* ═══════════════════════════════════════════════════════════════
           LAYOUT STRUCTURE
           ═══════════════════════════════════════════════════════════════ */

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ═══════════════════════════════════════════════════════════════
           SIDEBAR - Collapsible
           ═══════════════════════════════════════════════════════════════ */

        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 100;
            transition: width var(--transition-normal);
            overflow: hidden;
        }

        .admin-sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar-header {
            padding: 16px;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: var(--header-height);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
        }

        .sidebar-logo img {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-weight: 700;
            font-size: 18px;
            color: #FFFFFF;
            white-space: nowrap;
            transition: opacity var(--transition-normal);
        }

        .admin-sidebar.collapsed .sidebar-logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--sidebar-border);
            background: var(--sidebar-bg-hover);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            transition: all var(--transition-fast);
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
            color: #FFFFFF;
        }

        .sidebar-toggle svg {
            width: 18px;
            height: 18px;
            transition: transform var(--transition-normal);
        }

        .admin-sidebar.collapsed .sidebar-toggle svg {
            transform: rotate(180deg);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
        }

        /* Custom scrollbar for sidebar */
        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-nav::-webkit-scrollbar-thumb {
            background: var(--sidebar-border);
            border-radius: 3px;
        }
        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: var(--sidebar-text-muted);
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--sidebar-text-muted);
            padding: 0 12px;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--transition-normal);
        }

        .admin-sidebar.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all var(--transition-fast);
            position: relative;
            white-space: nowrap;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: var(--sidebar-bg-hover);
            color: #FFFFFF;
        }

        .nav-item.active {
            background: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--admin-primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-item svg, .nav-item i {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .nav-item.active svg, .nav-item.active i {
            opacity: 1;
        }

        .nav-item-text {
            transition: opacity var(--transition-normal), width var(--transition-normal);
        }

        .admin-sidebar.collapsed .nav-item-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .admin-sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 12px;
        }

        /* Tooltips for collapsed sidebar */
        .nav-item[data-tooltip] {
            position: relative;
        }

        .admin-sidebar.collapsed .nav-item::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--admin-text);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-fast);
            z-index: 1000;
            pointer-events: none;
        }

        .admin-sidebar.collapsed .nav-item:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* ═══════════════════════════════════════════════════════════════
           MAIN CONTENT AREA
           ═══════════════════════════════════════════════════════════════ */

        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-normal);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-sidebar.collapsed ~ .admin-main {
            margin-left: var(--sidebar-collapsed);
        }

        /* ═══════════════════════════════════════════════════════════════
           HEADER
           ═══════════════════════════════════════════════════════════════ */

        .admin-header {
            height: var(--header-height);
            background: var(--admin-card);
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--admin-text);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 8px;
            background: var(--admin-bg);
        }

        .header-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--admin-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--admin-primary);
            font-weight: 600;
            font-size: 14px;
        }

        .header-user-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--admin-text);
        }

        /* ═══════════════════════════════════════════════════════════════
           BUTTONS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-lg {
            padding: 12px 24px;
            font-size: 15px;
        }

        .btn-primary {
            background: var(--admin-primary);
            color: white;
            box-shadow: 0 1px 2px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: var(--admin-primary-dark);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--admin-card);
            color: var(--admin-text-secondary);
            border: 1px solid var(--admin-border);
        }

        .btn-secondary:hover {
            background: var(--admin-bg);
            border-color: var(--admin-text-light);
        }

        .btn-danger {
            background: var(--admin-danger);
            color: white;
        }

        .btn-danger:hover {
            background: #DC2626;
        }

        .btn-success {
            background: var(--admin-success);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-ghost {
            background: transparent;
            color: var(--admin-text-secondary);
        }

        .btn-ghost:hover {
            background: var(--admin-bg);
        }

        /* ═══════════════════════════════════════════════════════════════
           CARDS
           ═══════════════════════════════════════════════════════════════ */

        .admin-card {
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .admin-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--admin-border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--admin-text);
        }

        .admin-card-body {
            padding: 20px;
        }

        /* ═══════════════════════════════════════════════════════════════
           TABLES
           ═══════════════════════════════════════════════════════════════ */

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background: var(--admin-bg);
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--admin-text-muted);
            border-bottom: 1px solid var(--admin-border);
        }

        .admin-table td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--admin-text-secondary);
            border-bottom: 1px solid var(--admin-border-light);
        }

        .admin-table tbody tr:hover {
            background: var(--admin-bg);
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Table responsive wrapper */
        .admin-table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Mobile card view for tables */
        @media (max-width: 768px) {
            .admin-table-mobile thead {
                display: none;
            }
            .admin-table-mobile tbody tr {
                display: block;
                background: var(--admin-card);
                border: 1px solid var(--admin-border);
                border-radius: 12px;
                margin-bottom: 12px;
                padding: 16px;
            }
            .admin-table-mobile tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px solid var(--admin-border-light);
            }
            .admin-table-mobile tbody td:last-child {
                border-bottom: none;
            }
            .admin-table-mobile tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 12px;
                text-transform: uppercase;
                color: var(--admin-text-muted);
                margin-right: 16px;
            }
            .admin-table-mobile tbody td:has(.btn) {
                justify-content: flex-end;
            }
            .admin-table-mobile tbody td:has(.btn)::before {
                display: none;
            }
        }

        /* ═══════════════════════════════════════════════════════════════
           FORM INPUTS
           ═══════════════════════════════════════════════════════════════ */

        .form-input {
            width: 100%;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            background: var(--admin-card);
            color: var(--admin-text);
            transition: all var(--transition-fast);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px var(--admin-primary-light);
        }

        .form-input::placeholder {
            color: var(--admin-text-light);
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--admin-text);
            margin-bottom: 6px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        /* ═══════════════════════════════════════════════════════════════
           BADGES & STATUS
           ═══════════════════════════════════════════════════════════════ */

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 6px;
        }

        .badge-primary {
            background: var(--admin-primary-light);
            color: var(--admin-primary-dark);
        }

        .badge-success {
            background: var(--admin-success-light);
            color: #065F46;
        }

        .badge-warning {
            background: var(--admin-warning-light);
            color: #92400E;
        }

        .badge-danger {
            background: var(--admin-danger-light);
            color: #991B1B;
        }

        .badge-info {
            background: var(--admin-info-light);
            color: #5B21B6;
        }

        .badge-gray {
            background: var(--admin-bg);
            color: var(--admin-text-muted);
        }

        .badge-default {
            background: var(--admin-border-light);
            color: var(--admin-text-secondary);
        }

        /* ═══════════════════════════════════════════════════════════════
           MODALS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-normal);
        }

        .admin-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .admin-modal {
            background: var(--admin-card);
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow: hidden;
            transform: scale(0.95) translateY(10px);
            transition: transform var(--transition-normal);
        }

        .admin-modal-overlay.active .admin-modal {
            transform: scale(1) translateY(0);
        }

        .admin-modal.modal-sm { max-width: 400px; }
        .admin-modal.modal-lg { max-width: 700px; }
        .admin-modal.modal-xl { max-width: 900px; }

        .admin-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--admin-border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-modal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--admin-text);
            margin: 0;
        }

        .admin-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--admin-text-muted);
            transition: all var(--transition-fast);
        }

        .admin-modal-close:hover {
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        .admin-modal-body {
            padding: 24px;
            overflow-y: auto;
            max-height: calc(90vh - 140px);
        }

        .admin-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--admin-border-light);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        /* ═══════════════════════════════════════════════════════════════
           LOADING STATES
           ═══════════════════════════════════════════════════════════════ */

        .admin-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            color: var(--admin-text-muted);
        }

        .admin-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--admin-border);
            border-top-color: var(--admin-primary);
            border-radius: 50%;
            animation: admin-spin 0.8s linear infinite;
        }

        .admin-spinner.spinner-sm {
            width: 20px;
            height: 20px;
            border-width: 2px;
        }

        .admin-spinner.spinner-lg {
            width: 56px;
            height: 56px;
            border-width: 4px;
        }

        @keyframes admin-spin {
            to { transform: rotate(360deg); }
        }

        .admin-loading-text {
            margin-top: 16px;
            font-size: 14px;
            color: var(--admin-text-muted);
        }

        /* Skeleton loading */
        .skeleton {
            background: linear-gradient(90deg, var(--admin-border-light) 25%, var(--admin-bg) 50%, var(--admin-border-light) 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 4px;
        }

        .skeleton-text {
            height: 14px;
            margin-bottom: 8px;
        }

        .skeleton-title {
            height: 24px;
            width: 60%;
            margin-bottom: 12px;
        }

        .skeleton-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ═══════════════════════════════════════════════════════════════
           EMPTY STATES
           ═══════════════════════════════════════════════════════════════ */

        .admin-empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            text-align: center;
        }

        .admin-empty-icon {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            color: var(--admin-text-light);
        }

        .admin-empty-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--admin-text);
            margin-bottom: 8px;
        }

        .admin-empty-description {
            font-size: 14px;
            color: var(--admin-text-muted);
            max-width: 400px;
            margin-bottom: 24px;
        }

        /* ═══════════════════════════════════════════════════════════════
           TOGGLE SWITCHES - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-toggle {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .admin-toggle input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .admin-toggle-track {
            width: 44px;
            height: 24px;
            background: var(--admin-border);
            border-radius: 12px;
            transition: background var(--transition-fast);
        }

        .admin-toggle input:checked + .admin-toggle-track {
            background: var(--admin-primary);
        }

        .admin-toggle-thumb {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: transform var(--transition-fast);
        }

        .admin-toggle input:checked ~ .admin-toggle-thumb {
            transform: translateX(20px);
        }

        .admin-toggle-label {
            margin-left: 12px;
            font-size: 14px;
            color: var(--admin-text);
        }

        /* ═══════════════════════════════════════════════════════════════
           BREADCRUMBS
           ═══════════════════════════════════════════════════════════════ */

        .admin-breadcrumbs {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .admin-breadcrumbs a {
            color: var(--admin-text-muted);
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .admin-breadcrumbs a:hover {
            color: var(--admin-primary);
        }

        .admin-breadcrumbs-separator {
            color: var(--admin-text-light);
        }

        .admin-breadcrumbs-current {
            color: var(--admin-text);
            font-weight: 500;
        }

        /* ═══════════════════════════════════════════════════════════════
           AVATARS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--admin-primary-light);
            color: var(--admin-primary);
            font-weight: 600;
            overflow: hidden;
        }

        .admin-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .admin-avatar-xs { width: 24px; height: 24px; font-size: 10px; }
        .admin-avatar-sm { width: 32px; height: 32px; font-size: 12px; }
        .admin-avatar-md { width: 40px; height: 40px; font-size: 14px; }
        .admin-avatar-lg { width: 48px; height: 48px; font-size: 16px; }
        .admin-avatar-xl { width: 64px; height: 64px; font-size: 20px; }

        /* ═══════════════════════════════════════════════════════════════
           TOOLTIPS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        [data-admin-tooltip] {
            position: relative;
        }

        [data-admin-tooltip]::after {
            content: attr(data-admin-tooltip);
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%);
            background: var(--admin-text);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-fast);
            z-index: 1000;
            pointer-events: none;
        }

        [data-admin-tooltip]:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* ═══════════════════════════════════════════════════════════════
           TABS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-tabs {
            display: flex;
            border-bottom: 1px solid var(--admin-border);
            margin-bottom: 24px;
        }

        .admin-tab {
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            color: var(--admin-text-muted);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: all var(--transition-fast);
            cursor: pointer;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .admin-tab:hover {
            color: var(--admin-text);
        }

        .admin-tab.active {
            color: var(--admin-primary);
            border-bottom-color: var(--admin-primary);
        }

        /* ═══════════════════════════════════════════════════════════════
           ALERTS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .admin-alert-icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
        }

        .admin-alert-content {
            flex: 1;
        }

        .admin-alert-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .admin-alert-close {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            border: none;
            background: transparent;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity var(--transition-fast);
        }

        .admin-alert-close:hover {
            opacity: 1;
        }

        .admin-alert-success {
            background: var(--admin-success-light);
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .admin-alert-danger {
            background: var(--admin-danger-light);
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .admin-alert-warning {
            background: var(--admin-warning-light);
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .admin-alert-info {
            background: var(--admin-info-light);
            color: #5B21B6;
            border: 1px solid #DDD6FE;
        }

        /* ═══════════════════════════════════════════════════════════════
           DATE PICKERS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-date-input {
            position: relative;
        }

        .admin-date-input input[type="date"],
        .admin-date-input input[type="datetime-local"] {
            width: 100%;
            padding: 10px 14px;
            padding-right: 40px;
            font-size: 14px;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            background: var(--admin-card);
            color: var(--admin-text);
            transition: all var(--transition-fast);
        }

        .admin-date-input input:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px var(--admin-primary-light);
        }

        .admin-date-input::after {
            content: '';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Date range picker */
        .admin-date-range {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-date-range-separator {
            color: var(--admin-text-muted);
            font-size: 14px;
        }

        /* ═══════════════════════════════════════════════════════════════
           CHECKBOXES & RADIOS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-checkbox,
        .admin-radio {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            color: var(--admin-text);
        }

        .admin-checkbox input,
        .admin-radio input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .admin-checkbox-box {
            width: 18px;
            height: 18px;
            border: 2px solid var(--admin-border);
            border-radius: 4px;
            background: var(--admin-card);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-fast);
        }

        .admin-checkbox input:checked + .admin-checkbox-box {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        .admin-checkbox-box svg {
            width: 12px;
            height: 12px;
            color: white;
            opacity: 0;
            transform: scale(0.5);
            transition: all var(--transition-fast);
        }

        .admin-checkbox input:checked + .admin-checkbox-box svg {
            opacity: 1;
            transform: scale(1);
        }

        .admin-checkbox input:focus + .admin-checkbox-box {
            box-shadow: 0 0 0 3px var(--admin-primary-light);
        }

        .admin-radio-circle {
            width: 18px;
            height: 18px;
            border: 2px solid var(--admin-border);
            border-radius: 50%;
            background: var(--admin-card);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-fast);
        }

        .admin-radio input:checked + .admin-radio-circle {
            border-color: var(--admin-primary);
        }

        .admin-radio-circle::after {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--admin-primary);
            opacity: 0;
            transform: scale(0);
            transition: all var(--transition-fast);
        }

        .admin-radio input:checked + .admin-radio-circle::after {
            opacity: 1;
            transform: scale(1);
        }

        .admin-radio input:focus + .admin-radio-circle {
            box-shadow: 0 0 0 3px var(--admin-primary-light);
        }

        /* ═══════════════════════════════════════════════════════════════
           PROGRESS BARS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-progress {
            height: 8px;
            background: var(--admin-border-light);
            border-radius: 4px;
            overflow: hidden;
        }

        .admin-progress-bar {
            height: 100%;
            border-radius: 4px;
            transition: width var(--transition-normal);
        }

        .admin-progress-primary { background: var(--admin-primary); }
        .admin-progress-success { background: var(--admin-success); }
        .admin-progress-warning { background: var(--admin-warning); }
        .admin-progress-danger { background: var(--admin-danger); }

        .admin-progress.progress-sm { height: 4px; }
        .admin-progress.progress-lg { height: 12px; }

        /* Progress with label */
        .admin-progress-wrapper {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }

        .admin-progress-label-text {
            color: var(--admin-text-secondary);
        }

        .admin-progress-label-value {
            font-weight: 600;
            color: var(--admin-text);
        }

        /* ═══════════════════════════════════════════════════════════════
           DROPDOWNS - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-dropdown {
            position: relative;
            display: inline-block;
        }

        .admin-dropdown-menu {
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            min-width: 180px;
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all var(--transition-fast);
            z-index: 100;
        }

        .admin-dropdown.open .admin-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .admin-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 14px;
            color: var(--admin-text-secondary);
            text-decoration: none;
            cursor: pointer;
            transition: all var(--transition-fast);
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .admin-dropdown-item:first-child {
            border-radius: 8px 8px 0 0;
        }

        .admin-dropdown-item:last-child {
            border-radius: 0 0 8px 8px;
        }

        .admin-dropdown-item:hover {
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        .admin-dropdown-item.danger {
            color: var(--admin-danger);
        }

        .admin-dropdown-item.danger:hover {
            background: var(--admin-danger-light);
        }

        .admin-dropdown-divider {
            height: 1px;
            background: var(--admin-border-light);
            margin: 4px 0;
        }

        .admin-dropdown-item svg {
            width: 16px;
            height: 16px;
        }

        /* ═══════════════════════════════════════════════════════════════
           SELECT WITH SEARCH - Standardized
           ═══════════════════════════════════════════════════════════════ */

        .admin-select-wrapper {
            position: relative;
        }

        .admin-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            background: var(--admin-card);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .admin-select-trigger:hover {
            border-color: var(--admin-text-light);
        }

        .admin-select-trigger.active {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px var(--admin-primary-light);
        }

        .admin-select-value {
            font-size: 14px;
            color: var(--admin-text);
        }

        .admin-select-placeholder {
            font-size: 14px;
            color: var(--admin-text-light);
        }

        .admin-select-arrow {
            width: 16px;
            height: 16px;
            color: var(--admin-text-muted);
            transition: transform var(--transition-fast);
        }

        .admin-select-wrapper.open .admin-select-arrow {
            transform: rotate(180deg);
        }

        .admin-select-dropdown {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all var(--transition-fast);
            z-index: 100;
            max-height: 280px;
            overflow: hidden;
        }

        .admin-select-wrapper.open .admin-select-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .admin-select-search {
            padding: 12px;
            border-bottom: 1px solid var(--admin-border-light);
        }

        .admin-select-search input {
            width: 100%;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid var(--admin-border);
            border-radius: 6px;
            background: var(--admin-bg);
        }

        .admin-select-search input:focus {
            outline: none;
            border-color: var(--admin-primary);
        }

        .admin-select-options {
            max-height: 200px;
            overflow-y: auto;
            padding: 4px;
        }

        .admin-select-option {
            padding: 10px 12px;
            font-size: 14px;
            color: var(--admin-text-secondary);
            border-radius: 6px;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .admin-select-option:hover {
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        .admin-select-option.selected {
            background: var(--admin-primary-light);
            color: var(--admin-primary-dark);
        }

        /* ═══════════════════════════════════════════════════════════════
           HIDDEN UTILITY
           ═══════════════════════════════════════════════════════════════ */

        .hidden {
            display: none !important;
        }

        /* ═══════════════════════════════════════════════════════════════
           PAGE CONTENT
           ═══════════════════════════════════════════════════════════════ */

        .admin-content {
            flex: 1;
            padding: 24px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--admin-text);
            margin: 0 0 4px 0;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--admin-text-muted);
            margin: 0;
        }

        /* ═══════════════════════════════════════════════════════════════
           CHART AREAS
           ═══════════════════════════════════════════════════════════════ */

        .chart-area { position: relative; height: 360px; }
        .chart-area.sm { height: 220px; }
        .chart-area.lg { height: 480px; }

        /* ═══════════════════════════════════════════════════════════════
           GOOGLE TRANSLATE HIDE
           ═══════════════════════════════════════════════════════════════ */

        iframe.goog-te-banner-frame,
        .goog-te-banner-frame { display: none !important; }
        body > .skiptranslate { display: none !important; }
        html { margin-top: 0 !important; }
        #goog-gt-tt, .goog-te-balloon-frame, .goog-te-gadget { display: none !important; }
        .VIpgJd-ZVi9od-ORHb { display: none !important; }

        /* ═══════════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════════ */

        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .mobile-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 90;
            }
            .admin-sidebar.mobile-open ~ .mobile-overlay {
                display: block;
            }
        }
    </style>
</head>
<body>

@if (session('success'))
<script>document.addEventListener('DOMContentLoaded', () => toastr.success('{{ session('success') }}'));</script>
@endif
@if (session('error'))
<script>document.addEventListener('DOMContentLoaded', () => toastr.error('{{ session('error') }}'));</script>
@endif

<div class="admin-layout">
    <!-- Sidebar -->
    @include('admin.dashboard.sidebar')

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" onclick="document.querySelector('.admin-sidebar').classList.remove('mobile-open')"></div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-left">
                <button class="btn btn-ghost btn-sm lg:hidden" onclick="document.querySelector('.admin-sidebar').classList.toggle('mobile-open')">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="header-title">Administration</span>
            </div>
            <div class="header-right">
                @php
                    $adminUser = auth()->guard('admin')->user();
                    $initials = $adminUser ? strtoupper(substr($adminUser->name ?? 'A', 0, 1)) : 'A';
                @endphp
                <div class="header-user">
                    <div class="header-user-avatar">{{ $initials }}</div>
                    <span class="header-user-name">{{ $adminUser->name ?? 'Admin' }}</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="admin-content">
            @yield('admin-content')
        </main>
    </div>
</div>

@stack('scripts')

<script>
// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.admin-sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    // Load saved state
    const isCollapsed = localStorage.getItem('admin-sidebar-collapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('admin-sidebar-collapsed', sidebar.classList.contains('collapsed'));
        });
    }
});

// Toastr configuration
if (typeof toastr !== 'undefined') {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 4000
    };
}

// Modal management
window.AdminModal = {
    open: function(modalId) {
        const overlay = document.getElementById(modalId);
        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    },
    close: function(modalId) {
        const overlay = document.getElementById(modalId);
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    },
    init: function() {
        // Close modal on overlay click
        document.querySelectorAll('.admin-modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        // Close modal on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.admin-modal-overlay.active').forEach(overlay => {
                    overlay.classList.remove('active');
                });
                document.body.style.overflow = '';
            }
        });
    }
};
document.addEventListener('DOMContentLoaded', () => AdminModal.init());
</script>

</body>
</html>
