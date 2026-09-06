@extends('Employee.layouts.app')

@section('title', 'لوحة تحكم الموظف | Elite Club')

@section('styles')
<style>
    .dashboard-page {
        width: 100%;
        min-width: 0;
        max-width: 100%;
        color: var(--text);
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding: 4px 2px;
    }

    .dashboard-header-info {
        min-width: 0;
        max-width: 100%;
    }

    .dashboard-title {
        margin: 0;
        color: var(--text);
        font-size: 30px;
        font-weight: 900;
        line-height: 1.4;
        letter-spacing: -.6px;
        overflow-wrap: anywhere;
    }

    .dashboard-subtitle {
        display: block;
        margin-top: 6px;
        color: var(--muted, var(--text));
        font-size: 14px;
        font-weight: 600;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .dashboard-alert {
        display: flex;
        align-items: center;
        gap: 11px;
        max-width: 100%;
        padding: 14px 17px;
        margin-bottom: 18px;
        border-radius: 13px;
        font-size: 14px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .dashboard-alert.success {
        color: var(--success);
        background: color-mix(in srgb, var(--success) 7%, var(--surface));
        border: 1px solid color-mix(in srgb, var(--success) 18%, var(--border));
    }

    .dashboard-alert.error {
        color: var(--danger);
        background: color-mix(in srgb, var(--danger) 7%, var(--surface));
        border: 1px solid color-mix(in srgb, var(--danger) 18%, var(--border));
    }

    .player-notifications {
        position: relative;
        min-width: 0;
        max-width: 100%;
        margin-bottom: 22px;
        background: linear-gradient(
            135deg,
            color-mix(in srgb, var(--gold) 7%, var(--surface)),
            var(--surface)
        );
        border: 1px solid color-mix(in srgb, var(--gold) 25%, var(--border));
        border-radius: 19px;
        box-shadow:
            var(--shadow-sm),
            0 0 35px color-mix(in srgb, var(--gold) 4%, transparent);
        overflow: hidden;
    }

    .player-notifications::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(
            180deg,
            var(--gold-light),
            var(--gold-dark)
        );
    }

    .player-notifications::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        left: -70px;
        bottom: -85px;
        border-radius: 50%;
        background: color-mix(in srgb, var(--gold) 5%, transparent);
        pointer-events: none;
    }

    .notification-header {
        min-height: 76px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 21px;
        border-bottom: 1px solid color-mix(in srgb, var(--border) 85%, transparent);
        background: color-mix(in srgb, var(--surface-2) 45%, transparent);
    }

    .notification-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        flex: 1 1 auto;
    }

    .notification-heading > div:last-child {
        min-width: 0;
    }

    .notification-heading-icon {
        position: relative;
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 10%, var(--surface));
        border: 1px solid color-mix(in srgb, var(--gold) 24%, var(--border));
        border-radius: 12px;
        font-size: 16px;
    }

    .notification-heading-icon::after {
        content: "";
        position: absolute;
        top: 5px;
        right: 5px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--danger);
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--danger) 10%, transparent);
    }

    .notification-heading h3 {
        margin: 0 0 3px;
        color: var(--text);
        font-size: 16px;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .notification-heading p {
        margin: 0;
        color: var(--muted);
        font-size: 10px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .notification-count {
        min-height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        padding: 5px 11px;
        color: var(--gold-dark);
        background: color-mix(in srgb, var(--gold) 10%, var(--surface));
        border: 1px solid color-mix(in srgb, var(--gold) 22%, var(--border));
        border-radius: 999px;
        font-size: 9px;
        font-weight: 850;
        white-space: nowrap;
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .notification-item {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        min-width: 0;
        padding: 16px 21px;
        border-bottom: 1px solid color-mix(in srgb, var(--border) 70%, transparent);
        transition:
            background .2s ease,
            transform .2s ease;
    }

    .notification-item:last-child {
        border-bottom: 0;
    }

    .notification-item:hover {
        background: color-mix(in srgb, var(--gold) 4%, transparent);
    }

    .notification-player {
        min-width: 0;
        flex: 1 1 auto;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .notification-player-avatar {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 8%, var(--surface-2));
        border: 1px solid color-mix(in srgb, var(--gold) 17%, var(--border));
        border-radius: 11px;
        font-size: 14px;
        transition: transform .2s ease;
    }

    .notification-item:hover .notification-player-avatar {
        transform: scale(1.06);
    }

    .notification-info {
        min-width: 0;
        flex: 1 1 auto;
    }

    .notification-label {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        max-width: 100%;
        margin-bottom: 3px;
        color: var(--gold-dark);
        font-size: 8px;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .notification-label i {
        font-size: 8px;
        flex: 0 0 auto;
    }

    .notification-message {
        margin: 0;
        color: var(--text);
        font-size: 12px;
        font-weight: 750;
        line-height: 1.7;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .notification-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 4px;
        color: var(--muted);
        font-size: 8.5px;
        font-weight: 600;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .notification-meta-divider {
        opacity: .4;
    }

    .notification-action {
        min-height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex: 0 0 auto;
        padding: 8px 13px;
        color: #171717;
        background: linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );
        border: 0;
        border-radius: 10px;
        text-decoration: none;
        font-family: "Cairo", "Tajawal", Arial, sans-serif;
        font-size: 9px;
        font-weight: 900;
        box-shadow: 0 6px 16px rgba(184, 146, 62, .14);
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            filter .2s ease;
    }

    .notification-action:hover {
        color: #171717;
        transform: translateY(-2px);
        filter: brightness(1.04);
        box-shadow: 0 9px 21px rgba(184, 146, 62, .23);
    }

    .notification-action i {
        font-size: 9px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        position: relative;
        min-width: 0;
        min-height: 140px;
        padding: 20px;
        overflow: hidden;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 17px;
        box-shadow: var(--shadow-sm);
        transition:
            transform .2s ease,
            border-color .2s ease,
            background .25s ease,
            box-shadow .2s ease;
        opacity: 0;
        animation: statCardIn .5s cubic-bezier(.2, .7, .2, 1) both;
    }

    @keyframes statCardIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-stats .stat-card:nth-child(1) {
        animation-delay: .05s;
    }

    .dashboard-stats .stat-card:nth-child(2) {
        animation-delay: .10s;
    }

    .dashboard-stats .stat-card:nth-child(3) {
        animation-delay: .15s;
    }

    .dashboard-stats .stat-card:nth-child(4) {
        animation-delay: .20s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
        box-shadow: var(--shadow);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08) rotate(-4deg);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        left: -25px;
        bottom: -35px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: color-mix(in srgb, var(--gold) 7%, transparent);
        pointer-events: none;
    }

    .stat-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        min-width: 0;
    }

    .stat-label {
        min-width: 0;
        overflow-wrap: anywhere;
        color: var(--text);
        font-size: 14px;
        font-weight: 800;
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));
        border: 1px solid var(--border-soft);
        font-size: 17px;
        transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
    }

    .stat-value {
        margin-top: 15px;
        color: var(--text);
        font-size: 32px;
        font-weight: 900;
        line-height: 1;
    }

    .stat-description {
        margin-top: 9px;
        color: var(--muted, var(--text));
        font-size: 12px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .stat-card.success .stat-icon {
        color: var(--success);
        background: color-mix(in srgb, var(--success) 8%, var(--surface-2));
    }

    .stat-card.warning .stat-icon {
        color: var(--warning);
        background: color-mix(in srgb, var(--warning) 8%, var(--surface-2));
    }

    .stat-card.info .stat-icon {
        color: var(--info);
        background: color-mix(in srgb, var(--info) 8%, var(--surface-2));
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(300px, .9fr);
        gap: 18px;
        margin-bottom: 20px;
    }

    .dashboard-panel {
        min-width: 0;
        max-width: 100%;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease;
        opacity: 0;
        animation: statCardIn .5s cubic-bezier(.2, .7, .2, 1) both;
        animation-delay: .22s;
    }

    .dashboard-panel-header {
        min-height: 68px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 19px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .dashboard-panel-title {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
        color: var(--text);
        font-size: 16px;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .dashboard-panel-title i {
        color: var(--gold);
        font-size: 16px;
        flex: 0 0 auto;
    }

    .dashboard-panel-subtitle {
        min-width: 0;
        max-width: 100%;
        color: var(--muted, var(--text));
        font-size: 11px;
        font-weight: 700;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .dashboard-panel-body {
        min-width: 0;
        padding: 18px;
    }

    .level-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        min-width: 0;
    }

    .level-row {
        display: grid;
        grid-template-columns: 120px minmax(0, 1fr) 40px;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .level-name {
        min-width: 0;
        color: var(--text);
        font-size: 14px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .level-progress {
        min-width: 0;
        height: 9px;
        overflow: hidden;
        background: var(--surface-3);
        border-radius: 99px;
    }

    .level-progress-bar {
        height: 100%;
        min-width: 3px;
        border-radius: inherit;
        background: linear-gradient(
            90deg,
            var(--gold-dark),
            var(--gold-light)
        );
        transition: width .5s ease;
    }

    .level-count {
        text-align: left;
        color: var(--text);
        font-size: 14px;
        font-weight: 900;
    }

    .dashboard-empty {
        min-height: 170px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: var(--text);
        text-align: center;
        padding: 20px 15px;
    }

    .dashboard-empty i {
        color: var(--gold);
        font-size: 28px;
        opacity: .8;
    }

    .dashboard-empty strong {
        color: var(--text);
        font-size: 16px;
    }

    .dashboard-empty span {
        color: var(--muted, var(--text));
        font-size: 13px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .attendance-card {
        position: relative;
        min-width: 0;
        padding: 20px;
        background: linear-gradient(
            135deg,
            color-mix(in srgb, var(--gold) 7%, var(--surface)),
            var(--surface)
        );
        border: 1px solid var(--border);
        border-radius: 16px;
    }

    .attendance-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
        flex-wrap: wrap;
    }

    .attendance-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 10%, var(--surface-2));
        border: 1px solid var(--border-soft);
        font-size: 18px;
    }

    .attendance-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        max-width: 100%;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        color: var(--muted);
        background: color-mix(in srgb, var(--muted) 7%, var(--surface));
        border: 1px solid var(--border);
        overflow-wrap: anywhere;
    }

    .attendance-status.present {
        color: var(--success);
        background: color-mix(in srgb, var(--success) 8%, var(--surface));
        border-color: color-mix(in srgb, var(--success) 20%, var(--border));
    }

    .attendance-status.late {
        color: var(--warning);
        background: color-mix(in srgb, var(--warning) 8%, var(--surface));
        border-color: color-mix(in srgb, var(--warning) 20%, var(--border));
    }

    .attendance-status i {
        font-size: 9px;
        flex: 0 0 auto;
    }

    .attendance-title {
        margin: 0;
        color: var(--text);
        font-size: 18px;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .attendance-text {
        margin: 7px 0 0;
        color: var(--muted, var(--text));
        font-size: 13px;
        line-height: 1.9;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .attendance-btn {
        width: 100%;
        min-height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        margin-top: 18px;
        border: 0;
        border-radius: 11px;
        color: #171717;
        background: linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );
        box-shadow: 0 8px 20px rgba(184, 146, 62, .16);
        cursor: pointer;
        font-family: "Cairo", "Tajawal", Arial, sans-serif;
        font-size: 14px;
        font-weight: 900;
        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .attendance-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(184, 146, 62, .23);
    }

    .attendance-btn:disabled {
        cursor: not-allowed;
        opacity: .65;
        transform: none;
    }

    .plan-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .plan-card {
        min-width: 0;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 18px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 14px;
        transition:
            background .25s ease,
            transform .2s ease,
            border-color .2s ease;
    }

    .plan-card:hover {
        transform: translateY(-2px);
        border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
        box-shadow: var(--shadow-sm);
    }

    .plan-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .plan-card-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 8%, var(--surface));
        font-size: 15px;
    }

    .plan-card-label {
        min-width: 0;
        color: var(--text);
        font-size: 13px;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .plan-card-value {
        margin-top: 12px;
        color: var(--text);
        font-size: 26px;
        font-weight: 900;
    }

    .players-panel {
        margin-bottom: 20px;
        min-width: 0;
        max-width: 100%;
    }

    .players-table-wrapper {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        scrollbar-width: thin;
        scrollbar-color: var(--border) transparent;
        -webkit-overflow-scrolling: touch;
    }

    .players-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .players-table th {
        padding: 14px 16px;
        color: var(--text);
        background: var(--surface-2);
        border-bottom: 1px solid var(--border);
        font-size: 13px;
        font-weight: 900;
        text-align: right;
        white-space: nowrap;
    }

    .players-table td {
        padding: 15px 16px;
        color: var(--text);
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
        font-weight: 600;
        transition: background .15s ease;
        white-space: nowrap;
    }

    .players-table tr:hover td {
        background: color-mix(in srgb, var(--gold) 4%, transparent);
    }

    .players-table tr:last-child td {
        border-bottom: 0;
    }

    .player-name {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text);
        font-weight: 850;
        white-space: nowrap;
    }

    .player-avatar {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 34px;
        border-radius: 9px;
        color: var(--gold);
        background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));
        border: 1px solid var(--border-soft);
        transition: transform .2s ease;
    }

    .players-table tr:hover .player-avatar {
        transform: scale(1.08);
    }

    .subscription-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 850;
        color: #fff;
        white-space: nowrap;
    }

    .subscription-badge.expired {
        background: var(--danger);
    }

    .subscription-badge.expiring {
        background: var(--warning);
    }

    .subscription-date {
        color: var(--text);
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    @media (max-width: 1150px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: minmax(0, 1fr);
        }
    }

    @media (max-width: 900px) {
        .dashboard-title {
            font-size: 26px;
        }

        .stat-value {
            font-size: 28px;
        }

        .notification-item {
            align-items: flex-start;
        }

        .dashboard-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .dashboard-panel-header {
            gap: 10px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .dashboard-title {
            font-size: 23px;
        }

        .dashboard-subtitle {
            font-size: 12px;
        }

        .dashboard-alert {
            align-items: flex-start;
            padding: 12px 14px;
            font-size: 12px;
        }

        .dashboard-stats {
            grid-template-columns: minmax(0, 1fr);
            gap: 12px;
        }

        .stat-card {
            min-height: 125px;
            padding: 17px;
        }

        .plan-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .dashboard-panel-header {
            align-items: flex-start;
            padding: 13px 15px;
        }

        .dashboard-panel-body {
            padding: 14px;
        }

        .dashboard-panel-title {
            max-width: 100%;
        }

        .dashboard-panel-subtitle {
            width: 100%;
        }

        .level-row {
            grid-template-columns: 95px minmax(0, 1fr) 34px;
            gap: 8px;
        }

        .notification-header {
            min-height: auto;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 13px 15px;
        }

        .notification-heading {
            flex: 1 1 100%;
        }

        .notification-count {
            margin-right: auto;
        }

        .notification-item {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
            padding: 14px 15px;
        }

        .notification-player {
            width: 100%;
        }

        .notification-action {
            width: 100%;
        }

        .notification-player-avatar {
            width: 39px;
            height: 39px;
            flex-basis: 39px;
        }

        .notification-message {
            font-size: 11px;
        }

        .notification-meta {
            max-width: 100%;
        }

        .attendance-card {
            padding: 16px;
        }

        .attendance-title {
            font-size: 16px;
        }

        .players-table-wrapper {
            margin-left: 0;
            margin-right: 0;
        }

        .players-table {
            min-width: 600px;
        }

        .players-table th,
        .players-table td {
            padding: 12px 10px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-title {
            font-size: 21px;
        }

        .dashboard-subtitle {
            font-size: 12px;
        }

        .stat-value {
            font-size: 26px;
        }

        .stat-card {
            min-height: 120px;
            padding: 16px;
            border-radius: 14px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
            font-size: 15px;
        }

        .level-row {
            grid-template-columns: minmax(0, 1fr);
            gap: 5px;
        }

        .level-progress {
            width: 100%;
        }

        .level-count {
            text-align: right;
        }

        .attendance-title {
            font-size: 16px;
        }

        .attendance-text {
            font-size: 12px;
        }

        .attendance-btn {
            min-height: 50px;
            font-size: 13px;
        }

        .plan-card {
            padding: 16px;
        }

        .plan-card-value {
            font-size: 22px;
        }

        .players-table {
            min-width: 560px;
        }

        .player-notifications {
            border-radius: 14px;
        }

        .notification-header {
            gap: 10px;
            padding: 12px;
        }

        .notification-heading {
            gap: 9px;
        }

        .notification-heading-icon {
            width: 37px;
            height: 37px;
            flex-basis: 37px;
            font-size: 13px;
        }

        .notification-heading h3 {
            font-size: 14px;
        }

        .notification-heading p {
            font-size: 9px;
        }

        .notification-count {
            font-size: 8px;
            padding: 4px 8px;
        }

        .notification-item {
            padding: 13px 12px;
        }

        .notification-player {
            gap: 9px;
        }

        .notification-message {
            font-size: 10.5px;
        }

        .notification-meta {
            font-size: 8px;
        }

        .dashboard-panel-header {
            padding: 12px;
        }

        .dashboard-panel-body {
            padding: 12px;
        }
    }

    @media (max-width: 360px) {
        .dashboard-title {
            font-size: 19px;
        }

        .dashboard-panel-title {
            font-size: 14px;
        }

        .dashboard-panel-subtitle {
            font-size: 10px;
        }

        .stat-value {
            font-size: 24px;
        }

        .attendance-card {
            padding: 13px;
        }

        .attendance-btn {
            min-height: 48px;
            font-size: 12px;
        }

        .notification-heading h3 {
            font-size: 13px;
        }

        .notification-message {
            font-size: 10px;
        }
    }
</style>

@endsection


@section('content')

    <div class="dashboard-page">

        {{-- =====================================================
         FLASH MESSAGES
    ====================================================== --}}

        @if (session('success'))
            <div class="dashboard-alert success">
                <i class="fas fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>
            </div>
        @endif


        @if (session('error'))
            <div class="dashboard-alert error">
                <i class="fas fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>
            </div>
        @endif


 


        {{-- =====================================================
         PLAYER NOTIFICATIONS
         تظهر فقط عند وجود لاعبين اشتراكاتهم قريبة من الانتهاء
    ====================================================== --}}

        @if (isset($notifications) && $notifications->count() > 0)

            <section class="player-notifications">

                <div class="notification-header">

                    <div class="notification-heading">

                        <span class="notification-heading-icon">
                            <i class="fas fa-bell"></i>
                        </span>

                        <div>

                            <h3>
                                تنبيهات تحتاج إلى متابعتك
                            </h3>

                            <p>
                                يوجد لاعبين لديهم اشتراكات ستنتهي قريباً
                            </p>

                        </div>

                    </div>

                    <span class="notification-count">
                        {{ $notifications->count() }}
                        {{ $notifications->count() == 1 ? 'تنبيه' : 'تنبيهات' }}
                    </span>

                </div>


                <div class="notification-list">

                    @foreach ($notifications as $notification)
                        <div class="notification-item">

                            <div class="notification-player">

                                <span class="notification-player-avatar">
                                    <i class="fas fa-user"></i>
                                </span>

                                <div class="notification-info">

                                    <div class="notification-label">
                                        <i class="fas fa-clock"></i>
                                        اشتراك يوشك على الانتهاء
                                    </div>

                                    <p class="notification-message">
                                        {{ $notification['message'] }}
                                    </p>

                                    <div class="notification-meta">

                                        <span>
                                            تاريخ الانتهاء:
                                            {{ $notification['end_date'] }}
                                        </span>

                                        @if (isset($notification['days_remaining']))
                                            <span class="notification-meta-divider">
                                                •
                                            </span>

                                            <span>
                                                @if ($notification['days_remaining'] <= 0)
                                                    ينتهي اليوم
                                                @elseif($notification['days_remaining'] == 1)
                                                    متبقي يوم واحد
                                                @else
                                                    متبقي
                                                    {{ $notification['days_remaining'] }}
                                                    أيام
                                                @endif
                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </div>


                            <a href="{{ $notification['url'] }}" class="notification-action">
                                <span>
                                    عرض ملف اللاعب
                                </span>

                                <i class="fas fa-arrow-left"></i>
                            </a>

                        </div>
                    @endforeach

                </div>

            </section>

        @endif


        {{-- =====================================================
         STATISTICS
    ====================================================== --}}

        <div class="dashboard-stats">

            {{-- Players --}}

            <div class="stat-card">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <span class="stat-label">
                        إجمالي اللاعبين
                    </span>

                </div>

                <div class="stat-value">
                    {{ $totalPlayers }}
                </div>

                <div class="stat-description">
                    اللاعبون المسجلون تحت إشرافك
                </div>

            </div>


            {{-- Training --}}

            <div class="stat-card info">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>

                    <span class="stat-label">
                        خطط التدريب
                    </span>

                </div>

                <div class="stat-value">
                    {{ $totalTrainingPlans }}
                </div>

                <div class="stat-description">
                    خطط التدريب العامة
                </div>

            </div>


            {{-- Diet --}}

            <div class="stat-card success">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-utensils"></i>
                    </div>

                    <span class="stat-label">
                        خطط التغذية
                    </span>

                </div>

                <div class="stat-value">
                    {{ $totalDietPlans }}
                </div>

                <div class="stat-description">
                    خطط التغذية العامة
                </div>

            </div>


            {{-- Expiring --}}

            <div class="stat-card warning">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                    <span class="stat-label">
                        تنتهي قريباً
                    </span>

                </div>

                <div class="stat-value">
                    {{ $expiringSoonPlayers->count() }}
                </div>

                <div class="stat-description">
                    اشتراكات خلال 7 أيام
                </div>

            </div>

        </div>


        {{-- =====================================================
         MAIN GRID
    ====================================================== --}}

        <div class="dashboard-grid">

            {{-- PLAYER LEVELS --}}

            <section class="dashboard-panel">

                <div class="dashboard-panel-header">

                    <div class="dashboard-panel-title">

                        <i class="fas fa-chart-column"></i>

                        توزيع اللاعبين حسب المستوى

                    </div>

                    <span class="dashboard-panel-subtitle">
                        {{ $totalPlayers }} لاعب
                    </span>

                </div>


                <div class="dashboard-panel-body">

                    @if ($totalPlayers > 0)
                        <div class="level-list">

                            {{-- Beginner --}}

                            <div class="level-row">

                                <span class="level-name">
                                    مبتدئ
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($beginnerCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">
                                    {{ $beginnerCount }}
                                </span>

                            </div>


                            {{-- Intermediate --}}

                            <div class="level-row">

                                <span class="level-name">
                                    متوسط
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($intermediateCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">
                                    {{ $intermediateCount }}
                                </span>

                            </div>


                            {{-- Advanced --}}

                            <div class="level-row">

                                <span class="level-name">
                                    متقدم
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($advancedCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">
                                    {{ $advancedCount }}
                                </span>

                            </div>

                        </div>
                    @else
                        <div class="dashboard-empty">

                            <i class="fas fa-users-slash"></i>

                            <strong>
                                لا يوجد لاعبين حالياً
                            </strong>

                            <span>
                                ستظهر الإحصائيات هنا عند إضافة اللاعبين.
                            </span>

                        </div>
                    @endif

                </div>

            </section>


            {{-- ATTENDANCE --}}

            <section class="dashboard-panel">

                <div class="dashboard-panel-header">

                    <div class="dashboard-panel-title">

                        <i class="fas fa-calendar-check"></i>

                        حضور الموظف

                    </div>

                    <span class="dashboard-panel-subtitle">
                        حضور اليوم
                    </span>

                </div>


                <div class="dashboard-panel-body">

                    <div class="attendance-card">

                        <div class="attendance-top">

                            <div class="attendance-icon">
                                <i class="fas fa-user-check"></i>
                            </div>


                            @if ($attendance)

                                @if ($attendance->status === 'late')
                                    <span class="attendance-status late">

                                        <i class="fas fa-circle"></i>

                                        متأخر

                                    </span>
                                @else
                                    <span class="attendance-status present">

                                        <i class="fas fa-circle"></i>

                                        حاضر

                                    </span>
                                @endif
                            @else
                                <span class="attendance-status">

                                    لم يتم التسجيل

                                </span>

                            @endif

                        </div>


                        <h3 class="attendance-title">
                            تسجيل حضور اليوم
                        </h3>


                        @if ($attendance)

                            <p class="attendance-text">

                                تم تسجيل حضورك اليوم بنجاح.

                                @if ($attendance->recorded_at)
                                    <br>

                                    وقت التسجيل:

                                    {{ \Carbon\Carbon::parse($attendance->recorded_at)->format('h:i A') }}
                                @endif

                            </p>
                        @else
                            <p class="attendance-text">
                                قم بتسجيل حضورك لليوم من خلال الزر التالي.
                            </p>

                        @endif


                        <form action="{{ route('employee.dashboard.attendance.toggle') }}" method="POST">

                            @csrf

                            <button type="submit" class="attendance-btn" {{ $attendance ? 'disabled' : '' }}>

                                @if ($attendance)
                                    <i class="fas fa-check"></i>

                                    تم تسجيل الحضور
                                @else
                                    <i class="fas fa-fingerprint"></i>

                                    تسجيل الحضور
                                @endif

                            </button>

                        </form>

                    </div>

                </div>

            </section>

        </div>


        {{-- =====================================================
         PLANS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-layer-group"></i>

                    ملخص الخطط

                </div>

                <span class="dashboard-panel-subtitle">
                    الخطط الخاصة بك
                </span>

            </div>


            <div class="dashboard-panel-body">

                <div class="plan-grid">

                    <div class="plan-card">

                        <div class="plan-card-top">

                            <span class="plan-card-icon">
                                <i class="fas fa-dumbbell"></i>
                            </span>

                            <span class="plan-card-label">
                                بنك التدريب
                            </span>

                        </div>

                        <div class="plan-card-value">
                            {{ $totalTrainingPlans }}
                        </div>

                    </div>


                    <div class="plan-card">

                        <div class="plan-card-top">

                            <span class="plan-card-icon">
                                <i class="fas fa-utensils"></i>
                            </span>

                            <span class="plan-card-label">
                                بنك التغذية
                            </span>

                        </div>

                        <div class="plan-card-value">
                            {{ $totalDietPlans }}
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
         EXPIRING PLAYERS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-hourglass-half"></i>

                    الاشتراكات التي تنتهي قريباً

                </div>

                <span class="dashboard-panel-subtitle">
                    خلال 7 أيام
                </span>

            </div>


            <div class="players-table-wrapper">

                @if ($expiringSoonPlayers->count() > 0)

                    <table class="players-table">

                        <thead>

                            <tr>

                                <th>
                                    اللاعب
                                </th>

                                <th>
                                    تاريخ الانتهاء
                                </th>

                                <th>
                                    الحالة
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($expiringSoonPlayers as $player)
                                <tr>

                                    <td>

                                        <div class="player-name">

                                            <span class="player-avatar">
                                                <i class="fas fa-user"></i>
                                            </span>

                                            {{ $player->name }}

                                        </div>

                                    </td>


                                    <td>

                                        @if ($player->subscription)
                                            <span class="subscription-date">

                                                {{ \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') }}

                                            </span>
                                        @else
                                            —
                                        @endif

                                    </td>


                                    <td>

                                        <span class="subscription-badge expiring">

                                            <i class="fas fa-clock"></i>

                                            ينتهي قريباً

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <div class="dashboard-empty">

                        <i class="fas fa-circle-check"></i>

                        <strong>
                            لا توجد اشتراكات تنتهي قريباً
                        </strong>

                        <span>
                            لا يوجد لاعب لديه اشتراك ينتهي خلال 7 أيام.
                        </span>

                    </div>

                @endif

            </div>

        </section>


        {{-- =====================================================
         EXPIRED PLAYERS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-triangle-exclamation"></i>

                    الاشتراكات المنتهية

                </div>

                <span class="dashboard-panel-subtitle">
                    {{ $expiredPlayers->count() }} لاعب
                </span>

            </div>


            <div class="players-table-wrapper">

                @if ($expiredPlayers->count() > 0)

                    <table class="players-table">

                        <thead>

                            <tr>

                                <th>
                                    اللاعب
                                </th>

                                <th>
                                    تاريخ الانتهاء
                                </th>

                                <th>
                                    الحالة
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($expiredPlayers as $player)
                                <tr>

                                    <td>

                                        <div class="player-name">

                                            <span class="player-avatar">
                                                <i class="fas fa-user"></i>
                                            </span>

                                            {{ $player->name }}

                                        </div>

                                    </td>


                                    <td>

                                        @if ($player->subscription)
                                            <span class="subscription-date">

                                                {{ \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') }}

                                            </span>
                                        @else
                                            —
                                        @endif

                                    </td>


                                    <td>

                                        <span class="subscription-badge expired">

                                            <i class="fas fa-circle-xmark"></i>

                                            منتهي

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <div class="dashboard-empty">

                        <i class="fas fa-shield-check"></i>

                        <strong>
                            لا توجد اشتراكات منتهية
                        </strong>

                        <span>
                            جميع اشتراكات اللاعبين تحت إشرافك فعالة.
                        </span>

                    </div>

                @endif

            </div>

        </section>

    </div>

@endsection
