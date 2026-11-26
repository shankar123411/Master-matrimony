<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>மாஸ்டர் மணமாலை | Master Matrimony Information Centre</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&family=Tiro+Tamil:ital@0;1&family=Noto+Sans+Tamil:wght@400;600;700;800;900&family=Noto+Serif+Tamil:wght@400;600;700;800&family=Catamaran:wght@400;600;700;800&family=Arima:wght@400;600;700&family=Kavivanar&display=swap" rel="stylesheet">
    <!-- Real In-Browser OCR & PDF Document Extraction Engines -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script>
        if (typeof html2canvas === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"><\/script>');
        }
    </script>
    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script>
        if (typeof window.jspdf === 'undefined' && typeof jsPDF === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"><\/script>');
        }
    </script>
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        if (typeof pdfjsLib !== 'undefined') {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        }
        window.__SERVER_PRINT_STYLES__ = {!! json_encode($savedPrintStyles ?? (object)[]) !!};
    </script>
    <style>
        :root {
            --primary: #881337;
            --primary-dark: #4c0519;
            --primary-light: #fff1f2;
            --primary-glow: rgba(136, 19, 55, 0.25);
            --gold: #b45309;
            --gold-light: #fef3c7;
            --gold-border: #f59e0b;
            --gold-hover: #d97706;
            --dark: #0f172a;
            --dark-card: #1e293b;
            --slate-600: #475569;
            --slate-500: #64748b;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --bride-color: #be185d;
            --groom-color: #1d4ed8;
            --success: #15803d;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Mukta Malar', 'Plus Jakarta Sans', 'Outfit', sans-serif;
        }

        body {
            background: #f1f5f9;
            background-image: 
                radial-gradient(at 0% 0%, rgba(136, 19, 55, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(180, 83, 9, 0.05) 0px, transparent 50%);
            color: var(--dark);
            min-height: 100vh;
            padding-bottom: 80px;
        }

        /* Executive Header */
        .header-nav {
            background: #0f172a;
            border-bottom: 3px solid var(--gold-border);
            padding: 14px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-container {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-symbol {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35);
            flex-shrink: 0;
        }

        .brand-info h1 {
            font-size: 21px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            letter-spacing: -0.2px;
        }

        .brand-info p {
            font-size: 13px;
            font-weight: 600;
            color: #fcd34d;
            margin-top: 2px;
        }

        .nav-right-controls {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Language Toggle Switcher */
        .language-toggle {
            display: flex;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 3px;
        }

        .lang-button {
            border: none;
            padding: 7px 18px;
            font-size: 13.5px;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            background: transparent;
            color: #cbd5e1;
            transition: all 0.2s;
        }

        .lang-button.active {
            background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(153, 27, 27, 0.4);
        }

        .btn-exit {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-exit:hover {
            background: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
        }

        .btn-master-settings {
            background: rgba(245, 158, 11, 0.18);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.45);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-master-settings:hover {
            background: #d97706;
            color: #ffffff;
            border-color: #f59e0b;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.35);
        }

        /* Master Settings Modal */
        .master-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 20px 0;
            background: #f8fafc;
        }
        .master-tab-btn {
            padding: 10px 18px;
            border: none;
            background: none;
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
        }
        .master-tab-btn.active {
            color: #881337;
            border-bottom-color: #881337;
            background: #fff;
            border-radius: 8px 8px 0 0;
        }
        .master-body {
            padding: 20px;
            max-height: 480px;
            overflow-y: auto;
        }
        .master-add-card {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }
        .master-table {
            width: 100%;
            border-collapse: collapse;
        }
        .master-table th {
            text-align: left;
            padding: 10px 12px;
            font-size: 12.5px;
            font-weight: 800;
            color: #475569;
            background: #f1f5f9;
            border-bottom: 2px solid #cbd5e1;
        }
        .master-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13.5px;
        }

        /* Container */
        .dashboard-container {
            max-width: 1140px;
            margin: 28px auto;
            padding: 0 16px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
        }

        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 24px;
            border: 1px solid var(--slate-200);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 6px solid var(--primary);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .stat-card.bride { border-left-color: var(--bride-color); }
        .stat-card.groom { border-left-color: var(--groom-color); }

        .stat-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--slate-600);
            margin-bottom: 6px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .stat-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: #fdf2f8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .stat-card.bride .stat-icon-box { background: #fdf2f8; }
        .stat-card.groom .stat-icon-box { background: #eff6ff; }

        /* Main Tabs */
        .nav-tabs {
            display: flex;
            gap: 14px;
            margin-bottom: 22px;
        }

        .tab-link {
            flex: 1;
            padding: 15px 22px;
            background: #ffffff;
            border: 2px solid var(--slate-200);
            border-radius: 12px;
            font-size: 15.5px;
            font-weight: 800;
            cursor: pointer;
            color: var(--slate-600);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.2s;
        }

        .tab-link.active {
            background: linear-gradient(135deg, #881337 0%, #701a25 100%);
            color: #ffffff;
            border-color: #881337;
            box-shadow: 0 6px 18px rgba(136, 19, 55, 0.3);
        }

        .tab-badge {
            background: rgba(255, 255, 255, 0.25);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 800;
        }

        .tab-link:not(.active) .tab-badge {
            background: var(--slate-100);
            color: var(--slate-600);
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeIn 0.25s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Card */
        .form-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--slate-200);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Candidate Type Selection with Emojis */
        .gender-switch-bar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #f8fafc;
            border-bottom: 2px solid var(--slate-200);
            padding: 16px 24px;
            gap: 16px;
        }

        .gender-selector {
            border: 2px solid var(--slate-200);
            border-radius: 12px;
            padding: 14px 20px;
            background: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s;
            user-select: none;
        }

        .gender-selector * {
            pointer-events: none;
        }

        .gender-selector.active-bride {
            border-color: var(--bride-color);
            background: #fdf2f8;
            box-shadow: 0 4px 14px rgba(190, 24, 93, 0.15);
        }

        .gender-selector.active-groom {
            border-color: var(--groom-color);
            background: #eff6ff;
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.15);
        }

        .gender-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--slate-100);
            font-size: 26px;
            flex-shrink: 0;
        }

        .gender-text-title {
            font-size: 18px;
            font-weight: 800;
        }

        .gender-text-sub {
            font-size: 13px;
            color: var(--slate-600);
            margin-top: 2px;
        }

        /* Form Block Sections */
        .form-block {
            padding: 24px 32px;
            border-bottom: 1px solid var(--slate-200);
        }

        .block-header {
            font-size: 16.5px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #ffe4e6;
            padding-bottom: 10px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 18px;
        }

        @media (max-width: 768px) {
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .form-block { padding: 20px 18px; }
            .header-nav { padding: 12px 16px; }
        }

        .field-group {
            margin-bottom: 14px;
        }

        .field-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .input-with-voice {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-text {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            padding-right: 48px; /* Space for mic button */
            font-size: 14.5px;
            font-weight: 600;
            color: #0f172a;
            border: 1.5px solid var(--slate-200);
            border-radius: 9px;
            background: #ffffff;
            outline: none;
            transition: all 0.2s;
        }

        textarea.input-text {
            height: auto;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .input-text:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(136, 19, 55, 0.12);
        }

        .input-select {
            cursor: pointer;
            font-weight: 600;
            background: #ffffff;
        }

        /* Voice Microphone Action Button */
        .voice-mic-btn {
            position: absolute;
            right: 7px;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--gold-border);
            background: #fffbeb;
            color: #b45309;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 5;
        }

        .voice-mic-btn:hover {
            background: #fef3c7;
            color: #78350f;
            transform: translateY(-50%) scale(1.08);
        }

        .voice-mic-btn.is-active-recording {
            background: #dc2626 !important;
            color: #ffffff !important;
            border-color: #b91c1c !important;
            animation: pulseRecord 1.2s infinite;
        }

        @keyframes pulseRecord {
            0% { transform: translateY(-50%) scale(1); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
            70% { transform: translateY(-50%) scale(1.15); box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); }
            100% { transform: translateY(-50%) scale(1); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
        }

        /* Live Voice Toast Notification */
        .live-voice-toast {
            display: none;
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0f172a;
            border: 2px solid var(--gold-border);
            color: #ffffff;
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14.5px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            z-index: 999999;
            align-items: center;
            gap: 12px;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Photo Uploader Component */
        .photo-container {
            display: flex;
            align-items: center;
            gap: 18px;
            background: var(--slate-100);
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 14px 20px;
        }

        .photo-preview-frame {
            width: 80px;
            height: 95px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            color: var(--slate-500);
        }

        .photo-preview-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* 12-Kattam Kundali Matrix */
        .astrology-dual-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 14px;
        }

        @media (max-width: 720px) {
            .astrology-dual-grid { grid-template-columns: 1fr; }
        }

        .kundali-box {
            background: #ffffff;
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }

        .kundali-title {
            font-weight: 800;
            color: var(--primary);
            font-size: 15px;
            margin-bottom: 8px;
        }

        .chart-matrix {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 68px);
            border: 1.5px solid var(--primary);
            background: #ffffff;
        }

        .chart-cell {
            border: 1px solid var(--primary);
            padding: 1px;
            display: flex;
            flex-direction: column;
            position: relative;
            cursor: pointer;
            transition: all 0.15s ease;
            overflow: hidden;
            height: 68px;
            box-sizing: border-box;
            background: #ffffff;
            user-select: none;
        }

        .chart-cell:hover {
            background: #fffbeb;
        }

        .chart-cell.active-cell {
            background: #fef3c7 !important;
            outline: 2.5px solid #d97706 !important;
            outline-offset: -2.5px;
            box-shadow: inset 0 0 0 1px #d97706;
        }

        .cell-index-name {
            position: absolute;
            top: 2px;
            left: 3px;
            font-size: 8.5px;
            font-weight: 700;
            color: #64748b;
            pointer-events: none;
            z-index: 3;
            line-height: 1;
        }

        .cell-planets-matrix {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            align-items: center;
            justify-items: center;
            padding-top: 11px;
            padding-left: 1px;
            padding-right: 1px;
            padding-bottom: 1px;
            box-sizing: border-box;
            pointer-events: none;
        }

        .planet-slot {
            font-size: 10px;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            letter-spacing: -0.3px;
        }

        .cell-empty-dash {
            grid-column: 1 / span 3;
            grid-row: 1 / span 3;
            color: #cbd5e1;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-center-hub {
            grid-column: 2 / span 2;
            grid-row: 2 / span 2;
            background: #fffbeb;
            border: 1px solid var(--primary);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary);
            font-size: 15px;
        }

        .planets-selector-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            background: #fffbeb;
            border: 1.5px dashed var(--gold-border);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 12px;
            align-items: center;
        }

        .planet-btn {
            background: #ffffff;
            border: 1px solid var(--gold-border);
            color: #78350f;
            font-size: 12.5px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .planet-btn:hover {
            background: var(--gold-border);
            color: #ffffff;
            transform: scale(1.05);
        }

        /* Submit Action Footer */
        .form-action-footer {
            background: #f8fafc;
            border-top: 2px solid var(--slate-200);
            padding: 26px;
            text-align: center;
        }

        .btn-submit-action {
            background: linear-gradient(135deg, #881337 0%, #4c0519 100%);
            color: #ffffff;
            font-size: 17px;
            font-weight: 800;
            padding: 15px 44px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(136, 19, 55, 0.35);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }

        .btn-submit-action:hover {
            background: linear-gradient(135deg, #9f1239 0%, #701a25 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(136, 19, 55, 0.45);
        }

        /* Directory Table (Tab 2) */
        .directory-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--slate-200);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .directory-header {
            padding: 20px 28px;
            border-bottom: 1.5px solid var(--slate-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .search-field-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-field {
            padding: 10px 16px;
            padding-left: 38px;
            border: 1.5px solid var(--slate-200);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            width: 280px;
            outline: none;
            transition: border 0.2s;
        }

        .search-field:focus {
            border-color: var(--primary);
        }

        .search-icon-svg {
            position: absolute;
            left: 12px;
            color: var(--slate-500);
            pointer-events: none;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8fafc;
            color: var(--slate-600);
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 18px;
            text-align: left;
            border-bottom: 2px solid var(--slate-200);
        }

        .data-table td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--slate-200);
            font-size: 14px;
            vertical-align: middle;
        }

        .data-table tbody tr {
            cursor: pointer;
            transition: background 0.15s;
        }

        .data-table tbody tr:hover {
            background: #fffbeb;
        }

        .badge-tag {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-tag.groom { background: #eff6ff; color: #1d4ed8; }
        .badge-tag.bride { background: #fdf2f8; color: #be185d; }

        .action-btn-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action-icon {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s;
        }

        .btn-view {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .btn-view:hover {
            background: #1d4ed8;
            color: #ffffff;
        }

        .btn-edit {
            background: #fefce8;
            color: #a16207;
            border-color: #fef08a;
        }

        .btn-edit:hover {
            background: #ca8a04;
            color: #ffffff;
        }

        .btn-print {
            background: #fef3c7;
            color: #b45309;
            border-color: #fde68a;
        }

        .btn-print:hover {
            background: #b45309;
            color: #ffffff;
        }

        .btn-pdf-action {
            background: #e0f2fe;
            color: #0369a1;
            border-color: #bae6fd;
        }

        .btn-pdf-action:hover {
            background: #0284c7;
            color: #ffffff;
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #ffffff;
        }

        /* Profile Modal Overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(4px);
            z-index: 100000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-body-box {
            background: #ffffff;
            width: 100%;
            max-width: 680px;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            animation: modalPop 0.25s ease-out;
        }

        @keyframes modalPop {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-top-bar {
            background: #0f172a;
            border-bottom: 2px solid var(--gold-border);
            color: #ffffff;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-content-scroll {
            padding: 22px 28px;
            overflow-y: auto;
        }

        .modal-detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .modal-detail-label {
            width: 38%;
            font-weight: 700;
            color: #475569;
        }

        .modal-detail-value {
            width: 62%;
            font-weight: 700;
            color: #0f172a;
        }

        /* Smart Biodata Document / Photo Upload Banner & Zone */
        .smart-upload-banner {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 40%, #fef9c3 100%);
            border-bottom: 2.5px solid var(--gold-border);
            padding: 22px 28px;
            position: relative;
        }

        .smart-upload-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 14px;
        }

        .smart-upload-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 17.5px;
            font-weight: 800;
            color: #92400e;
        }

        .smart-badge-ai {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 800;
            padding: 3px 9px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 6px rgba(180, 83, 9, 0.25);
        }

        .smart-upload-sub {
            font-size: 13.5px;
            color: #78350f;
            font-weight: 600;
            margin-top: 3px;
        }

        .biodata-dropzone {
            background: #ffffff;
            border: 2px dashed #d97706;
            border-radius: 14px;
            padding: 22px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(180, 83, 9, 0.05);
        }

        .biodata-dropzone:hover, .biodata-dropzone.dragover {
            background: #fffbeb;
            border-color: #b45309;
            box-shadow: 0 6px 18px rgba(180, 83, 9, 0.15);
            transform: translateY(-2px);
        }

        .dropzone-icon-circle {
            width: 52px;
            height: 52px;
            background: #fef3c7;
            color: #b45309;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .dropzone-prompt-main {
            font-size: 15px;
            font-weight: 800;
            color: #1e293b;
            word-break: break-word;
        }

        .dropzone-prompt-sub {
            font-size: 12.5px;
            font-weight: 600;
            color: #64748b;
            margin-top: 4px;
            word-break: break-word;
            line-height: 1.4;
        }

        /* Blank Printable Biodata Forms Bar - Universal Fully Responsive */
        .blank-forms-bar {
            background: #fdfbf7;
            border: 1.5px solid #fde68a;
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 14px;
            box-shadow: 0 2px 6px rgba(217, 119, 6, 0.08);
            box-sizing: border-box;
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        .blank-forms-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .blank-forms-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 800;
            font-size: 13.5px;
            color: #92400e;
            word-break: break-word;
        }

        .blank-forms-badge {
            color: #b45309;
            font-weight: 700;
            font-size: 11.5px;
            background: #fef3c7;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #fde68a;
            white-space: nowrap;
            display: inline-block;
        }

        .blank-forms-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            width: 100%;
            box-sizing: border-box;
        }

        .blank-forms-field {
            display: flex;
            align-items: center;
            gap: 6px;
            box-sizing: border-box;
            min-width: 0;
        }

        .blank-forms-field label {
            font-size: 11.5px;
            font-weight: 700;
            color: #78350f;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .blank-forms-field select {
            height: 36px;
            font-weight: 700;
            border-radius: 8px;
            border: 1.5px solid #cbd5e1;
            background-color: #ffffff;
            color: #0f172a;
            box-sizing: border-box;
            cursor: pointer;
        }

        .blank-forms-field-cat {
            flex: 1 1 200px;
            min-width: 190px;
        }

        .blank-forms-field-cat select {
            width: 100%;
            min-width: 0;
            font-size: 12.5px;
            padding: 0 24px 0 10px;
        }

        .blank-forms-field-lang {
            flex: 0 1 170px;
            min-width: 140px;
        }

        .blank-forms-field-lang select {
            width: 100%;
            min-width: 0;
            font-size: 13px;
            padding: 0 24px 0 10px;
        }

        .blank-forms-btn-wrap {
            flex: 0 0 auto;
            box-sizing: border-box;
        }

        .blank-forms-btn {
            background: #d97706;
            color: #ffffff;
            height: 36px;
            padding: 0 16px;
            font-size: 12.5px;
            font-weight: 800;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(217, 119, 6, 0.25);
            box-sizing: border-box;
            transition: all 0.2s;
        }

        .blank-forms-btn:hover {
            background: #b45309;
        }

        /* Scanning Progress UI */
        .upload-progress-box {
            display: none;
            background: #ffffff;
            border: 1.5px solid #f59e0b;
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 12px;
            animation: fadeIn 0.2s ease-out;
        }

        .progress-bar-track {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 8px;
        }

        .progress-bar-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #f59e0b 0%, #10b981 100%);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Success Extraction Banner */
        .autofill-success-banner {
            display: none;
            background: #ecfdf5;
            border: 1.5px solid #10b981;
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 12px;
            animation: fadeIn 0.3s ease-out;
        }

        .autofill-success-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* Pulsing highlight for auto-filled inputs */
        @keyframes emeraldPulse {
            0% {
                border-color: #10b981;
                background-color: #ecfdf5;
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.35);
            }
            50% {
                border-color: #059669;
                background-color: #f0fdf4;
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0.2);
            }
            100% {
                border-color: #cbd5e1;
                background-color: #ffffff;
                box-shadow: none;
            }
        }

        .autofill-glow {
            animation: emeraldPulse 3.5s ease-out;
            border-color: #10b981 !important;
        }

        /* 📱 Universal Responsive Design (Mobile, Tablet, Laptop, Desktop) */
        @media (max-width: 900px) {
            .header-nav {
                padding: 12px 16px !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }
            .brand-container {
                justify-content: center !important;
                text-align: center !important;
            }
            .nav-right-controls {
                justify-content: center !important;
                flex-wrap: wrap !important;
                width: 100% !important;
                gap: 10px !important;
            }
            .dashboard-container {
                padding: 14px 12px !important;
            }
        }

        @media (max-width: 640px) {
            body {
                overflow-x: hidden !important;
            }
            .header-nav {
                padding: 10px 8px !important;
            }
            .brand-symbol {
                width: 36px !important;
                height: 36px !important;
            }
            .brand-info h1 {
                font-size: 15px !important;
                line-height: 1.3 !important;
            }
            .brand-info p {
                font-size: 11px !important;
            }
            .nav-right-controls {
                gap: 6px !important;
            }
            .lang-button {
                padding: 5px 10px !important;
                font-size: 12px !important;
            }
            .btn-master-settings, .btn-exit {
                padding: 6px 10px !important;
                font-size: 12px !important;
            }
            .stats-grid {
                grid-template-columns: 1fr !important;
                gap: 10px !important;
            }
            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr !important;
                gap: 10px !important;
            }
            .nav-tabs {
                flex-direction: column !important;
                gap: 6px !important;
            }
            .tab-link {
                width: 100% !important;
                justify-content: center !important;
                font-size: 13.5px !important;
                padding: 10px 14px !important;
            }
            .gender-switch-bar {
                flex-direction: column !important;
                gap: 8px !important;
            }
            .gender-selector {
                width: 100% !important;
                min-width: 0 !important;
                box-sizing: border-box !important;
            }
            .form-card, .form-block, .directory-card {
                padding: 14px 12px !important;
                box-sizing: border-box !important;
            }
            .chart-matrix {
                grid-template-rows: repeat(4, 52px) !important;
            }
            .chart-cell-title {
                font-size: 8px !important;
            }
            .chart-cell-content {
                font-size: 9px !important;
            }
            .table-responsive {
                width: 100% !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }
            .input-with-voice input {
                font-size: 13px !important;
            }
            .directory-header {
                padding: 14px 12px !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }
            .search-field-container {
                width: 100% !important;
            }
            .search-field {
                width: 100% !important;
                box-sizing: border-box !important;
            }
            #btnBulkDelete {
                width: 100% !important;
                justify-content: center !important;
            }
            .data-table th, .data-table td {
                padding: 10px 12px !important;
                font-size: 13px !important;
            }
        }

        /* Ultra-Responsive Mobile Design (Up to 320px screens) */
        @media (max-width: 640px) {
            /* 1. Header Navigation */
            .header-nav {
                padding: 10px 14px !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px !important;
                position: relative !important;
            }
            .brand-container {
                justify-content: center !important;
                text-align: center !important;
                gap: 10px !important;
            }
            .brand-symbol {
                width: 38px !important;
                height: 38px !important;
            }
            .brand-info h1 {
                font-size: 15px !important;
                line-height: 1.2 !important;
            }
            .brand-info p {
                font-size: 11px !important;
            }
            .nav-right-controls {
                display: flex !important;
                flex-wrap: wrap !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 8px !important;
                width: 100% !important;
            }
            .lang-button {
                padding: 5px 12px !important;
                font-size: 12px !important;
            }
            .btn-master-settings, .btn-exit {
                padding: 5px 12px !important;
                font-size: 12px !important;
            }

            /* 2. Candidate Type Switch (Bride vs Groom) - STACK IN 1 COLUMN */
            .gender-switch-bar {
                grid-template-columns: 1fr !important;
                padding: 12px !important;
                gap: 10px !important;
            }
            .gender-selector {
                padding: 10px 14px !important;
                gap: 12px !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .gender-icon {
                width: 42px !important;
                height: 42px !important;
                font-size: 22px !important;
            }
            .gender-text-title {
                font-size: 15px !important;
                line-height: 1.2 !important;
            }
            .gender-text-sub {
                font-size: 11.5px !important;
                margin-top: 2px !important;
            }

            /* 3. Dashboard Container & Tabs */
            .dashboard-container {
                padding: 0 10px !important;
                margin: 12px auto !important;
            }
            .nav-tabs {
                flex-direction: column !important;
                gap: 8px !important;
            }
            .tab-link {
                padding: 10px 14px !important;
                font-size: 13.5px !important;
            }

            /* 4. Form Blocks */
            .form-block {
                padding: 14px 12px !important;
            }
            .block-header {
                font-size: 14.5px !important;
            }

            /* 5. 12-Kattam Kundali Matrix */
            .chart-matrix {
                grid-template-rows: repeat(4, 58px) !important;
            }
            .chart-cell {
                height: 58px !important;
            }
            .cell-index-name {
                font-size: 7.5px !important;
            }
            .planet-slot {
                font-size: 8.5px !important;
            }

            /* 6. Blank Printable Biodata Forms Bar - Mobile Ultra-Responsive */
            .blank-forms-bar {
                padding: 10px 10px !important;
                border-radius: 8px !important;
            }
            .blank-forms-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 6px !important;
            }
            .blank-forms-title {
                font-size: 12px !important;
                line-height: 1.35 !important;
            }
            .blank-forms-badge {
                font-size: 10.5px !important;
                padding: 2px 6px !important;
            }
            .blank-forms-controls {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 8px !important;
                width: 100% !important;
            }
            .blank-forms-field {
                width: 100% !important;
                min-width: 0 !important;
                flex: none !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 4px !important;
            }
            .blank-forms-field label {
                font-size: 11px !important;
                margin-bottom: 2px !important;
            }
            .blank-forms-field select {
                width: 100% !important;
                min-width: 0 !important;
                height: 38px !important;
                font-size: 13px !important;
                box-sizing: border-box !important;
            }
            .blank-forms-btn-wrap {
                width: 100% !important;
                margin-top: 4px !important;
            }
            .blank-forms-btn {
                width: 100% !important;
                height: 40px !important;
                font-size: 12.5px !important;
                justify-content: center !important;
                white-space: normal !important;
                text-align: center !important;
                box-sizing: border-box !important;
            }
            .dropzone-prompt-main {
                font-size: 13.5px !important;
            }
            .dropzone-prompt-sub {
                font-size: 11px !important;
            }
            .admin-tab-visibility-box {
                min-width: 0 !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
        }

    </style>
</head>
<body>

    <!-- Executive Header Navigation -->
    <header class="header-nav">
        <div class="brand-container">
            <div class="brand-symbol" style="background: transparent; box-shadow: none; width: 48px; height: 48px; padding: 0;">
                <img src="{{ asset('images/logo.svg') }}" alt="Master Matrimony Logo" onerror="this.src='/images/logo.svg'" style="width: 48px; height: 48px; object-fit: contain; border-radius: 50%; display: block;">
            </div>
            <div class="brand-info">
                <h1 id="brandTitle">மாஸ்டர் மணமாலை</h1>
                <p id="brandSub">திருமண தகவல் மையம் | அலைபேசி: +91 90000 00000</p>
            </div>
        </div>

        <div class="nav-right-controls">
            <!-- 100% Strict Pure Language Toggle -->
            <div class="language-toggle">
                <button type="button" class="lang-button active" id="btnTa" onclick="setAppLanguage('ta')">தமிழ்</button>
                <button type="button" class="lang-button" id="btnEn" onclick="setAppLanguage('en')">English</button>
            </div>

            <!-- Admin Panel Button (Full Page View Switch) -->
            <button type="button" class="btn-master-settings" onclick="selectTab(3)" title="Admin Panel (அட்மின் பேனல்)">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg>
                <span id="btnAdminPanelText">அட்மின் பேனல்</span>
            </button>

            <a href="{{ route('matrimony.logout') }}" class="btn-exit" id="btnLogoutText">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                <span>வெளியேறு</span>
            </a>
        </div>
    </header>

    <!-- Floating Live Voice Recognition Toast -->
    <div id="voiceAlertToast" class="live-voice-toast">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
        <span id="voiceToastMessage">கேட்கிறது... பேசவும்...</span>
    </div>

    <!-- Main Container -->
    <main class="dashboard-container">

        <!-- 3 Executive Stats Cards (With Bride & Groom Emojis) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div>
                    <div class="stat-title" id="stat_total_label">மொத்த வரன்கள்</div>
                    <div class="stat-number">{{ $totalCount }}</div>
                </div>
                <div class="stat-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>

            <div class="stat-card bride">
                <div>
                    <div class="stat-title" id="stat_female_label">👰 பெண் வரன்கள்</div>
                    <div class="stat-number">{{ $femaleCount }}</div>
                </div>
                <div class="stat-icon-box" style="font-size: 28px;">
                    👰
                </div>
            </div>

            <div class="stat-card groom">
                <div>
                    <div class="stat-title" id="stat_male_label">🤵 ஆண் வரன்கள்</div>
                    <div class="stat-number">{{ $maleCount }}</div>
                </div>
                <div class="stat-icon-box" style="font-size: 28px;">
                    🤵
                </div>
            </div>
        </div>

        <!-- Navigation Tabs (Only 2 Tabs - Admin Panel accessed from top header) -->
        <div class="nav-tabs">
            <button type="button" class="tab-link active" id="btnTab1" onclick="selectTab(1)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                <span id="tab1Title">புதிய வரன் பதிவு</span>
            </button>

            <button type="button" class="tab-link" id="btnTab2" onclick="selectTab(2)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                <span id="tab2Title">பதிவான வரன்கள் பட்டியல்</span>
                <span class="tab-badge" id="tab2Badge">{{ $totalCount }}</span>
            </button>
        </div>

        <!-- TAB 1: NEW / EDIT REGISTRATION FORM -->
        <div id="tabPanel1" class="tab-panel active">
            <div class="form-card">
                <form action="{{ route('varans.store') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    <input type="hidden" name="varan_id" id="edit_varan_id" value="">
                    <input type="hidden" name="lang" id="form_lang_input" value="ta">

                    <!-- ✨ SMART BIODATA DOCUMENT / PHOTO AUTO-FILL SECTION -->
                    <div class="smart-upload-banner">
                        <div class="smart-upload-header">
                            <div>
                                <div class="smart-upload-title">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <line x1="12" y1="18" x2="12" y2="12"/>
                                        <line x1="9" y1="15" x2="15" y2="15"/>
                                    </svg>
                                    <span id="txt_smart_title">📄 ஸ்மார்ட் பயோடேட்டா அப்லோடு & ஆட்டோபில் (Smart Auto-Fill)</span>
                                    <span class="smart-badge-ai">AI Scanner</span>
                                </div>
                                <div class="smart-upload-sub" id="txt_smart_sub">
                                    வாடிக்கையாளர் அனுப்பிய பூர்த்தி செய்த பயோடேட்டா / ஜாதகப் படம் (Photo) அல்லது PDF அப்லோடு செய்தால், அனைத்து விபரங்களும் உடனே தானாக நிரப்பப்படும்!
                                </div>
                            </div>
                        </div>

                        <!-- Dropzone Area -->
                        <div class="biodata-dropzone" id="biodataDropzone" onclick="document.getElementById('biodataFileInput').click()">
                            <input type="file" id="biodataFileInput" accept="image/*,application/pdf,.txt" style="display: none;" onchange="handleBiodataFileUpload(this.files)">
                            <div class="dropzone-icon-circle">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                            </div>
                            <div class="dropzone-prompt-main" id="txt_dropzone_main">
                                📂 பயோடேட்டா போட்டோ (JPG/PNG) அல்லது PDF கோப்பை இங்கே தேர்ந்தெடுக்கவும்
                            </div>
                            <div class="dropzone-prompt-sub" id="txt_dropzone_sub">
                                கணினியிலிருந்து இழுத்துப் போடவும் அல்லது கிளிக் செய்யவும் (Images: PNG, JPG | PDF | Text)
                            </div>
                        </div>

                        <!-- Blank Printable Biodata Forms Bar (Moved from Settings to Fill Form - Fully Responsive) -->
                        <div class="blank-forms-bar">
                            <div class="blank-forms-header">
                                <div class="blank-forms-title">
                                    <span>📄</span>
                                    <span id="lbl_blank_sec_title">வெற்றிட அச்சுப் படிவங்கள் (Download / Print Blank Forms):</span>
                                </div>
                                <small class="blank-forms-badge" id="lbl_blank_sec_badge">
                                    நேரடி அச்சு / PDF பதிவிறக்கம்
                                </small>
                            </div>
                            <div class="blank-forms-controls">
                                <div class="blank-forms-field blank-forms-field-cat">
                                    <label id="lbl_blank_cat">வரன் பிரிவு:</label>
                                    <select id="blank_form_cat" class="input-select">
                                        <option value="aan" selected id="opt_blank_cat_aan">🤵 ஆண் வரன்</option>
                                        <option value="penn" id="opt_blank_cat_penn">👰 பெண் வரன்</option>
                                        <option value="marumanam_aan" id="opt_blank_cat_maru_aan">💍 ஆண் மறுமணம்</option>
                                        <option value="marumanam_penn" id="opt_blank_cat_maru_penn">💍 பெண் மறுமணம்</option>
                                    </select>
                                </div>
                                <div class="blank-forms-field blank-forms-field-lang">
                                    <label id="lbl_blank_lang">படிவ மொழி:</label>
                                    <select id="blank_form_lang" class="input-select">
                                        <option value="ta" selected id="opt_blank_lang_ta">தமிழ்</option>
                                        <option value="en" id="opt_blank_lang_en">English</option>
                                    </select>
                                </div>
                                <div class="blank-forms-btn-wrap">
                                    <button type="button" onclick="openBlankBiodataForm()" class="btn blank-forms-btn" id="btn_print_blank">
                                        <span>🖨️</span> <span id="btn_print_blank_txt">படிவத்தை அச்சிடுக / PDF</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Live Scanning / OCR Progress Box -->
                        <div class="upload-progress-box" id="uploadProgressBox">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <svg class="spinner-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2.5" style="animation: spin 1s linear infinite;">
                                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"/>
                                        <path d="M12 2a10 10 0 0 1 10 10"/>
                                    </svg>
                                    <span id="scanStatusText" style="font-size: 13.5px; font-weight: 800; color: #92400e;">
                                        பயோடேட்டாவை ஸ்கேன் செய்கிறது...
                                    </span>
                                </div>
                                <span id="scanPercentText" style="font-size: 13px; font-weight: 800; color: #d97706;">0%</span>
                            </div>
                            <div class="progress-bar-track">
                                <div class="progress-bar-fill" id="scanProgressBar"></div>
                            </div>
                        </div>

                        <!-- Auto-Fill Success Alert Banner -->
                        <div class="autofill-success-banner" id="uploadSuccessBanner">
                            <div class="autofill-success-content">
                                <div style="display: flex; align-items: flex-start; gap: 12px;">
                                    <div style="font-size: 24px; line-height: 1;">🎉</div>
                                    <div>
                                        <div style="font-size: 15px; font-weight: 800; color: #065f46;" id="txt_success_title">
                                            வெற்றிகரமாக படிக்கப்பட்டது! <span id="autofillCount" style="background: #10b981; color: #fff; padding: 1px 8px; border-radius: 12px;">34</span> தகவல்கள் தானாக நிரப்பப்பட்டன.
                                        </div>
                                        <div style="font-size: 13px; color: #047857; margin-top: 3px; font-weight: 600;" id="txt_success_sub">
                                            💡 பச்சை நிறத்தில் ஒளிரும் பெட்டிகளை சரிபார்க்கவும். ஏதேனும் விபரம் மாற்ற விரும்பினால் தட்டச்சு செய்யலாம் அல்லது 🎙️ Mic பட்டனை அழுத்தி பேசி திருத்தலாம்!
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="clearAutofillNotification()" style="background: #10b981; color: #fff; border: none; padding: 6px 14px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 12.5px;">
                                    ✓ <span id="txt_btn_ok">சரி (Done)</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 1. Gender Selector Switch with Emojis -->
                    <div class="gender-switch-bar">
                        <div class="gender-selector active-bride" id="boxBride" onclick="pickGender('penn')">
                            <input type="radio" name="varan_type" value="penn" id="rdoPenn" checked style="display: none;">
                            <div class="gender-icon">
                                👰
                            </div>
                            <div>
                                <div class="gender-text-title" id="t_bride">👰 பெண் வரன்</div>
                                <div class="gender-text-sub" id="t_bride_sub">மணமகள் விபரங்கள் பதிவு</div>
                            </div>
                        </div>

                        <div class="gender-selector" id="boxGroom" onclick="pickGender('aan')">
                            <input type="radio" name="varan_type" value="aan" id="rdoAan" style="display: none;">
                            <div class="gender-icon">
                                🤵
                            </div>
                            <div>
                                <div class="gender-text-title" id="t_groom">🤵 ஆண் வரன்</div>
                                <div class="gender-text-sub" id="t_groom_sub">மணமகன் விபரங்கள் பதிவு</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Basic Candidate Details -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span id="h_basic">அடிப்படை விபரங்கள்</span>
                        </div>

                        <!-- Hidden reg_no to preserve database compatibility without visible UI -->
                        <input type="hidden" name="reg_no" id="reg_no" value="">

                        <!-- Hidden reg_date to preserve database compatibility without visible UI -->
                        <input type="hidden" name="reg_date" id="reg_date" value="{{ date('Y-m-d') }}">

                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_name">வரன் பெயர் *</label>
                                <div class="input-with-voice">
                                    <input type="text" name="name" id="name" class="input-text" placeholder="பெயர் தட்டச்சு செய்யவும்" required>
                                    <button type="button" class="voice-mic-btn" onclick="startMic('name', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Community: Select an Option Dropdown + Editable Text Input + Voice Mic -->
                            <div class="field-group">
                                <label class="field-label" id="l_community">இனம் / சமூகம்</label>
                                <div style="display: flex; gap: 8px;">
                                    <select id="community_select" onchange="pickCommunityOption(this.value)" class="input-text input-select" style="width: 50%; min-width: 0; padding-right: 8px;">
                                        <option value="" id="opt_c_default">-- தேர்ந்தெடுக்கவும் --</option>
                                        @foreach($communitiesTa as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-with-voice" style="width: 50%; min-width: 0;">
                                        <input type="text" name="community" id="community" class="input-text" placeholder="சமூகம் (தட்டச்சு அல்லது மைக்)" value="">
                                        <button type="button" class="voice-mic-btn" onclick="startMic('community', this)" title="Voice Mic for Community">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="field-group" style="margin-top: 10px;">
                            <label class="field-label" id="l_photo">வரன் புகைப்படம்</label>
                            <div class="photo-container">
                                <div class="photo-preview-frame" id="photoPreviewFrame" onclick="triggerPhotoUploadOrCrop()" style="cursor: pointer; position: relative;" title="Click to choose or crop photograph">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                                <div style="flex-grow: 1;">
                                    <div style="display: flex; gap: 8px; align-items: center;">
                                        <input type="file" name="photo" id="photo" accept="image/*" onchange="previewUpload(event)" class="input-text" style="padding-right: 14px; height: 38px; flex-grow: 1;">
                                        <button type="button" id="btnReCrop" onclick="triggerPhotoUploadOrCrop()" style="display: none; height: 38px; padding: 0 12px; font-size: 12.5px; font-weight: 700; color: #2563eb; background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: 8px; cursor: pointer; white-space: nowrap; align-items: center; gap: 5px;" title="Adjust / Re-crop Photo">
                                            ✂️ Adjust / Crop
                                        </button>
                                    </div>
                                    <small style="color: #64748b; font-size: 12.5px; display: block; margin-top: 4px;" id="l_photo_help">பாஸ்போர்ட் அளவு புகைப்படம் தேர்ந்தெடுக்கவும் (Select or crop any photo)</small>

                                    <!-- Global Admin Print Photo Setting Managed via Admin Panel -->
                                    <input type="hidden" name="show_photo_on_print" id="show_photo_on_print" value="1">
                                    <input type="hidden" name="photo_base64" id="photo_base64" value="">
                                    <div style="margin-top: 6px; font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px;">
                                        <span style="font-size: 14px;">⚙️</span>
                                        <span id="l_admin_photo_note">அச்சுத்தாள் படம் காட்டும் அமைப்பு அட்மின் பேனல் மூலம் பொதுவானதாக நிர்வகிக்கப்படுகிறது.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Birth Details -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span id="h_birth">பிறப்பு விபரங்கள்</span>
                        </div>

                        <div class="grid-3">
                            <div class="field-group">
                                <label class="field-label" id="l_dob">பிறந்த தேதி</label>
                                <div id="dob_error_msg" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin-bottom:5px; padding:5px 9px; background:#fee2e2; border-radius:6px; border:1px solid #fca5a5;"></div>
                                <div class="input-with-voice">
                                    <input type="date" name="dob" id="dob" onchange="validateDobInput()" onblur="validateDobInput()" oninput="validateDobInput()" max="{{ date('Y-m-d') }}" min="1920-01-01" class="input-text input-select" style="padding-right: 42px;">
                                    <button type="button" class="voice-mic-btn" id="btn_dob_mic" onclick="startDobMic(this)" title="குரல் பதிவு - பிறந்த தேதி (Voice Mic for Date of Birth)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_time">பிறந்த நேரம்</label>
                                <div id="birth_time_error_msg" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin-bottom:5px; padding:5px 9px; background:#fee2e2; border-radius:6px; border:1px solid #fca5a5;"></div>
                                <div class="input-with-voice">
                                    <input type="text" name="birth_time" id="birth_time" onblur="validateBirthTimeInput()" oninput="if(document.getElementById('birth_time_error_msg')) document.getElementById('birth_time_error_msg').style.display='none'; this.style.borderColor='';" class="input-text" placeholder="எ.கா: 10:30 AM">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('birth_time', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_place">பிறந்த ஊர்</label>
                                <div id="birth_place_error_msg" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin-bottom:5px; padding:5px 9px; background:#fee2e2; border-radius:6px; border:1px solid #fca5a5;"></div>
                                <div class="input-with-voice">
                                    <input type="text" name="birth_place" id="birth_place" onchange="validateBirthPlaceInput()" onblur="validateBirthPlaceInput()" oninput="validateBirthPlaceInput()" class="input-text" placeholder="பிறந்த ஊர்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('birth_place', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Education & Career (Job Dropdown + Voice Mic) -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            <span id="h_career">கல்வி & பணி விபரம்</span>
                        </div>

                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_edu">வரனின் படிப்பு</label>
                                <select name="education" id="education" class="input-text input-select">
                                    <option value="" id="opt_sel_edu">-- தேர்ந்தெடுக்கவும் --</option>
                                    @foreach($educationsTa as $k => $v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Job / Profession: Select an Option Dropdown + Editable Text + Voice Mic -->
                            <div class="field-group">
                                <label class="field-label" id="l_job">வேலை / தொழில்</label>
                                <div style="display: flex; gap: 8px;">
                                    <select id="job_select" onchange="pickJobOption(this.value)" class="input-text input-select" style="width: 50%; min-width: 0; padding-right: 8px;">
                                        <option value="" id="opt_job_default">-- தேர்ந்தெடுக்கவும் --</option>
                                        @foreach($jobsTa as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-with-voice" style="width: 50%; min-width: 0;">
                                        <input type="text" name="job_title" id="job_title" class="input-text" placeholder="பணி விபரம்">
                                        <button type="button" class="voice-mic-btn" onclick="startMic('job_title', this)" title="Voice Mic for Job">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_company">நிறுவனம் பெயர் & ஊர்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="company_details" id="company_details" class="input-text" placeholder="நிறுவனம் பெயர் & ஊர்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('company_details', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_income">மாத வருமானம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="monthly_income" id="monthly_income" class="input-text" placeholder="மாத வருமானம் (எ.கா: 50,000)">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('monthly_income', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Physical & Ancestry -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                            <span id="h_physical">தோற்றம், குலதெய்வம் & கூட்டம்</span>
                        </div>

                        <div class="grid-3">
                            <div class="field-group">
                                <label class="field-label" id="l_height">உயரம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="height" id="height" class="input-text" placeholder="உயரம் (எ.கா: 165 cm)">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('height', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_weight">எடை</label>
                                <div class="input-with-voice">
                                    <input type="text" name="weight" id="weight" class="input-text" placeholder="எடை (எ.கா: 55 kg)">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('weight', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_color">நிறம்</label>
                                <select name="complexion" id="complexion" class="input-text input-select">
                                    <option value="" id="opt_sel_col">-- தேர்ந்தெடுக்கவும் --</option>
                                    <option value="சிவப்பு" id="opt_col1">சிவப்பு</option>
                                    <option value="மாநிறம்" id="opt_col2">மாநிறம்</option>
                                    <option value="அடர் சிவப்பு" id="opt_col3">அடர் சிவப்பு</option>
                                    <option value="கருப்பு" id="opt_col4">கருப்பு</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid-3">
                            <div class="field-group">
                                <label class="field-label" id="l_temple">குலதெய்வம், ஊர்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="kuladeivam" id="kuladeivam" class="input-text" placeholder="குலதெய்வம், ஊர்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('kuladeivam', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_gothram">கோத்திரம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="gothram" id="gothram" class="input-text" placeholder="கோத்திரம்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('gothram', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_kootam">கூட்டம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="kootam" id="kootam" class="input-text" placeholder="கூட்டம்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('kootam', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Parents & Family Background (Every Single Field Separate) -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span id="h_family">பெற்றோர் & குடும்ப விபரம்</span>
                        </div>

                        <!-- Father Details Row -->
                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_fname">தந்தை பெயர்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="father_name" id="father_name" class="input-text" placeholder="தந்தை பெயர்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('father_name', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_fphone">தந்தை அலைபேசி</label>
                                <div id="father_mobile_error_msg" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin-bottom:5px; padding:4px 8px; background:#fee2e2; border-radius:6px; border:1px solid #fca5a5;"></div>
                                <div class="input-with-voice">
                                    <input type="tel" name="father_mobile" id="father_mobile" class="input-text" placeholder="அலைபேசி எண் (10 இலக்கம்)" maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10); validateMobileField(this, false);" onblur="validateMobileField(this, true);">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('father_mobile', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_fjob">தந்தையின் பணி</label>
                                <div class="input-with-voice">
                                    <input type="text" name="father_job" id="father_job" class="input-text" placeholder="தந்தையின் பணி">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('father_job', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_fnative">தந்தை பூர்வீகம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="father_native" id="father_native" class="input-text" placeholder="தந்தை பூர்வீகம்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('father_native', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mother Details Row -->
                        <div class="grid-2" style="margin-top: 8px;">
                            <div class="field-group">
                                <label class="field-label" id="l_mname">தாய் பெயர்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="mother_name" id="mother_name" class="input-text" placeholder="தாய் பெயர்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('mother_name', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_mphone">தாய் அலைபேசி</label>
                                <div id="mother_mobile_error_msg" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin-bottom:5px; padding:4px 8px; background:#fee2e2; border-radius:6px; border:1px solid #fca5a5;"></div>
                                <div class="input-with-voice">
                                    <input type="tel" name="mother_mobile" id="mother_mobile" class="input-text" placeholder="அலைபேசி எண் (10 இலக்கம்)" maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10); validateMobileField(this, false);" onblur="validateMobileField(this, true);">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('mother_mobile', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_mjob">தாயின் பணி</label>
                                <div class="input-with-voice">
                                    <input type="text" name="mother_job" id="mother_job" class="input-text" placeholder="தாயின் பணி">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('mother_job', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_mnative">தாய் பூர்வீகம்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="mother_native" id="mother_native" class="input-text" placeholder="தாய் பூர்வீகம்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('mother_native', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid-2" style="margin-top: 8px;">
                            <div class="field-group">
                                <label class="field-label" id="l_wealth">குடும்ப வருமானம் / வசதிகள்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="family_wealth" id="family_wealth" class="input-text" placeholder="குடும்ப சொத்து விபரம்">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('family_wealth', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="siblings_details" id="siblings_details">

                            <div class="field-group">
                                <label class="field-label" id="l_brothers">சகோதரர்கள்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="brothers" id="brothers" class="input-text" placeholder="எ.கா: அண்ணன் 1 / இல்லை">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('brothers', this)" title="Voice Mic for Brothers">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid-2" style="margin-top: 8px;">
                            <div class="field-group">
                                <label class="field-label" id="l_sisters">சகோதரிகள்</label>
                                <div class="input-with-voice">
                                    <input type="text" name="sisters" id="sisters" class="input-text" placeholder="எ.கா: அக்கா 1 திருமணமானவர் / இல்லை">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('sisters', this)" title="Voice Mic for Sisters">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_address">முழு முகவரி (Address)</label>
                                <div class="input-with-voice">
                                    <input type="text" name="address" id="address" class="input-text" placeholder="முழு முகவரி">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('address', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Astrology Section -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span id="h_astrology">ஜோதிட விபரம் / Astrological Particulars</span>
                        </div>

                        <div class="grid-3">
                            <div class="field-group">
                                <label class="field-label" id="l_rasi">ராசி</label>
                                <select name="rasi" id="rasi" onchange="filterStarsByRasi(this.value)" class="input-text input-select">
                                    <option value="" id="opt_sel_rasi">-- தேர்ந்தெடுக்கவும் --</option>
                                    @foreach($rasisTa as $rk => $rv)
                                        <option value="{{ $rk }}">{{ $rv }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_star">நட்சத்திரம்</label>
                                <select name="natchathiram" id="natchathiram" class="input-text input-select">
                                    <option value="" id="opt_sel_star">-- தேர்ந்தெடுக்கவும் --</option>
                                    @foreach($starsTa as $sk => $sv)
                                        <option value="{{ $sk }}">{{ $sv }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_lagnam">லக்னம்</label>
                                <select name="lagnam" id="lagnam" class="input-text input-select">
                                    <option value="" id="opt_sel_lag">-- தேர்ந்தெடுக்கவும் --</option>
                                    @foreach($lagnamsTa as $lk => $lv)
                                        <option value="{{ $lk }}">{{ $lv }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="field-group">
                                <label class="field-label" id="l_dosham">தோஷ விபரம்</label>
                                <select name="dosham" id="dosham" class="input-text input-select">
                                    <option value="" id="opt_sel_dosham">-- தேர்ந்தெடுக்கவும் --</option>
                                    <option value="சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி" id="opt_d1">சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி</option>
                                    <option value="சுத்தம்" id="opt_d2">சுத்தம்</option>
                                    <option value="செவ்வாய் தோஷம்" id="opt_d3">செவ்வாய் தோஷம்</option>
                                    <option value="ராகு கேது தோஷம்" id="opt_d4">ராகு கேது தோஷம்</option>
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_thisai">திசை இருப்பு</label>
                                <div class="input-with-voice">
                                    <input type="text" name="thisai_iruppu" id="thisai_iruppu" class="input-text" placeholder="திசை இருப்பு (எ.கா: சுக்கிரன் திசை)">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('thisai_iruppu', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid-2" style="margin-top: 8px; display: none;">
                            <div class="field-group">
                                <label class="field-label" id="l_tamil_month">தமிழ் மாதம் (Tamil Month)</label>
                                <div style="display: flex; gap: 6px;">
                                    <select name="tamil_month_name" id="tamil_month_name" class="input-text input-select" style="flex: 1;" onchange="syncTamilMonthValue()">
                                        <option value="">-- மாதம் தேர்ந்தெடுக்கவும் --</option>
                                        <option value="சித்திரை">சித்திரை</option>
                                        <option value="வைகாசி">வைகாசி</option>
                                        <option value="ஆனி">ஆனி</option>
                                        <option value="ஆடி">ஆடி</option>
                                        <option value="ஆவணி">ஆவணி</option>
                                        <option value="புரட்டாசி">புரட்டாசி</option>
                                        <option value="ஐப்பசி">ஐப்பசி</option>
                                        <option value="கார்த்திகை">கார்த்திகை</option>
                                        <option value="மார்கழி">மார்கழி</option>
                                        <option value="தை">தை</option>
                                        <option value="மாசி">மாசி</option>
                                        <option value="பங்குனி">பங்குனி</option>
                                    </select>
                                    <input type="number" name="tamil_month_date" id="tamil_month_date" class="input-text" placeholder="தேதி (25)" min="1" max="31" style="width: 90px;" oninput="validateTamilDate(this); syncTamilMonthValue()">
                                    <input type="hidden" name="tamil_month" id="tamil_month">
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_tamil_year">தமிழ் வருடம் (Tamil Year)</label>
                                <select name="tamil_year" id="tamil_year" class="input-text input-select">
                                    <option value="">-- 60 தமிழ் வருடங்கள் --</option>
                                    <option value="பிரபவ">1. பிரபவ</option>
                                    <option value="விபவ">2. விபவ</option>
                                    <option value="சுக்கில">3. சுக்கில</option>
                                    <option value="பிரமோதூத">4. பிரமோதூத</option>
                                    <option value="பிரஜோற்பத்தி">5. பிரஜோற்பத்தி</option>
                                    <option value="ஆங்கீரச">6. ஆங்கீரச</option>
                                    <option value="ஸ்ரீமுக">7. ஸ்ரீமுக</option>
                                    <option value="பவ">8. பவ</option>
                                    <option value="யுவ">9. யுவ</option>
                                    <option value="தாது">10. தாது</option>
                                    <option value="ஈஸ்வர">11. ஈஸ்வர</option>
                                    <option value="வெகுதானிய">12. வெகுதானிய</option>
                                    <option value="பிரமாதி">13. பிரமாதி</option>
                                    <option value="விக்ரம">14. விக்ரம</option>
                                    <option value="விஷு">15. விஷு</option>
                                    <option value="சித்திரபானு">16. சித்திரபானு</option>
                                    <option value="சுபானு">17. சுபானு</option>
                                    <option value="தாரண">18. தாரண</option>
                                    <option value="பார்த்திப">19. பார்த்திப</option>
                                    <option value="விய">20. விய</option>
                                    <option value="சர்வஜித்">21. சர்வஜித்</option>
                                    <option value="சர்வதாரி">22. சர்வதாரி</option>
                                    <option value="விரோதி">23. விரோதி</option>
                                    <option value="விக்ருதி">24. விக்ருதி</option>
                                    <option value="கர">25. கர</option>
                                    <option value="நந்தன">26. நந்தன</option>
                                    <option value="விஜய">27. விஜய</option>
                                    <option value="ஜய">28. ஜய</option>
                                    <option value="மன்மத">29. மன்மத</option>
                                    <option value="துன்முகி">30. துன்முகி</option>
                                    <option value="ஹேவிளம்பி">31. ஹேவிளம்பி</option>
                                    <option value="விளம்பி">32. விளம்பி</option>
                                    <option value="விகாரி">33. விகாரி</option>
                                    <option value="சார்வரி">34. சார்வரி</option>
                                    <option value="பிலவ">35. பிலவ</option>
                                    <option value="சுபகிருது">36. சுபகிருது</option>
                                    <option value="சோபகிருது">37. சோபகிருது</option>
                                    <option value="குரோதி">38. குரோதி</option>
                                    <option value="விசுவாவசு">39. விசுவாவசு</option>
                                    <option value="பராபவ">40. பராபவ</option>
                                    <option value="பிலவங்க">41. பிலவங்க</option>
                                    <option value="கீலக">42. கீலக</option>
                                    <option value="சௌமிய">43. சௌமிய</option>
                                    <option value="சாதாரண">44. சாதாரண</option>
                                    <option value="விரோதிகிருது">45. விரோதிகிருது</option>
                                    <option value="பரிதாபி">46. பரிதாபி</option>
                                    <option value="பிரமாதீச">47. பிரமாதீச</option>
                                    <option value="ஆனந்த">48. ஆனந்த</option>
                                    <option value="ராட்சச">49. ராட்சச</option>
                                    <option value="நள">50. நள</option>
                                    <option value="பிங்கள">51. பிங்கள</option>
                                    <option value="காளயுக்தி">52. காளயுக்தி</option>
                                    <option value="சித்தார்த்தி">53. சித்தார்த்தி</option>
                                    <option value="ரௌத்திரி">54. ரௌத்திரி</option>
                                    <option value="துன்மதி">55. துன்மதி</option>
                                    <option value="துந்துபி">56. துந்துபி</option>
                                    <option value="ருத்ரோத்காரி">57. ருத்ரோத்காரி</option>
                                    <option value="ரக்தாட்சி">58. ரக்தாட்சி</option>
                                    <option value="குரோதன">59. குரோதன</option>
                                    <option value="அட்சய">60. அட்சய</option>
                                </select>
                            </div>
                        </div>

                        <!-- 12-Kattam Kundali Matrix -->
                        <div style="margin-top: 14px;">
                            <label class="field-label" id="l_kattam_header">12 கட்ட ஜாதகம் (ராசி & நவாம்சம்) / 12-House Horoscope Grid (Rasi & Navamsam):</label>
                            
                            <div class="planets-selector-bar">
                                <span style="font-size: 13px; font-weight: 800; color: #78350f;" id="l_planets_label">கிரகங்கள்:</span>
                                @foreach($planetsTa as $pk => $pv)
                                    <button type="button" class="planet-btn" onclick="injectPlanet('{{ $pk }}')">{{ $pk }}</button>
                                @endforeach
                                <button type="button" class="planet-btn" style="background: #fee2e2; color: #991b1b; border-color: #fca5a5; font-weight: 800;" onclick="clearActiveCell()" id="btn_clear_cell" title="தேர்ந்தெடுத்த கட்டத்தை அழிக்க">❌ அழிக்க (Clear)</button>
                            </div>

                            <div class="astrology-dual-grid">
                                <!-- Rasi Chart -->
                                <div class="kundali-box">
                                    <div class="kundali-title" id="t_chart_rasi">ராசி கட்டம்</div>
                                    <div class="chart-matrix">
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_12')"><span class="cell-index-name" id="c_r_12">12 மீனம்</span><div class="cell-planets-matrix" id="disp_r_cell_12"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[12][]" id="r_cell_12" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_1')"><span class="cell-index-name" id="c_r_1">1 மேஷம்</span><div class="cell-planets-matrix" id="disp_r_cell_1"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[1][]" id="r_cell_1" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_2')"><span class="cell-index-name" id="c_r_2">2 ரிஷபம்</span><div class="cell-planets-matrix" id="disp_r_cell_2"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[2][]" id="r_cell_2" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_3')"><span class="cell-index-name" id="c_r_3">3 மிதுனம்</span><div class="cell-planets-matrix" id="disp_r_cell_3"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[3][]" id="r_cell_3" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_11')"><span class="cell-index-name" id="c_r_11">11 கும்பம்</span><div class="cell-planets-matrix" id="disp_r_cell_11"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[11][]" id="r_cell_11" class="cell-data-input" value=""></div>
                                        <div class="chart-center-hub" id="hub_rasi">ராசி</div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_4')"><span class="cell-index-name" id="c_r_4">4 கடகம்</span><div class="cell-planets-matrix" id="disp_r_cell_4"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[4][]" id="r_cell_4" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_10')"><span class="cell-index-name" id="c_r_10">10 மகரம்</span><div class="cell-planets-matrix" id="disp_r_cell_10"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[10][]" id="r_cell_10" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_5')"><span class="cell-index-name" id="c_r_5">5 சிம்மம்</span><div class="cell-planets-matrix" id="disp_r_cell_5"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[5][]" id="r_cell_5" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_9')"><span class="cell-index-name" id="c_r_9">9 தனுசு</span><div class="cell-planets-matrix" id="disp_r_cell_9"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[9][]" id="r_cell_9" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_8')"><span class="cell-index-name" id="c_r_8">8 விருச்சி</span><div class="cell-planets-matrix" id="disp_r_cell_8"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[8][]" id="r_cell_8" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_7')"><span class="cell-index-name" id="c_r_7">7 துலாம்</span><div class="cell-planets-matrix" id="disp_r_cell_7"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[7][]" id="r_cell_7" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'r_cell_6')"><span class="cell-index-name" id="c_r_6">6 கன்னி</span><div class="cell-planets-matrix" id="disp_r_cell_6"><span class="cell-empty-dash">-</span></div><input type="hidden" name="rasi_chart[6][]" id="r_cell_6" class="cell-data-input" value=""></div>
                                    </div>
                                </div>

                                <!-- Navamsam Chart -->
                                <div class="kundali-box">
                                    <div class="kundali-title" id="t_chart_nav">நவாம்சம் கட்டம்</div>
                                    <div class="chart-matrix">
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_12')"><span class="cell-index-name" id="c_n_12">12 மீனம்</span><div class="cell-planets-matrix" id="disp_n_cell_12"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[12][]" id="n_cell_12" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_1')"><span class="cell-index-name" id="c_n_1">1 மேஷம்</span><div class="cell-planets-matrix" id="disp_n_cell_1"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[1][]" id="n_cell_1" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_2')"><span class="cell-index-name" id="c_n_2">2 ரிஷபம்</span><div class="cell-planets-matrix" id="disp_n_cell_2"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[2][]" id="n_cell_2" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_3')"><span class="cell-index-name" id="c_n_3">3 மிதுனம்</span><div class="cell-planets-matrix" id="disp_n_cell_3"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[3][]" id="n_cell_3" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_11')"><span class="cell-index-name" id="c_n_11">11 கும்பம்</span><div class="cell-planets-matrix" id="disp_n_cell_11"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[11][]" id="n_cell_11" class="cell-data-input" value=""></div>
                                        <div class="chart-center-hub" id="hub_nav">நவாம்சம்</div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_4')"><span class="cell-index-name" id="c_n_4">4 கடகம்</span><div class="cell-planets-matrix" id="disp_n_cell_4"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[4][]" id="n_cell_4" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_10')"><span class="cell-index-name" id="c_n_10">10 மகரம்</span><div class="cell-planets-matrix" id="disp_n_cell_10"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[10][]" id="n_cell_10" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_5')"><span class="cell-index-name" id="c_n_5">5 சிம்மம்</span><div class="cell-planets-matrix" id="disp_n_cell_5"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[5][]" id="n_cell_5" class="cell-data-input" value=""></div>

                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_9')"><span class="cell-index-name" id="c_n_9">9 தனுசு</span><div class="cell-planets-matrix" id="disp_n_cell_9"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[9][]" id="n_cell_9" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_8')"><span class="cell-index-name" id="c_n_8">8 விருச்சி</span><div class="cell-planets-matrix" id="disp_n_cell_8"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[8][]" id="n_cell_8" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_7')"><span class="cell-index-name" id="c_n_7">7 துலாம்</span><div class="cell-planets-matrix" id="disp_n_cell_7"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[7][]" id="n_cell_7" class="cell-data-input" value=""></div>
                                        <div class="chart-cell" onclick="selectChartCell(this, 'n_cell_6')"><span class="cell-index-name" id="c_n_6">6 கன்னி</span><div class="cell-planets-matrix" id="disp_n_cell_6"><span class="cell-empty-dash">-</span></div><input type="hidden" name="navamsam_chart[6][]" id="n_cell_6" class="cell-data-input" value=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Expectations & Contact -->
                    <div class="form-block">
                        <div class="block-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            <span id="h_expectations">எதிர்பார்ப்புகள் & இதர விபரம்</span>
                        </div>

                        <div class="grid-3">
                            <div class="field-group">
                                <label class="field-label" id="l_mtype">திருமண வகை</label>
                                <select name="marriage_type" id="marriage_type" class="input-text input-select">
                                    <option value="mudhal_manama" id="opt_m1" selected>முதல் மணம்</option>
                                    <option value="marumanama" id="opt_m2">மறு மணம்</option>
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_blood">ரத்த வகை</label>
                                <select name="blood_group" id="blood_group" class="input-text input-select">
                                    <option value="" id="opt_sel_blood">-- தேர்ந்தெடுக்கவும் --</option>
                                    @foreach($bloodGroups as $bg)
                                        <option value="{{ $bg }}">{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-group">
                                <label class="field-label" id="l_email">மின்னஞ்சல்</label>
                                <div class="input-with-voice">
                                    <input type="email" name="email" id="email" class="input-text" placeholder="example@gmail.com" oninput="this.value = this.value.replace(/\s+/g, '')">
                                    <button type="button" class="voice-mic-btn" onclick="startMic('email', this)" title="Voice Mic">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" id="l_expect">எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்</label>
                            <div class="input-with-voice">
                                <textarea name="expectations" id="expectations" rows="3" class="input-text" style="padding-right: 48px;" placeholder="எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்"></textarea>
                                <button type="button" class="voice-mic-btn" style="top: 24px;" onclick="startMic('expectations', this)" title="Voice Mic">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button & Direct PDF Button -->
                    <div class="form-action-footer" style="display: flex; justify-content: center; align-items: center; gap: 16px; flex-wrap: wrap;">
                        <button type="submit" class="btn-submit-action" id="btnSubmitForm">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span id="btnSubmitText">சேமித்து மஞ்சள் அட்டை PDF பதிவிறக்குக</span>
                        </button>
                        <button type="button" class="btn-submit-action" id="btnSaveAsPdfForm" onclick="handleSaveAndDownloadPdf()" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); box-shadow: 0 4px 16px rgba(2, 132, 199, 0.35);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            <span id="btnSaveAsPdfText">📄 PDF-ஆக சேமிக்க</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 2: PROFILES DIRECTORY (FULLY INTERACTIVE & LOADABLE) -->
        <div id="tabPanel2" class="tab-panel">
            <div class="directory-card">
                <div class="directory-header" style="flex-wrap: wrap; gap: 14px;">
                    <div>
                        <h2 style="font-size: 19px; font-weight: 800; color: var(--primary);" id="h_directory_title">
                            பதிவான வரன்கள் பட்டியல்
                        </h2>
                        <p style="font-size: 13.5px; color: var(--slate-600); margin-top: 3px;" id="h_directory_sub">
                            விபரங்களை பார்க்க அல்லது அச்சிட வரிசையை கிளிக் செய்யவும்
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <button type="button" id="btnBulkDelete" onclick="executeBulkDelete()" style="display: none; align-items: center; gap: 6px; padding: 8px 14px; background: #dc2626; color: #ffffff; border: none; border-radius: 8px; font-size: 13.5px; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.25);">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            <span id="txtBulkDelete">தேர்ந்தெடுத்தவற்றை நீக்கு (<span id="bulkSelectedCount">0</span>)</span>
                        </button>
                        <div class="search-field-container">
                            <svg class="search-icon-svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <input type="text" id="tableSearch" onkeyup="filterDirectory()" class="search-field" placeholder="பெயர், படிப்பு, போன் மூலம் தேடுக..." style="padding-right: 44px;">
                            <button type="button" class="voice-mic-btn" id="searchVoiceMicBtn" onclick="startSearchMic(this)" title="குரல் மூலம் தேட (Voice Search Mic)" style="position: absolute; right: 6px; top: 50%; transform: translateY(-50%); border-radius: 6px; padding: 6px 8px; background: #fff1f2; border: 1.5px solid #fecdd3; color: #881337; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
                    <table class="data-table" id="profilesTable" style="min-width: 820px;">
                        <thead>
                            <tr>
                                <th style="width: 38px; text-align: center;"><input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAllRows(this)" title="அனைத்தையும் தேர்ந்தெடு (Select All)" style="width: 17px; height: 17px; cursor: pointer;"></th>
                                <th>#</th>
                                <th id="th_pic">புகைப்படம்</th>
                                <th id="th_name">வரன் பெயர்</th>
                                <th id="th_type">பிரிவு</th>
                                <th id="th_rasi">ராசி / நட்சத்திரம்</th>
                                <th id="th_job">படிப்பு / பணி</th>
                                <th id="th_phone">அலைபேசி</th>
                                <th id="th_action">செயல்கள்</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($varans as $idx => $v)
                                <tr class="profile-table-row" onclick="showProfileModal({{ $v->id }})" id="row_varan_{{ $v->id }}">
                                    <td onclick="event.stopPropagation();" style="text-align: center;">
                                        <input type="checkbox" class="profile-row-checkbox" value="{{ $v->id }}" onclick="event.stopPropagation();" onchange="onRowCheckboxChange()" style="width: 17px; height: 17px; cursor: pointer;">
                                    </td>
                                    <td><strong>{{ $idx + 1 }}</strong></td>
                                    <td>
                                        <div style="width: 44px; height: 50px; border-radius: 8px; overflow: hidden; border: 1.5px solid #cbd5e1; background: #f8fafc; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                                            @if($v->photo_path)
                                                <img src="{{ $v->photo_url ?? asset($v->photo_path) }}" onerror="if (!this.dataset.tried) { this.dataset.tried = 1; if (this.src.includes('/public/uploads/')) { this.src = this.src.replace('/public/uploads/', '/uploads/'); } else if (this.src.includes('/uploads/')) { this.src = this.src.replace('/uploads/', '/public/uploads/'); } }" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                {{ $v->varan_type === 'aan' ? '🤵' : '👰' }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div style="color: #0f172a; font-size: 15px; font-weight: 800;">{{ $v->name }}</div>
                                        <div style="font-size: 12.5px; color: #64748b; font-weight: 600;">{{ $v->community ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge-tag {{ $v->varan_type === 'aan' ? 'groom' : 'bride' }} badge-varan-type" data-type="{{ $v->varan_type }}">
                                            {{ $v->varan_type === 'aan' ? '🤵 ஆண் வரன்' : '👰 பெண் வரன்' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700;">{{ $v->rasi ?? '-' }}</div>
                                        <div style="font-size: 12.5px; color: #64748b;">{{ $v->natchathiram ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700;">{{ $v->education ?? '-' }}</div>
                                        <div style="font-size: 12.5px; color: #64748b;">{{ $v->job_title ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <span style="font-weight: 700; color: #0f172a;">{{ $v->father_mobile ?? $v->mother_mobile ?? '-' }}</span>
                                    </td>
                                    <td onclick="event.stopPropagation();">
                                        <div class="action-btn-group">
                                            <button type="button" class="btn-action-icon btn-view" onclick="showProfileModal({{ $v->id }})" title="View Details">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                <span class="btn-action-txt-view">பார்வை</span>
                                            </button>
                                            <button type="button" class="btn-action-icon btn-edit" onclick="loadForEdit({{ $v->id }})" title="Edit Profile">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                <span class="btn-action-txt-edit">திருத்து</span>
                                            </button>
                                            <a href="{{ route('varans.print', $v->id) }}" onclick="this.href='/varans/{{ $v->id }}/print?lang=' + appLang + '&show_photo=' + (localStorage.getItem('matrimony_admin_show_photo') || '1')" target="_blank" class="btn-action-icon btn-print" title="Print PDF">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                                                <span class="btn-action-txt-print">அச்சு</span>
                                            </a>
                                            <button type="button" class="btn-action-icon btn-pdf-action" onclick="downloadCandidateDirectPdf({{ $v->id }}, '{{ addslashes($v->name) }}', '{{ $v->varan_type }}', '{{ $v->marriage_type }}')" title="Download PDF">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                                <span class="btn-action-txt-pdf">PDF</span>
                                            </button>
                                            <form action="{{ route('varans.destroy', $v->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('இந்த வரனை நீக்க வேண்டுமா? (Delete this profile?)')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-delete" title="Delete">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 48px; color: #94a3b8; font-weight: 700;" id="txt_empty_table">
                                        பதிவான வரன்கள் விவரம் எதுவும் இல்லை. புதிய வரன் சேர்க்கவும்!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- DIRECTORY PAGINATION & ROWS PER PAGE TOOLBAR -->
                <div class="directory-pagination-toolbar" id="directoryPaginationToolbar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; padding: 14px 18px; margin-top: 14px; background: #fafaf9; border: 1.5px solid #e7e5e4; border-radius: 10px;">
                    <div style="display: flex; align-items: center; gap: 12px; font-size: 13.5px; color: #44403c;">
                        <span id="lbl_per_page" style="font-weight: 700;">Per page:</span>
                        <select id="directoryPerPageSelect" onchange="changeDirectoryPerPage(this.value)" class="input-select" style="padding: 5px 12px; height: 34px; font-weight: 700; border-radius: 6px; border: 1.5px solid #cbd5e1; background: #ffffff; cursor: pointer;">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="all">All</option>
                        </select>
                        <span id="directoryRecordsSummary" style="font-weight: 700; color: #78350f; margin-left: 6px;"></span>
                    </div>

                    <div class="pagination-controls" style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" class="btn-action-icon" id="btnPageFirst" onclick="goToDirectoryPage(1)" title="First Page" style="height: 34px; padding: 0 10px; font-weight: 800;">«</button>
                        <button type="button" class="btn-action-icon" id="btnPagePrev" onclick="goToDirectoryPage(directoryCurrentPage - 1)" title="Previous Page" style="height: 34px; padding: 0 10px; font-weight: 800;">‹</button>
                        <div id="directoryPageButtons" style="display: flex; gap: 4px; align-items: center;"></div>
                        <button type="button" class="btn-action-icon" id="btnPageNext" onclick="goToDirectoryPage(directoryCurrentPage + 1)" title="Next Page" style="height: 34px; padding: 0 10px; font-weight: 800;">›</button>
                        <button type="button" class="btn-action-icon" id="btnPageLast" onclick="goToDirectoryPage('last')" title="Last Page" style="height: 34px; padding: 0 10px; font-weight: 800;">»</button>
                    </div>
                </div>
            </div>
        </div>

                <!-- TAB 3: ADMIN PANEL (DEDICATED FULL-PAGE VIEW) -->
        <div id="tabPanel3" class="tab-panel" style="display: none;">
            <div class="directory-card" style="padding: 24px; box-sizing: border-box;">
                <div class="directory-header" style="border-bottom: 2px solid var(--gold-border); padding-bottom: 16px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.15); display: flex; align-items: center; justify-content: center; color: #b45309; flex-shrink:0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg>
                        </div>
                        <div>
                            <h2 style="font-size: 20px; font-weight: 800; color: var(--primary); margin:0;" id="adminPanelHeaderTitle">
                                அட்மின் பேனல் - ஆப்ஷன்கள் மேலாண்மை
                            </h2>
                            <p style="font-size: 13.5px; color: var(--slate-600); margin: 3px 0 0;" id="adminPanelHeaderSub">
                                சமூகம், படிப்பு, வேலை ஆப்ஷன்களை சேர்க்க மற்றும் நீக்கலாம்
                            </p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <!-- Dedicated Admin Panel Language Switch -->
                        <div class="admin-lang-toggle" style="display: flex; background: #f1f5f9; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 3px; gap: 4px;">
                            <button type="button" class="btn-admin-lang active" id="btnAdminTa" onclick="setAdminLanguage('ta')" style="border: none; border-radius: 6px; padding: 6px 14px; font-size: 12.5px; font-weight: 800; cursor: pointer; background: #881337; color: #fff;">தமிழ்</button>
                            <button type="button" class="btn-admin-lang" id="btnAdminEn" onclick="setAdminLanguage('en')" style="border: none; border-radius: 6px; padding: 6px 14px; font-size: 12.5px; font-weight: 800; cursor: pointer; background: transparent; color: #475569;">English</button>
                        </div>
                        <button type="button" onclick="selectTab(1)" class="btn-action-icon btn-view" style="padding: 8px 16px; font-size: 13px;">
                            ← <span id="adminBackBtnTxt">படிவத்திற்கு திரும்பு</span>
                        </button>
                    </div>
                </div>

                <!-- Global Print Sheet Settings Card (HR Requirement: Centralized in Admin Panel) -->
                <div class="admin-global-settings-card" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1.5px solid #f59e0b; border-radius: 12px; padding: 16px 20px; margin-bottom: 22px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.1);">
                    <div style="display: flex; align-items: center; gap: 12px; min-width: 240px; flex: 1 1 auto;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: #881337; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; box-shadow: 0 2px 6px rgba(136, 19, 55, 0.25);">
                            🖨️
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 800; color: #78350f;" id="lbl_admin_photo_setting_title">
                                அச்சுத்தாள் பொது அமைப்பு (Global Print Sheet Setting)
                            </div>
                            <div style="font-size: 12.5px; color: #92400e; margin-top: 2px;" id="lbl_admin_photo_setting_sub">
                                அனைத்து வரன்களின் அச்சுத்தாளில் படம் காட்ட வேண்டுமா அல்லது வெற்று இடமாக இருக்க வேண்டுமா?
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; background: #fff; padding: 4px; border: 1.5px solid #d97706; border-radius: 8px; flex-shrink: 0;">
                        <button type="button" id="btnAdminPhotoYes" onclick="setAdminPhotoPrintSetting('1')" style="border: none; border-radius: 6px; padding: 8px 18px; font-size: 13px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                            ✅ <span id="lbl_admin_photo_opt_yes">ஆம் (Show Photo)</span>
                        </button>
                        <button type="button" id="btnAdminPhotoNo" onclick="setAdminPhotoPrintSetting('0')" style="border: none; border-radius: 6px; padding: 8px 18px; font-size: 13px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                            ⏹️ <span id="lbl_admin_photo_opt_no">இல்லை (Empty Space)</span>
                        </button>
                    </div>

                    <!-- Master Option Tabs Visibility Controls (Community, Education, Job Show/Hide) -->
                    <div class="admin-tab-visibility-box" style="display: flex; flex-direction: column; gap: 5px; background: #fff; padding: 8px 14px; border: 1.5px solid #d97706; border-radius: 10px; min-width: 260px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); flex-shrink: 0;">
                        <div style="font-size: 11px; font-weight: 800; color: #78350f; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; display: flex; align-items: center; gap: 4px;">
                            <span>⚙️</span> <span id="lbl_tab_vis_header">Options பார்வை (Tabs Visibility):</span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <span style="font-size: 11.5px; font-weight: 700; color: #451a03;" id="lbl_vis_name_comm">👥 சமூகம் (Community)</span>
                            <div style="display: inline-flex; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 2px; gap: 2px;">
                                <button type="button" id="btnVisCommShow" onclick="toggleMasterTabVisibility('community', true)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Show</button>
                                <button type="button" id="btnVisCommHide" onclick="toggleMasterTabVisibility('community', false)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Hide</button>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <span style="font-size: 11.5px; font-weight: 700; color: #451a03;" id="lbl_vis_name_edu">🎓 படிப்பு (Education)</span>
                            <div style="display: inline-flex; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 2px; gap: 2px;">
                                <button type="button" id="btnVisEduShow" onclick="toggleMasterTabVisibility('education', true)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Show</button>
                                <button type="button" id="btnVisEduHide" onclick="toggleMasterTabVisibility('education', false)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Hide</button>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <span style="font-size: 11.5px; font-weight: 700; color: #451a03;" id="lbl_vis_name_job">💼 வேலை (Job)</span>
                            <div style="display: inline-flex; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 2px; gap: 2px;">
                                <button type="button" id="btnVisJobShow" onclick="toggleMasterTabVisibility('job', true)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Show</button>
                                <button type="button" id="btnVisJobHide" onclick="toggleMasterTabVisibility('job', false)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Hide</button>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <span style="font-size: 11.5px; font-weight: 700; color: #451a03;" id="lbl_vis_name_auth">🔐 கணக்கு (Admin ID & Pass)</span>
                            <div style="display: inline-flex; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 2px; gap: 2px;">
                                <button type="button" id="btnVisAuthShow" onclick="toggleMasterTabVisibility('auth_settings', true)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Show</button>
                                <button type="button" id="btnVisAuthHide" onclick="toggleMasterTabVisibility('auth_settings', false)" style="border: none; border-radius: 4px; padding: 3px 9px; font-size: 11px; font-weight: 800; cursor: pointer; transition: all 0.15s;">Hide</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Tabs inside Admin Panel (Print Styles is 1st!) -->
                <div class="master-tabs" style="display: flex; gap: 10px; margin-bottom: 20px; padding: 0; background: transparent; border-bottom: 2px solid #e2e8f0; flex-wrap: wrap;">
                    <button type="button" class="master-tab-btn active" id="mtab_print_style" onclick="switchMasterTab('print_style_settings')">
                        🎨 <span id="lbl_mtab_print_style">அச்சுத்தாள் வடிவமைப்பு</span>
                    </button>
                    <button type="button" class="master-tab-btn" id="mtab_auth_settings" onclick="switchMasterTab('auth_settings')" style="display: none;">
                        🔐 <span id="lbl_mtab_auth">நிர்வாக கணக்கு & கடவுச்சொல்</span>
                    </button>
                    <button type="button" class="master-tab-btn" id="mtab_comm" onclick="switchMasterTab('community')" style="display: none;">
                        👥 <span id="lbl_mtab_comm">சமூகம்</span> (<span id="count_comm">0</span>)
                    </button>
                    <button type="button" class="master-tab-btn" id="mtab_edu" onclick="switchMasterTab('education')" style="display: none;">
                        🎓 <span id="lbl_mtab_edu">படிப்பு</span> (<span id="count_edu">0</span>)
                    </button>
                    <button type="button" class="master-tab-btn" id="mtab_job" onclick="switchMasterTab('job')" style="display: none;">
                        💼 <span id="lbl_mtab_job">வேலை</span> (<span id="count_job">0</span>)
                    </button>
                </div>

                <!-- 🔐 ADMIN AUTH / CREDENTIALS MANAGEMENT CARD -->
                <div id="adminAuthSettingsCard" class="admin-auth-card" style="display: none; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 14px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.04); box-sizing: border-box; width: 100%;">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; border-bottom: 1.5px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(136, 19, 55, 0.1); color: #881337; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                                🔐
                            </div>
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #1e293b; margin: 0;" id="lbl_admin_auth_title">
                                    நிர்வாக உள்நுழைவு விபரங்கள் மாற்றம் (Change Admin Login ID & Password)
                                </h3>
                                <p style="font-size: 13px; color: #64748b; margin: 3px 0 0;" id="lbl_admin_auth_sub">
                                    Login பக்கத்தில் உள்நுழைவதற்கான ID மற்றும் கடவுச்சொல்லை இங்கு எளிதாக மாற்றிக்கொள்ளலாம்.
                                </p>
                            </div>
                        </div>
                        <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 8px 14px; font-size: 12.5px; font-weight: 700; color: #475569; display: flex; flex-direction: column; gap: 5px; min-width: 210px;">
                            <div>
                                <span id="lbl_cur_user_prefix">தற்போதைய பயனர் ID:</span> <strong style="color: #881337; font-size: 13.5px;" id="disp_current_username">{{ $currentAdminUsername ?? 'admin' }}</strong>
                            </div>
                            <div style="border-top: 1px dashed #cbd5e1; padding-top: 5px;">
                                <span id="lbl_cur_email_prefix">மீட்டெடுப்பு மின்னஞ்சல்:</span> <strong style="color: #1e40af; font-size: 13px;" id="disp_current_email">{{ $currentAdminEmail ?? 'anithar.12@gmail.com' }}</strong>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; border-top: 1px dashed #cbd5e1; padding-top: 5px;">
                                <div>
                                    <span id="lbl_cur_pass_prefix">தற்போதைய கடவுச்சொல்:</span>
                                    <strong style="color: #0f766e; font-size: 13.5px; font-family: monospace;" id="disp_current_password">{{ $currentAdminPassword ?? 'password' }}</strong>
                                </div>
                                <button type="button" onclick="toggleCurrentPasswordDisp()" id="btnCurPassEye" style="background: transparent; border: none; cursor: pointer; font-size: 15px; padding: 0 2px; line-height: 1;" title="Show/Hide">
                                    👁️
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Live Notification Alert -->
                    <div id="authAlertBox" style="display: none; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 700; margin-bottom: 18px;"></div>

                    <form id="formAdminAuthSettings" onsubmit="submitAdminAuthSettings(event)" style="max-width: 620px;">
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            <!-- Username Field -->
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;" id="lbl_new_username">
                                    புதிய பயனர் பெயர் அல்லது ID (New Username / ID) *
                                </label>
                                <input type="text" id="admin_new_username" class="input-text" value="{{ $currentAdminUsername ?? 'admin' }}" placeholder="எ.கா: admin அல்லது master_matrimony" required style="height: 44px; font-size: 14px; padding-left: 14px; padding-right: 14px; width: 100%; box-sizing: border-box;">
                                <small style="display: block; font-size: 11.5px; color: #64748b; margin-top: 4px;" id="lbl_username_help">
                                    Login செய்யும் போது இந்த ID-யை உள்ளிட வேண்டும்.
                                </small>
                            </div>

                            <!-- Admin Recovery Email Field -->
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;" id="lbl_admin_email">
                                    மீட்டெடுப்பு மின்னஞ்சல் (Admin Recovery Email) *
                                </label>
                                <input type="email" id="admin_new_email" class="input-text" value="{{ $currentAdminEmail ?? 'admin@mastermatrimony.example' }}" placeholder="எ.கா: admin@mastermatrimony.example" required style="height: 44px; font-size: 14px; padding-left: 14px; padding-right: 14px; width: 100%; box-sizing: border-box;">
                                <small style="display: block; font-size: 11.5px; color: #64748b; margin-top: 4px;" id="lbl_admin_email_help">
                                    கடவுச்சொல் அல்லது ID மறந்துவிட்டால் OTP பெற இந்த மின்னஞ்சல் பயன்படும்.
                                </small>
                            </div>

                            <!-- New Password Field -->
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;" id="lbl_new_password">
                                    புதிய கடவுச்சொல் (New Password)
                                </label>
                                <div style="position: relative; display: flex; align-items: center; width: 100%;">
                                    <input type="password" id="admin_new_password" class="input-text" placeholder="கடவுச்சொல் மாற்ற வேண்டுமெனில் மட்டும் உள்ளிடவும் (குறைந்தது 4 எழுத்துகள்)" style="height: 44px; font-size: 14px; padding-left: 14px; padding-right: 44px; width: 100%; box-sizing: border-box;">
                                    <button type="button" onclick="togglePasswordVis('admin_new_password', this)" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; color: #64748b; font-size: 16px; padding: 4px;" title="Show/Hide">
                                        👁️
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm New Password Field -->
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;" id="lbl_confirm_password">
                                    புதிய கடவுச்சொல்லை உறுதி செய்க (Confirm New Password)
                                </label>
                                <div style="position: relative; display: flex; align-items: center; width: 100%;">
                                    <input type="password" id="admin_confirm_password" class="input-text" placeholder="புதிய கடவுச்சொல்லை மீண்டும் உள்ளிடவும்" style="height: 44px; font-size: 14px; padding-left: 14px; padding-right: 44px; width: 100%; box-sizing: border-box;">
                                    <button type="button" onclick="togglePasswordVis('admin_confirm_password', this)" style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; color: #64748b; font-size: 16px; padding: 4px;" title="Show/Hide">
                                        👁️
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center; margin-top: 8px;">
                                <button type="submit" id="btnSaveAdminAuth" class="btn" style="background: #881337; color: #ffffff; height: 42px; padding: 0 22px; font-size: 13.5px; font-weight: 800; border-radius: 8px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(136, 19, 55, 0.3); transition: all 0.2s;">
                                    <span>💾</span> <span id="btn_save_auth_txt">மாற்றங்களை சேமிக்கவும் (Save Changes)</span>
                                </button>
                                <button type="button" onclick="resetDefaultAdminAuth()" class="btn" style="background: #f1f5f9; color: #475569; height: 42px; padding: 0 16px; font-size: 13px; font-weight: 700; border-radius: 8px; border: 1.5px solid #cbd5e1; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;">
                                    <span>🔄</span> <span id="btn_reset_auth_txt">இயல்புநிலைக்கு மாற்றுக (Reset Default)</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Security Guidance Note -->
                    <div style="margin-top: 22px; background: #fffbeb; border: 1px dashed #f59e0b; border-radius: 10px; padding: 12px 16px; font-size: 12.5px; color: #92400e; line-height: 1.45;">
                        <span style="font-weight: 800;" id="lbl_auth_note_title">💡 முக்கிய குறிப்பு (Important Note):</span>
                        <span id="lbl_auth_note_body">புதிய ID மற்றும் கடவுச்சொல்லை மாற்றிய பின்னர், அடுத்த முறை Login பக்கத்தில் நுழையும் போது இந்த புதிய விபரங்களை மட்டுமே பயன்படுத்த வேண்டும்.</span>
                    </div>
                </div>

                <!-- Add New Option Card (Single Input + Voice Mic) -->
                <div id="masterAddCard" class="master-add-card" style="display: none; background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 12px; padding: 18px 22px; margin-bottom: 22px;">
                    <div style="font-weight: 800; font-size: 14.5px; color: #78350f; margin-bottom: 12px; display:flex; align-items:center; gap:8px;">
                        <span id="lbl_add_title">➕ புதிய ஆப்ஷன் சேர்க்க:</span>
                    </div>
                    <form id="formAddMasterOption" onsubmit="submitNewMasterOption(event)" style="display:flex; gap:14px; flex-wrap:wrap; align-items:flex-end;">
                        <input type="hidden" id="master_new_cat" value="community">
                        <div style="flex: 1; min-width: 260px;">
                            <label style="font-size: 13px; font-weight: 700; color: #475569; display:block; margin-bottom:6px;" id="lbl_new_option_name">ஆப்ஷன் பெயர் *</label>
                            <div class="input-with-voice" style="position: relative; display: flex; align-items: center; width: 100%;">
                                <input type="text" id="master_new_name" class="input-text" placeholder="எ.கா: வன்னியர் / முதலியார் (தட்டச்சு அல்லது மைக் மூலம் பேசவும்)" required style="height:44px; font-size:13.5px; padding-right: 46px; width: 100%;">
                                <button type="button" class="voice-mic-btn" onclick="startMic('master_new_name', this)" title="Voice Mic for Option" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%);">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="22"/></svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" id="btnMasterAdd" class="btn" style="background:#881337; color:#fff; border-color:#881337; height:44px; padding:0 24px; font-size:13.5px; font-weight:800; border-radius:8px; cursor:pointer;">
                            + சேர்க்க
                        </button>
                    </form>
                </div>

                <!-- Options List / Table -->
                <div id="masterTableCard" style="display: none; background:#fff; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                    <div style="padding:12px 18px; background:#f8fafc; border-bottom:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center; flex-wrap: wrap; gap: 10px;">
                        <span style="font-size:14px; font-weight:800; color:#0f172a;" id="lblCurrentTabList">தற்போது உள்ள பட்டியல்கள்</span>
                        <input type="text" id="masterFilterSearch" oninput="filterMasterList(this.value)" placeholder="தேடுக..." class="input-text" style="width:240px; height:36px; font-size:12.5px; padding:4px 12px;">
                    </div>
                    <div style="max-height: 440px; overflow-y:auto;">
                        <table class="master-table data-table" style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th id="th_admin_name">பெயர்</th>
                                    <th style="width:140px; text-align:right;" id="th_admin_act">செயல்கள்</th>
                                </tr>
                            </thead>
                            <tbody id="masterOptionsTableBody">
                                <!-- Populated dynamically via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Print Styles & Field Highlights Settings Card (Req 2 & 3) -->
                <div id="printStyleSettingsCard" style="display: block; background: #fff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 24px; box-shadow: 0 4px 14px rgba(0,0,0,0.05); margin-bottom: 22px;">
                    <div style="border-bottom: 1.5px solid #e2e8f0; padding-bottom: 14px; margin-bottom: 20px;">
                        <div style="font-size: 16px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                            <span>🎨</span>
                            <span id="lbl_print_style_title">அச்சுத்தாள் எழுத்து, வண்ண &amp; வடிவமைப்பு அமைப்புகள்</span>
                        </div>
                        <small style="color: #64748b; font-size: 12.5px; display: block; margin-top: 4px;" id="lbl_print_style_sub">
                            ஆண், பெண், மறுமணம் வரன்களுக்கு தனித்தனியாக இடதுபுற புலப் பெயர்கள் மற்றும் பதில்கள் வண்ணங்களை மாற்றியமைக்கலாம்.
                        </small>
                    </div>

                    <!-- 0. மேல் தலைப்பு பேனர் வடிவமைப்பு (Top Header Title Typography) -->
                      <div style="background: #fefce8; border: 1.5px solid #fde047; border-radius: 10px; padding: 16px; margin-bottom: 18px;">
                          <div style="font-weight: 800; font-size: 13.5px; color: #854d0e; margin-bottom: 6px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                              <span id="lbl_print_sec0_title">🏛️ 1. மேல் தலைப்பு பேனர் வடிவமைப்பு:</span>
                              <small style="color: #a16207; font-weight: 700; font-size: 11.5px;" id="lbl_print_sec0_badge">மாஸ்டர் மணமாலை (Master Matrimony)</small>
                          </div>
                          <p style="font-size: 12px; color: #a16207; margin: 0 0 12px 0;" id="lbl_print_sec0_desc">அச்சுத்தாளின் உச்சியில் உள்ள தலைப்புக்கான எழுத்து வடிவம், அளவு மற்றும் தடிமன் தனிப்பட்ட அமைப்புகள்:</p>
                          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 14px;">
                              <div>
                                  <label style="font-size: 12px; font-weight: 700; color: #854d0e; display: block; margin-bottom: 5px;" id="lbl_cfg_header_font_family">தலைப்பு எழுத்து வடிவம்:</label>
                                  <select id="cfg_header_title_font_family" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 38px; font-weight: 700;">
                                      <option value="'Noto Serif Tamil', 'Mukta Malar', 'Baloo Thambi 2', 'Latha', serif">Noto Serif Tamil (பாரம்பரிய தலைப்பு)</option>
                                      <option value="'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif">Mukta Malar (நவீன எழுத்து)</option>
                                      <option value="'Baloo Thambi 2', 'Mukta Malar', Arial, sans-serif">Baloo Thambi 2 (தடித்த எழுத்து)</option>
                                      <option value="Arial, sans-serif">Arial / Standard</option>
                                  </select>
                              </div>
                              <div>
                                  <label style="font-size: 12px; font-weight: 700; color: #854d0e; display: block; margin-bottom: 5px;" id="lbl_cfg_header_font_size">தலைப்பு எழுத்து அளவு:</label>
                                  <select id="cfg_header_title_font_size" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 38px; font-weight: 700;">
                                      <option value="17px">17px</option>
                                      <option value="18px">18px</option>
                                      <option value="18.5px">18.5px</option>
                                      <option value="19px">19px</option>
                                      <option value="19.5px" selected>19.5px (பரிந்துரைக்கப்பட்டது / இயல்பு)</option>
                                      <option value="20px">20px</option>
                                      <option value="21px">21px</option>
                                      <option value="22px">22px</option>
                                  </select>
                              </div>
                              <div>
                                  <label style="font-size: 12px; font-weight: 700; color: #854d0e; display: block; margin-bottom: 5px;" id="lbl_cfg_header_font_weight">தலைப்பு எழுத்து தடிமன்:</label>
                                  <select id="cfg_header_title_font_weight" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 38px; font-weight: 700;">
                                      <option value="700">700 - Bold</option>
                                      <option value="800">800 - Extra Bold</option>
                                      <option value="900" selected>900 - Black (அடர்த்தியான தடிமன்)</option>
                                  </select>
                              </div>
                          </div>
                      </div>


                    <!-- 2. இடதுபுற புலப் பெயர்கள் வண்ண & எழுத்து அமைப்புகள் (Field Label Settings) -->
                    <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 10px; padding: 16px; margin-bottom: 18px;">
                        <div style="font-weight: 800; font-size: 13.5px; color: #14532d; margin-bottom: 6px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                            <span id="lbl_print_sec2_title">🏷️ 2. இடதுபுற புலப் பெயர்கள்:</span>
                            <small style="color: #15803d; font-weight: 700; font-size: 11.5px;" id="lbl_print_sec2_badge">ஆண் = பச்சை, பெண் = பிங்க், மறுமணம் = நீலம்</small>
                        </div>
                        <p style="font-size: 12px; color: #166534; margin: 0 0 12px 0;" id="lbl_print_sec2_desc">அச்சுத்தாளில் இடதுபுறம் உள்ள தலைப்புகளுக்கு மட்டும் தனித்தனி வண்ணங்கள்:</p>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
                            <!-- Male Label Color -->
                            <div style="background: #fff; border: 1.5px solid #bbf7d0; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #14532d; display: block; margin-bottom: 4px;" id="lbl_male_label_color">🤵 ஆண் வரன் புலப் பெயர் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_male_label_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_male_label_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_male_label_color" value="#14532d" onchange="onColorPickerChange('cfg_male_label_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Female Label Color -->
                            <div style="background: #fff; border: 1.5px solid #fbcfe8; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #881337; display: block; margin-bottom: 4px;" id="lbl_female_label_color">👰 பெண் வரன் புலப் பெயர் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_female_label_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_female_label_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_female_label_color" value="#881337" onchange="onColorPickerChange('cfg_female_label_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Remarriage Label Color -->
                            <div style="background: #fff; border: 1.5px solid #bae6fd; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #0369a1; display: block; margin-bottom: 4px;" id="lbl_remarriage_label_color">💍 மறுமணம் வரன் புலப் பெயர் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_remarriage_label_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_remarriage_label_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_remarriage_label_color" value="#0369a1" onchange="onColorPickerChange('cfg_remarriage_label_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>
                        </div>

                        <!-- Label Font & Size Controls -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-top: 12px;">
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #166534; display: block; margin-bottom: 3px;" id="lbl_label_font_family">புலப் பெயர் எழுத்து வடிவம்:</label>
                                <select id="cfg_label_font_family" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #166534; display: block; margin-bottom: 3px;" id="lbl_label_font_size">புலப் பெயர் எழுத்து அளவு:</label>
                                <select id="cfg_label_font_size" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #166534; display: block; margin-bottom: 3px;" id="lbl_label_font_weight">புலப் பெயர் தடிமன்:</label>
                                <select id="cfg_label_font_weight" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                        </div>
                    </div>

                    <!-- 3. புல பதில்கள் வண்ண & எழுத்து அமைப்புகள் (Field Answer / Value Settings) -->
                    <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 18px;">
                        <div style="font-weight: 800; font-size: 13.5px; color: #0f172a; margin-bottom: 6px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                            <span id="lbl_print_sec3_title">📝 3. புல பதில்கள்:</span>
                            <small style="color: #475569; font-weight: 700; font-size: 11.5px;" id="lbl_print_sec3_badge">ஆண் / பெண் / மறுமணம் பதில்களுக்கு தனித்தனி நிறம்</small>
                        </div>
                        <p style="font-size: 12px; color: #475569; margin: 0 0 12px 0;" id="lbl_print_sec3_desc">அச்சுத்தாளில் நிரப்பப்படும் பதில்களின் வண்ணங்கள் மற்றும் எழுத்து அமைப்புகள்:</p>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
                            <!-- Male Answer Color -->
                            <div style="background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #14532d; display: block; margin-bottom: 4px;" id="lbl_male_answer_color">🤵 ஆண் வரன் பதில் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_male_answer_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_male_answer_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_male_answer_color" value="#000000" onchange="onColorPickerChange('cfg_male_answer_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Female Answer Color -->
                            <div style="background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #881337; display: block; margin-bottom: 4px;" id="lbl_female_answer_color">👰 பெண் வரன் பதில் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_female_answer_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_female_answer_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_female_answer_color" value="#000000" onchange="onColorPickerChange('cfg_female_answer_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Remarriage Answer Color -->
                            <div style="background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                                <label style="font-size: 12px; font-weight: 800; color: #0369a1; display: block; margin-bottom: 4px;" id="lbl_remarriage_answer_color">💍 மறுமணம் பதில் நிறம்:</label>
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    <select id="cfg_remarriage_answer_color_sel" class="input-text input-select" onchange="onColorPresetChange('cfg_remarriage_answer_color', this.value)" style="height: 36px; font-weight: 700; flex: 1; font-size: 12px;"></select>
                                    <input type="color" id="cfg_remarriage_answer_color" value="#000000" onchange="onColorPickerChange('cfg_remarriage_answer_color_sel', this.value)" style="width: 36px; height: 36px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                </div>
                            </div>
                        </div>

                        <!-- Answer Font & Size Controls -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-top: 12px;">
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;" id="lbl_answer_font_family">பதில் எழுத்து வடிவம்:</label>
                                <select id="cfg_answer_font_family" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;" id="lbl_answer_font_size">பதில் எழுத்து அளவு:</label>
                                <select id="cfg_answer_font_size" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                            <div>
                                <label style="font-size: 11.5px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;" id="lbl_answer_font_weight">பதில் தடிமன்:</label>
                                <select id="cfg_answer_font_weight" class="input-text input-select" onchange="updatePrintStylePreview()" style="height: 36px; font-size: 12px;"></select>
                            </div>
                        </div>
                    </div>

                    <!-- 4. நேரடி மாதிரி முன்னோட்டம் (Live Sample Preview with 1-Click Gender Switcher) -->
                    <div style="background: #fff; border: 1.5px dashed #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
                            <div style="font-size: 12.5px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;" id="lbl_live_preview_title">
                                ✨ 4. நேரடி மாதிரி முன்னோட்டம்:
                            </div>
                            <div style="display: flex; gap: 6px; align-items: center;">
                                <span style="font-size: 12px; font-weight: 700; color: #64748b; margin-right: 4px;" id="lbl_live_preview_gender">வரன் வகை:</span>
                                <button type="button" id="prev_btn_male" onclick="switchPreviewGender('aan')" style="background: #14532d; color: #fff; border: none; border-radius: 6px; padding: 4px 10px; font-size: 12px; font-weight: 800; cursor: pointer;">🤵 ஆண்</button>
                                <button type="button" id="prev_btn_female" onclick="switchPreviewGender('penn')" style="background: #f1f5f9; color: #64748b; border: 1px solid #cbd5e1; border-radius: 6px; padding: 4px 10px; font-size: 12px; font-weight: 800; cursor: pointer;">👰 பெண்</button>
                                <button type="button" id="prev_btn_remarriage" onclick="switchPreviewGender('marumanam')" style="background: #f1f5f9; color: #64748b; border: 1px solid #cbd5e1; border-radius: 6px; padding: 4px 10px; font-size: 12px; font-weight: 800; cursor: pointer;">💍 மறுமணம்</button>
                            </div>
                        </div>

                        <div id="printStyleLivePreview" style="padding: 14px 18px; background: #fafaf9; border: 1.5px solid #14532d; border-radius: 8px; transition: all 0.2s;">
                            <div style="display: flex; gap: 16px; border-bottom: 1px dotted #94a3b8; padding: 6px 0;" class="preview-row" id="prev_row_name">
                                <span style="width: 150px;" class="preview-lbl" id="prev_lbl_name">வரன் பெயர்:</span>
                                <span class="preview-val" id="prev_val_name">சரவணகுமார் M</span>
                            </div>
                            <div style="display: flex; gap: 16px; border-bottom: 1px dotted #94a3b8; padding: 6px 0;" class="preview-row" id="prev_row_dob">
                                <span style="width: 150px;" class="preview-lbl" id="prev_lbl_dob">பிறந்த தேதி:</span>
                                <span class="preview-val" id="prev_val_dob">20-05-1998</span>
                            </div>
                            <div style="display: flex; gap: 16px; border-bottom: 1px dotted #94a3b8; padding: 6px 0;" class="preview-row" id="prev_row_edu">
                                <span style="width: 150px;" class="preview-lbl" id="prev_lbl_edu">வரனின் படிப்பு:</span>
                                <span class="preview-val" id="prev_val_edu">M.E / M.Tech</span>
                            </div>
                            <div style="display: flex; gap: 16px; padding: 6px 0;" class="preview-row" id="prev_row_job">
                                <span style="width: 150px;" class="preview-lbl" id="prev_lbl_job">மாத வருமானம்:</span>
                                <span class="preview-val" id="prev_val_job">ரூ. 1,25,000 / மாதம்</span>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Row -->
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <button type="button" onclick="savePrintStyleSettings()" class="btn" id="btn_save_print_style" style="background: #15803d; color: #fff; height: 42px; padding: 0 24px; font-weight: 800; font-size: 13.5px; border-radius: 8px; border: none; cursor: pointer;">
                            💾 அமைப்புகளை சேமிக்க
                        </button>
                        <button type="button" onclick="resetPrintStyleSettingsToDefault()" class="btn" id="btn_reset_print_style" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; height: 42px; padding: 0 18px; font-weight: 700; font-size: 13px; border-radius: 8px; cursor: pointer;">
                            ↺ இயல்புநிலைக்கு மீட்டமைக்க
                        </button>
                        <span id="printStyleSaveMsg" style="color: #15803d; font-weight: 800; font-size: 13.5px; display: none;">
                            ✓ அச்சுத்தாள் வடிவமைப்பு அமைப்புகள் வெற்றிகரமாக சேமிக்கப்பட்டன!
                        </span>
                    </div>
                </div>

                <div id="masterFooterCard" style="margin-top: 16px; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <span style="font-size: 12.5px; color: #64748b;" id="lbl_admin_footer_hint">💡 ஆப்ஷன்களை உள்ளிட்ட உடனே படிவத்தின் Dropdown-களில் மாற்றங்கள் தானாக புதுப்பிக்கப்படும்.</span>
                    <button type="button" onclick="selectTab(1)" class="btn-action-icon btn-view" style="padding: 6px 16px; font-size: 13px;">
                        ← <span id="adminBackBtnTxt2">படிவத்திற்கு திரும்பு</span>
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Interactive Profile View Modal (With Bride / Groom Emojis) -->
    <div id="quickViewModal" class="modal-overlay" onclick="closeModal()">
        <div class="modal-body-box" onclick="event.stopPropagation()">
            <div class="modal-top-bar">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:10px; height:10px; border-radius:50%; background:#22c55e;"></div>
                    <h3 id="modalName" style="font-size: 18px; font-weight: 800; color:#fff;">வரன் முழு விபரம்</h3>
                </div>
                <button type="button" onclick="closeModal()" style="background:none; border:none; color:#cbd5e1; font-size:24px; cursor:pointer; line-height:1;">&times;</button>
            </div>
            <div class="modal-content-scroll" id="modalDetails">
                <!-- Dynamically populated via JS -->
            </div>
            <div style="padding: 14px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <button type="button" id="modalBtnEdit" onclick="editCurrentModalProfile()" class="btn-action-icon btn-edit" style="padding: 9px 18px; font-size: 13.5px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    <span id="modalTxtEdit">படிவத்தில் திருத்து</span>
                </button>
                <div style="display: flex; gap: 10px;">
                    <button type="button" onclick="closeModal()" class="btn-action-icon" style="background:#fff; border-color:#cbd5e1; color:#475569;" id="modalBtnClose">மூடுக</button>
                    <a id="modalPrintLink" href="#" target="_blank" class="btn-action-icon btn-print" style="padding: 9px 18px; font-size: 13.5px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                        <span id="modalTxtPrint">மஞ்சள் அட்டை அச்சு</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Photo Upload & Interactive Passport Cropper Modal (Matching Reference Mockup) -->
    <div id="documentPhotoCropModal" class="modal-overlay" style="display:none; align-items:center; justify-content:center; z-index:100050; padding:16px;">
        <div class="modal-body-box" style="max-width:520px; background:#ffffff; border-radius:18px; box-shadow:0 25px 60px rgba(0,0,0,0.35); overflow:hidden; border:1px solid #e2e8f0; animation:modalPop 0.25s ease-out;">
            <!-- Header matching Image 2 mockup -->
            <div style="background:#ffffff; padding:20px 24px 14px; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h3 style="font-size:20px; font-weight:800; color:#0f172a; margin:0; letter-spacing:-0.3px;">Document Photo Upload</h3>
                    <p style="margin:4px 0 0; font-size:12.5px; color:#64748b; font-weight:500;">Adjust & frame photo to passport size (35 × 45 mm)</p>
                </div>
                <button type="button" onclick="closePhotoCropModal(false)" style="background:#f1f5f9; border:none; color:#64748b; width:34px; height:34px; border-radius:50%; font-size:22px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s; line-height:1;" onmouseover="this.style.background='#e2e8f0';this.style.color='#0f172a'" onmouseout="this.style.background='#f1f5f9';this.style.color='#64748b'">&times;</button>
            </div>

            <!-- Cropper Canvas Workspace -->
            <div style="padding:18px 24px 12px; display:flex; flex-direction:column; align-items:center;">
                <!-- Dashed container matching Image 2 reference -->
                <div id="cropCanvasWrapper" style="position:relative; width:100%; max-width:440px; height:350px; background:#0f172a; border:2px dashed #94a3b8; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center; cursor:grab; box-shadow:inset 0 2px 10px rgba(0,0,0,0.4); user-select:none; touch-action:none;">
                    <canvas id="cropCanvas" width="440" height="350" style="display:block; width:100%; height:100%;"></canvas>
                    <div style="position:absolute; top:12px; left:12px; background:rgba(15,23,42,0.8); backdrop-filter:blur(4px); color:#f8fafc; font-size:11.5px; padding:3px 10px; border-radius:6px; font-weight:600; pointer-events:none; border:1px solid rgba(255,255,255,0.15);">
                        📐 Passport Frame (35 × 45 mm)
                    </div>
                </div>

                <!-- Interactive Zoom & Rotate Toolbar -->
                <div style="width:100%; max-width:440px; margin-top:14px; display:flex; align-items:center; justify-content:space-between; gap:10px; background:#f8fafc; padding:8px 14px; border-radius:10px; border:1px solid #e2e8f0;">
                    <div style="display:flex; align-items:center; gap:8px; flex-grow:1;">
                        <span style="font-size:12.5px; color:#475569; font-weight:700;">🔍 Zoom:</span>
                        <button type="button" onclick="adjustCropZoom(-0.1)" style="border:1px solid #cbd5e1; background:#fff; border-radius:6px; width:26px; height:26px; cursor:pointer; font-weight:800; color:#334155; display:flex; align-items:center; justify-content:center; font-size:14px;">−</button>
                        <input type="range" id="cropZoomSlider" min="0.3" max="3" step="0.01" value="1" oninput="onCropZoomSlider(this.value)" style="flex-grow:1; accent-color:#2563eb; cursor:pointer; height:6px;">
                        <button type="button" onclick="adjustCropZoom(0.1)" style="border:1px solid #cbd5e1; background:#fff; border-radius:6px; width:26px; height:26px; cursor:pointer; font-weight:800; color:#334155; display:flex; align-items:center; justify-content:center; font-size:14px;">+</button>
                    </div>
                    <div style="display:flex; align-items:center; gap:6px;">
                        <button type="button" onclick="rotateCropImage()" title="Rotate 90° clockwise" style="border:1px solid #cbd5e1; background:#fff; border-radius:6px; padding:4px 9px; cursor:pointer; font-size:12px; font-weight:600; color:#334155; display:flex; align-items:center; gap:4px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
                            Rotate
                        </button>
                        <button type="button" onclick="resetCropTransform()" title="Reset photo to fit" style="border:1px solid #cbd5e1; background:#fff; border-radius:6px; padding:4px 9px; cursor:pointer; font-size:12px; font-weight:600; color:#334155;">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Helper Hint -->
                <p style="margin:8px 0 0; font-size:12px; color:#64748b; text-align:center;">
                    👆 Drag photo to align face • Scroll or slider to zoom in/out
                </p>
            </div>

            <!-- Footer Action Buttons matching Image 2 reference -->
            <div style="padding:14px 24px 20px; background:#ffffff; border-top:1px solid #f1f5f9; display:flex; justify-content:center; align-items:center; gap:12px;">
                <button type="button" onclick="closePhotoCropModal(false)" style="padding:10px 22px; font-size:14px; font-weight:600; color:#64748b; background:#f8fafc; border:1px solid #cbd5e1; border-radius:8px; cursor:pointer; transition:all 0.15s;" onmouseover="this.style.background='#f1f5f9';this.style.color='#334155'" onmouseout="this.style.background='#f8fafc';this.style.color='#64748b'">
                    Cancel
                </button>
                <button type="button" id="btnApplyPhotoCrop" onclick="applyPhotoCrop()" style="padding:11px 48px; font-size:15px; font-weight:800; color:#ffffff; background:#2563eb; border:none; border-radius:8px; cursor:pointer; box-shadow:0 4px 14px rgba(37,99,235,0.38); letter-spacing:0.4px; transition:all 0.15s;" onmouseover="this.style.background='#1d4ed8';this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#2563eb';this.style.transform='none'">
                    OK / UPLOAD
                </button>
            </div>
        </div>
    </div>

    <!-- Application Javascript Logic -->
    <script>
        let appLang = 'ta';
        let currentGender = 'penn';
        let targetChartCell = null;
        let activeModalId = null;
        let activeRecognition = null;
        let activeMicButton = null;

        // Safe JSON Data Cache from Laravel Eloquent
        const rawProfilesData = @json($varans->keyBy('id'));

        // Master Dropdown Options Admin State & Handlers
        let currentMasterTab = 'print_style_settings';
        let adminLang = 'ta';
        let masterOptionsData = { community: [], education: [], job: [] };

        let masterTabVisibility = {
            community: false,
            education: false,
            job: false,
            auth_settings: false
        };

        function initMasterTabVisibility() {
            try {
                const saved = localStorage.getItem('matrimony_admin_tab_visibility');
                if (saved) {
                    masterTabVisibility = Object.assign(masterTabVisibility, JSON.parse(saved));
                }
            } catch (e) {
                console.warn('Error loading tab visibility:', e);
            }
            applyAdminTabVisibility();
        }

        function toggleMasterTabVisibility(cat, isVisible) {
            masterTabVisibility[cat] = !!isVisible;
            try {
                localStorage.setItem('matrimony_admin_tab_visibility', JSON.stringify(masterTabVisibility));
            } catch (e) {}
            applyAdminTabVisibility();

            if (!isVisible && currentMasterTab === cat) {
                switchMasterTab('print_style_settings');
            } else if (isVisible) {
                switchMasterTab(cat);
            }
        }

        function applyAdminTabVisibility() {
            const tabs = ['community', 'education', 'job', 'auth_settings'];
            const btnMap = {
                community: { show: 'btnVisCommShow', hide: 'btnVisCommHide', tab: 'mtab_comm' },
                education: { show: 'btnVisEduShow', hide: 'btnVisEduHide', tab: 'mtab_edu' },
                job: { show: 'btnVisJobShow', hide: 'btnVisJobHide', tab: 'mtab_job' },
                auth_settings: { show: 'btnVisAuthShow', hide: 'btnVisAuthHide', tab: 'mtab_auth_settings' }
            };

            tabs.forEach(cat => {
                const isVis = !!masterTabVisibility[cat];
                const cfg = btnMap[cat];
                const tabEl = document.getElementById(cfg.tab);
                const btnShow = document.getElementById(cfg.show);
                const btnHide = document.getElementById(cfg.hide);

                if (tabEl) {
                    tabEl.style.display = isVis ? 'inline-block' : 'none';
                }

                if (btnShow) {
                    btnShow.style.background = isVis ? '#16a34a' : 'transparent';
                    btnShow.style.color = isVis ? '#ffffff' : '#64748b';
                }
                if (btnHide) {
                    btnHide.style.background = !isVis ? '#dc2626' : 'transparent';
                    btnHide.style.color = !isVis ? '#ffffff' : '#64748b';
                }
            });
        }
    

        function openMasterModal() {
            selectTab(3);
        }

        function closeMasterModal() {
            selectTab(1);
        }

        // Global Photo Print Setting (HR Requirement - Centralized in Admin Panel)
        function setAdminPhotoPrintSetting(val) {
            try {
                localStorage.setItem('matrimony_admin_show_photo', val);
            } catch (e) {}
            updateAdminPhotoSettingUI(val);
            const hid = document.getElementById('show_photo_on_print');
            if (hid) hid.value = val;

            // Persist setting to server so print page and language toggles strictly obey
            try {
                const csrf = document.querySelector('input[name="_token"]')?.value || '';
                fetch('/matrimony/photo-setting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ show_photo: val, _token: csrf })
                }).catch(err => console.warn('Photo setting sync notice:', err));
            } catch(e) {}

            showScanToast(val === '1' ? '✅ அச்சுத்தாளில் படம் காட்டப்படும் (Photo ON)' : '⏹️ அச்சுத்தாளில் வெற்று இடம் வைக்கப்படும் (Photo OFF - Empty Space)');
        }

        function updateAdminPhotoSettingUI(val) {
            const btnYes = document.getElementById('btnAdminPhotoYes');
            const btnNo = document.getElementById('btnAdminPhotoNo');
            if (!btnYes || !btnNo) return;
            if (val === '0') {
                btnNo.style.background = '#881337';
                btnNo.style.color = '#ffffff';
                btnNo.style.boxShadow = '0 2px 6px rgba(136, 19, 55, 0.3)';
                btnYes.style.background = 'transparent';
                btnYes.style.color = '#475569';
                btnYes.style.boxShadow = 'none';
            } else {
                btnYes.style.background = '#15803d';
                btnYes.style.color = '#ffffff';
                btnYes.style.boxShadow = '0 2px 6px rgba(21, 128, 61, 0.3)';
                btnNo.style.background = 'transparent';
                btnNo.style.color = '#475569';
                btnNo.style.boxShadow = 'none';
            }
        }


        // ========================================================
        // Intelligent Date of Birth Speech Parser & Dictation
        // ========================================================
        function parseSpokenDate(transcript) {
            if (!transcript) return null;
            let text = transcript.trim().toLowerCase();

            // Clean filler words (Tamil & English)
            text = text.replace(/(?:ஆம்\s*தேதி|ஆம்\s*நாள்|தேதி|மாதம்|மாசம்|வருடம்|வருஷம்|ஆண்டு|பிறந்த\s*தேதி)/g, ' ');
            text = text.replace(/(\d+)(st|nd|rd|th)\b/gi, '$1');

            const months = {
                'january': 1, 'jan': 1, 'ஜனவரி': 1,
                'february': 2, 'feb': 2, 'பிப்ரவரி': 2,
                'march': 3, 'mar': 3, 'மார்ச்': 3,
                'april': 4, 'apr': 4, 'ஏப்ரல்': 4,
                'may': 5, 'மே': 5,
                'june': 6, 'jun': 6, 'ஜூன்': 6,
                'july': 7, 'jul': 7, 'ஜூலை': 7,
                'august': 8, 'aug': 8, 'ஆகஸ்ட்': 8,
                'september': 9, 'sep': 9, 'sept': 9, 'செப்டம்பர்': 9,
                'october': 10, 'oct': 10, 'அக்டோபர்': 10,
                'november': 11, 'nov': 11, 'நவம்பர்': 11,
                'december': 12, 'dec': 12, 'டிசம்பர்': 12
            };

            const tamilNumbers = {
                'ஒன்று': '1', 'இரண்டு': '2', 'மூன்று': '3', 'நான்கு': '4', 'ஐந்து': '5',
                'ஆறு': '6', 'ஏழு': '7', 'எட்டு': '8', 'ஒன்பது': '9', 'பத்து': '10',
                'பதினொன்று': '11', 'பன்னிரண்டு': '12', 'பதின்மூன்று': '13', 'பதினான்கு': '14', 'பதினைந்து': '15',
                'பதினாறு': '16', 'பதினேழு': '17', 'பதினெட்டு': '18', 'பத்தொன்பது': '19', 'இருபது': '20',
                'இருபத்தொன்று': '21', 'இருபத்திரண்டு': '22', 'இருபத்திமூன்று': '23', 'இருபத்திநான்கு': '24', 'இருபத்தைந்து': '25',
                'இருபத்தாறு': '26', 'இருபத்தேழு': '27', 'இருபத்தெட்டு': '28', 'இருபத்தொன்பது': '29', 'முப்பது': '30',
                'முப்பத்தொன்று': '31'
            };

            for (const [k, v] of Object.entries(tamilNumbers)) {
                text = text.replaceAll(k, v);
            }

            text = text.replace(/[,/–\-.]/g, ' ');
            const tokens = text.split(/\s+/).filter(Boolean);

            let day = null, month = null, year = null;

            // 1. Search for 4-digit year (1900 - 2099)
            for (let i = 0; i < tokens.length; i++) {
                if (/^(19\d\d|20[0-2]\d)$/.test(tokens[i])) {
                    year = parseInt(tokens[i], 10);
                    tokens.splice(i, 1);
                    break;
                }
            }

            // 2. Search for named month
            for (let i = 0; i < tokens.length; i++) {
                const t = tokens[i];
                if (months[t] !== undefined) {
                    month = months[t];
                    tokens.splice(i, 1);
                    break;
                }
            }

            // 3. Process remaining tokens as numbers
            const nums = tokens.map(t => parseInt(t, 10)).filter(n => !isNaN(n));

            // If month is named and we have remaining numbers
            if (month !== null) {
                if (!year && nums.length >= 2) {
                    if (nums[0] > 31 && nums[1] <= 31) {
                        year = nums[0]; day = nums[1];
                    } else {
                        day = nums[0]; year = nums[1];
                    }
                } else if (nums.length >= 1) {
                    day = nums[0];
                    if (!year && nums.length >= 2) {
                        year = nums[1];
                    }
                }
            } else {
                // Month not named: we have numbers only (e.g. 15 5 1995 or 15 5 95 or 15 5)
                if (year !== null) {
                    if (nums.length >= 2) {
                        if (nums[0] > 12 && nums[1] <= 12) {
                            day = nums[0]; month = nums[1];
                        } else if (nums[1] > 12 && nums[0] <= 12) {
                            day = nums[1]; month = nums[0];
                        } else {
                            day = nums[0]; month = nums[1];
                        }
                    } else if (nums.length === 1) {
                        day = nums[0];
                    }
                } else {
                    if (nums.length >= 3) {
                        let y = nums[2];
                        if (nums[0] > 1000) {
                            year = nums[0]; month = nums[1]; day = nums[2];
                        } else {
                            if (y < 100) y = (y > 30) ? 1900 + y : 2000 + y;
                            year = y;
                            if (nums[0] > 12 && nums[1] <= 12) {
                                day = nums[0]; month = nums[1];
                            } else if (nums[1] > 12 && nums[0] <= 12) {
                                day = nums[1]; month = nums[0];
                            } else {
                                day = nums[0]; month = nums[1];
                            }
                        }
                    } else if (nums.length === 2) {
                        if (nums[0] > 12 && nums[1] <= 12) {
                            day = nums[0]; month = nums[1];
                        } else if (nums[1] > 12 && nums[0] <= 12) {
                            day = nums[1]; month = nums[0];
                        } else {
                            day = nums[0]; month = nums[1];
                        }
                    } else if (nums.length === 1) {
                        day = nums[0];
                    }
                }
            }

            // Expand 2-digit year if present
            if (year !== null && year < 100) {
                year = (year > 30) ? 1900 + year : 2000 + year;
            }

            // Check day out of range (> 31 or < 1)
            if (day !== null && (day < 1 || day > 31)) {
                return { isInvalid: true, day: day, month: month || 0, year: year, maxDays: 31, reason: 'day_out_of_range' };
            }

            // Check specific month day count if month is known
            if (month !== null) {
                if (month < 1 || month > 12) {
                    return { isInvalid: true, day: day, month: month, year: year, maxDays: 0, reason: 'invalid_month' };
                }
                let isLeap = true;
                if (year !== null) {
                    isLeap = (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0));
                }
                const maxDaysInMonth = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                if (day !== null && day > maxDaysInMonth[month]) {
                    return { isInvalid: true, day: day, month: month, year: year, maxDays: maxDaysInMonth[month], reason: 'day_exceeds_month' };
                }
            }

            // Check if year is missing
            if (!year) {
                return { isIncomplete: true, reason: 'missing_year', day: day, month: month };
            }

            if (day && month && year) {
                const dStr = String(day).padStart(2, '0');
                const mStr = String(month).padStart(2, '0');
                const yStr = String(year);
                return `${yStr}-${mStr}-${dStr}`;
            }

            return null;
        }

        function startDobMic(btnEl) {
            const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
            const toast = document.getElementById('voiceAlertToast');
            const toastMsg = document.getElementById('voiceToastMessage');
            const targetInput = document.getElementById('dob');

            if (!SpeechRec) {
                alert('குரல் உள்ளீடு வசதி இல்லை (Voice recognition is not supported in this browser. Please use Google Chrome).');
                return;
            }

            let dobSilenceTimer = null;
            let latestDobTranscript = '';
            let isUserEndingDob = false;

            if (activeRecognition) {
                isUserEndingDob = true;
                if (dobSilenceTimer) clearTimeout(dobSilenceTimer);
                try { activeRecognition.stop(); } catch (e) {}
                activeRecognition = null;
                if (activeMicBtn) {
                    activeMicBtn.classList.remove('is-active-recording');
                    activeMicBtn = null;
                }
                if (toast) toast.style.display = 'none';
                return;
            }

            const recognition = new SpeechRec();
            // Continuous listening with real-time interim results so dates are not cut off
            recognition.continuous = true;
            recognition.interimResults = true;
            if ('maxAlternatives' in recognition) recognition.maxAlternatives = 5;
            recognition.lang = (appLang === 'en') ? 'en-IN' : 'ta-IN';

            activeRecognition = recognition;
            activeMicBtn = btnEl;
            latestDobTranscript = '';
            isUserEndingDob = false;

            if (btnEl) btnEl.classList.add('is-active-recording');
            if (toast) {
                if (toastMsg) {
                    toastMsg.innerText = (appLang === 'en')
                        ? '🎙️ Listening for Date of Birth... Speak e.g. 15 May 1995 or 15-05-1995'
                        : '🎙️ பிறந்த தேதி கேட்கிறது... எ.கா: 15 மே 1995 அல்லது 15-05-1995 என பேசவும்...';
                }
                toast.style.display = 'flex';
            }

            function processDobTranscript(transcript) {
                const dobErrEl = document.getElementById('dob_error_msg');
                const parsed = parseSpokenDate(transcript);
                if (parsed && typeof parsed === 'object' && parsed.isInvalid) {
                    const errMsg = (appLang === 'ta')
                        ? `⚠️ தவறான பிறந்த தேதி! "${transcript}" - ${parsed.month ? parsed.month + '-வது மாதத்தில்' : ''} ${parsed.day} தேதி கிடையாது (அதிகபட்சம் ${parsed.maxDays || 31} நாட்கள் மட்டுமே).`
                        : `⚠️ Invalid Date! "${transcript}" - Day ${parsed.day} is not valid in this month (max ${parsed.maxDays || 31} days).`;
                    if (dobErrEl) {
                        dobErrEl.innerText = errMsg;
                        dobErrEl.style.display = 'block';
                    }
                    if (targetInput) targetInput.style.borderColor = '#dc2626';
                    if (toastMsg) toastMsg.innerText = errMsg;
                    return;
                }

                if (parsed && typeof parsed === 'object' && parsed.isIncomplete) {
                    const missMsg = (appLang === 'ta')
                        ? `⚠️ பிறந்த வருடம் விடுபட்டுள்ளது! "${transcript}" - பிறந்த வருடத்தையும் சேர்த்து கூறவும் (எ.கா: 15 மே 1995 அல்லது 15-05-1995).`
                        : `⚠️ Year is missing! "${transcript}" - Please speak day, month and year (e.g. 15 May 1995).`;
                    if (dobErrEl) {
                        dobErrEl.innerText = missMsg;
                        dobErrEl.style.display = 'block';
                    }
                    if (targetInput) targetInput.style.borderColor = '#dc2626';
                    if (toastMsg) toastMsg.innerText = missMsg;
                    return;
                }

                if (parsed && typeof parsed === 'string' && targetInput) {
                    if (dobErrEl) dobErrEl.style.display = 'none';
                    targetInput.style.borderColor = '';
                    targetInput.value = parsed;
                    targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                    targetInput.dispatchEvent(new Event('change', { bubbles: true }));
                    if (toastMsg) {
                        toastMsg.innerText = `✓ பதிவு செய்யப்பட்டது: ${parsed}`;
                    }
                } else {
                    const failMsg = (appLang === 'ta')
                        ? `⚠️ தேதியை புரிந்து கொள்ள முடியவில்லை: "${transcript}". தயவுசெய்து 15-05-1995 அல்லது 15 மே 1995 என தெளிவாக பேசவும்.`
                        : `⚠️ Could not parse date: "${transcript}". Please speak clearly e.g. 15-05-1995.`;
                    if (dobErrEl) {
                        dobErrEl.innerText = failMsg;
                        dobErrEl.style.display = 'block';
                    }
                    if (targetInput) targetInput.style.borderColor = '#dc2626';
                    if (toastMsg) toastMsg.innerText = failMsg;
                }
            }

            const finalizeDob = function() {
                isUserEndingDob = true;
                if (dobSilenceTimer) clearTimeout(dobSilenceTimer);
                if (latestDobTranscript && latestDobTranscript.trim()) {
                    processDobTranscript(latestDobTranscript.trim());
                }
                try { recognition.stop(); } catch (e) {}
            };

            recognition.onresult = function(event) {
                let fullTranscript = '';
                for (let i = 0; i < event.results.length; i++) {
                    if (event.results[i] && event.results[i][0]) {
                        fullTranscript += ' ' + event.results[i][0].transcript;
                    }
                }
                fullTranscript = fullTranscript.trim();
                if (fullTranscript) {
                    latestDobTranscript = fullTranscript;
                    if (toastMsg) {
                        toastMsg.innerText = `🎙️ கேட்கிறது: ${fullTranscript}`;
                    }
                    if (dobSilenceTimer) clearTimeout(dobSilenceTimer);
                    dobSilenceTimer = setTimeout(finalizeDob, 2400);
                }
            };

            recognition.onerror = function(event) {
                if (dobSilenceTimer) clearTimeout(dobSilenceTimer);
                if (event.error !== 'no-speech') {
                    console.warn('DOB speech error:', event.error);
                    if (toastMsg) toastMsg.innerText = 'குரல் உள்ளீடு முடிந்தது.';
                    setTimeout(() => { if (toast && !activeRecognition) toast.style.display = 'none'; }, 1200);
                }
            };

            recognition.onend = function() {
                if (dobSilenceTimer) clearTimeout(dobSilenceTimer);
                if (latestDobTranscript && !isUserEndingDob) {
                    processDobTranscript(latestDobTranscript.trim());
                }
                if (btnEl) btnEl.classList.remove('is-active-recording');
                setTimeout(() => { if (toast && !activeRecognition) toast.style.display = 'none'; }, 1200);
                activeRecognition = null;
                activeMicBtn = null;
            };

            try {
                recognition.start();
            } catch (err) {
                console.error('DOB Mic start failed:', err);
                if (btnEl) btnEl.classList.remove('is-active-recording');
                if (toast) toast.style.display = 'none';
                activeRecognition = null;
                activeMicBtn = null;
            }
        }

        // ========================================================
        // Search Directory Voice Dictation
        // ========================================================
        function startSearchMic(btnEl) {
            const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
            const toast = document.getElementById('voiceAlertToast');
            const toastMsg = document.getElementById('voiceToastMessage');
            const searchInput = document.getElementById('tableSearch') || document.getElementById('directorySearchInput');

            if (!SpeechRec) {
                alert(appLang === 'en' 
                    ? 'Voice recognition is not supported in this browser. Please use Google Chrome.' 
                    : 'குரல் உள்ளீடு வசதி இல்லை (Voice recognition is not supported).');
                return;
            }

            let searchSilenceTimer = null;
            let latestSearchTranscript = '';

            if (activeRecognition) {
                if (searchSilenceTimer) clearTimeout(searchSilenceTimer);
                try { activeRecognition.stop(); } catch (e) {}
                activeRecognition = null;
                if (activeMicBtn) {
                    activeMicBtn.classList.remove('is-active-recording');
                    activeMicBtn = null;
                }
                if (toast) toast.style.display = 'none';
                return;
            }

            const recognition = new SpeechRec();
            // Continuous listening with real-time live search update
            recognition.continuous = true;
            recognition.interimResults = true;
            if ('maxAlternatives' in recognition) recognition.maxAlternatives = 5;
            // Always listen in Tamil (ta-IN) for directory candidate search, so Tamil candidate names
            // like 'ஆறுமுகம்' / 'சரவணன்' are recognized accurately regardless of whether English or Tamil UI is active!
            recognition.lang = 'ta-IN';

            activeRecognition = recognition;
            activeMicBtn = btnEl;
            latestSearchTranscript = '';

            if (btnEl) btnEl.classList.add('is-active-recording');
            if (toast) {
                if (toastMsg) toastMsg.innerText = (appLang === 'en') ? '🔍 Speak candidate name, education or details to search...' : '🔍 தேட வேண்டிய பெயர் அல்லது விபரத்தை பேசவும்...';
                toast.style.display = 'flex';
            }

            const finalizeSearch = function() {
                if (searchSilenceTimer) clearTimeout(searchSilenceTimer);
                try { recognition.stop(); } catch (e) {}
            };

            recognition.onresult = function(event) {
                let fullTranscript = '';
                let extraAlts = [];
                for (let i = 0; i < event.results.length; i++) {
                    if (event.results[i]) {
                        if (event.results[i][0]) fullTranscript += ' ' + event.results[i][0].transcript;
                        for (let j = 1; j < event.results[i].length; j++) {
                            if (event.results[i][j] && event.results[i][j].transcript) {
                                extraAlts.push(event.results[i][j].transcript.trim());
                            }
                        }
                    }
                }
                fullTranscript = fullTranscript.trim();
                const targetInput = document.getElementById('tableSearch') || document.getElementById('directorySearchInput');
                if (fullTranscript && targetInput) {
                    latestSearchTranscript = fullTranscript;
                    targetInput.value = fullTranscript;
                    targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                    targetInput.dispatchEvent(new Event('keyup', { bubbles: true }));
                    if (typeof filterDirectory === 'function') filterDirectory(fullTranscript, extraAlts);
                    if (toastMsg) toastMsg.innerText = `🔍 தேடல்: ${fullTranscript}`;

                    if (searchSilenceTimer) clearTimeout(searchSilenceTimer);
                    searchSilenceTimer = setTimeout(finalizeSearch, 2200);
                }
            };

            recognition.onerror = function(event) {
                if (searchSilenceTimer) clearTimeout(searchSilenceTimer);
                if (event.error !== 'no-speech') {
                    if (toastMsg) toastMsg.innerText = 'குரல் உள்ளீடு முடிந்தது.';
                    setTimeout(() => { if (toast && !activeRecognition) toast.style.display = 'none'; }, 1200);
                }
            };

            recognition.onend = function() {
                if (searchSilenceTimer) clearTimeout(searchSilenceTimer);
                if (btnEl) btnEl.classList.remove('is-active-recording');
                if (toast) toast.style.display = 'none';
                activeRecognition = null;
                activeMicBtn = null;
            };

            try {
                recognition.start();
            } catch (err) {
                if (btnEl) btnEl.classList.remove('is-active-recording');
                if (toast) toast.style.display = 'none';
                activeRecognition = null;
                activeMicBtn = null;
            }
        }


        // ========================================================
        // Dedicated Ultra-Sensitive Email Speech Dictation
        // ========================================================
        function formatSpokenEmail(raw) {
            if (!raw) return '';
            let str = raw.trim().toLowerCase();

            // Tamil spoken email phonetics
            str = str.replace(/அட்\s*த\s*ரேட்|அட்|அட்டு/g, '@');
            str = str.replace(/டாட்|புள்ளி/g, '.');
            str = str.replace(/ஜிமெயில்/g, 'gmail');
            str = str.replace(/யாஹூ/g, 'yahoo');
            str = str.replace(/ஹாட்மெயில்/g, 'hotmail');
            str = str.replace(/அவுட்லுக்/g, 'outlook');
            str = str.replace(/காம்/g, 'com');
            str = str.replace(/இன்/g, 'in');

            // English spoken terms
            str = str.replace(/\bat\s+the\s+rate\s+of\b|\bat\s+the\s+rate\b|\bat\b/gi, '@');
            str = str.replace(/\bdot\b|\bpoint\b|\bperiod\b/gi, '.');
            str = str.replace(/\bunderscore\b/gi, '_');
            str = str.replace(/\bhyphen\b|\bdash\b/gi, '-');

            // Spoken English number words to digits
            const numWords = {
                'zero': '0', 'one': '1', 'two': '2', 'three': '3', 'four': '4',
                'five': '5', 'six': '6', 'seven': '7', 'eight': '8', 'nine': '9'
            };
            for (const [w, d] of Object.entries(numWords)) {
                str = str.replace(new RegExp('\\b' + w + '\\b', 'gi'), d);
            }

            // Smart Auto-Complete: 'shankar gmail' -> 'shankar@gmail.com'
            str = str.replace(/([^@\s]+)\s+gmail(?:\.com|\s+com)?/gi, '$1@gmail.com');
            str = str.replace(/([^@\s]+)\s+yahoo(?:\.com|\s+com)?/gi, '$1@yahoo.com');
            str = str.replace(/([^@\s]+)\s+outlook(?:\.com|\s+com)?/gi, '$1@outlook.com');
            str = str.replace(/([^@\s]+)\s+hotmail(?:\.com|\s+com)?/gi, '$1@hotmail.com');

            // Normalize '@ gmail' to '@gmail.com'
            str = str.replace(/@\s*gmail(?![\.a-z0-9])/gi, '@gmail.com');
            str = str.replace(/@\s*yahoo(?![\.a-z0-9])/gi, '@yahoo.com');
            str = str.replace(/@\s*outlook(?![\.a-z0-9])/gi, '@outlook.com');
            str = str.replace(/@\s*hotmail(?![\.a-z0-9])/gi, '@hotmail.com');

            // Remove all whitespace
            str = str.replace(/\s+/g, '');

            // Keep only valid email characters
            str = str.replace(/[^a-z0-9@._\-+]/g, '');

            return str;
        }

        let emailSilenceTimer = null;
        let latestEmailText = '';

        function startEmailMic(btnEl) {
            const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
            const toast = document.getElementById('voiceAlertToast');
            const toastMsg = document.getElementById('voiceToastMessage');
            const targetInput = document.getElementById('email');

            if (!SpeechRec) {
                alert('குரல் உள்ளீடு வசதி இல்லை (Voice recognition is not supported in this browser).');
                return;
            }

            if (activeRecognition) {
                if (emailSilenceTimer) clearTimeout(emailSilenceTimer);
                try { activeRecognition.stop(); } catch (e) {}
                activeRecognition = null;
                if (activeMicBtn) {
                    activeMicBtn.classList.remove('is-active-recording');
                    activeMicBtn = null;
                }
                if (toast) toast.style.display = 'none';
                return;
            }

            const recognition = new SpeechRec();
            // Ultra-sensitive continuous listening + real-time interim results!
            recognition.continuous = true;
            recognition.interimResults = true;
            // Strictly English for email
            recognition.lang = 'en-IN';

            activeRecognition = recognition;
            activeMicBtn = btnEl;
            latestEmailText = '';

            if (btnEl) btnEl.classList.add('is-active-recording');
            if (toast) {
                if (toastMsg) {
                    toastMsg.innerText = (appLang === 'en')
                        ? 'Listening... Speak email (e.g. shankar@gmail.com)...'
                        : 'மின்னஞ்சல் பேசவும்... (எ.கா: shankar@gmail.com)...';
                }
                toast.style.display = 'flex';
            }

            const finalizeAndStopEmail = function() {
                if (emailSilenceTimer) clearTimeout(emailSilenceTimer);
                if (latestEmailText && targetInput) {
                    let finalEmail = latestEmailText;
                    if (!finalEmail.includes('@') && finalEmail.length >= 2) {
                        finalEmail += '@gmail.com';
                    }
                    targetInput.value = finalEmail;
                    targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                    targetInput.dispatchEvent(new Event('change', { bubbles: true }));
                    if (toastMsg) toastMsg.innerText = `✓ மின்னஞ்சல்: ${finalEmail}`;
                }
                try { recognition.stop(); } catch (e) {}
            };

            recognition.onresult = function(event) {
                let fullTranscript = '';
                for (let i = 0; i < event.results.length; i++) {
                    if (event.results[i] && event.results[i][0]) {
                        fullTranscript += ' ' + event.results[i][0].transcript;
                    }
                }

                if (fullTranscript.trim() && targetInput) {
                    const formattedEmail = formatSpokenEmail(fullTranscript);
                    latestEmailText = formattedEmail;
                    targetInput.value = formattedEmail;
                    targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                    targetInput.dispatchEvent(new Event('change', { bubbles: true }));
                    if (toastMsg) {
                        toastMsg.innerText = `✓ கேட்கிறது: ${formattedEmail}`;
                    }

                    // Reset silence debounce (1.6s pause automatically finalizes)
                    if (emailSilenceTimer) clearTimeout(emailSilenceTimer);
                    emailSilenceTimer = setTimeout(finalizeAndStopEmail, 1600);
                }
            };

            recognition.onerror = function(event) {
                console.warn('Email speech notice:', event.error);
                if (emailSilenceTimer) clearTimeout(emailSilenceTimer);
                if (event.error !== 'no-speech') {
                    if (toastMsg) toastMsg.innerText = 'குரல் உள்ளீடு முடிந்தது.';
                    setTimeout(() => { if (toast) toast.style.display = 'none'; }, 1000);
                }
            };

            recognition.onend = function() {
                if (emailSilenceTimer) clearTimeout(emailSilenceTimer);
                // Ensure default @gmail.com is attached if user only spoke a single name
                if (latestEmailText && targetInput && !targetInput.value.includes('@') && targetInput.value.length >= 2) {
                    targetInput.value = targetInput.value + '@gmail.com';
                    targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                    targetInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
                if (btnEl) btnEl.classList.remove('is-active-recording');
                setTimeout(() => { if (toast) toast.style.display = 'none'; }, 1000);
                activeRecognition = null;
                activeMicBtn = null;
            };

            try {
                recognition.start();
            } catch (err) {
                console.error('Email Mic start failed:', err);
                if (btnEl) btnEl.classList.remove('is-active-recording');
                if (toast) toast.style.display = 'none';
                activeRecognition = null;
                activeMicBtn = null;
            }
        }

        // Comprehensive Spoken Number Parser (Tamil & English)
        function parseSpokenWordsToNumber(text) {
            if (!text) return null;
            let s = String(text).trim().toLowerCase();

            // 1. Direct digits
            const m = s.match(/(\d+(?:\.\d+)?)/);
            if (m) return parseFloat(m[1]);

            // Tamil digits
            const tamilDigits = {'௦':0,'௧':1,'௨':2,'௩':3,'௪':4,'௫':5,'௬':6,'௭':7,'௮':8,'௯':9};
            s = s.replace(/[௦-௯]/g, d => tamilDigits[d]);
            const m2 = s.match(/(\d+(?:\.\d+)?)/);
            if (m2) return parseFloat(m2[1]);

            // 2. English words
            const engWords = {
                'zero': 0, 'one': 1, 'two': 2, 'three': 3, 'four': 4, 'five': 5,
                'six': 6, 'seven': 7, 'eight': 8, 'nine': 9, 'ten': 10,
                'eleven': 11, 'twelve': 12, 'thirteen': 13, 'fourteen': 14, 'fifteen': 15,
                'sixteen': 16, 'seventeen': 17, 'eighteen': 18, 'nineteen': 19,
                'twenty': 20, 'thirty': 30, 'forty': 40, 'fifty': 50,
                'sixty': 60, 'seventy': 70, 'eighty': 80, 'ninety': 90,
                'hundred': 100
            };

            let engTotal = 0;
            let hasEng = false;
            let tokens = s.replace(/[^a-z0-9]/g, ' ').split(/\s+/).filter(Boolean);
            for (let i = 0; i < tokens.length; i++) {
                let t = tokens[i];
                if (engWords[t] !== undefined) {
                    hasEng = true;
                    let val = engWords[t];
                    if (val === 100) {
                        if (engTotal === 0) engTotal = 100;
                        else engTotal = engTotal * 100;
                    } else {
                        engTotal += val;
                    }
                }
            }
            if (hasEng && engTotal > 0) return engTotal;

            // 3. Tamil compound spoken numbers
            let total = 0;

            // Check hundreds
            if (/இருநூற்று|இருநூறு|ரெண்டு\s*நூறு|இரண்டு\s*நூறு/.test(s)) {
                total += 200;
                s = s.replace(/இருநூற்று|இருநூறு|ரெண்டு\s*நூறு|இரண்டு\s*நூறு/, ' ');
            } else if (/நூற்று|நூத்தி|நூறு/.test(s)) {
                total += 100;
                s = s.replace(/நூற்று|நூத்தி|நூறு/, ' ');
            }

            // Tens and composite units (99 down to 10)
            const tamilCompounds = [
                // 90s
                { p: /தொண்ணூற்றொன்பது|தொண்ணூற்றொம்பது/, v: 99 },
                { p: /தொண்ணூற்றெட்டு/, v: 98 },
                { p: /தொண்ணூற்றேழு/, v: 97 },
                { p: /தொண்ணூற்றாறு/, v: 96 },
                { p: /தொண்ணூற்றைந்து|தொண்ணூத்தஞ்சு/, v: 95 },
                { p: /தொண்ணூற்றுநான்கு|தொண்ணூற்றுநாலு/, v: 94 },
                { p: /தொண்ணூற்றுமூன்று|தொண்ணூத்துமூணு/, v: 93 },
                { p: /தொண்ணூற்றிரண்டு|தொண்ணூத்திரெண்டு/, v: 92 },
                { p: /தொண்ணூற்றொன்று|தொண்ணூத்தொன்னு/, v: 91 },
                { p: /தொண்ணூறு/, v: 90 },

                // 80s
                { p: /எண்பத்தொன்பது|எம்பத்தொம்பது/, v: 89 },
                { p: /எண்பத்தெட்டு|எம்பத்தெட்டு/, v: 88 },
                { p: /எண்பத்தேழு|எம்பத்தேழு/, v: 87 },
                { p: /எண்பத்தாறு|எம்பத்தாறு/, v: 86 },
                { p: /எண்பத்தைந்து|எண்பத்தஞ்சு|எம்பத்தஞ்சு/, v: 85 },
                { p: /எண்பத்துநான்கு|எண்பத்துநாலு|எம்பத்துநாலு/, v: 84 },
                { p: /எண்பத்துமூன்று|எண்பத்துமூணு|எம்பத்துமூணு/, v: 83 },
                { p: /எண்பத்திரண்டு|எண்பத்திரெண்டு|எம்பத்திரெண்டு/, v: 82 },
                { p: /எண்பத்தொன்று|எண்பத்தொன்னு|எம்பத்தொன்னு/, v: 81 },
                { p: /எண்பது|எம்பது/, v: 80 },

                // 70s
                { p: /எழுபத்தொன்பது|எழுபத்தொம்பது/, v: 79 },
                { p: /எழுபத்தெட்டு/, v: 78 },
                { p: /எழுபத்தேழு/, v: 77 },
                { p: /எழுபத்தாறு/, v: 76 },
                { p: /எழுபத்தைந்து|எழுபத்தஞ்சு/, v: 75 },
                { p: /எழுபத்துநான்கு|எழுபத்துநாலு/, v: 74 },
                { p: /எழுபத்துமூன்று|எழுபத்துமூணு/, v: 73 },
                { p: /எழுபத்திரண்டு|எழுபத்திரெண்டு/, v: 72 },
                { p: /எழுபத்தொன்று|எழுபத்தொன்னு/, v: 71 },
                { p: /எழுபது/, v: 70 },

                // 60s
                { p: /அறுபத்தொன்பது|அறுபத்தொம்பது/, v: 69 },
                { p: /அறுபத்தெட்டு/, v: 68 },
                { p: /அறுபத்தேழு/, v: 67 },
                { p: /அறுபத்தாறு/, v: 66 },
                { p: /அறுபத்தைந்து|அறுபத்தஞ்சு/, v: 65 },
                { p: /அறுபத்துநான்கு|அறுபத்துநாலு/, v: 64 },
                { p: /அறுபத்துமூன்று|அறுபத்துமூணு/, v: 63 },
                { p: /அறுபத்திரண்டு|அறுபத்திரெண்டு/, v: 62 },
                { p: /அறுபத்தொன்று|அறுபத்தொன்னு/, v: 61 },
                { p: /அறுபது/, v: 60 },

                // 50s
                { p: /ஐம்பத்தொன்பது|ஐம்பத்தொம்பது|அம்பத்தொம்பது/, v: 59 },
                { p: /ஐம்பத்தெட்டு|அம்பத்தெட்டு/, v: 58 },
                { p: /ஐம்பத்தேழு|அம்பத்தேழு/, v: 57 },
                { p: /ஐம்பத்தாறு|அம்பத்தாறு/, v: 56 },
                { p: /ஐம்பத்தைந்து|ஐம்பத்தஞ்சு|அம்பத்தஞ்சு/, v: 55 },
                { p: /ஐம்பத்துநான்கு|ஐம்பத்துநாலு|அம்பத்துநாலு/, v: 54 },
                { p: /ஐம்பத்துமூன்று|ஐம்பத்துமூணு|அம்பத்துமூணு/, v: 53 },
                { p: /ஐம்பத்திரண்டு|ஐம்பத்திரெண்டு|அம்பத்திரெண்டு/, v: 52 },
                { p: /ஐம்பத்தொன்று|ஐம்பத்தொன்னு|அம்பத்தொன்னு/, v: 51 },
                { p: /ஐம்பது|அம்பது/, v: 50 },

                // 40s
                { p: /நாற்பத்தொன்பது|நாற்பத்தொம்பது|நாப்பத்தொம்பது/, v: 49 },
                { p: /நாற்பத்தெட்டு|நாப்பத்தெட்டு/, v: 48 },
                { p: /நாற்பத்தேழு|நாப்பத்தேழு/, v: 47 },
                { p: /நாற்பத்தாறு|நாப்பத்தாறு/, v: 46 },
                { p: /நாற்பத்தைந்து|நாற்பத்தஞ்சு|நாப்பத்தஞ்சு/, v: 45 },
                { p: /நாற்பத்துநான்கு|நாற்பத்துநாலு|நாப்பத்துநாலு/, v: 44 },
                { p: /நாற்பத்துமூன்று|நாற்பத்துமூணு|நாப்பத்துமூணு/, v: 43 },
                { p: /நாற்பத்திரண்டு|நாற்பத்திரெண்டு|நாப்பத்திரெண்டு/, v: 42 },
                { p: /நாற்பத்தொன்று|நாற்பத்தொன்னு|நாப்பத்தொன்னு/, v: 41 },
                { p: /நாற்பது|நாப்பது/, v: 40 },

                // 30s
                { p: /முப்பத்தொன்பது|முப்பத்தொம்பது/, v: 39 },
                { p: /முப்பத்தெட்டு/, v: 38 },
                { p: /முப்பத்தேழு/, v: 37 },
                { p: /முப்பத்தாறு/, v: 36 },
                { p: /முப்பத்தைந்து|முப்பத்தஞ்சு/, v: 35 },
                { p: /முப்பத்துநான்கு|முப்பத்துநாலு/, v: 34 },
                { p: /முப்பத்துமூன்று|முப்பத்துமூணு/, v: 33 },
                { p: /முப்பத்திரண்டு|முப்பத்திரெண்டு/, v: 32 },
                { p: /முப்பத்தொன்று|முப்பத்தொன்னு/, v: 31 },
                { p: /முப்பது/, v: 30 },

                // 20s
                { p: /இருபத்தொன்பது|இருபத்தொம்பது/, v: 29 },
                { p: /இருபத்தெட்டு/, v: 28 },
                { p: /இருபத்தேழு/, v: 27 },
                { p: /இருபத்தாறு/, v: 26 },
                { p: /இருபத்தைந்து|இருபத்தஞ்சு/, v: 25 },
                { p: /இருபத்துநான்கு|இருபத்துநாலு/, v: 24 },
                { p: /இருபத்துமூன்று|இருபத்துமூணு/, v: 23 },
                { p: /இருபத்திரண்டு|இருபத்திரெண்டு/, v: 22 },
                { p: /இருபத்தொன்று|இருபத்தொன்னு/, v: 21 },
                { p: /இருபது/, v: 20 },

                // Teens (10-19)
                { p: /பத்தொன்பது|பத்தொம்பது/, v: 19 },
                { p: /பதினெட்டு/, v: 18 },
                { p: /பதினேழு/, v: 17 },
                { p: /பதினாறு/, v: 16 },
                { p: /பதினைந்து|பதினஞ்சு/, v: 15 },
                { p: /பதினான்கு|பதினாலு/, v: 14 },
                { p: /பதின்மூன்று|பதிமூன்று|பதிமூணு/, v: 13 },
                { p: /பன்னிரண்டு|பன்னிரெண்டு/, v: 12 },
                { p: /பதினொன்று|பதினொன்னு/, v: 11 },
                { p: /பத்து/, v: 10 },

                // 1-9 (Strict Tamil word boundaries so names like ஆறுமுகம், ஏழுமலை are NEVER matched!)
                { p: /(?:^|[\s,.\-!?;:])(?:ஒன்பது|ஒம்பது)(?:$|[\s,.\-!?;:])/, v: 9 },
                { p: /(?:^|[\s,.\-!?;:])(?:எட்டு)(?:$|[\s,.\-!?;:])/, v: 8 },
                { p: /(?:^|[\s,.\-!?;:])(?:ஏழு)(?:$|[\s,.\-!?;:])/, v: 7 },
                { p: /(?:^|[\s,.\-!?;:])(?:ஆறு)(?:$|[\s,.\-!?;:])/, v: 6 },
                { p: /(?:^|[\s,.\-!?;:])(?:ஐந்து|அஞ்சு)(?:$|[\s,.\-!?;:])/, v: 5 },
                { p: /(?:^|[\s,.\-!?;:])(?:நான்கு|நாலு)(?:$|[\s,.\-!?;:])/, v: 4 },
                { p: /(?:^|[\s,.\-!?;:])(?:மூன்று|மூணு)(?:$|[\s,.\-!?;:])/, v: 3 },
                { p: /(?:^|[\s,.\-!?;:])(?:இரண்டு|ரெண்டு)(?:$|[\s,.\-!?;:])/, v: 2 },
                { p: /(?:^|[\s,.\-!?;:])(?:ஒன்று|ஒன்னு|ஒரு)(?:$|[\s,.\-!?;:])/, v: 1 }
            ];

            for (const c of tamilCompounds) {
                if (c.p.test(s)) {
                    total += c.v;
                    s = s.replace(c.p, ' ');
                    break;
                }
            }

            return total > 0 ? total : null;
        }

        // Replace spoken number words in general sentences with digits
        function replaceTamilNumberWordsWithDigits(text) {
            if (!text) return '';
            let str = String(text);
            const replacements = [
                [/(?<=^|[\s,.\-!?;:])(?:நூற்று\s*எழுபத்தெட்டு|நூத்தி\s*எழுபத்தெட்டு)(?=$|[\s,.\-!?;:])/g, '178'],
                [/(?<=^|[\s,.\-!?;:])(?:நூற்று\s*ஐம்பது|நூத்தி\s*ஐம்பது)(?=$|[\s,.\-!?;:])/g, '150'],
                [/(?<=^|[\s,.\-!?;:])(?:நூற்று\s*அறுபத்தைந்து|நூத்தி\s*அறுபத்தைந்து|நூத்தி\s*அறுபத்தஞ்சு)(?=$|[\s,.\-!?;:])/g, '165'],
                [/(?<=^|[\s,.\-!?;:])(?:நூற்று\s*எழுபது|நூத்தி\s*எழுபது)(?=$|[\s,.\-!?;:])/g, '170'],
                [/(?<=^|[\s,.\-!?;:])(?:நூற்று\s*எண்பது|நூத்தி\s*எண்பது)(?=$|[\s,.\-!?;:])/g, '180'],
                [/(?<=^|[\s,.\-!?;:])(?:இருநூறு|ரெண்டு\s*நூறு)(?=$|[\s,.\-!?;:])/g, '200'],
                [/(?<=^|[\s,.\-!?;:])நூறு(?=$|[\s,.\-!?;:])/g, '100'],
                [/(?<=^|[\s,.\-!?;:])எழுபத்தெட்டு(?=$|[\s,.\-!?;:])/g, '78'],
                [/(?<=^|[\s,.\-!?;:])(?:அறுபத்தைந்து|அறுபத்தஞ்சு)(?=$|[\s,.\-!?;:])/g, '65'],
                [/(?<=^|[\s,.\-!?;:])(?:ஐம்பத்தைந்து|ஐம்பத்தஞ்சு|அம்பத்தஞ்சு)(?=$|[\s,.\-!?;:])/g, '55'],
                [/(?<=^|[\s,.\-!?;:])எண்பது(?=$|[\s,.\-!?;:])/g, '80'],
                [/(?<=^|[\s,.\-!?;:])எழுபது(?=$|[\s,.\-!?;:])/g, '70'],
                [/(?<=^|[\s,.\-!?;:])அறுபது(?=$|[\s,.\-!?;:])/g, '60'],
                [/(?<=^|[\s,.\-!?;:])(?:ஐம்பது|அம்பது)(?=$|[\s,.\-!?;:])/g, '50'],
                [/(?<=^|[\s,.\-!?;:])(?:நாற்பது|நாப்பது)(?=$|[\s,.\-!?;:])/g, '40'],
                [/(?<=^|[\s,.\-!?;:])முப்பது(?=$|[\s,.\-!?;:])/g, '30'],
                [/(?<=^|[\s,.\-!?;:])இருபது(?=$|[\s,.\-!?;:])/g, '20'],
                [/(?<=^|[\s,.\-!?;:])பத்து(?=$|[\s,.\-!?;:])/g, '10']
            ];
            for (const [re, val] of replacements) {
                str = str.replace(re, val);
            }
            return str;
        }

        // Normalize Height speech input: always format as '[number] cm' in English
        function normalizeHeightSpeech(text) {
            if (!text) return '';
            let s = String(text).trim();
            if (/(?:ft|feet|inch|inches|அடி|அங்குலம்)/i.test(s)) {
                return s;
            }
            const num = parseSpokenWordsToNumber(s);
            if (num !== null) {
                return num + ' cm';
            }
            s = s.replace(/(?:சென்டி\s*மீட்டர்|செண்டி\s*மீட்டர்|செ\.?\s*மீ|centi\s*meters?|cente\s*meters?|centi\s*metres?|cms?)/gi, '').trim();
            return s ? (s + ' cm') : text;
        }

        // Normalize Weight speech input: always format as '[number] kg' in English
        function normalizeWeightSpeech(text) {
            if (!text) return '';
            let s = String(text).trim();
            const num = parseSpokenWordsToNumber(s);
            if (num !== null) {
                return num + ' kg';
            }
            s = s.replace(/(?:கிலோ\s*கிராம்|கிலோ|கி\.?\s*கி|kilo\s*grams?|kilos?|kgs?)/gi, '').trim();
            return s ? (s + ' kg') : text;
        }

        // Normalize Birth Time speech input: convert spoken Tamil / English time into 'HH:MM AM/PM'
        function normalizeBirthTimeSpeech(text) {
            if (!text) return '';
            let s = String(text).trim();

            // 1. Detect meridiem (AM / PM)
            let meridiem = null;
            if (/ஏ\s*எம்|ஏஎம்|\bam\b|\ba\.m\b|காலை|முற்பகல்|விடியற்காலை|அதிகாலை/i.test(s)) {
                meridiem = 'AM';
            } else if (/பி\s*எம்|பிஎம்|\bpm\b|\bp\.m\b|மாலை|இரவு|பிற்பகல்|நண்பகல்/i.test(s)) {
                meridiem = 'PM';
            }

            // Remove meridiem words from text so they don't interfere
            s = s.replace(/ஏ\s*எம்|ஏஎம்|\bam\b|\ba\.m\b|\bpm\b|\bp\.m\b|பி\s*எம்|பிஎம்|காலை|முற்பகல்|விடியற்காலை|அதிகாலை|மாலை|இரவு|பிற்பகல்|நண்பகல்/gi, ' ');

            // 2. Handle fractional words: கால் -> 15, அரை -> 30, முக்கால் -> 45
            const hasQuarter = /கால்/.test(s);
            const hasHalf = /அரை/.test(s);
            const hasThreeQuarters = /முக்கால்/.test(s);
            s = s.replace(/கால்|அரை|முக்கால்/g, ' ');

            // Remove words for o'clock / minutes / hours
            s = s.replace(/மணிக்கு|மணிக்கி|மணி|நிமிடங்கள்|நிமிடம்|நிமிஷம்|நி|o['"]?clock|hours|hrs|minutes|mins/gi, ' ');

            // 3. Tamil word to number replacements
            const tamilNums = [
                [/ஐம்பத்தொன்பது|ஐம்பத்தொம்பது|அம்பத்தொம்பது/g, '59'],
                [/ஐம்பத்தெட்டு|அம்பத்தெட்டு/g, '58'],
                [/ஐம்பத்தேழு|அம்பத்தேழு/g, '57'],
                [/ஐம்பத்தாறு|அம்பத்தாறு/g, '56'],
                [/ஐம்பத்தைந்து|ஐம்பத்தஞ்சு|அம்பத்தஞ்சு/g, '55'],
                [/ஐம்பத்துநான்கு|ஐம்பத்துநாலு|அம்பத்துநாலு/g, '54'],
                [/ஐம்பத்துமூன்று|ஐம்பத்துமூணு|அம்பத்துமூணு/g, '53'],
                [/ஐம்பத்திரண்டு|ஐம்பத்திரெண்டு|அம்பத்திரெண்டு/g, '52'],
                [/ஐம்பத்தொன்று|ஐம்பத்தொன்னு|அம்பத்தொன்னு/g, '51'],
                [/ஐம்பது|அம்பது/g, '50'],
                [/நாற்பத்தொன்பது|நாற்பத்தொம்பது|நாப்பத்தொம்பது/g, '49'],
                [/நாற்பத்தெட்டு|நாப்பத்தெட்டு/g, '48'],
                [/நாற்பத்தேழு|நாப்பத்தேழு/g, '47'],
                [/நாற்பத்தாறு|நாப்பத்தாறு/g, '46'],
                [/நாற்பத்தைந்து|நாற்பத்தஞ்சு|நாப்பத்தஞ்சு/g, '45'],
                [/நாற்பத்துநான்கு|நாற்பத்துநாலு|நாப்பத்துநாலு/g, '44'],
                [/நாற்பத்துமூன்று|நாற்பத்துமூணு|நாப்பத்துமூணு/g, '43'],
                [/நாற்பத்திரண்டு|நாற்பத்திரெண்டு|நாப்பத்திரெண்டு/g, '42'],
                [/நாற்பத்தொன்று|நாற்பத்தொன்னு|நாப்பத்தொன்னு/g, '41'],
                [/நாற்பது|நாப்பது/g, '40'],
                [/முப்பத்தொன்பது|முப்பத்தொம்பது/g, '39'],
                [/முப்பத்தெட்டு/g, '38'],
                [/முப்பத்தேழு/g, '37'],
                [/முப்பத்தாறு/g, '36'],
                [/முப்பத்தைந்து|முப்பத்தஞ்சு/g, '35'],
                [/முப்பத்துநான்கு|முப்பத்துநாலு/g, '34'],
                [/முப்பத்துமூன்று|முப்பத்துமூணு/g, '33'],
                [/முப்பத்திரண்டு|முப்பத்திரெண்டு/g, '32'],
                [/முப்பத்தொன்று|முப்பத்தொன்னு/g, '31'],
                [/முப்பது/g, '30'],
                [/இருபத்தொன்பது|இருபத்தொம்பது/g, '29'],
                [/இருபத்தெட்டு/g, '28'],
                [/இருபத்தேழு/g, '27'],
                [/இருபத்தாறு/g, '26'],
                [/இருபத்தைந்து|இருபத்தஞ்சு/g, '25'],
                [/இருபத்துநான்கு|இருபத்துநாலு/g, '24'],
                [/இருபத்துமூன்று|இருபத்துமூணு/g, '23'],
                [/இருபத்திரண்டு|இருபத்திரெண்டு/g, '22'],
                [/இருபத்தொன்று|இருபத்தொன்னு/g, '21'],
                [/இருபது/g, '20'],
                [/பத்தொன்பது|பத்தொம்பது/g, '19'],
                [/பதினெட்டு/g, '18'],
                [/பதினேழு/g, '17'],
                [/பதினாறு/g, '16'],
                [/பதினைந்து|பதினஞ்சு/g, '15'],
                [/பதினான்கு|பதினாலு/g, '14'],
                [/பதின்மூன்று|பதிமூன்று|பதிமூணு/g, '13'],
                [/பன்னிரண்டு|பன்னிரெண்டு|பனிரெண்டு/g, '12'],
                [/பதினொன்று|பதினொன்னு|பதினோரு/g, '11'],
                [/பத்து/g, '10'],
                [/ஒன்பது|ஒம்பது/g, '9'],
                [/எட்டு/g, '8'],
                [/ஏழு/g, '7'],
                [/ஆறு/g, '6'],
                [/ஐந்து|அஞ்சு/g, '5'],
                [/நான்கு|நாலு/g, '4'],
                [/மூன்று|மூணு/g, '3'],
                [/இரண்டு|ரெண்டு/g, '2'],
                [/ஒன்று|ஒன்னு/g, '1']
            ];

            for (const [pat, rep] of tamilNums) {
                s = s.replace(pat, rep);
            }

            // 4. English words to numbers
            const engNums = {
                'one': 1, 'two': 2, 'three': 3, 'four': 4, 'five': 5, 'six': 6, 'seven': 7,
                'eight': 8, 'nine': 9, 'ten': 10, 'eleven': 11, 'twelve': 12, 'thirteen': 13,
                'fourteen': 14, 'fifteen': 15, 'sixteen': 16, 'seventeen': 17, 'eighteen': 18,
                'nineteen': 19, 'twenty': 20, 'thirty': 30, 'forty': 40, 'fifty': 50
            };
            for (const [w, num] of Object.entries(engNums)) {
                s = s.replace(new RegExp('\\b' + w + '\\b', 'gi'), String(num));
            }

            // 5. Extract numbers from string
            const nums = s.match(/\d+/g);
            let hour = null;
            let minute = 0;

            if (hasQuarter) {
                minute = 15;
            } else if (hasHalf) {
                minute = 30;
            } else if (hasThreeQuarters) {
                minute = 45;
            }

            if (nums && nums.length > 0) {
                const timeMatch = String(text).match(/(\d{1,2})[:.](\d{2})/);
                if (timeMatch) {
                    hour = parseInt(timeMatch[1], 10);
                    minute = parseInt(timeMatch[2], 10);
                } else {
                    hour = parseInt(nums[0], 10);
                    if (nums.length > 1 && !hasQuarter && !hasHalf && !hasThreeQuarters) {
                        minute = parseInt(nums[1], 10);
                    }
                }
            }

            if (hour !== null && !isNaN(hour)) {
                // Convert 24-hr format to 12-hr
                if (hour >= 13 && hour <= 23) {
                    hour -= 12;
                    if (!meridiem) meridiem = 'PM';
                } else if (hour === 12) {
                    if (!meridiem) meridiem = 'PM';
                } else if (hour === 0) {
                    hour = 12;
                    if (!meridiem) meridiem = 'AM';
                }

                if (!meridiem) {
                    meridiem = 'AM';
                }

                return `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')} ${meridiem}`;
            }

            return text;
        }

        // Validate Tamil Month Date (Strictly 1 to 31)
        function validateTamilDate(el) {
            if (!el) return;
            let v = String(el.value).replace(/[^0-9]/g, '');
            if (v !== '') {
                let num = parseInt(v, 10);
                if (num > 31) num = 31;
                if (num < 1) num = 1;
                el.value = num;
            } else {
                el.value = '';
            }
        }

        // Normalize Salary / Monthly Income speech input: converts spoken Tamil & English number expressions into clean digits only
        function normalizeSalarySpeech(text) {
            if (!text) return '';
            let s = String(text).trim().toLowerCase();

            // Convert Tamil digits to standard digits
            const tamilDigits = {'௦':'0','௧':'1','௨':'2','௩':'3','௪':'4','௫':'5','௬':'6','௭':'7','௮':'8','௯':'9'};
            s = s.replace(/[௦-௯]/g, d => tamilDigits[d]);

            const parseSingleSalaryChunk = function(chunk) {
                if (!chunk) return null;
                let c = chunk.trim().toLowerCase();

                const salaryMultipliers = [
                    { p: /(?:ஒன்றரை|ஒன்னரை)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 150000 },
                    { p: /(?:இரண்டரை|ரெண்டரை)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 250000 },
                    { p: /(?:மூன்றரை|மூணரை)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 350000 },
                    { p: /(?:ஒன்று|ஒரு|1)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 100000 },
                    { p: /(?:இரண்டு|ரெண்டு|2)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 200000 },
                    { p: /(?:மூன்று|மூணு|3)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 300000 },
                    { p: /(?:நான்கு|நாலு|4)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 400000 },
                    { p: /(?:ஐந்து|அஞ்சு|5)\s*(?:லட்சம்|லக்ஷம்|lakh)/i, v: 500000 },
                    { p: /(\d+(?:\.\d+)?)\s*(?:லட்சம்|லக்ஷம்|lakhs?)/i, mult: 100000 },

                    { p: /ஒரு\s*லட்சத்து\s*ஐம்பதாயிரம்/i, v: 150000 },
                    { p: /ஒரு\s*லட்சத்து\s*இருபத்தைந்தாயிரம்/i, v: 125000 },
                    { p: /ஒரு\s*லட்சம்/i, v: 100000 },
                    { p: /தொண்ணூறாயிரம்|தொண்ணூற்றாயிரம்/i, v: 90000 },
                    { p: /எண்பத்தைந்தாயிரம்|எம்பத்தஞ்சாயிரம்/i, v: 85000 },
                    { p: /எண்பதாயிரம்|எம்பதாயிரம்/i, v: 80000 },
                    { p: /எழுபத்தைந்தாயிரம்|எழுபத்தஞ்சாயிரம்/i, v: 75000 },
                    { p: /எழுபதாயிரம்/i, v: 70000 },
                    { p: /அறுபத்தைந்தாயிரம்|அறுபத்தஞ்சாயிரம்/i, v: 65000 },
                    { p: /அறுபதாயிரம்/i, v: 60000 },
                    { p: /ஐம்பத்தைந்தாயிரம்|அம்பத்தஞ்சாயிரம்/i, v: 55000 },
                    { p: /ஐம்பதாயிரம்|அம்பதாயிரம்/i, v: 50000 },
                    { p: /நாற்பத்தைந்தாயிரம்|நாப்பத்தஞ்சாயிரம்/i, v: 45000 },
                    { p: /நாற்பதாயிரம்|நாப்பதாயிரம்/i, v: 40000 },
                    { p: /முப்பத்தைந்தாயிரம்|முப்பத்தஞ்சாயிரம்/i, v: 35000 },
                    { p: /முப்பதாயிரம்/i, v: 30000 },
                    { p: /இருபத்தைந்தாயிரம்|இருபத்தஞ்சாயிரம்/i, v: 25000 },
                    { p: /இருபதாயிரம்/i, v: 20000 },
                    { p: /பதினைந்தாயிரம்|பதினஞ்சாயிரம்/i, v: 15000 },
                    { p: /பத்தாயிரம்/i, v: 10000 },
                    { p: /ஐயாயிரம்/i, v: 5000 },

                    { p: /fifty\s*thousand/i, v: 50000 },
                    { p: /forty\s*five\s*thousand/i, v: 45000 },
                    { p: /forty\s*thousand/i, v: 40000 },
                    { p: /thirty\s*five\s*thousand/i, v: 35000 },
                    { p: /thirty\s*thousand/i, v: 30000 },
                    { p: /twenty\s*five\s*thousand/i, v: 25000 },
                    { p: /twenty\s*thousand/i, v: 20000 },
                    { p: /fifteen\s*thousand/i, v: 15000 },
                    { p: /ten\s*thousand/i, v: 10000 },
                    { p: /one\s*lakh/i, v: 100000 },
                    { p: /two\s*lakhs?/i, v: 200000 }
                ];

                for (const item of salaryMultipliers) {
                    if (item.v && item.p.test(c)) return item.v;
                    if (item.mult) {
                        const m = c.match(item.p);
                        if (m) return Math.round(parseFloat(m[1]) * item.mult);
                    }
                }

                const tm = c.match(/(\d+)\s*(?:ஆயிரம்|ஆயிரத்து|aayiram|aairam|thousand|k\b)/i);
                if (tm) return parseInt(tm[1], 10) * 1000;

                const lm = c.match(/(\d+(?:\.\d+)?)\s*(?:லட்சம்|லக்ஷம்|lakhs?)/i);
                if (lm) return Math.round(parseFloat(lm[1]) * 100000);

                const nm = c.replace(/,/g, '').match(/\b\d{3,7}\b/);
                if (nm) return parseInt(nm[0], 10);

                return null;
            };

            // If user corrected themselves (e.g. "50000 இல்ல 45000" or re-spoke), take the latest
            const correctionTokens = s.split(/(?:இல்ல|இல்லை|தவறு|sorry|no|not|rather|\band\b|;|,)/i);
            for (let i = correctionTokens.length - 1; i >= 0; i--) {
                const parsed = parseSingleSalaryChunk(correctionTokens[i]);
                if (parsed !== null && parsed > 0) {
                    return String(parsed);
                }
            }

            const wholeParsed = parseSingleSalaryChunk(s);
            if (wholeParsed !== null && wholeParsed > 0) {
                return String(wholeParsed);
            }

            const digitsOnly = s.replace(/[^0-9]/g, '');
            return digitsOnly;
        }

        // Live Voice Microphone Dictation (High Sensitivity with Real-Time Debounce)
        let activeMicBtn = null;
        let micSilenceTimer = null;
        let latestMicTranscript = '';
        let micRetryCount = 0;
        let isUserEndingMic = false;

        // Normalize Mobile / Phone numbers from speech (Tamil words or English words or digits)
        function normalizePhoneSpeech(text) {
            if (!text) return '';
            let s = String(text).trim().toLowerCase();

            // 1. Spoken Tamil words to digits
            const tamilDigitsMap = [
                [/(?:பூஜ்ஜியம்|பூஜ்யம்|சைபர்)/g, '0'],
                [/(?:ஒன்று|ஒன்னு|ஒரு)/g, '1'],
                [/(?:இரண்டு|ரெண்டு)/g, '2'],
                [/(?:மூன்று|மூணு)/g, '3'],
                [/(?:நான்கு|நாலு)/g, '4'],
                [/(?:ஐந்து|அஞ்சு)/g, '5'],
                [/(?:ஆறு)/g, '6'],
                [/(?:ஏழு)/g, '7'],
                [/(?:எட்டு)/g, '8'],
                [/(?:ஒன்பது|ஒம்பது)/g, '9']
            ];
            for (const [re, d] of tamilDigitsMap) {
                s = s.replace(re, d);
            }

            // 2. Spoken English words to digits
            const engWords = {
                'zero': '0', 'one': '1', 'two': '2', 'three': '3', 'four': '4',
                'five': '5', 'six': '6', 'seven': '7', 'eight': '8', 'nine': '9'
            };
            for (const [w, d] of Object.entries(engWords)) {
                s = s.replace(new RegExp('\\b' + w + '\\b', 'gi'), d);
            }

            // 3. Tamil Unicode digits ௦-௯ to 0-9
            const tamilDigits = {'௦':'0','௧':'1','௨':'2','௩':'3','௪':'4','௫':'5','௬':'6','௭':'7','௮':'8','௯':'9'};
            s = s.replace(/[௦-௯]/g, d => tamilDigits[d]);

            // 4. Extract digits only
            let digits = s.replace(/\D/g, '');
            if (digits.length === 12 && digits.startsWith('91')) digits = digits.slice(2);
            if (digits.length === 11 && digits.startsWith('0')) digits = digits.slice(1);
            return digits.slice(0, 10);
        }

        function applySpokenValue(fieldId, rawText, isFinal) {
            const targetInput = document.getElementById(fieldId);
            if (!targetInput || !rawText) return;
            let cleaned = String(rawText).trim();

            if (fieldId === 'monthly_income') {
                cleaned = normalizeSalarySpeech(cleaned);
            } else if (fieldId === 'height') {
                cleaned = normalizeHeightSpeech(cleaned);
            } else if (fieldId === 'weight') {
                cleaned = normalizeWeightSpeech(cleaned);
            } else if (fieldId === 'birth_time') {
                cleaned = normalizeBirthTimeSpeech(cleaned);
            } else if (fieldId === 'father_mobile' || fieldId === 'mother_mobile' || fieldId.includes('phone') || fieldId.includes('mobile')) {
                cleaned = normalizePhoneSpeech(cleaned);
            } else if (fieldId === 'birth_place') {
                const hasOnlyDigits = /^\d+$/.test(cleaned.replace(/\s+/g, ''));
                const bpErr = document.getElementById('birth_place_error_msg');
                const toastMsg = document.getElementById('voiceToastMessage');

                if (hasOnlyDigits) {
                    const errMsg = (appLang === 'ta')
                        ? '⚠️ பிறந்த ஊரில் எண்கள் இருக்கக்கூடாது! ஊர் பெயரை மட்டும் கூறவும் (எ.கா: ஈரோடு, சென்னை).'
                        : '⚠️ Numbers are not allowed in Birth Place! Please speak place name only (e.g. Erode, Chennai).';
                    if (bpErr) {
                        bpErr.innerText = errMsg;
                        bpErr.style.display = 'block';
                    }
                    targetInput.style.borderColor = '#dc2626';
                    if (toastMsg) toastMsg.innerText = errMsg;
                    return;
                }

                if (bpErr) bpErr.style.display = 'none';
                targetInput.style.borderColor = '';
                cleaned = cleaned.replace(/^[,.\s\-_/]+|[,.\s\-_/]+$/g, '');
            } else {
                // ALL GENERAL & TEXT FIELDS: Name, Father Name, Mother Name, Kuladeivam, Gothram, Kootam,
                // Community, Job Title, Company, Education, Brothers, Sisters, Address, Thisai Iruppu, Expectations, etc.
                // STRICTLY KEEP AS SPOKEN WORDS! NEVER convert words or names to numbers!
                cleaned = cleaned.replace(/^[,.\s\-_/]+|[,.\s\-_/]+$/g, '');

                // Smart Capitalization for English names & titles
                if (fieldId === 'name' || fieldId === 'father_name' || fieldId === 'mother_name' || fieldId === 'kuladeivam' || fieldId === 'kootam') {
                    if (/^[a-zA-Z\s.]+$/.test(cleaned)) {
                        cleaned = cleaned.split(/\s+/).map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join(' ');
                    }
                }
            }

            if (targetInput.tagName === 'INPUT' || targetInput.tagName === 'TEXTAREA') {
                targetInput.value = cleaned;
                targetInput.dispatchEvent(new Event('input', { bubbles: true }));
                targetInput.dispatchEvent(new Event('change', { bubbles: true }));

                if (fieldId === 'community' && typeof syncCommunityDropdown === 'function') syncCommunityDropdown(cleaned);
                if (fieldId === 'job_title' && typeof syncJobDropdown === 'function') syncJobDropdown(cleaned);
                if (fieldId === 'education' && typeof syncEducationDropdown === 'function') syncEducationDropdown(cleaned);
                if (fieldId === 'birth_time' && typeof validateBirthTimeInput === 'function') validateBirthTimeInput();
                if (fieldId === 'birth_place' && typeof validateBirthPlaceInput === 'function') validateBirthPlaceInput();
                if (fieldId === 'father_mobile' || fieldId === 'mother_mobile') {
                    if (typeof validateMobileField === 'function') validateMobileField(targetInput, isFinal);
                }
            }

            const toastMsg = document.getElementById('voiceToastMessage');
            if (toastMsg) {
                toastMsg.innerText = isFinal ? `✓ பதிவு செய்யப்பட்டது: ${cleaned}` : `🎙️ கேட்கிறது: ${cleaned}`;
            }
        }

        function startMic(fieldId, btnEl) {
            if (fieldId === 'email') {
                return startEmailMic(btnEl);
            }
            if (fieldId === 'dob') {
                return startDobMic(btnEl);
            }
            if (fieldId === 'directorySearchInput' || fieldId === 'tableSearch') {
                return startSearchMic(btnEl);
            }
            const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
            const toast = document.getElementById('voiceAlertToast');
            const toastMsg = document.getElementById('voiceToastMessage');

            if (!SpeechRec) {
                alert(appLang === 'en' 
                    ? 'Voice recognition is not supported in this browser. Please use Google Chrome.' 
                    : 'உங்கள் உலாவியில் குரல் உள்ளீடு வசதி இல்லை. தயவுசெய்து Google Chrome உலாவியைப் பயன்படுத்தவும்.');
                return;
            }

            if (activeRecognition) {
                isUserEndingMic = true;
                if (micSilenceTimer) clearTimeout(micSilenceTimer);
                if (latestMicTranscript) applySpokenValue(fieldId, latestMicTranscript, true);
                try { activeRecognition.stop(); } catch (e) {}
                activeRecognition = null;
                if (activeMicBtn) {
                    activeMicBtn.classList.remove('is-active-recording');
                    activeMicBtn = null;
                }
                if (toast) {
                    setTimeout(() => { if (!activeRecognition) toast.style.display = 'none'; }, 1000);
                }
                return;
            }

            const targetInput = document.getElementById(fieldId);
            if (!targetInput) return;

            isUserEndingMic = false;
            micRetryCount = 0;
            latestMicTranscript = '';

            function initAndStartRecognition() {
                const recognition = new SpeechRec();
                // High-sensitivity continuous listening with real-time interim results
                recognition.continuous = true;
                recognition.interimResults = true;
                if ('maxAlternatives' in recognition) recognition.maxAlternatives = 5;
                recognition.lang = (appLang === 'en') ? 'en-IN' : 'ta-IN';

                activeRecognition = recognition;
                activeMicBtn = btnEl;

                if (btnEl) btnEl.classList.add('is-active-recording');
                if (toast) {
                    if (toastMsg) {
                        toastMsg.innerText = (appLang === 'en') 
                            ? '🎙️ Listening... Speak now (in English)...' 
                            : '🎙️ கேட்கிறது... இப்போது தெளிவாக பேசவும்...';
                    }
                    toast.style.display = 'flex';
                }

                const finalizeAndStop = function() {
                    isUserEndingMic = true;
                    if (micSilenceTimer) clearTimeout(micSilenceTimer);
                    if (latestMicTranscript) {
                        applySpokenValue(fieldId, latestMicTranscript, true);
                    }
                    try { recognition.stop(); } catch (e) {}
                };

                recognition.onresult = function(event) {
                    let fullTranscript = '';
                    for (let i = 0; i < event.results.length; i++) {
                        if (event.results[i] && event.results[i][0]) {
                            fullTranscript += ' ' + event.results[i][0].transcript;
                        }
                    }
                    fullTranscript = fullTranscript.trim();
                    if (fullTranscript) {
                        latestMicTranscript = fullTranscript;
                        applySpokenValue(fieldId, fullTranscript, false);

                        // High sensitivity debounce: 2.8 seconds of silence automatically finalizes without cutting off early
                        if (micSilenceTimer) clearTimeout(micSilenceTimer);
                        micSilenceTimer = setTimeout(finalizeAndStop, 2800);
                    }
                };

                recognition.onerror = function(event) {
                    if (event.error === 'no-speech') {
                        // User paused or preparing to speak - keep listening up to 2 retries (~15 seconds)
                        if (!isUserEndingMic && !latestMicTranscript && micRetryCount < 2) {
                            micRetryCount++;
                            if (toastMsg) {
                                toastMsg.innerText = (appLang === 'en')
                                    ? '🎙️ Still listening... Speak now...'
                                    : '🎙️ கேட்கிறது... தொடர்ந்து பேசவும்...';
                            }
                            return;
                        }
                    }
                    if (micSilenceTimer) clearTimeout(micSilenceTimer);
                    if (event.error !== 'no-speech') {
                        console.warn('Speech recognition notice:', event.error);
                        if (toastMsg) {
                            toastMsg.innerText = (appLang === 'en') ? 'Voice stopped.' : 'குரல் உள்ளீடு முடிந்தது.';
                        }
                        setTimeout(() => { if (toast && !activeRecognition) toast.style.display = 'none'; }, 1000);
                    }
                };

                recognition.onend = function() {
                    if (micSilenceTimer) clearTimeout(micSilenceTimer);
                    // If user hasn't spoken yet and hasn't clicked stop, restart smoothly to allow plenty of time to talk
                    if (!isUserEndingMic && !latestMicTranscript && micRetryCount < 2) {
                        micRetryCount++;
                        try {
                            recognition.start();
                            return;
                        } catch (e) {}
                    }
                    if (latestMicTranscript) {
                        applySpokenValue(fieldId, latestMicTranscript, true);
                    }
                    if (btnEl) btnEl.classList.remove('is-active-recording');
                    activeRecognition = null;
                    activeMicBtn = null;
                    setTimeout(() => { if (toast && !activeRecognition) toast.style.display = 'none'; }, 1200);
                };

                try {
                    recognition.start();
                } catch (err) {
                    console.error('Failed to start speech recognition:', err);
                    if (btnEl) btnEl.classList.remove('is-active-recording');
                    if (toast) toast.style.display = 'none';
                    activeRecognition = null;
                    activeMicBtn = null;
                }
            }

            initAndStartRecognition();
        }

        // Synchronize Tamil Month dropdown + date into hidden input (with 1-31 date clamp)
        function syncTamilMonthValue() {
            const m = document.getElementById('tamil_month_name')?.value || '';
            const dateEl = document.getElementById('tamil_month_date');
            if (dateEl && dateEl.value) {
                validateTamilDate(dateEl);
            }
            const d = dateEl?.value || '';
            const target = document.getElementById('tamil_month');
            if (target) {
                target.value = m ? (m + (d ? ' ' + d.trim() : '')) : '';
            }
        }

        // Dedicated Admin Panel Language Switcher
        function setAdminLanguage(lang) {
            adminLang = lang;
            const btnTa = document.getElementById('btnAdminTa');
            const btnEn = document.getElementById('btnAdminEn');
            if (btnTa && btnEn) {
                if (lang === 'ta') {
                    btnTa.style.background = '#881337';
                    btnTa.style.color = '#fff';
                    btnEn.style.background = 'transparent';
                    btnEn.style.color = '#475569';
                } else {
                    btnEn.style.background = '#881337';
                    btnEn.style.color = '#fff';
                    btnTa.style.background = 'transparent';
                    btnTa.style.color = '#475569';
                }
            }

            const isTa = (lang === 'ta');
            const setText = (id, text) => {
                const el = document.getElementById(id);
                if (el) el.innerText = text;
            };

            setText('adminPanelHeaderTitle', isTa ? 'அட்மின் பேனல் - ஆப்ஷன்கள் மேலாண்மை' : 'Admin Panel - Master Options Management');
            setText('adminPanelHeaderSub', isTa ? 'சமூகம், படிப்பு, வேலை ஆப்ஷன்களை சேர்க்க மற்றும் நீக்கலாம்' : 'Add, edit and manage options for Community, Education, and Job');
            setText('adminBackBtnTxt', isTa ? 'படிவத்திற்கு திரும்பு' : 'Back to Form');
            setText('adminBackBtnTxt2', isTa ? 'படிவத்திற்கு திரும்பு' : 'Back to Form');
            setText('lbl_admin_photo_setting_title', isTa ? 'அச்சுத்தாள் பொது அமைப்பு' : 'Global Print Sheet Setting');
            setText('lbl_admin_photo_setting_sub', isTa ? 'அனைத்து வரன்களின் அச்சுத்தாளில் படம் காட்ட வேண்டுமா அல்லது வெற்று இடமாக இருக்க வேண்டுமா?' : 'Should all candidate print sheets display photo or blank space?');
            setText('lbl_admin_photo_opt_yes', isTa ? 'ஆம் (படம் காட்டுக)' : 'Yes (Show Photo)');
            setText('lbl_admin_photo_opt_no', isTa ? 'இல்லை (வெற்று இடம்)' : 'No (Empty Space)');
            setText('lbl_add_title', isTa ? '➕ புதிய ஆப்ஷன் சேர்க்க:' : '➕ Add New Option:');
            setText('lbl_new_option_name', isTa ? 'ஆப்ஷன் பெயர் *' : 'Option Name *');
            setText('btnMasterAdd', isTa ? '+ சேர்க்க' : '+ Add Option');
            setText('lblCurrentTabList', isTa ? 'தற்போது உள்ள பட்டியல்கள்' : 'Current Active Options');
            setText('th_admin_name', isTa ? 'பெயர்' : 'Option Name');
            setText('th_admin_act', isTa ? 'செயல்கள்' : 'Actions');
            setText('lbl_admin_footer_hint', isTa ? '💡 ஆப்ஷன்களை உள்ளிட்ட உடனே படிவத்தின் Dropdown-களில் மாற்றங்கள் தானாக புதுப்பிக்கப்படும்.' : '💡 Options added or edited will immediately reflect in registration form dropdowns.');

            setText('lbl_mtab_comm', isTa ? 'சமூகம்' : 'Community / Caste');
            setText('lbl_mtab_edu', isTa ? 'படிப்பு' : 'Education');
            setText('lbl_mtab_job', isTa ? 'வேலை' : 'Job / Profession');
            setText('lbl_mtab_reg', isTa ? 'பதிவு எண் அமைப்பு' : 'Reg No Settings');
            setText('lbl_mtab_print_style', isTa ? '🎨 அச்சுத்தாள் வடிவமைப்பு' : '🎨 Print Styles');
            setText('lbl_mtab_auth', isTa ? 'நிர்வாக கணக்கு & கடவுச்சொல்' : 'Admin ID & Password');

            // Tabs Visibility Box translations
            setText('lbl_tab_vis_header', isTa ? 'Options பார்வை (Tabs Visibility):' : 'Options Visibility:');
            setText('lbl_vis_name_comm', isTa ? '👥 சமூகம் (Community)' : '👥 Community / Caste');
            setText('lbl_vis_name_edu', isTa ? '🎓 படிப்பு (Education)' : '🎓 Education');
            setText('lbl_vis_name_job', isTa ? '💼 வேலை (Job)' : '💼 Job / Profession');
            setText('lbl_vis_name_auth', isTa ? '🔐 கணக்கு (Admin ID & Pass)' : '🔐 Admin ID & Password');

            // Admin Auth / ID & Password Translations
            setText('lbl_admin_auth_title', isTa ? 'நிர்வாக உள்நுழைவு விபரங்கள் மாற்றம் (Change Admin Login ID & Password)' : 'Change Admin Login ID & Password');
            setText('lbl_admin_auth_sub', isTa ? 'Login பக்கத்தில் உள்நுழைவதற்கான ID மற்றும் கடவுச்சொல்லை இங்கு எளிதாக மாற்றிக்கொள்ளலாம்.' : 'Easily update the username/ID and password used to sign in to the portal.');
            setText('lbl_cur_user_prefix', isTa ? 'தற்போதைய பயனர் ID:' : 'Current User ID:');
            setText('lbl_cur_email_prefix', isTa ? 'மீட்டெடுப்பு மின்னஞ்சல்:' : 'Recovery Email:');
            setText('lbl_cur_pass_prefix', isTa ? 'தற்போதைய கடவுச்சொல்:' : 'Current Password:');
            setText('lbl_new_username', isTa ? 'புதிய பயனர் பெயர் அல்லது ID (New Username / ID) *' : 'New Username / ID *');
            setText('lbl_username_help', isTa ? 'Login செய்யும் போது இந்த ID-யை உள்ளிட வேண்டும்.' : 'Use this ID when logging into the system.');
            setText('lbl_admin_email', isTa ? 'மீட்டெடுப்பு மின்னஞ்சல் (Admin Recovery Email) *' : 'Admin Recovery Email *');
            setText('lbl_admin_email_help', isTa ? 'கடவுச்சொல் அல்லது ID மறந்துவிட்டால் OTP பெற இந்த மின்னஞ்சல் பயன்படும்.' : 'Used to receive OTP for password reset / ID recovery.');
            setText('lbl_new_password', isTa ? 'புதிய கடவுச்சொல் (New Password)' : 'New Password');
            setText('lbl_confirm_password', isTa ? 'புதிய கடவுச்சொல்லை உறுதி செய்க (Confirm New Password)' : 'Confirm New Password');
            setText('btn_save_auth_txt', isTa ? 'மாற்றங்களை சேமிக்கவும் (Save Changes)' : 'Save Changes');
            setText('btn_reset_auth_txt', isTa ? 'இயல்புநிலைக்கு மாற்றுக (Reset Default)' : 'Reset Default');
            setText('lbl_auth_note_title', isTa ? '💡 முக்கிய குறிப்பு (Important Note):' : '💡 Important Note:');
            setText('lbl_auth_note_body', isTa ? 'புதிய ID மற்றும் கடவுச்சொல்லை மாற்றிய பின்னர், அடுத்த முறை Login பக்கத்தில் நுழையும் போது இந்த புதிய விபரங்களை மட்டுமே பயன்படுத்த வேண்டும்.' : 'After changing your ID and password, you must use these new credentials to log in next time.');

            const authUInp = document.getElementById('admin_new_username');
            if (authUInp) authUInp.placeholder = isTa ? 'எ.கா: admin அல்லது master_matrimony' : 'e.g. admin or master_matrimony';
            const authEInp = document.getElementById('admin_new_email');
            if (authEInp) authEInp.placeholder = isTa ? 'எ.கா: admin@mastermatrimony.example' : 'e.g. admin@mastermatrimony.example';
            const authPInp = document.getElementById('admin_new_password');
            if (authPInp) authPInp.placeholder = isTa ? 'கடவுச்சொல் மாற்ற வேண்டுமெனில் மட்டும் உள்ளிடவும் (குறைந்தது 4 எழுத்துகள்)' : 'Enter new password (leave blank to keep unchanged)';
            const authCPInp = document.getElementById('admin_confirm_password');
            if (authCPInp) authCPInp.placeholder = isTa ? 'புதிய கடவுச்சொல்லை மீண்டும் உள்ளிடவும்' : 'Re-enter new password to confirm';

            // Strict Bilingual Separation for Print Styles Card
            setText('lbl_print_style_title', isTa ? 'அச்சுத்தாள் எழுத்து, வண்ண & வடிவமைப்பு அமைப்புகள்' : 'Print Typography, Colors & Highlight Settings');
            setText('lbl_print_style_sub', isTa 
                ? 'ஆண், பெண், மறுமணம் வரன்களுக்கு தனித்தனியாக இடதுபுற புலப் பெயர்கள் மற்றும் பதில்கள் வண்ணங்களை மாற்றியமைக்கலாம்.' 
                : 'Customize print typography, colors, field labels, and answers individually for Male, Female, and Remarriage biodatas.');

            // Section 1: Top Header Banner Title Typography
            setText('lbl_print_sec0_title', isTa ? '🏛️ 1. மேல் தலைப்பு பேனர் வடிவமைப்பு:' : '🏛️ 1. Top Header Banner Title Typography:');
            setText('lbl_print_sec0_badge', isTa ? 'மாஸ்டர் மணமாலை' : 'MASTER MATRIMONY');
            setText('lbl_print_sec0_desc', isTa 
                ? 'அச்சுத்தாளின் உச்சியில் உள்ள தலைப்புக்கான எழுத்து வடிவம், அளவு மற்றும் தடிமன் தனிப்பட்ட அமைப்புகள்:' 
                : 'Custom font family, size and weight settings for the print sheet top banner title:');
            setText('lbl_cfg_header_font_family', isTa ? 'தலைப்பு எழுத்து வடிவம்:' : 'Header Title Font Family:');
            setText('lbl_cfg_header_font_size', isTa ? 'தலைப்பு எழுத்து அளவு:' : 'Header Title Font Size:');
            setText('lbl_cfg_header_font_weight', isTa ? 'தலைப்பு எழுத்து தடிமன்:' : 'Header Title Font Weight:');

            const hffSel = document.getElementById('cfg_header_title_font_family');
            if (hffSel && hffSel.options.length >= 4) {
                hffSel.options[0].text = isTa ? 'Noto Serif Tamil (பாரம்பரிய தலைப்பு)' : 'Noto Serif Tamil (Traditional Heading)';
                hffSel.options[1].text = isTa ? 'Mukta Malar (நவீன எழுத்து)' : 'Mukta Malar (Modern Heading)';
                hffSel.options[2].text = isTa ? 'Baloo Thambi 2 (தடித்த எழுத்து)' : 'Baloo Thambi 2 (Bold Heading)';
                hffSel.options[3].text = isTa ? 'Arial / Standard' : 'Arial / Standard';
            }
            const hfsSel = document.getElementById('cfg_header_title_font_size');
            if (hfsSel) {
                for (let opt of hfsSel.options) {
                    if (opt.value === '19.5px') {
                        opt.text = isTa ? '19.5px (பரிந்துரைக்கப்பட்டது / இயல்பு)' : '19.5px (Recommended / Default)';
                    }
                }
            }
            const hfwSel = document.getElementById('cfg_header_title_font_weight');
            if (hfwSel && hfwSel.options.length >= 3) {
                hfwSel.options[0].text = isTa ? '700 - Bold' : '700 - Bold';
                hfwSel.options[1].text = isTa ? '800 - Extra Bold' : '800 - Extra Bold';
                hfwSel.options[2].text = isTa ? '900 - Black (அடர்த்தியான தடிமன்)' : '900 - Black (Extra Bold)';
            }

            // Section 2: Field Labels
            setText('lbl_print_sec2_title', isTa ? '🏷️ 2. இடதுபுற புலப் பெயர்கள்:' : '🏷️ 2. Left Field Labels:');
            setText('lbl_print_sec2_badge', isTa ? 'ஆண் = பச்சை, பெண் = பிங்க், மறுமணம் = நீலம்' : 'Male = Green, Female = Pink, Remarriage = Blue');
            setText('lbl_print_sec2_desc', isTa ? 'அச்சுத்தாளில் இடதுபுறம் உள்ள தலைப்புகளுக்கு மட்டும் தனித்தனி வண்ணங்கள்:' : 'Individual colors for left-side field label titles on print sheet:');
            setText('lbl_male_label_color', isTa ? '🤵 ஆண் வரன் புலப் பெயர் நிறம்:' : '🤵 Male Biodata Label Color:');
            setText('lbl_female_label_color', isTa ? '👰 பெண் வரன் புலப் பெயர் நிறம்:' : '👰 Female Biodata Label Color:');
            setText('lbl_remarriage_label_color', isTa ? '💍 மறுமணம் வரன் புலப் பெயர் நிறம்:' : '💍 Remarriage Biodata Label Color:');
            setText('lbl_label_font_family', isTa ? 'புலப் பெயர் எழுத்து வடிவம்:' : 'Field Label Font Family:');
            setText('lbl_label_font_size', isTa ? 'புலப் பெயர் எழுத்து அளவு:' : 'Field Label Font Size:');
            setText('lbl_label_font_weight', isTa ? 'புலப் பெயர் தடிமன்:' : 'Field Label Font Weight:');

            // Section 3: Field Answers
            setText('lbl_print_sec3_title', isTa ? '📝 3. புல பதில்கள்:' : '📝 3. Field Answers:');
            setText('lbl_print_sec3_badge', isTa ? 'ஆண் / பெண் / மறுமணம் பதில்களுக்கு தனித்தனி நிறம்' : 'Individual answer colors for Male, Female, Remarriage');
            setText('lbl_print_sec3_desc', isTa ? 'அச்சுத்தாளில் நிரப்பப்படும் பதில்களின் வண்ணங்கள் மற்றும் எழுத்து அமைப்புகள்:' : 'Colors and typography for filled answers on print sheet:');
            setText('lbl_male_answer_color', isTa ? '🤵 ஆண் வரன் பதில் நிறம்:' : '🤵 Male Biodata Answer Color:');
            setText('lbl_female_answer_color', isTa ? '👰 பெண் வரன் பதில் நிறம்:' : '👰 Female Biodata Answer Color:');
            setText('lbl_remarriage_answer_color', isTa ? '💍 மறுமணம் பதில் நிறம்:' : '💍 Remarriage Biodata Answer Color:');
            setText('lbl_answer_font_family', isTa ? 'பதில் எழுத்து வடிவம்:' : 'Answer Font Family:');
            setText('lbl_answer_font_size', isTa ? 'பதில் எழுத்து அளவு:' : 'Answer Font Size:');
            setText('lbl_answer_font_weight', isTa ? 'பதில் தடிமன்:' : 'Answer Font Weight:');

            // Blank Forms Bar (Available in Registration Form)
            setText('lbl_blank_sec_title', isTa ? '📄 வெற்றிட அச்சுப் படிவங்கள் (Download / Print Blank Forms):' : '📄 Download / Print Blank Biodata Forms:');
            setText('lbl_blank_sec_badge', isTa ? 'நேரடி அச்சு / PDF பதிவிறக்கம்' : 'Direct Print / PDF Download');
            setText('lbl_blank_sec_desc', isTa 
                ? 'கையால் எழுதக்கூடிய வெற்று வரன் படிவங்களை (ஆண், பெண், மறுமணம்) தமிழ் அல்லது ஆங்கிலத்தில் நேரடியாக அச்சிடலாம் அல்லது PDF ஆக பதிவிறக்கம் செய்யலாம்:' 
                : 'Download or print blank biodata forms (Male, Female, Remarriage) in Tamil or English ready for handwriting:');
            setText('lbl_blank_cat', isTa ? 'வரன் பிரிவு:' : 'Biodata Category:');
            setText('lbl_blank_lang', isTa ? 'படிவ மொழி:' : 'Form Language:');
            setText('opt_blank_cat_aan', isTa ? '🤵 ஆண் வரன்' : '🤵 Male Biodata (Groom)');
            setText('opt_blank_cat_penn', isTa ? '👰 பெண் வரன்' : '👰 Female Biodata (Bride)');
            setText('opt_blank_cat_maru_aan', isTa ? '💍 ஆண் மறுமணம்' : '💍 Male Remarriage (Groom)');
            setText('opt_blank_cat_maru_penn', isTa ? '💍 பெண் மறுமணம்' : '💍 Female Remarriage (Bride)');
            setText('opt_blank_lang_ta', isTa ? 'தமிழ்' : 'Tamil');
            setText('opt_blank_lang_en', isTa ? 'English' : 'English');
            setText('btn_print_blank_txt', isTa ? 'படிவத்தை அச்சிடுக / PDF' : 'Print / Download Blank Form');

            // Section 4: Live Preview
            setText('lbl_live_preview_title', isTa ? '✨ 4. நேரடி மாதிரி முன்னோட்டம்:' : '✨ 4. Live Sample Preview:');
            setText('lbl_live_preview_gender', isTa ? 'வரன் வகை:' : 'Biodata Type:');
            setText('prev_btn_male', isTa ? '🤵 ஆண்' : '🤵 Male');
            setText('prev_btn_female', isTa ? '👰 பெண்' : '👰 Female');
            setText('prev_btn_remarriage', isTa ? '💍 மறுமணம்' : '💍 Remarriage');
            setText('prev_lbl_name', isTa ? 'வரன் பெயர்:' : 'Candidate Name:');
            setText('prev_lbl_dob', isTa ? 'பிறந்த தேதி:' : 'Date of Birth:');
            setText('prev_lbl_edu', isTa ? 'வரனின் படிப்பு:' : 'Education:');
            setText('prev_lbl_job', isTa ? 'மாத வருமானம்:' : 'Monthly Income:');

            // Action Buttons
            setText('btn_save_print_style', isTa ? '💾 அமைப்புகளை சேமிக்க' : '💾 Save Print Styles');
            setText('btn_reset_print_style', isTa ? '↺ இயல்புநிலைக்கு மீட்டமைக்க' : '↺ Reset to Default');

            // Refresh all dropdown options in the selected language
            if (typeof loadSavedPrintStyleSettings === 'function') {
                loadSavedPrintStyleSettings();
            }


                        // Reg No Auto-Generation Settings Card Translations
            setText('lbl_reg_settings_title', isTa ? 'பதிவு எண் உருவாக்க அமைப்பு' : 'Registration Number Auto-Generation Settings');
            setText('lbl_reg_settings_subtitle', isTa 
                ? 'முன்னொட்டு, நடுப்பகுதி, எண் இலக்கங்கள், பின்னொட்டு போன்றவற்றை உங்கள் விருப்பத்திற்கேற்ப மாற்றியமைக்கலாம்.' 
                : 'Customize prefix, middle/year, digit sequence length, and suffix according to your requirements.');
            setText('lbl_reg_live_preview_tag', isTa ? '✓ நேரடி முன்னோட்டம்' : '✓ Live Preview');
            setText('lbl_reg_preview_heading', isTa ? '✨ அடுத்த பதிவு எண் மாதிரி:' : '✨ NEXT REGISTRATION NUMBER PREVIEW:');
            setText('lbl_reg_preview_hint', isTa 
                ? '(படிவத்தில் பதிவு எண் வெற்று விட்டால் மேலே உள்ள வடிவமைப்பில் தானாக உருவாகும்)' 
                : '(If left empty in the form, the registration number will be automatically generated in this format)');

            setText('lbl_reg_cfg_pfx', isTa ? '1. முன்னொட்டு *' : '1. Prefix *');
            setText('hint_reg_cfg_pfx', isTa ? 'முதல் பகுதி (வெற்று விட்டால் SAM)' : 'First part (Default: SAM)');
            const pfxInp = document.getElementById('reg_cfg_prefix');
            if (pfxInp) pfxInp.placeholder = isTa ? 'எ.கா: SAM, SGM, AGM' : 'e.g.: SAM, SGM, AGM';

            setText('lbl_reg_cfg_sep', isTa ? '2. பிரிப்பான்' : '2. Separator');
            setText('hint_reg_cfg_sep', isTa ? 'பகுதிகளுக்கு இடையே வரும் குறி' : 'Symbol between sections');
            setText('opt_reg_sep_hyphen', isTa ? 'ஹைபன் ( - ) எ.கா: SAM-2026-0001' : 'Hyphen ( - ) e.g.: SAM-2026-0001');
            setText('opt_reg_sep_slash', isTa ? 'ஸ்லாஷ் ( / ) எ.கா: SAM/2026/0001' : 'Slash ( / ) e.g.: SAM/2026/0001');
            setText('opt_reg_sep_underscore', isTa ? 'அண்டர்ஸ்கோர் ( _ ) எ.கா: SAM_2026_0001' : 'Underscore ( _ ) e.g.: SAM_2026_0001');
            setText('opt_reg_sep_none', isTa ? 'பிரிப்பான் இன்றி எ.கா: SAM20260001' : 'No Separator e.g.: SAM20260001');

            setText('lbl_reg_cfg_mid', isTa ? '3. நடுப்பகுதி / ஆண்டு' : '3. Middle / Year');
            setText('hint_reg_cfg_mid', isTa ? 'நடுவில் வர வேண்டிய ஆண்டு அல்லது உரை' : 'Year or custom text in the middle');
            setText('opt_reg_mid_year4', isTa ? 'நடப்பு ஆண்டு 4 இலக்கம் (எ.கா: 2026)' : 'Current 4-digit Year (e.g. 2026)');
            setText('opt_reg_mid_year2', isTa ? 'நடப்பு ஆண்டு 2 இலக்கம் (எ.கா: 26)' : 'Current 2-digit Year (e.g. 26)');
            setText('opt_reg_mid_tn', isTa ? 'மாநில குறியீடு (TN)' : 'State Code (TN)');
            setText('opt_reg_mid_erode', isTa ? 'மாவட்டம் (CHENNAI)' : 'District (CHENNAI)');
            setText('opt_reg_mid_none', isTa ? 'நடுப்பகுதி வேண்டாம் (வெற்று)' : 'No Middle Section (Empty)');
            setText('opt_reg_mid_custom', isTa ? 'சுய விருப்ப உரை...' : 'Custom Text...');
            const midCustInp = document.getElementById('reg_cfg_middle_custom');
            if (midCustInp) midCustInp.placeholder = isTa ? 'விருப்பமான உரையை உள்ளிடவும்' : 'Enter custom text';

            setText('lbl_reg_cfg_dig', isTa ? '4. எண் இலக்கங்கள்' : '4. Digit Length');
            setText('hint_reg_cfg_dig', isTa ? 'வரிசை எண்ணின் நீளம்' : 'Sequence number padding length');
            setText('opt_reg_dig_4', isTa ? '4 இலக்கங்கள் (0001, 0002...)' : '4 Digits (0001, 0002...)');
            setText('opt_reg_dig_5', isTa ? '5 இலக்கங்கள் (00001, 00002...)' : '5 Digits (00001, 00002...)');
            setText('opt_reg_dig_6', isTa ? '6 இலக்கங்கள் (000001, 000002...)' : '6 Digits (000001, 000002...)');
            setText('opt_reg_dig_3', isTa ? '3 இலக்கங்கள் (001, 002...)' : '3 Digits (001, 002...)');
            setText('opt_reg_dig_0', isTa ? 'பூஜ்ஜியம் இன்றி (1, 2, 3...)' : 'No Leading Zeros (1, 2, 3...)');

            setText('lbl_reg_cfg_suf', isTa ? '5. பின்னொட்டு (விருப்பத்திற்கு)' : '5. Suffix (Optional)');
            setText('hint_reg_cfg_suf', isTa ? 'கடைசியில் வர வேண்டிய எழுத்துக்கள் (தேவையெனில்)' : 'Characters at the end (if needed)');
            const sufInp = document.getElementById('reg_cfg_suffix');
            if (sufInp) sufInp.placeholder = isTa ? 'எ.கா: MTR, TN (வெற்று விடலாம்)' : 'e.g.: MTR, TN (Optional)';

            setText('btnSaveRegSettings', isTa ? '💾 அமைப்புகளை சேமிக்க' : '💾 Save Settings');
            setText('btnResetRegSettings', isTa ? '↺ இயல்புநிலைக்கு மீட்டமைக்க' : '↺ Reset to Default');
            setText('regSettingsSaveMsg', isTa ? '✓ வெற்றிகரமாக சேமிக்கப்பட்டது!' : '✓ Settings saved successfully!');

            const regNoticeEl = document.getElementById('lbl_reg_notice');
            if (regNoticeEl) {
                regNoticeEl.innerHTML = isTa
                    ? '💡 <strong>குறிப்பு:</strong> இந்த அமைப்பை மாற்றிய பின் சேமிக்கப்படும் புதிய வரன்களுக்கு மட்டுமே இது தானாக பொருந்தும். ஏற்கனவே உள்ள வரன்களின் பதிவு எண்கள் மாறாது. குறிப்பிட்ட வரனுக்கு நீங்களாகவே கைமுறையாகவும் பதிவு எண் தட்டச்சு செய்யலாம்.'
                    : '💡 <strong>Note:</strong> Changes to this setting will only apply to new profiles saved hereafter. Existing profile registration numbers will remain unchanged. You can also manually enter a custom registration number for any profile.';
            }

            const searchInput = document.getElementById('masterFilterSearch');
            if (searchInput) searchInput.placeholder = isTa ? 'தேடுக...' : 'Search options...';

            updateMasterInputPlaceholder();
            renderMasterTable(currentMasterTab);
        }

        function updateMasterInputPlaceholder() {
            const input = document.getElementById('master_new_name');
            if (!input) return;
            const isTa = (adminLang === 'ta');
            const placeholders = {
                community: {
                    ta: 'எ.கா: வன்னியர் / முதலியார் (தட்டச்சு அல்லது மைக் மூலம் பேசவும்)',
                    en: 'e.g.: Vanniyar / Mudaliar (Type or click mic to speak)'
                },
                education: {
                    ta: 'எ.கா: பி.டெக் / எம்பிஏ (தட்டச்சு அல்லது மைக் மூலம் பேசவும்)',
                    en: 'e.g.: B.Tech / MBA (Type or click mic to speak)'
                },
                job: {
                    ta: 'எ.கா: வங்கி மேலாளர் / ஆசிரியர் (தட்டச்சு அல்லது மைக் மூலம் பேசவும்)',
                    en: 'e.g.: Bank Manager / Teacher (Type or click mic to speak)'
                }
            };
            const p = placeholders[currentMasterTab] || placeholders.community;
            input.placeholder = isTa ? p.ta : p.en;
        }

        async function switchMasterTab(cat) {
            currentMasterTab = cat;
            const catInput = document.getElementById('master_new_cat');
            if (catInput) catInput.value = cat;

            const tComm = document.getElementById('mtab_comm');
            const tEdu = document.getElementById('mtab_edu');
            const tJob = document.getElementById('mtab_job');
            const tPrint = document.getElementById('mtab_print_style');
            const tAuth = document.getElementById('mtab_auth_settings');
            if (tComm) tComm.classList.toggle('active', cat === 'community');
            if (tEdu) tEdu.classList.toggle('active', cat === 'education');
            if (tJob) tJob.classList.toggle('active', cat === 'job');
            if (tPrint) tPrint.classList.toggle('active', cat === 'print_style_settings');
            if (tAuth) tAuth.classList.toggle('active', cat === 'auth_settings');

            const addCard = document.getElementById('masterAddCard');
            const tableCard = document.getElementById('masterTableCard');
            const printCard = document.getElementById('printStyleSettingsCard');
            const authCard = document.getElementById('adminAuthSettingsCard');

            if (cat === 'print_style_settings') {
                if (addCard) addCard.style.display = 'none';
                if (tableCard) tableCard.style.display = 'none';
                if (authCard) authCard.style.display = 'none';
                if (printCard) printCard.style.display = 'block';
                loadSavedPrintStyleSettings();
                updatePrintStylePreview();
            } else if (cat === 'auth_settings') {
                if (addCard) addCard.style.display = 'none';
                if (tableCard) tableCard.style.display = 'none';
                if (printCard) printCard.style.display = 'none';
                if (authCard) authCard.style.display = 'block';
                loadAdminAuthSetting();
            } else {
                if (addCard) addCard.style.display = 'block';
                if (tableCard) tableCard.style.display = 'block';
                if (printCard) printCard.style.display = 'none';
                if (authCard) authCard.style.display = 'none';
                updateMasterInputPlaceholder();
                await loadMasterOptions(cat);
            }
        }

        // ==========================================
        // PRINT STYLES & FIELD HIGHLIGHTS CONTROLLER
        // ==========================================
        const PRINT_COLOR_PRESETS = [
            { value: '#14532d', ta: 'அடர் வனப் பச்சை', en: 'Dark Forest Green' },
            { value: '#166534', ta: 'மரகதப் பச்சை', en: 'Emerald Green' },
            { value: '#059669', ta: 'நடுத்தரப் பச்சை', en: 'Medium Green' },
            { value: '#881337', ta: 'அரச மெரூன்', en: 'Royal Maroon' },
            { value: '#be185d', ta: 'ரோஜா பிங்க்', en: 'Deep Rose Pink' },
            { value: '#db2777', ta: 'பிரகாசமான பிங்க்', en: 'Vibrant Pink' },
            { value: '#b91c1c', ta: 'அடர் சிவப்பு', en: 'Crimson Red' },
            { value: '#dc2626', ta: 'சிவப்பு', en: 'Bright Red' },
            { value: '#0369a1', ta: 'ராயல் நீலம்', en: 'Royal Blue' },
            { value: '#1d4ed8', ta: 'அடர் நீலம்', en: 'Deep Blue' },
            { value: '#0284c7', ta: 'ஆகாய நீலம்', en: 'Sky Blue' },
            { value: '#002060', ta: 'அடர் நேவி நீலம்', en: 'Deep Navy Blue' },
            { value: '#6b21a8', ta: 'ராயல் ஊதா', en: 'Royal Purple' },
            { value: '#7c2d12', ta: 'அடர் பழுப்பு', en: 'Dark Chocolate Brown' },
            { value: '#b45309', ta: 'தங்கம் மற்றும் அம்பர்', en: 'Dark Amber Gold' },
            { value: '#1e293b', ta: 'அடர் ஸ்லேட் சாம்பல்', en: 'Dark Slate' },
            { value: '#000000', ta: 'கிளாசிக் கருப்பு', en: 'Classic Black' },
            { value: 'CUSTOM',  ta: 'விருப்ப நிறம்...', en: 'Custom Color...' }
        ];

        const PRINT_FONT_FAMILIES = [
            { value: "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif", ta: 'முக்தா மலர் (நேர்த்தி)', en: 'Mukta Malar (Classic)' },
            { value: "'Noto Sans Tamil', Arial, sans-serif", ta: 'நோட்டோ சான்ஸ் (தெளிவு)', en: 'Noto Sans Tamil (Clean)' },
            { value: "'Tiro Tamil', serif", ta: 'டிரோ தமிழ் (செரிஃப்)', en: 'Tiro Tamil (Serif)' },
            { value: "'Noto Serif Tamil', serif", ta: 'நோட்டோ செரிஃப் (பாரம்பரியம்)', en: 'Noto Serif Tamil (Traditional)' },
            { value: "'Catamaran', sans-serif", ta: 'கடமரன் (நவீன சான்ஸ்)', en: 'Catamaran (Modern Sans)' },
            { value: "'Arima', cursive", ta: 'அரிமா (கலை அழகு)', en: 'Arima (Calligraphy)' },
            { value: "'Kavivanar', cursive", ta: 'கவிவாணர் (கவிதை நயம்)', en: 'Kavivanar (Artistic)' },
            { value: "Arial, sans-serif", ta: 'ஏரியல் (எளிய வடிவம்)', en: 'Arial Standard' },
            { value: "Georgia, serif", ta: 'ஜார்ஜியா (அச்சு எழுத்து)', en: 'Georgia Serif' },
            { value: "'Times New Roman', serif", ta: 'டைம்ஸ் நியூ ரோமன்', en: 'Times New Roman' },
            { value: "Tahoma, sans-serif", ta: 'தஹோமா', en: 'Tahoma Sans' },
            { value: "'Trebuchet MS', sans-serif", ta: 'ட்ரெபுசெட்', en: 'Trebuchet MS' },
            { value: "Verdana, sans-serif", ta: 'வெர்டானா', en: 'Verdana' }
        ];

        const PRINT_FONT_SIZES = [
            '10px', '10.5px', '11px', '11.5px', '12px', '12.5px', '12.8px', '13px', '13.5px', '14px', '14.5px', '15px', '16px'
        ];

        const PRINT_FONT_WEIGHTS = [
            { value: '500', ta: '500 - மிதமானது', en: '500 - Medium' },
            { value: '600', ta: '600 - நடுத்தர தடிமன்', en: '600 - Semi Bold' },
            { value: '700', ta: '700 - தடிமன்', en: '700 - Bold' },
            { value: '800', ta: '800 - அதிக தடிமன்', en: '800 - Extra Bold' },
            { value: '900', ta: '900 - முழு தடிமன்', en: '900 - Black' }
        ];

        let currentPrintStyles = {
            fontFamily: "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif",
            fontSize: '12.8px',
            fontWeight: '800',
            maleLabelColor: '#14532d',
            femaleLabelColor: '#881337',
            remarriageLabelColor: '#0369a1',
            labelFontFamily: 'INHERIT',
            labelFontSize: 'INHERIT',
            labelFontWeight: '800',
            maleAnswerColor: '#000000',
            femaleAnswerColor: '#000000',
            remarriageAnswerColor: '#000000',
            answerFontFamily: 'INHERIT',
            answerFontSize: 'INHERIT',
            answerFontWeight: '700',
            highlights: {}
        };

        const fieldDisplayLabelsTa = {
            name: 'வரன் பெயர்',
            dob: 'பிறந்த தேதி',
            birth_time: 'பிறந்த நேரம்',
            birth_place: 'பிறந்த ஊர்',
            education: 'வரனின் படிப்பு',
            job_title: 'வேலை / தொழில்',
            company_details: 'நிறுவனம் & ஊர்',
            monthly_income: 'மாத வருமானம்',
            height: 'உயரம் & எடை',
            complexion: 'நிறம்',
            kuladeivam: 'குலதெய்வம்',
            gothram: 'கோத்திரம் & கூட்டம்',
            father_name: 'தந்தை பெயர்',
            father_mobile: 'தந்தை அலைபேசி',
            mother_name: 'தாய் பெயர்',
            mother_mobile: 'தாய் அலைபேசி',
            address: 'முழு முகவரி',
            rasi: 'ராசி',
            natchathiram: 'நட்சத்திரம்',
            lagnam: 'லக்னம்',
            dosham: 'தோஷம்',
            thisai_iruppu: 'திசை இருப்பு',
            expectations: 'எதிர்பார்ப்புகள்'
        };

        const fieldDisplayLabelsEn = {
            name: 'Candidate Name',
            dob: 'Date of Birth',
            birth_time: 'Birth Time',
            birth_place: 'Birth Place',
            education: 'Education',
            job_title: 'Job / Profession',
            company_details: 'Company & City',
            monthly_income: 'Monthly Income',
            height: 'Height & Weight',
            complexion: 'Complexion',
            kuladeivam: 'Kuladeivam',
            gothram: 'Gothram & Kootam',
            father_name: 'Father Name',
            father_mobile: 'Father Mobile',
            mother_name: 'Mother Name',
            mother_mobile: 'Mother Mobile',
            address: 'Full Address',
            rasi: 'Rasi',
            natchathiram: 'Star (Natchathiram)',
            lagnam: 'Lagnam',
            dosham: 'Dosham',
            thisai_iruppu: 'Dasa Balance',
            expectations: 'Expectations'
        };

        let previewGender = 'aan'; // 'aan', 'penn', 'marumanam'

        function populateColorSelect(selectId, activeVal, isTa) {
            const el = document.getElementById(selectId);
            if (!el) return;
            const normVal = (activeVal || '').toLowerCase();
            let hasMatch = false;
            let html = '';
            PRINT_COLOR_PRESETS.forEach(p => {
                const isSelected = (p.value !== 'CUSTOM' && p.value.toLowerCase() === normVal);
                if (isSelected) hasMatch = true;
                const txt = isTa ? p.ta : p.en;
                html += `<option value="${p.value}" ${isSelected ? 'selected' : ''}>${txt}</option>`;
            });
            el.innerHTML = html;
            if (!hasMatch) {
                el.value = 'CUSTOM';
            }
        }

        function populateFontSelect(selectId, activeVal, isTa, allowInherit) {
            const el = document.getElementById(selectId);
            if (!el) return;
            let html = '';
            if (allowInherit) {
                const inheritTxt = isTa ? 'பொதுவான வடிவம்' : 'Inherit Common Font';
                const isSel = (!activeVal || activeVal === 'INHERIT');
                html += `<option value="INHERIT" ${isSel ? 'selected' : ''}>${inheritTxt}</option>`;
            }
            PRINT_FONT_FAMILIES.forEach(f => {
                const isSel = (activeVal && activeVal === f.value);
                const txt = isTa ? f.ta : f.en;
                html += `<option value="${f.value}" ${isSel ? 'selected' : ''}>${txt}</option>`;
            });
            el.innerHTML = html;
            if (activeVal) el.value = activeVal;
        }

        function populateSizeSelect(selectId, activeVal, isTa, allowInherit) {
            const el = document.getElementById(selectId);
            if (!el) return;
            let html = '';
            if (allowInherit) {
                const inheritTxt = isTa ? 'பொதுவான அளவு' : 'Inherit Base Size';
                const isSel = (!activeVal || activeVal === 'INHERIT');
                html += `<option value="INHERIT" ${isSel ? 'selected' : ''}>${inheritTxt}</option>`;
            }
            PRINT_FONT_SIZES.forEach(sz => {
                const isSel = (activeVal && activeVal === sz);
                let txt = sz;
                if (sz === '12.8px') txt += isTa ? ' - இயல்பு' : ' - Default';
                html += `<option value="${sz}" ${isSel ? 'selected' : ''}>${txt}</option>`;
            });
            el.innerHTML = html;
            if (activeVal) el.value = activeVal;
        }

        function populateWeightSelect(selectId, activeVal, isTa, allowInherit) {
            const el = document.getElementById(selectId);
            if (!el) return;
            let html = '';
            if (allowInherit) {
                const inheritTxt = isTa ? 'பொதுவான தடிமன்' : 'Inherit Base Weight';
                const isSel = (!activeVal || activeVal === 'INHERIT');
                html += `<option value="INHERIT" ${isSel ? 'selected' : ''}>${inheritTxt}</option>`;
            }
            PRINT_FONT_WEIGHTS.forEach(w => {
                const isSel = (activeVal && String(activeVal) === w.value);
                const txt = isTa ? w.ta : w.en;
                html += `<option value="${w.value}" ${isSel ? 'selected' : ''}>${txt}</option>`;
            });
            el.innerHTML = html;
            if (activeVal) el.value = String(activeVal);
        }

        function onColorPresetChange(pickerId, val) {
            const picker = document.getElementById(pickerId);
            if (val === 'CUSTOM') {
                if (picker) picker.click();
            } else {
                if (picker) picker.value = val;
                updatePrintStylePreview();
            }
        }

        function onColorPickerChange(selectId, hexVal) {
            const sel = document.getElementById(selectId);
            if (!sel) {
                updatePrintStylePreview();
                return;
            }
            const normHex = hexVal.toLowerCase();
            let found = false;
            for (let i = 0; i < sel.options.length; i++) {
                if (sel.options[i].value.toLowerCase() === normHex) {
                    sel.selectedIndex = i;
                    found = true;
                    break;
                }
            }
            if (!found) {
                sel.value = 'CUSTOM';
            }
            updatePrintStylePreview();
        }

        function switchPreviewGender(g) {
            previewGender = g;
            const btnM = document.getElementById('prev_btn_male');
            const btnF = document.getElementById('prev_btn_female');
            const btnR = document.getElementById('prev_btn_remarriage');
            const isTa = (adminLang === 'ta');

            if (btnM) {
                btnM.style.background = (g === 'aan') ? '#14532d' : '#f1f5f9';
                btnM.style.color = (g === 'aan') ? '#fff' : '#64748b';
                btnM.style.border = (g === 'aan') ? 'none' : '1px solid #cbd5e1';
            }
            if (btnF) {
                btnF.style.background = (g === 'penn') ? '#881337' : '#f1f5f9';
                btnF.style.color = (g === 'penn') ? '#fff' : '#64748b';
                btnF.style.border = (g === 'penn') ? 'none' : '1px solid #cbd5e1';
            }
            if (btnR) {
                btnR.style.background = (g === 'marumanam') ? '#0369a1' : '#f1f5f9';
                btnR.style.color = (g === 'marumanam') ? '#fff' : '#64748b';
                btnR.style.border = (g === 'marumanam') ? 'none' : '1px solid #cbd5e1';
            }

            // Update sample values in preview box
            const valName = document.getElementById('prev_val_name');
            const valDob = document.getElementById('prev_val_dob');
            const valEdu = document.getElementById('prev_val_edu');
            const valJob = document.getElementById('prev_val_job');

            if (g === 'aan') {
                if (valName) valName.textContent = isTa ? 'சரவணகுமார் M' : 'Saravanakumar M';
                if (valDob) valDob.textContent = '20-05-1998';
                if (valEdu) valEdu.textContent = 'M.E / M.Tech';
                if (valJob) valJob.textContent = isTa ? 'ரூ. 1,25,000 / மாதம்' : 'Rs. 1,25,000 / Month';
            } else if (g === 'penn') {
                if (valName) valName.textContent = isTa ? 'அமிர்தவடிவு S' : 'Amirthavadivu S';
                if (valDob) valDob.textContent = '14-08-2001';
                if (valEdu) valEdu.textContent = 'B.Tech IT';
                if (valJob) valJob.textContent = isTa ? 'ரூ. 85,000 / மாதம்' : 'Rs. 85,000 / Month';
            } else {
                if (valName) valName.textContent = isTa ? 'கார்த்திகேயன் R (மறுமணம்)' : 'Karthikeyan R (Remarriage)';
                if (valDob) valDob.textContent = '10-02-1990';
                if (valEdu) valEdu.textContent = 'B.E (Mechanical)';
                if (valJob) valJob.textContent = isTa ? 'ரூ. 90,000 / மாதம்' : 'Rs. 90,000 / Month';
            }

            updatePrintStylePreview();
        }

        function updatePrintStylePreview() {
            // Read Common Typography
            const hdrFamily = document.getElementById('cfg_header_title_font_family') ? document.getElementById('cfg_header_title_font_family').value : "'Noto Serif Tamil', 'Mukta Malar', 'Baloo Thambi 2', 'Latha', serif";
            const hdrSize = document.getElementById('cfg_header_title_font_size') ? document.getElementById('cfg_header_title_font_size').value : '19.5px';
            const hdrWeight = document.getElementById('cfg_header_title_font_weight') ? document.getElementById('cfg_header_title_font_weight').value : '900';
            currentPrintStyles.headerTitleFontFamily = hdrFamily;
            currentPrintStyles.headerTitleFontSize = hdrSize;
            currentPrintStyles.headerTitleFontWeight = hdrWeight;

            const fFamily = document.getElementById('cfg_print_font_family') ? document.getElementById('cfg_print_font_family').value : (currentPrintStyles.fontFamily || "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif");
            const fSize = document.getElementById('cfg_print_font_size') ? document.getElementById('cfg_print_font_size').value : (currentPrintStyles.fontSize || '12.8px');
            const fWeight = document.getElementById('cfg_print_font_weight') ? document.getElementById('cfg_print_font_weight').value : (currentPrintStyles.fontWeight || '800');

            // Read Label Settings
            const maleLabelCol = document.getElementById('cfg_male_label_color') ? document.getElementById('cfg_male_label_color').value : '#14532d';
            const femaleLabelCol = document.getElementById('cfg_female_label_color') ? document.getElementById('cfg_female_label_color').value : '#881337';
            const remarriageLabelCol = document.getElementById('cfg_remarriage_label_color') ? document.getElementById('cfg_remarriage_label_color').value : '#0369a1';
            const labelFF = document.getElementById('cfg_label_font_family') ? document.getElementById('cfg_label_font_family').value : 'INHERIT';
            const labelFS = document.getElementById('cfg_label_font_size') ? document.getElementById('cfg_label_font_size').value : 'INHERIT';
            const labelFW = document.getElementById('cfg_label_font_weight') ? document.getElementById('cfg_label_font_weight').value : '800';

            // Read Answer Settings
            const maleAnsCol = document.getElementById('cfg_male_answer_color') ? document.getElementById('cfg_male_answer_color').value : '#000000';
            const femaleAnsCol = document.getElementById('cfg_female_answer_color') ? document.getElementById('cfg_female_answer_color').value : '#000000';
            const remarriageAnsCol = document.getElementById('cfg_remarriage_answer_color') ? document.getElementById('cfg_remarriage_answer_color').value : '#000000';
            const ansFF = document.getElementById('cfg_answer_font_family') ? document.getElementById('cfg_answer_font_family').value : 'INHERIT';
            const ansFS = document.getElementById('cfg_answer_font_size') ? document.getElementById('cfg_answer_font_size').value : 'INHERIT';
            const ansFW = document.getElementById('cfg_answer_font_weight') ? document.getElementById('cfg_answer_font_weight').value : '700';

            // Update currentPrintStyles state
            currentPrintStyles.fontFamily = fFamily;
            currentPrintStyles.fontSize = fSize;
            currentPrintStyles.fontWeight = fWeight;

            currentPrintStyles.maleLabelColor = maleLabelCol;
            currentPrintStyles.femaleLabelColor = femaleLabelCol;
            currentPrintStyles.remarriageLabelColor = remarriageLabelCol;
            currentPrintStyles.labelFontFamily = labelFF;
            currentPrintStyles.labelFontSize = labelFS;
            currentPrintStyles.labelFontWeight = labelFW;

            currentPrintStyles.maleAnswerColor = maleAnsCol;
            currentPrintStyles.femaleAnswerColor = femaleAnsCol;
            currentPrintStyles.remarriageAnswerColor = remarriageAnsCol;
            currentPrintStyles.answerFontFamily = ansFF;
            currentPrintStyles.answerFontSize = ansFS;
            currentPrintStyles.answerFontWeight = ansFW;

            const effLabelFF = (labelFF === 'INHERIT') ? fFamily : labelFF;
            const effLabelFS = (labelFS === 'INHERIT') ? fSize : labelFS;
            const effLabelFW = (labelFW === 'INHERIT') ? fWeight : labelFW;
            const effAnsFF = (ansFF === 'INHERIT') ? fFamily : ansFF;
            const effAnsFS = (ansFS === 'INHERIT') ? fSize : ansFS;
            const effAnsFW = (ansFW === 'INHERIT') ? fWeight : ansFW;

            // Resolve active colors based on current preview gender
            let activeLabelColor = currentPrintStyles.maleLabelColor;
            let activeAnswerColor = currentPrintStyles.maleAnswerColor;
            let activeBorderColor = '#14532d';

            if (previewGender === 'penn') {
                activeLabelColor = currentPrintStyles.femaleLabelColor;
                activeAnswerColor = currentPrintStyles.femaleAnswerColor;
                activeBorderColor = '#881337';
            } else if (previewGender === 'marumanam') {
                activeLabelColor = currentPrintStyles.remarriageLabelColor;
                activeAnswerColor = currentPrintStyles.remarriageAnswerColor;
                activeBorderColor = '#0369a1';
            }

            // Apply to live sample preview box
            const prevBox = document.getElementById('printStyleLivePreview');
            if (prevBox) {
                prevBox.style.fontFamily = fFamily;
                prevBox.style.borderColor = activeBorderColor;

                ['name', 'dob', 'edu', 'job'].forEach(item => {
                    const lbl = prevBox.querySelector(`#prev_lbl_${item}`);
                    const val = prevBox.querySelector(`#prev_val_${item}`);

                    if (lbl) {
                        lbl.style.color = activeLabelColor;
                        lbl.style.fontFamily = effLabelFF;
                        lbl.style.fontSize = effLabelFS;
                        lbl.style.fontWeight = effLabelFW;
                        lbl.style.fontStyle = 'normal';
                        lbl.style.textDecoration = 'none';
                    }

                    if (val) {
                        val.style.color = activeAnswerColor;
                        val.style.fontSize = effAnsFS;
                        val.style.fontWeight = effAnsFW;
                        val.style.fontStyle = 'normal';
                        val.style.textDecoration = 'none';
                        val.style.fontFamily = effAnsFF;
                    }
                });
            }
        }

        function addPrintHighlightField() {}
        function removePrintHighlightField(field) {}
        function renderPrintHighlightsTags() {}

        function openBlankBiodataForm() {
            const catEl = document.getElementById('blank_form_cat');
            const langEl = document.getElementById('blank_form_lang');
            const cat = catEl ? catEl.value : 'aan';
            const lang = langEl ? langEl.value : 'ta';
            const url = '/matrimony/print-blank?gender=' + encodeURIComponent(cat) + '&lang=' + encodeURIComponent(lang);
            window.open(url, '_blank');
        }

        function savePrintStyleSettings() {
            localStorage.setItem('matrimony_print_styles', JSON.stringify(currentPrintStyles));
            try {
                fetch('/matrimony/print-style-setting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        styles: currentPrintStyles
                    })
                })
                .then(async r => {
                    if (!r.ok) {
                        const errTxt = await r.text();
                        console.warn('Sync print styles response not ok:', r.status, errTxt);
                    } else {
                        return r.json();
                    }
                })
                .then(data => {
                    if (data && data.styles) {
                        currentPrintStyles = Object.assign({}, currentPrintStyles, data.styles);
                    }
                })
                .catch(e => console.warn('Sync print styles failed:', e));
            } catch(e) {}

            const msg = document.getElementById('printStyleSaveMsg');
            if (msg) {
                const isTa = (adminLang === 'ta');
                msg.textContent = isTa 
                    ? '✓ அச்சுத்தாள் வடிவமைப்பு அமைப்புகள் வெற்றிகரமாக சேமிக்கப்பட்டன!' 
                    : '✓ Print style settings saved successfully!';
                msg.style.display = 'inline';
                setTimeout(() => { msg.style.display = 'none'; }, 3000);
            }
        }

        function resetPrintStyleSettingsToDefault() {
            currentPrintStyles = {
                headerTitleFontFamily: "'Noto Serif Tamil', serif",
                headerTitleFontSize: '19.5px',
                headerTitleFontWeight: '900',
                fontFamily: "'Mukta Malar', 'Plus Jakarta Sans', Arial, sans-serif",
                fontSize: '12.8px',
                fontWeight: '800',
                maleLabelColor: '#14532d',
                femaleLabelColor: '#881337',
                remarriageLabelColor: '#0369a1',
                labelFontFamily: 'INHERIT',
                labelFontSize: 'INHERIT',
                labelFontWeight: '800',
                maleAnswerColor: '#000000',
                femaleAnswerColor: '#000000',
                remarriageAnswerColor: '#000000',
                answerFontFamily: 'INHERIT',
                answerFontSize: 'INHERIT',
                answerFontWeight: '700',
                highlights: {}
            };
            localStorage.removeItem('matrimony_print_styles');
            try {
                fetch('/matrimony/print-style-setting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        styles: currentPrintStyles
                    })
                }).catch(e => console.warn('Reset sync failed:', e));
            } catch(e) {}
            loadSavedPrintStyleSettings();
            updatePrintStylePreview();
            const msg = document.getElementById('printStyleSaveMsg');
            if (msg) {
                const isTa = (adminLang === 'ta');
                msg.textContent = isTa ? '↺ இயல்புநிலைக்கு மீட்டமைக்கப்பட்டது!' : '↺ Reset to Default Settings!';
                msg.style.display = 'inline';
                setTimeout(() => { msg.style.display = 'none'; }, 3000);
            }
        }

        function loadSavedPrintStyleSettings() {
            let combinedHl = {};
            // 1. Merge server print styles first (Syncs phone & laptop!)
            if (window.__SERVER_PRINT_STYLES__ && typeof window.__SERVER_PRINT_STYLES__ === 'object' && Object.keys(window.__SERVER_PRINT_STYLES__).length > 0) {
                currentPrintStyles = Object.assign({}, currentPrintStyles, window.__SERVER_PRINT_STYLES__);
                if (window.__SERVER_PRINT_STYLES__.highlights && typeof window.__SERVER_PRINT_STYLES__.highlights === 'object') {
                    Object.assign(combinedHl, window.__SERVER_PRINT_STYLES__.highlights);
                }
            }
            // 2. Merge local storage print styles (Preserves active local choices!)
            try {
                const saved = localStorage.getItem('matrimony_print_styles');
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (parsed && typeof parsed === 'object') {
                        if (parsed.highlights && typeof parsed.highlights === 'object' && Object.keys(parsed.highlights).length > 0) {
                            Object.assign(combinedHl, parsed.highlights);
                        }
                        currentPrintStyles = Object.assign({}, currentPrintStyles, parsed);
                    }
                }
            } catch(e) {}
            if (Object.keys(combinedHl).length > 0) {
                currentPrintStyles.highlights = combinedHl;
            }

            const isTa = (adminLang === 'ta');

            // Populate all select dropdowns with translated option lists
            const hffEl = document.getElementById('cfg_header_title_font_family');
            if (hffEl && hffEl.options.length >= 4) {
                hffEl.options[0].text = isTa ? 'Noto Serif Tamil (பாரம்பரிய தலைப்பு)' : 'Noto Serif Tamil (Traditional Heading)';
                hffEl.options[1].text = isTa ? 'Mukta Malar (நவீன எழுத்து)' : 'Mukta Malar (Modern Heading)';
                hffEl.options[2].text = isTa ? 'Baloo Thambi 2 (தடித்த எழுத்து)' : 'Baloo Thambi 2 (Bold Heading)';
                hffEl.options[3].text = isTa ? 'Arial / Standard' : 'Arial / Standard';
            }
            const hfsEl_opt = document.getElementById('cfg_header_title_font_size');
            if (hfsEl_opt) {
                for (let opt of hfsEl_opt.options) {
                    if (opt.value === '19.5px') {
                        opt.text = isTa ? '19.5px (பரிந்துரைக்கப்பட்டது / இயல்பு)' : '19.5px (Recommended / Default)';
                    }
                }
            }
            const hfwEl_opt = document.getElementById('cfg_header_title_font_weight');
            if (hfwEl_opt && hfwEl_opt.options.length >= 3) {
                hfwEl_opt.options[0].text = isTa ? '700 - Bold' : '700 - Bold';
                hfwEl_opt.options[1].text = isTa ? '800 - Extra Bold' : '800 - Extra Bold';
                hfwEl_opt.options[2].text = isTa ? '900 - Black (அடர்த்தியான தடிமன்)' : '900 - Black (Extra Bold)';
            }
            if (hffEl && currentPrintStyles.headerTitleFontFamily) hffEl.value = currentPrintStyles.headerTitleFontFamily;
            const hfsEl = document.getElementById('cfg_header_title_font_size');
            if (hfsEl && currentPrintStyles.headerTitleFontSize) hfsEl.value = currentPrintStyles.headerTitleFontSize;
            const hfwEl = document.getElementById('cfg_header_title_font_weight');
            if (hfwEl && currentPrintStyles.headerTitleFontWeight) hfwEl.value = currentPrintStyles.headerTitleFontWeight;

            populateFontSelect('cfg_print_font_family', currentPrintStyles.fontFamily, isTa, false);
            populateSizeSelect('cfg_print_font_size', currentPrintStyles.fontSize, isTa, false);
            populateWeightSelect('cfg_print_font_weight', currentPrintStyles.fontWeight, isTa);

            // Labels
            populateColorSelect('cfg_male_label_color_sel', currentPrintStyles.maleLabelColor, isTa);
            populateColorSelect('cfg_female_label_color_sel', currentPrintStyles.femaleLabelColor, isTa);
            populateColorSelect('cfg_remarriage_label_color_sel', currentPrintStyles.remarriageLabelColor, isTa);
            const mlc = document.getElementById('cfg_male_label_color');
            const flc = document.getElementById('cfg_female_label_color');
            const rlc = document.getElementById('cfg_remarriage_label_color');
            if (mlc) mlc.value = currentPrintStyles.maleLabelColor || '#14532d';
            if (flc) flc.value = currentPrintStyles.femaleLabelColor || '#881337';
            if (rlc) rlc.value = currentPrintStyles.remarriageLabelColor || '#0369a1';

            populateFontSelect('cfg_label_font_family', currentPrintStyles.labelFontFamily, isTa, true);
            populateSizeSelect('cfg_label_font_size', currentPrintStyles.labelFontSize, isTa, true);
            populateWeightSelect('cfg_label_font_weight', currentPrintStyles.labelFontWeight, isTa, true);

            // Answers
            populateColorSelect('cfg_male_answer_color_sel', currentPrintStyles.maleAnswerColor, isTa);
            populateColorSelect('cfg_female_answer_color_sel', currentPrintStyles.femaleAnswerColor, isTa);
            populateColorSelect('cfg_remarriage_answer_color_sel', currentPrintStyles.remarriageAnswerColor, isTa);
            const mac = document.getElementById('cfg_male_answer_color');
            const fac = document.getElementById('cfg_female_answer_color');
            const rac = document.getElementById('cfg_remarriage_answer_color');
            if (mac) mac.value = currentPrintStyles.maleAnswerColor || '#000000';
            if (fac) fac.value = currentPrintStyles.femaleAnswerColor || '#000000';
            if (rac) rac.value = currentPrintStyles.remarriageAnswerColor || '#000000';

            populateFontSelect('cfg_answer_font_family', currentPrintStyles.answerFontFamily, isTa, true);
            populateSizeSelect('cfg_answer_font_size', currentPrintStyles.answerFontSize, isTa, true);
            populateWeightSelect('cfg_answer_font_weight', currentPrintStyles.answerFontWeight, isTa, true);

            updatePrintStylePreview();
        }

        async function loadMasterOptions(cat) {
            try {
                const res = await fetch(`/matrimony/master-options?category=${cat}`);
                const json = await res.json();
                if (json.success) {
                    masterOptionsData[cat] = json.options;
                    renderMasterTable(cat);
                    updateMasterCounts();
                }
            } catch (err) {
                console.error('Failed to load master options:', err);
            }
        }

        async function updateMasterCounts() {
            try {
                const res = await fetch('/matrimony/master-options');
                const json = await res.json();
                if (json.success) {
                    const all = json.options;
                    const commCount = all.filter(o => o.category === 'community').length;
                    const eduCount = all.filter(o => o.category === 'education').length;
                    const jobCount = all.filter(o => o.category === 'job').length;
                    if (document.getElementById('count_comm')) document.getElementById('count_comm').innerText = commCount;
                    if (document.getElementById('count_edu')) document.getElementById('count_edu').innerText = eduCount;
                    if (document.getElementById('count_job')) document.getElementById('count_job').innerText = jobCount;
                }
            } catch (e) {}
        }

        function renderMasterTable(cat, filterQuery = '') {
            const tbody = document.getElementById('masterOptionsTableBody');
            if (!tbody) return;
            let list = masterOptionsData[cat] || [];
            if (filterQuery && filterQuery.trim()) {
                const q = filterQuery.toLowerCase().trim();
                list = list.filter(o => (o.name_ta && o.name_ta.toLowerCase().includes(q)) || (o.name_en && o.name_en.toLowerCase().includes(q)));
            }

            const isTa = (adminLang === 'ta');
            if (list.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" style="text-align:center; padding: 22px; color:#94a3b8; font-size:13.5px;">${isTa ? 'எந்த ஆப்ஷனும் கிடைக்கவில்லை.' : 'No options found.'}</td></tr>`;
                return;
            }

            let html = '';
            list.forEach((opt, idx) => {
                const displayName = isTa ? (opt.name_ta || opt.name_en) : (opt.name_en || opt.name_ta);
                const safeTa = (opt.name_ta || '').replace(/'/g, "\\'");
                const safeEn = (opt.name_en || '').replace(/'/g, "\\'");
                html += `
                    <tr id="master_row_${opt.id}">
                        <td style="color:#64748b; font-weight:700;">${idx + 1}</td>
                        <td id="cell_name_${opt.id}" style="font-weight:700; color:#0f172a; font-size:14px;">${displayName}</td>
                        <td style="text-align:right;">
                            <button type="button" class="btn-action-icon btn-edit" onclick="editMasterOption(${opt.id}, '${safeTa}', '${safeEn}')" title="Edit" style="padding:4px 10px; font-size:12px;">
                                ✏️ ${isTa ? 'திருத்து' : 'Edit'}
                            </button>
                            <button type="button" class="btn-action-icon btn-delete" onclick="deleteMasterOption(${opt.id})" title="Delete" style="padding:4px 10px; font-size:12px; margin-left:4px;">
                                🗑️ ${isTa ? 'நீக்கு' : 'Delete'}
                            </button>
                        </td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
        }

        function filterMasterList(q) {
            renderMasterTable(currentMasterTab, q);
        }

        async function submitNewMasterOption(event) {
            event.preventDefault();
            const cat = currentMasterTab;
            const nameInput = document.getElementById('master_new_name');
            const nameVal = nameInput ? nameInput.value.trim() : '';
            const btn = document.getElementById('btnMasterAdd');

            if (!nameVal) return;
            if (btn) {
                btn.disabled = true;
                btn.innerText = (adminLang === 'ta') ? 'சேர்க்கிறது...' : 'Adding...';
            }

            try {
                const csrfToken = '{{ csrf_token() }}';
                const res = await fetch('/matrimony/master-options', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ category: cat, name_ta: nameVal, name_en: nameVal })
                });
                const json = await res.json();
                if (json.success) {
                    if (nameInput) nameInput.value = '';
                    await loadMasterOptions(cat);
                    await refreshFormSelect(cat);
                } else {
                    alert(json.message || (adminLang === 'ta' ? 'பிழை ஏற்பட்டது' : 'An error occurred'));
                }
            } catch (err) {
                console.error('Error adding master option:', err);
                alert(adminLang === 'ta' ? 'சேர்க்க முடியவில்லை. மீண்டும் முயற்சிக்கவும்.' : 'Could not add option. Please try again.');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerText = (adminLang === 'ta') ? '+ சேர்க்க' : '+ Add Option';
                }
            }
        }

        function editMasterOption(id, nameTa, nameEn) {
            const row = document.getElementById('master_row_' + id);
            if (!row) return;

            const isTa = (adminLang === 'ta');
            const currentVal = isTa ? (nameTa || nameEn) : (nameEn || nameTa);

            row.innerHTML = `
                <td style="color:#64748b; font-weight:700;">#</td>
                <td><input type="text" id="edit_name_${id}" value="${currentVal}" class="input-text" style="height:34px; font-size:13px; width:100%;"></td>
                <td style="text-align:right;">
                    <button type="button" class="btn-action-icon btn-view" onclick="saveEditMasterOption(${id})" style="padding:4px 10px; font-size:12px; background:#10b981; color:#fff; border-color:#10b981; cursor:pointer;">
                        ✓ ${isTa ? 'சேமி' : 'Save'}
                    </button>
                    <button type="button" class="btn-action-icon" onclick="renderMasterTable(currentMasterTab)" style="padding:4px 10px; font-size:12px; margin-left:4px; cursor:pointer;">
                        ✕
                    </button>
                </td>
            `;
        }

        async function saveEditMasterOption(id) {
            const input = document.getElementById('edit_name_' + id);
            const newName = input ? input.value.trim() : '';
            if (!newName) {
                alert(adminLang === 'ta' ? 'பெயர் அவசியம்!' : 'Name is required!');
                return;
            }

            try {
                const csrfToken = '{{ csrf_token() }}';
                const res = await fetch(`/matrimony/master-options/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name_ta: newName, name_en: newName })
                });
                const json = await res.json();
                if (json.success) {
                    await loadMasterOptions(currentMasterTab);
                    await refreshFormSelect(currentMasterTab);
                } else {
                    alert(json.message || (adminLang === 'ta' ? 'பிழை ஏற்பட்டது' : 'An error occurred'));
                }
            } catch (err) {
                console.error('Error saving master option:', err);
                alert(adminLang === 'ta' ? 'சேமிக்க முடியவில்லை.' : 'Could not save option.');
            }
        }

        async function deleteMasterOption(id) {
            const msg = (adminLang === 'ta') ? 'இந்த ஆப்ஷனை நீக்க வேண்டுமா?' : 'Are you sure you want to delete this option?';
            if (!confirm(msg)) return;

            try {
                const csrfToken = '{{ csrf_token() }}';
                const res = await fetch(`/matrimony/master-options/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                if (json.success) {
                    await loadMasterOptions(currentMasterTab);
                    await refreshFormSelect(currentMasterTab);
                } else {
                    alert(json.message || 'பிழை ஏற்பட்டது');
                }
            } catch (err) {
                console.error('Error deleting master option:', err);
                alert('நீக்க முடியவில்லை.');
            }
        }

        // Dynamically refresh select options from database in active language
        async function refreshFormSelect(cat) {
            try {
                const res = await fetch(`/matrimony/master-options?category=${cat}`);
                const json = await res.json();
                if (!json.success || !json.options || !json.options.length) return;

                const isTa = (appLang === 'ta');
                const defaultText = isTa ? '-- தேர்ந்தெடுக்கவும் --' : '-- Select an option --';

                if (cat === 'community') {
                    const sel = document.getElementById('community_select');
                    if (sel) {
                        const currentVal = sel.value;
                        let optionsHtml = `<option value="">${defaultText}</option>`;
                        json.options.forEach(opt => {
                            const val = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            const label = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            optionsHtml += `<option value="${val}">${label}</option>`;
                        });
                        sel.innerHTML = optionsHtml;
                        if (typeof syncCommunityDropdown === 'function') {
                            syncCommunityDropdown(document.getElementById('community')?.value || currentVal);
                        }
                    }
                } else if (cat === 'education') {
                    const sel = document.getElementById('education');
                    if (sel) {
                        const currentVal = sel.value;
                        let optionsHtml = `<option value="">${defaultText}</option>`;
                        json.options.forEach(opt => {
                            const val = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            const label = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            optionsHtml += `<option value="${val}">${label}</option>`;
                        });
                        sel.innerHTML = optionsHtml;
                        if (typeof syncEducationDropdown === 'function') {
                            syncEducationDropdown(currentVal);
                        }
                    }
                } else if (cat === 'job') {
                    const sel = document.getElementById('job_select');
                    if (sel) {
                        const currentVal = sel.value;
                        let optionsHtml = `<option value="">${defaultText}</option>`;
                        json.options.forEach(opt => {
                            const val = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            const label = isTa ? opt.name_ta : (opt.name_en || opt.name_ta);
                            optionsHtml += `<option value="${val}">${label}</option>`;
                        });
                        optionsHtml += `<option value="${isTa ? 'இதர பணிகள்' : 'Other Professions'}">${isTa ? 'இதர பணிகள்' : 'Other Professions'}</option>`;
                        sel.innerHTML = optionsHtml;
                        if (typeof syncJobDropdown === 'function') {
                            syncJobDropdown(document.getElementById('job_title')?.value || currentVal);
                        }
                    }
                }
            } catch (err) {
                console.error('Error refreshing form select for ' + cat, err);
            }
        }

        // ========== REGISTRATION NUMBER AUTO-GENERATION SETTINGS ==========
        function onMiddleSelectChange() {
            const sel = document.getElementById('reg_cfg_middle');
            const customInput = document.getElementById('reg_cfg_middle_custom');
            if (sel && customInput) {
                customInput.style.display = (sel.value === 'CUSTOM') ? 'block' : 'none';
            }
            updateLiveRegPreview();
        }

        function updateLiveRegPreview() {
            const prefix = document.getElementById('reg_cfg_prefix')?.value.trim() || 'SAM';
            const separator = document.getElementById('reg_cfg_separator')?.value ?? '-';
            let middle = document.getElementById('reg_cfg_middle')?.value || '{YEAR}';
            if (middle === 'CUSTOM') {
                middle = document.getElementById('reg_cfg_middle_custom')?.value.trim() || '';
            }
            const digits = parseInt(document.getElementById('reg_cfg_digits')?.value || '4', 10);
            const suffix = document.getElementById('reg_cfg_suffix')?.value.trim() || '';

            const currentYear = new Date().getFullYear().toString();
            const twoYear = currentYear.slice(-2);

            let middleResolved = '';
            if (middle !== 'NONE') {
                middleResolved = middle
                    .replace(/{YEAR}/gi, currentYear)
                    .replace(/{YY}/gi, twoYear);
            }

            let numberFormatted = '1';
            if (digits > 0) {
                numberFormatted = '1'.padStart(digits, '0');
            }

            const parts = [];
            if (prefix) parts.push(prefix);
            if (middleResolved) parts.push(middleResolved);
            if (numberFormatted) parts.push(numberFormatted);

            let res = parts.join(separator);
            if (suffix) {
                res += (separator ? separator : '') + suffix;
            }

            const badge = document.getElementById('regLivePreviewBadge');
            if (badge) badge.innerText = res;

            const helperSample = document.getElementById('reg_no_helper_sample');
            if (helperSample) helperSample.innerText = res;

            const regNoInput = document.getElementById('reg_no');
            if (regNoInput) {
                const placeholderFormat = res.replace(/\d+$/, 'XXXX');
                regNoInput.placeholder = `${placeholderFormat} (தானாக உருவாகும்)`;
            }
            return res;
        }

        async function loadRegNoSettings() {
            try {
                const res = await fetch('/matrimony/reg-no-setting');
                const json = await res.json();
                if (json.success && json.config) {
                    const cfg = json.config;
                    const pfx = document.getElementById('reg_cfg_prefix');
                    const sep = document.getElementById('reg_cfg_separator');
                    const mid = document.getElementById('reg_cfg_middle');
                    const midCust = document.getElementById('reg_cfg_middle_custom');
                    const dig = document.getElementById('reg_cfg_digits');
                    const suf = document.getElementById('reg_cfg_suffix');

                    if (pfx) pfx.value = cfg.prefix || 'SAM';
                    if (sep) sep.value = cfg.separator ?? '-';
                    if (dig) dig.value = String(cfg.digits ?? 4);
                    if (suf) suf.value = cfg.suffix || '';

                    const standardMids = ['{YEAR}', '{YY}', 'TN', 'ERODE', 'NONE'];
                    if (mid) {
                        if (standardMids.includes(cfg.middle)) {
                            mid.value = cfg.middle;
                            if (midCust) {
                                midCust.value = '';
                                midCust.style.display = 'none';
                            }
                        } else {
                            mid.value = 'CUSTOM';
                            if (midCust) {
                                midCust.value = cfg.middle || '';
                                midCust.style.display = 'block';
                            }
                        }
                    }

                    if (json.preview) {
                        const badge = document.getElementById('regLivePreviewBadge');
                        if (badge) badge.innerText = json.preview;
                        const helperSample = document.getElementById('reg_no_helper_sample');
                        if (helperSample) helperSample.innerText = json.preview;
                    } else {
                        updateLiveRegPreview();
                    }
                }
            } catch (err) {
                console.error('Error loading reg no settings:', err);
                updateLiveRegPreview();
            }
        }

        async function saveRegNoSettings(event) {
            if (event) event.preventDefault();
            const btn = document.getElementById('btnSaveRegSettings');
            const msg = document.getElementById('regSettingsSaveMsg');

            const prefix = document.getElementById('reg_cfg_prefix')?.value.trim() || 'SAM';
            const separator = document.getElementById('reg_cfg_separator')?.value ?? '-';
            let middle = document.getElementById('reg_cfg_middle')?.value || '{YEAR}';
            if (middle === 'CUSTOM') {
                middle = document.getElementById('reg_cfg_middle_custom')?.value.trim() || '';
            }
            const digits = parseInt(document.getElementById('reg_cfg_digits')?.value || '4', 10);
            const suffix = document.getElementById('reg_cfg_suffix')?.value.trim() || '';

            if (btn) {
                btn.disabled = true;
                btn.innerText = 'சேமிக்கிறது...';
            }

            try {
                const csrfToken = '{{ csrf_token() }}';
                const res = await fetch('/matrimony/reg-no-setting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ prefix, separator, middle, digits, suffix })
                });
                const json = await res.json();
                if (json.success) {
                    if (msg) {
                        msg.style.display = 'inline-block';
                        msg.innerText = '✅ ' + (json.message || 'அமைப்புகள் வெற்றிகரமாக சேமிக்கப்பட்டது!');
                        setTimeout(() => { msg.style.display = 'none'; }, 3500);
                    }
                    if (json.preview) {
                        const badge = document.getElementById('regLivePreviewBadge');
                        if (badge) badge.innerText = json.preview;
                        const helperSample = document.getElementById('reg_no_helper_sample');
                        if (helperSample) helperSample.innerText = json.preview;
                        const regNoInput = document.getElementById('reg_no');
                        if (regNoInput) {
                            const placeholderFormat = json.preview.replace(/\d+$/, 'XXXX');
                            regNoInput.placeholder = `${placeholderFormat} (தானாக உருவாகும்)`;
                        }
                    }
                } else {
                    alert(json.message || 'சேமிக்க முடியவில்லை.');
                }
            } catch (err) {
                console.error('Error saving reg no settings:', err);
                alert('பிழை ஏற்பட்டது. மீண்டும் முயற்சிக்கவும்.');
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerText = '💾 அமைப்புகளை சேமிக்க (Save Settings)';
                }
            }
        }

        async function resetRegSettingsToDefault() {
            if (!confirm('பதிவு எண் அமைப்பை ஆரம்ப இயல்புநிலைக்கு (SAM-2026-0001) மீட்டமைக்க வேண்டுமா?')) return;
            const prefixInput = document.getElementById('reg_cfg_prefix');
            const sepInput = document.getElementById('reg_cfg_separator');
            const midInput = document.getElementById('reg_cfg_middle');
            const midCustom = document.getElementById('reg_cfg_middle_custom');
            const digInput = document.getElementById('reg_cfg_digits');
            const sufInput = document.getElementById('reg_cfg_suffix');

            if (prefixInput) prefixInput.value = 'SAM';
            if (sepInput) sepInput.value = '-';
            if (midInput) midInput.value = '{YEAR}';
            if (midCustom) {
                midCustom.value = '';
                midCustom.style.display = 'none';
            }
            if (digInput) digInput.value = '4';
            if (sufInput) sufInput.value = '';

            updateLiveRegPreview();
            await saveRegNoSettings(null);
        }

        // ==========================================
        // ADMIN AUTH CREDENTIALS CONTROLLER
        // ==========================================
        let activeAdminPlainPassword = '{{ $currentAdminPassword ?? 'password' }}';
        let isCurPassMasked = false;

        function toggleCurrentPasswordDisp() {
            const pEl = document.getElementById('disp_current_password');
            const btn = document.getElementById('btnCurPassEye');
            if (!pEl) return;
            isCurPassMasked = !isCurPassMasked;
            if (isCurPassMasked) {
                pEl.innerText = '••••••••';
                if (btn) btn.innerHTML = '🙈';
            } else {
                pEl.innerText = activeAdminPlainPassword;
                if (btn) btn.innerHTML = '👁️';
            }
        }

        function togglePasswordVis(fieldId, btn) {
            const inp = document.getElementById(fieldId);
            if (!inp) return;
            if (inp.type === 'password') {
                inp.type = 'text';
                if (btn) btn.innerHTML = '🙈';
            } else {
                inp.type = 'password';
                if (btn) btn.innerHTML = '👁️';
            }
        }

        function showAuthAlert(msg, type) {
            const b = document.getElementById('authAlertBox');
            if (!b) return;
            b.style.display = 'block';
            if (type === 'success') {
                b.style.background = '#ecfdf5';
                b.style.border = '1.5px solid #10b981';
                b.style.color = '#065f46';
            } else {
                b.style.background = '#fef2f2';
                b.style.border = '1.5px solid #ef4444';
                b.style.color = '#991b1b';
            }
            b.innerText = msg;
            b.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        async function loadAdminAuthSetting() {
            try {
                const res = await fetch('/matrimony/admin-auth-setting');
                if (!res.ok) return;
                const data = await res.json();
                if (data && data.success) {
                    const uInp = document.getElementById('admin_new_username');
                    const eInp = document.getElementById('admin_new_email');
                    const disp = document.getElementById('disp_current_username');
                    const dispEmail = document.getElementById('disp_current_email');
                    const dispPass = document.getElementById('disp_current_password');
                    if (uInp && data.username) uInp.value = data.username;
                    if (eInp && data.email) eInp.value = data.email;
                    if (disp && data.username) disp.innerText = data.username;
                    if (dispEmail && data.email) dispEmail.innerText = data.email;
                    if (data.current_password) {
                        activeAdminPlainPassword = data.current_password;
                        if (dispPass) {
                            dispPass.innerText = isCurPassMasked ? '••••••••' : activeAdminPlainPassword;
                        }
                    }
                }
            } catch (e) {
                console.error('loadAdminAuthSetting error:', e);
            }
        }

        async function submitAdminAuthSettings(event) {
            if (event) event.preventDefault();
            const isTa = (adminLang === 'ta');
            const uInp = document.getElementById('admin_new_username');
            const eInp = document.getElementById('admin_new_email');
            const pInp = document.getElementById('admin_new_password');
            const cpInp = document.getElementById('admin_confirm_password');
            const username = uInp ? uInp.value.trim() : '';
            const email = eInp ? eInp.value.trim() : '';
            const password = pInp ? pInp.value : '';
            const confirmPassword = cpInp ? cpInp.value : '';

            if (!username) {
                showAuthAlert(isTa ? 'பயனர் ID காலியாக இருக்கக்கூடாது!' : 'Username / ID cannot be empty!', 'error');
                return;
            }

            if (!email) {
                showAuthAlert(isTa ? 'மின்னஞ்சல் முகவரி காலியாக இருக்கக்கூடாது!' : 'Recovery email cannot be empty!', 'error');
                return;
            }

            if (password || confirmPassword) {
                if (password !== confirmPassword) {
                    showAuthAlert(isTa ? 'கடவுச்சொல் மற்றும் உறுதி கடவுச்சொல் பொருந்தவில்லை!' : 'New password and confirm password do not match!', 'error');
                    return;
                }
                if (password.length < 4) {
                    showAuthAlert(isTa ? 'கடவுச்சொல் குறைந்தது 4 எழுத்துகள் இருக்க வேண்டும்!' : 'Password must be at least 4 characters!', 'error');
                    return;
                }
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                || '{{ csrf_token() }}';

            const saveBtn = document.getElementById('btnSaveAdminAuth');
            if (saveBtn) {
                saveBtn.disabled = true;
                saveBtn.style.opacity = '0.7';
            }

            try {
                const res = await fetch('/matrimony/admin-auth-setting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        username: username,
                        email: email,
                        password: password,
                        password_confirmation: confirmPassword
                    })
                });

                const data = await res.json();
                if (saveBtn) {
                    saveBtn.disabled = false;
                    saveBtn.style.opacity = '1';
                }

                if (res.ok && data.success) {
                    showAuthAlert(isTa ? (data.message_ta || 'நிர்வாக விபரங்கள் வெற்றிகரமாக சேமிக்கப்பட்டது!') : (data.message_en || 'Admin credentials updated successfully!'), 'success');
                    const disp = document.getElementById('disp_current_username');
                    const dispEmail = document.getElementById('disp_current_email');
                    const dispPass = document.getElementById('disp_current_password');
                    if (disp && data.username) disp.innerText = data.username;
                    if (dispEmail && data.email) dispEmail.innerText = data.email;
                    if (eInp && data.email) eInp.value = data.email;
                    if (data.current_password) {
                        activeAdminPlainPassword = data.current_password;
                        if (dispPass) {
                            dispPass.innerText = isCurPassMasked ? '••••••••' : activeAdminPlainPassword;
                        }
                    }
                    if (pInp) pInp.value = '';
                    if (cpInp) cpInp.value = '';
                } else {
                    showAuthAlert(data.message || (isTa ? 'சேமிப்பதில் பிழை ஏற்பட்டது!' : 'Failed to save admin credentials!'), 'error');
                }
            } catch (e) {
                console.error('submitAdminAuthSettings error:', e);
                showAuthAlert(isTa ? 'இணைப்பு பிழை! மீண்டும் முயற்சிக்கவும்.' : 'Network error! Please try again.', 'error');
                if (saveBtn) {
                    saveBtn.disabled = false;
                    saveBtn.style.opacity = '1';
                }
            }
        }

        async function resetDefaultAdminAuth() {
            const isTa = (adminLang === 'ta');
            const confirmMsg = isTa
                ? 'நிர்வாக ID மற்றும் கடவுச்சொல்லை ஆரம்ப இயல்புநிலைக்கு (admin / password) மீட்டமைக்க விரும்புகிறீர்களா?'
                : 'Are you sure you want to reset admin credentials to default (admin / password)?';
            if (!confirm(confirmMsg)) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                || '{{ csrf_token() }}';

            try {
                const res = await fetch('/matrimony/admin-auth-reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    showAuthAlert(isTa ? (data.message_ta || 'இயல்புநிலைக்கு வெற்றிகரமாக மீட்டமைக்கப்பட்டது!') : (data.message_en || 'Reset to default successfully!'), 'success');
                    const uInp = document.getElementById('admin_new_username');
                    const eInp = document.getElementById('admin_new_email');
                    const pInp = document.getElementById('admin_new_password');
                    const cpInp = document.getElementById('admin_confirm_password');
                    const disp = document.getElementById('disp_current_username');
                    const dispEmail = document.getElementById('disp_current_email');
                    const dispPass = document.getElementById('disp_current_password');
                    activeAdminPlainPassword = 'password';
                    if (uInp) uInp.value = 'admin';
                    if (eInp) eInp.value = data.email || 'anithar.12@gmail.com';
                    if (disp) disp.innerText = 'admin';
                    if (dispEmail) dispEmail.innerText = data.email || 'anithar.12@gmail.com';
                    if (dispPass) dispPass.innerText = isCurPassMasked ? '••••••••' : 'password';
                    if (pInp) pInp.value = '';
                    if (cpInp) cpInp.value = '';
                } else {
                    showAuthAlert(isTa ? 'மீட்டமைப்பதில் பிழை ஏற்பட்டது!' : 'Failed to reset!', 'error');
                }
            } catch (e) {
                console.error('resetDefaultAdminAuth error:', e);
                showAuthAlert(isTa ? 'இணைப்பு பிழை!' : 'Network error!', 'error');
            }
        }

        // Tab Selection Handler (Only 2 nav tabs + Dedicated Tab 3 for Admin Panel)
        function selectTab(num) {
            const t1 = document.getElementById('tabPanel1');
            const t2 = document.getElementById('tabPanel2');
            const t3 = document.getElementById('tabPanel3');
            const b1 = document.getElementById('btnTab1');
            const b2 = document.getElementById('btnTab2');

            if (t1) t1.style.display = (num === 1) ? 'block' : 'none';
            if (t2) t2.style.display = (num === 2) ? 'block' : 'none';
            if (t3) t3.style.display = (num === 3) ? 'block' : 'none';

            if (b1) b1.classList.toggle('active', num === 1);
            if (b2) b2.classList.toggle('active', num === 2);

            if (num === 3) {
                setAdminLanguage(adminLang);
                initMasterTabVisibility();
                switchMasterTab(currentMasterTab || 'print_style_settings');
            }
            window.scrollTo({ top: 120, behavior: 'smooth' });
        }

        function pickGender(type) {
            currentGender = type;
            const bP = document.getElementById('boxBride');
            const bG = document.getElementById('boxGroom');
            const rPenn = document.getElementById('rdoPenn');
            const rAan = document.getElementById('rdoAan');
            if (bP && bG) {
                if (type === 'penn' || type === 'female' || type === 'bride') {
                    bP.classList.add('active-bride');
                    bP.classList.remove('active-groom');
                    bG.classList.remove('active-groom', 'active-bride');
                    if (rPenn) rPenn.checked = true;
                    if (rAan) rAan.checked = false;
                } else {
                    bG.classList.add('active-groom');
                    bG.classList.remove('active-bride');
                    bP.classList.remove('active-bride', 'active-groom');
                    if (rAan) rAan.checked = true;
                    if (rPenn) rPenn.checked = false;
                }
            }
        }

        function transliterateTamilToEnglish(text) {
            if (!text || typeof text !== 'string') return '';
            const directWords = {
                'ஸ்ரீ': 'sri', 'ஈரோடு': 'erode', 'சேலம்': 'salem', 'கோவை': 'kovai',
                'கோயம்புத்தூர்': 'coimbatore', 'சென்னை': 'chennai', 'பொறியாளர்': 'engineer',
                'மருத்துவர்': 'doctor', 'ஆசிரியர்': 'teacher', 'வழக்கறிஞர்': 'advocate',
                'வரன்': 'varan', 'ஆண்': 'aan groom male', 'பெண்': 'penn bride female',
                'மறுமணம்': 'remarriage'
            };
            let result = text;
            for (const [k, v] of Object.entries(directWords)) {
                if (result.includes(k)) result = result.split(k).join(' ' + v + ' ');
            }
            const vowels = {
                'அ': 'a', 'ஆ': 'aa', 'இ': 'i', 'ஈ': 'ee', 'உ': 'u', 'ஊ': 'oo',
                'எ': 'e', 'ஏ': 'e', 'ஐ': 'ai', 'ஒ': 'o', 'ஓ': 'o', 'ஔ': 'au', 'ஃ': 'k'
            };
            const consonants = {
                'க': 'k', 'ங': 'ng', 'ச': 's', 'ஞ': 'nj', 'ட': 't', 'ண': 'n',
                'த': 'th', 'ந': 'n', 'ப': 'p', 'ம': 'm', 'ய': 'y', 'ர': 'r',
                'ல': 'l', 'வ': 'v', 'ழ': 'zh', 'ள': 'l', 'ற': 'r', 'ன': 'n',
                'ஜ': 'j', 'ஷ': 'sh', 'ஸ': 's', 'ஹ': 'h', 'க்ஷ': 'ksh'
            };
            const vowelSigns = {
                'ா': 'aa', 'ி': 'i', 'ீ': 'ee', 'ு': 'u', 'ூ': 'oo',
                'ெ': 'e', 'ே': 'e', 'ை': 'ai', 'ொ': 'o', 'ோ': 'o', 'ௌ': 'au'
            };
            const pulli = '்';
            let out = '';
            const chars = Array.from(result);
            const len = chars.length;
            for (let i = 0; i < len; i++) {
                const c = chars[i];
                const next = i + 1 < len ? chars[i + 1] : null;
                if (vowels[c]) {
                    out += vowels[c];
                } else if (consonants[c]) {
                    const base = consonants[c];
                    if (next === pulli) {
                        out += base;
                        i++;
                    } else if (next && vowelSigns[next]) {
                        out += base + vowelSigns[next];
                        i++;
                    } else {
                        out += base + 'a';
                    }
                } else {
                    out += c;
                }
            }
            return out.toLowerCase();
        }

        function normalizePhonetic(str) {
            if (!str) return '';
            return str.toLowerCase()
                .replace(/aa/g, 'a')
                .replace(/ee/g, 'i')
                .replace(/ii/g, 'i')
                .replace(/oo/g, 'u')
                .replace(/uu/g, 'u')
                .replace(/ou/g, 'au')
                .replace(/sh/g, 's')
                .replace(/ch/g, 's')
                .replace(/th/g, 't')
                .replace(/dh/g, 't')
                .replace(/d/g, 't')
                .replace(/g/g, 'k')
                .replace(/b/g, 'p')
                .replace(/zh/g, 'l')
                .replace(/w/g, 'v')
                .replace(/ck/g, 'k')
                .replace(/ph/g, 'f')
                .replace(/j/g, 'z')
                .replace(/pir/g, 'pr')
                .replace(/kir/g, 'kr')
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/([a-z])\1+/g, '$1')
                .replace(/\s+/g, ' ')
                .trim();
        }

        function filterDirectory(query, extraAlts) {
            const searchInput = document.getElementById('tableSearch');
            const q = (typeof query === 'string' ? query : (searchInput ? searchInput.value : '')).toLowerCase().trim();
            const rows = document.querySelectorAll('#profilesTable tbody tr.profile-table-row');
            matchingDirectoryRows = [];

            if (!q) {
                rows.forEach(r => matchingDirectoryRows.push(r));
                directoryCurrentPage = 1;
                renderDirectoryPagination();
                onRowCheckboxChange();
                return;
            }

            // Gather query variants including extra speech alternatives
            const queriesToCheck = [q];
            if (Array.isArray(extraAlts)) {
                extraAlts.forEach(alt => {
                    const altTrim = (alt || '').toLowerCase().trim();
                    if (altTrim && !queriesToCheck.includes(altTrim)) queriesToCheck.push(altTrim);
                });
            }

            // Pre-calculate transliteration and phonetic representations
            const queryData = queriesToCheck.map(item => {
                const roman = transliterateTamilToEnglish(item);
                const norm = normalizePhonetic(item + ' ' + roman);
                const words = norm.split(' ').filter(w => w.length > 1);
                return { raw: item, roman: roman, norm: norm, words: words };
            });

            rows.forEach(r => {
                if (!r._searchRaw) {
                    const raw = r.innerText.toLowerCase();
                    const roman = transliterateTamilToEnglish(raw);
                    const norm = normalizePhonetic(raw + ' ' + roman);
                    r._searchRaw = raw;
                    r._searchRoman = roman;
                    r._searchNorm = norm;
                }

                let isMatch = false;
                for (let i = 0; i < queryData.length; i++) {
                    const qd = queryData[i];
                    // 1. Exact raw text match (Tamil, English, Phone numbers, Dates)
                    if (r._searchRaw.includes(qd.raw)) {
                        isMatch = true;
                        break;
                    }
                    // 2. Transliterated / Romanized match (e.g. typing English for Tamil row or vice versa)
                    if (qd.roman && (r._searchRoman.includes(qd.raw) || r._searchRaw.includes(qd.roman) || r._searchRoman.includes(qd.roman))) {
                        isMatch = true;
                        break;
                    }
                    // 3. Phonetic fuzzy match (e.g. arumugam/aarumugam/ஆறுமுகம், karthik/karthick/கார்த்திக்)
                    if (qd.norm && (r._searchNorm.includes(qd.norm) || (qd.words.length > 0 && qd.words.every(w => r._searchNorm.includes(w))))) {
                        isMatch = true;
                        break;
                    }
                }

                if (isMatch) {
                    matchingDirectoryRows.push(r);
                }
            });

            directoryCurrentPage = 1;
            renderDirectoryPagination();
            onRowCheckboxChange();
        }

        function toggleSelectAll(masterCb) {
            const cbs = document.querySelectorAll('.profile-row-checkbox');
            cbs.forEach(cb => {
                const row = cb.closest('tr');
                if (row && row.style.display !== 'none') {
                    cb.checked = masterCb.checked;
                }
            });
            onRowCheckboxChange();
        }

        function toggleSelectAllRows(masterCb) {
            toggleSelectAll(masterCb);
        }

        function onRowCheckboxChange() {
            const allCbs = Array.from(document.querySelectorAll('.profile-row-checkbox')).filter(cb => {
                const row = cb.closest('tr');
                return row && row.style.display !== 'none';
            });
            const checked = allCbs.filter(cb => cb.checked);
            const count = checked.length;
            const countSpan = document.getElementById('bulkSelectedCount');
            const btn = document.getElementById('btnBulkDelete');
            const masterCb = document.getElementById('selectAllCheckbox');

            if (masterCb && allCbs.length > 0) {
                masterCb.checked = (checked.length === allCbs.length);
                masterCb.indeterminate = (checked.length > 0 && checked.length < allCbs.length);
            }

            if (countSpan) countSpan.innerText = count;
            if (btn) {
                if (count > 0) {
                    btn.style.display = 'inline-flex';
                    btn.disabled = false;
                } else {
                    btn.style.display = 'none';
                    btn.disabled = true;
                }
            }
        }

        function executeBulkDelete() {
            const checkedBoxes = document.querySelectorAll('.profile-row-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);
            if (ids.length === 0) return;

            const isTa = appLang === 'ta';
            const confirmMsg = isTa 
                ? `தேர்ந்தெடுக்கப்பட்ட ${ids.length} வரன்களையும் நிரந்தரமாக நீக்க வேண்டுமா? (Delete ${ids.length} profiles?)`
                : `Are you sure you want to permanently delete ${ids.length} selected profiles?`;

            if (!confirm(confirmMsg)) return;

            const btn = document.getElementById('btnBulkDelete');
            if (btn) {
                btn.disabled = true;
                btn.innerText = isTa ? 'நீக்கப்படுகிறது...' : 'Deleting...';
            }

            fetch('/matrimony/bulk-delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(isTa ? `${data.count} வரன்கள் வெற்றிகரமாக நீக்கப்பட்டன!` : `${data.count} profiles deleted successfully!`);
                    window.location.reload();
                } else {
                    alert(data.message || 'Error occurred while deleting');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> <span id="txtBulkDelete">தேர்ந்தெடுத்தவற்றை நீக்கு (<span id="bulkSelectedCount">${ids.length}</span>)</span>`;
                    }
                }
            })
            .catch(err => {
                console.error('Bulk delete error:', err);
                alert('Network / Server error during bulk delete');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> <span id="txtBulkDelete">தேர்ந்தெடுத்தவற்றை நீக்கு (<span id="bulkSelectedCount">${ids.length}</span>)</span>`;
                }
            });
        }

        // -------------------------------------------------------------
        // Document Photo Upload & Interactive Passport Cropper
        // -------------------------------------------------------------
        const cropState = {
            img: null,
            scale: 1,
            minScale: 0.3,
            maxScale: 4.0,
            baseFitScale: 1,
            posX: 220,
            posY: 175,
            rotation: 0,
            isDragging: false,
            dragStartX: 0,
            dragStartY: 0,
            imgStartX: 0,
            imgStartY: 0,
            cropW: 210, // 35mm passport ratio (210 x 270)
            cropH: 270,
        };

        function setupCropEventListeners() {
            const wrapper = document.getElementById('cropCanvasWrapper');
            const canvas = document.getElementById('cropCanvas');
            if (!wrapper || !canvas || window.cropEventsBound) return;
            window.cropEventsBound = true;

            // Mouse Drag
            wrapper.addEventListener('mousedown', function(e) {
                if (!cropState.img) return;
                cropState.isDragging = true;
                cropState.dragStartX = e.clientX;
                cropState.dragStartY = e.clientY;
                cropState.imgStartX = cropState.posX;
                cropState.imgStartY = cropState.posY;
                wrapper.style.cursor = 'grabbing';
            });

            window.addEventListener('mousemove', function(e) {
                if (!cropState.isDragging || !cropState.img) return;
                const dx = e.clientX - cropState.dragStartX;
                const dy = e.clientY - cropState.dragStartY;
                cropState.posX = cropState.imgStartX + dx;
                cropState.posY = cropState.imgStartY + dy;
                drawCropCanvas();
            });

            window.addEventListener('mouseup', function() {
                if (cropState.isDragging) {
                    cropState.isDragging = false;
                    const w = document.getElementById('cropCanvasWrapper');
                    if (w) w.style.cursor = 'grab';
                }
            });

            // Mouse Wheel Zoom
            wrapper.addEventListener('wheel', function(e) {
                if (!cropState.img) return;
                e.preventDefault();
                const zoomFactor = e.deltaY < 0 ? 1.08 : 0.92;
                let newScale = cropState.scale * zoomFactor;
                newScale = Math.max(cropState.minScale, Math.min(cropState.maxScale, newScale));
                cropState.scale = newScale;
                const slider = document.getElementById('cropZoomSlider');
                if (slider) slider.value = newScale;
                drawCropCanvas();
            }, { passive: false });

            // Touch Drag & Pinch-to-zoom for Mobile / Touch Devices
            let touchDist = 0;
            let touchScale = 1;

            wrapper.addEventListener('touchstart', function(e) {
                if (!cropState.img) return;
                if (e.touches.length === 1) {
                    cropState.isDragging = true;
                    cropState.dragStartX = e.touches[0].clientX;
                    cropState.dragStartY = e.touches[0].clientY;
                    cropState.imgStartX = cropState.posX;
                    cropState.imgStartY = cropState.posY;
                } else if (e.touches.length === 2) {
                    cropState.isDragging = false;
                    const dx = e.touches[0].clientX - e.touches[1].clientX;
                    const dy = e.touches[0].clientY - e.touches[1].clientY;
                    touchDist = Math.hypot(dx, dy);
                    touchScale = cropState.scale;
                }
            }, { passive: true });

            wrapper.addEventListener('touchmove', function(e) {
                if (!cropState.img) return;
                if (e.touches.length === 1 && cropState.isDragging) {
                    e.preventDefault();
                    const dx = e.touches[0].clientX - cropState.dragStartX;
                    const dy = e.touches[0].clientY - cropState.dragStartY;
                    cropState.posX = cropState.imgStartX + dx;
                    cropState.posY = cropState.imgStartY + dy;
                    drawCropCanvas();
                } else if (e.touches.length === 2 && touchDist > 0) {
                    e.preventDefault();
                    const dx = e.touches[0].clientX - e.touches[1].clientX;
                    const dy = e.touches[0].clientY - e.touches[1].clientY;
                    const dist = Math.hypot(dx, dy);
                    const factor = dist / touchDist;
                    let newScale = touchScale * factor;
                    newScale = Math.max(cropState.minScale, Math.min(cropState.maxScale, newScale));
                    cropState.scale = newScale;
                    const slider = document.getElementById('cropZoomSlider');
                    if (slider) slider.value = newScale;
                    drawCropCanvas();
                }
            }, { passive: false });

            wrapper.addEventListener('touchend', function() {
                cropState.isDragging = false;
                touchDist = 0;
            }, { passive: true });
        }

        function drawCropCanvas() {
            const canvas = document.getElementById('cropCanvas');
            if (!canvas || !cropState.img) return;
            const ctx = canvas.getContext('2d');
            const cw = canvas.width;
            const ch = canvas.height;

            ctx.clearRect(0, 0, cw, ch);

            // 1. Draw image with current position, rotation, and scale
            ctx.save();
            ctx.translate(cropState.posX, cropState.posY);
            ctx.rotate((cropState.rotation * Math.PI) / 180);
            ctx.scale(cropState.scale, cropState.scale);

            const iw = cropState.img.naturalWidth || cropState.img.width;
            const ih = cropState.img.naturalHeight || cropState.img.height;
            ctx.drawImage(cropState.img, -iw / 2, -ih / 2, iw, ih);
            ctx.restore();

            // 2. Crop mask outside the passport frame
            const cx = (cw - cropState.cropW) / 2;
            const cy = (ch - cropState.cropH) / 2;
            const cwBox = cropState.cropW;
            const chBox = cropState.cropH;

            ctx.fillStyle = 'rgba(15, 23, 42, 0.68)';
            // Top
            ctx.fillRect(0, 0, cw, cy);
            // Bottom
            ctx.fillRect(0, cy + chBox, cw, ch - (cy + chBox));
            // Left
            ctx.fillRect(0, cy, cx, chBox);
            // Right
            ctx.fillRect(cx + cwBox, cy, cw - (cx + cwBox), chBox);

            // 3. Passport frame border with dashed styling matching reference image
            ctx.save();
            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = 2;
            ctx.setLineDash([6, 5]);
            ctx.strokeRect(cx, cy, cwBox, chBox);
            ctx.setLineDash([]);

            // 4. Corner accent brackets
            const cornerLen = 18;
            ctx.lineWidth = 3.5;
            ctx.strokeStyle = '#38bdf8'; // Blue highlight

            // Top-left
            ctx.beginPath();
            ctx.moveTo(cx, cy + cornerLen);
            ctx.lineTo(cx, cy);
            ctx.lineTo(cx + cornerLen, cy);
            ctx.stroke();

            // Top-right
            ctx.beginPath();
            ctx.moveTo(cx + cwBox - cornerLen, cy);
            ctx.lineTo(cx + cwBox, cy);
            ctx.lineTo(cx + cwBox, cy + cornerLen);
            ctx.stroke();

            // Bottom-left
            ctx.beginPath();
            ctx.moveTo(cx, cy + chBox - cornerLen);
            ctx.lineTo(cx, cy + chBox);
            ctx.lineTo(cx + cornerLen, cy + chBox);
            ctx.stroke();

            // Bottom-right
            ctx.beginPath();
            ctx.moveTo(cx + cwBox - cornerLen, cy + chBox);
            ctx.lineTo(cx + cwBox, cy + chBox);
            ctx.lineTo(cx + cwBox, cy + chBox - cornerLen);
            ctx.stroke();

            // Faint face oval guideline to help center candidate portrait
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.22)';
            ctx.lineWidth = 1;
            ctx.setLineDash([3, 3]);
            ctx.beginPath();
            ctx.ellipse(cx + cwBox / 2, cy + chBox * 0.42, cwBox * 0.24, chBox * 0.28, 0, 0, Math.PI * 2);
            ctx.stroke();

            ctx.restore();
        }

        function initCropperWithImage(img) {
            setupCropEventListeners();

            cropState.img = img;
            cropState.rotation = 0;

            const canvas = document.getElementById('cropCanvas');
            if (!canvas) return;
            canvas.width = 440;
            canvas.height = 350;

            cropState.cropW = 210;
            cropState.cropH = 270; // 35:45 ratio

            const iw = img.naturalWidth || img.width;
            const ih = img.naturalHeight || img.height;

            // Fit covering the passport frame
            const scaleX = cropState.cropW / iw;
            const scaleY = cropState.cropH / ih;
            const coverScale = Math.max(scaleX, scaleY);

            cropState.baseFitScale = coverScale;
            cropState.scale = coverScale * 1.05;
            cropState.minScale = coverScale * 0.35;
            cropState.maxScale = coverScale * 4.5;

            cropState.posX = canvas.width / 2;
            cropState.posY = canvas.height / 2;

            const slider = document.getElementById('cropZoomSlider');
            if (slider) {
                slider.min = cropState.minScale;
                slider.max = cropState.maxScale;
                slider.step = (cropState.maxScale - cropState.minScale) / 100;
                slider.value = cropState.scale;
            }

            drawCropCanvas();
        }

        function openPhotoCropModalFromFile(file) {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const modal = document.getElementById('documentPhotoCropModal');
                    if (modal) modal.style.display = 'flex';
                    initCropperWithImage(img);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function previewUpload(event) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) {
                alert('தயவுசெய்து சரியான புகைப்படத்தை தேர்ந்தெடுக்கவும்! (Please select a valid image file)');
                event.target.value = '';
                return;
            }
            openPhotoCropModalFromFile(file);
        }

        function triggerPhotoUploadOrCrop() {
            if (cropState.img) {
                const modal = document.getElementById('documentPhotoCropModal');
                if (modal) {
                    modal.style.display = 'flex';
                    drawCropCanvas();
                    return;
                }
            }
            // Check if there is an existing img in photoPreviewFrame
            const frameImg = document.querySelector('#photoPreviewFrame img');
            if (frameImg && frameImg.src && !frameImg.src.startsWith('blob:') && !frameImg.src.includes('svg')) {
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = function() {
                    const modal = document.getElementById('documentPhotoCropModal');
                    if (modal) modal.style.display = 'flex';
                    initCropperWithImage(img);
                };
                img.onerror = function() {
                    const input = document.getElementById('photo');
                    if (input) input.click();
                };
                img.src = frameImg.src;
                return;
            }
            const input = document.getElementById('photo');
            if (input) input.click();
        }

        function closePhotoCropModal(saved) {
            const modal = document.getElementById('documentPhotoCropModal');
            if (modal) modal.style.display = 'none';
            if (!saved) {
                const b64 = document.getElementById('photo_base64');
                if (!b64 || !b64.value) {
                    const input = document.getElementById('photo');
                    if (input) input.value = '';
                }
            }
        }

        function rotateCropImage() {
            if (!cropState.img) return;
            cropState.rotation = (cropState.rotation + 90) % 360;
            drawCropCanvas();
        }

        function resetCropTransform() {
            if (!cropState.img) return;
            initCropperWithImage(cropState.img);
        }

        function adjustCropZoom(delta) {
            if (!cropState.img) return;
            const step = (cropState.maxScale - cropState.minScale) * 0.08;
            let newScale = cropState.scale + (delta > 0 ? step : -step);
            newScale = Math.max(cropState.minScale, Math.min(cropState.maxScale, newScale));
            cropState.scale = newScale;
            const slider = document.getElementById('cropZoomSlider');
            if (slider) slider.value = newScale;
            drawCropCanvas();
        }

        function onCropZoomSlider(val) {
            if (!cropState.img) return;
            cropState.scale = parseFloat(val);
            drawCropCanvas();
        }

        function applyPhotoCrop() {
            if (!cropState.img) return;

            // Crisp 300dpi passport dimension (35mm x 45mm -> 420 x 540)
            const outW = 420;
            const outH = 540;
            const outCanvas = document.createElement('canvas');
            outCanvas.width = outW;
            outCanvas.height = outH;
            const outCtx = outCanvas.getContext('2d');

            outCtx.fillStyle = '#ffffff';
            outCtx.fillRect(0, 0, outW, outH);

            const canvas = document.getElementById('cropCanvas');
            const cw = canvas.width;
            const ch = canvas.height;
            const cx = (cw - cropState.cropW) / 2;
            const cy = (ch - cropState.cropH) / 2;
            const factor = outW / cropState.cropW;

            outCtx.save();
            outCtx.translate((cropState.posX - cx) * factor, (cropState.posY - cy) * factor);
            outCtx.rotate((cropState.rotation * Math.PI) / 180);
            outCtx.scale(cropState.scale * factor, cropState.scale * factor);

            const iw = cropState.img.naturalWidth || cropState.img.width;
            const ih = cropState.img.naturalHeight || cropState.img.height;
            outCtx.drawImage(cropState.img, -iw / 2, -ih / 2, iw, ih);
            outCtx.restore();

            const dataUrl = outCanvas.toDataURL('image/jpeg', 0.95);

            // 1. Update Preview Frame in form
            const frame = document.getElementById('photoPreviewFrame');
            if (frame) {
                frame.innerHTML = `<img src="${dataUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">`;
            }

            // 2. Populate photo_base64 hidden input for backend saving
            const hidB64 = document.getElementById('photo_base64');
            if (hidB64) {
                hidB64.value = dataUrl;
            }

            // 3. Show Re-crop button
            const btnReCrop = document.getElementById('btnReCrop');
            if (btnReCrop) {
                btnReCrop.style.display = 'inline-flex';
            }

            // 4. Update file input with a real File object so standard multipart submission sends it
            try {
                const arr = dataUrl.split(',');
                const bstr = atob(arr[1]);
                let n = bstr.length;
                const u8arr = new Uint8Array(n);
                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                const fileObj = new File([u8arr], 'passport_photo_' + Date.now() + '.jpg', { type: 'image/jpeg' });
                const dt = new DataTransfer();
                dt.items.add(fileObj);
                const fileInput = document.getElementById('photo');
                if (fileInput) fileInput.files = dt.files;
            } catch (e) {
                console.warn('DataTransfer notice:', e);
            }

            closePhotoCropModal(true);
        }

        function updatePhotoPrintPref(val) {
            try {
                localStorage.setItem('matrimony_default_photo_print_pref', val ? 'yes' : 'no');
            } catch(e) {}
        }

        // Show Profile Details Modal (Strict Photo + Details for HR / User)
        function showProfileModal(id) {
            const p = rawProfilesData[id];
            if (!p) return;
            activeModalId = id;

            const isTa = appLang === 'ta';
            const genderTitle = p.varan_type === 'aan' ? (isTa ? '🤵 ஆண் வரன்' : '🤵 Groom') : (isTa ? '👰 பெண் வரன்' : '👰 Bride');

            const modalNameEl = document.getElementById('modalName');
            if (modalNameEl) modalNameEl.innerText = (p.name || '') + ' - ' + genderTitle;
            const printLinkEl = document.getElementById('modalPrintLink');
            if (printLinkEl) printLinkEl.href = '/varans/' + p.id + '/print?lang=' + appLang + '&show_photo=' + (localStorage.getItem('matrimony_admin_show_photo') || '1');

            let dobFormatted = p.dob ? p.dob.substring(0, 10) : '-';

            // Candidate Photo Display in View Modal
            let photoSrc = p.photo_url || (p.photo_path ? (p.photo_path.startsWith('http') ? p.photo_path : ('/' + p.photo_path.replace(/^\/+/, ''))) : null);
            let photoHtml = '';
            if (photoSrc) {
                photoHtml = `
                    <div style="display:flex; gap:16px; align-items:center; background:#f8fafc; padding:12px 16px; border-radius:10px; margin-bottom:14px; border:1.5px solid #cbd5e1; box-shadow:0 2px 6px rgba(0,0,0,0.04);">
                        <img src="${photoSrc}" alt="${p.name || ''}" style="width:78px; height:94px; object-fit:cover; border-radius:8px; border:2px solid #881337; box-shadow:0 3px 8px rgba(0,0,0,0.15); background:#fff;">
                        <div>
                            <div style="font-weight:800; font-size:17px; color:#881337;">${p.name || '-'}</div>
                            <div style="font-size:13.5px; color:#475569; font-weight:700; margin-top:2px;">${genderTitle} &bull; ${p.community || '-'}</div>
                            <div style="display:inline-flex; align-items:center; gap:5px; font-size:12px; color:#15803d; font-weight:800; background:#dcfce7; padding:2px 8px; border-radius:4px; margin-top:6px;">
                                📷 ${isTa ? 'புகைப்படம் இணைக்கப்பட்டுள்ளது' : 'Photo Attached'}
                            </div>
                        </div>
                    </div>
                `;
            } else {
                photoHtml = `
                    <div style="display:flex; gap:14px; align-items:center; background:#f8fafc; padding:10px 14px; border-radius:10px; margin-bottom:14px; border:1px dashed #cbd5e1;">
                        <div style="width:65px; height:78px; border-radius:6px; background:#fff; border:1.5px dashed #94a3b8; display:flex; align-items:center; justify-content:center; font-size:32px;">
                            ${p.varan_type === 'aan' ? '🤵' : '👰'}
                        </div>
                        <div>
                            <div style="font-weight:800; font-size:16px; color:#1e293b;">${p.name || '-'}</div>
                            <div style="font-size:13px; color:#64748b; font-weight:700;">${genderTitle} &bull; ${p.community || '-'}</div>
                            <div style="font-size:12px; color:#94a3b8; font-weight:600; margin-top:2px;">${isTa ? 'புகைப்படம் பதிவேற்றப்படவில்லை' : 'No photo uploaded'}</div>
                        </div>
                    </div>
                `;
            }

            let html = photoHtml + `
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'வரன் பெயர்:' : 'Candidate Name:'}</span><span class="modal-detail-value" style="font-size:16px; color:#881337;">${p.name || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'இனம் / சமூகம்:' : 'Community / Caste:'}</span><span class="modal-detail-value">${p.community || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'பிறந்த தேதி & ஊர்:' : 'Date of Birth & Place:'}</span><span class="modal-detail-value">${dobFormatted} | ${p.birth_time || '-'} | ${p.birth_place || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'படிப்பு & வேலை:' : 'Education & Profession:'}</span><span class="modal-detail-value">${p.education || '-'} | ${p.job_title || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'நிறுவனம் & வருமானம்:' : 'Company & Income:'}</span><span class="modal-detail-value">${p.company_details || '-'} | Rs. ${p.monthly_income || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'உயரம் & எடை:' : 'Height & Weight:'}</span><span class="modal-detail-value">${p.height || '-'} | ${p.weight || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'நிறம் & குலதெய்வம்:' : 'Complexion & Deity:'}</span><span class="modal-detail-value">${p.complexion || '-'} | ${p.kuladeivam || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'தந்தை விபரம்:' : "Father's Details:"}</span><span class="modal-detail-value">${p.father_name || '-'} | ${p.father_job || '-'} | ${p.father_native || '-'} | ${p.father_mobile || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'தாய் விபரம்:' : "Mother's Details:"}</span><span class="modal-detail-value">${p.mother_name || '-'} | ${p.mother_job || '-'} | ${p.mother_native || '-'} | ${p.mother_mobile || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'முழு முகவரி:' : 'Residential Address:'}</span><span class="modal-detail-value">${p.address || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'குடும்ப வசதிகள்:' : 'Family Wealth & Siblings:'}</span><span class="modal-detail-value">${p.family_wealth || '-'} | ${p.siblings_details || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">ஜோதிட விபரம் (Astrology):</span><span class="modal-detail-value">${p.rasi || '-'} | ${p.natchathiram || '-'} | ${p.lagnam || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">தோஷம் & திசை இருப்பு:</span><span class="modal-detail-value">${p.dosham || '-'} | ${p.thisai_iruppu || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'எதிர்பார்ப்புகள்:' : 'Expectations:'}</span><span class="modal-detail-value" style="color:#047857;">${p.expectations || '-'}</span></div>
                <div class="modal-detail-row"><span class="modal-detail-label">${isTa ? 'ரத்த வகை & மின்னஞ்சல்:' : 'Blood Group & Email:'}</span><span class="modal-detail-value">${p.blood_group || '-'} | ${p.email || '-'}</span></div>
            `;

            const modalDetailsEl = document.getElementById('modalDetails');
            if (modalDetailsEl) modalDetailsEl.innerHTML = html;
            const modal = document.getElementById('quickViewModal');
            if (modal) modal.style.display = 'flex';
        }

        function closeModal() {
            const modal = document.getElementById('quickViewModal');
            if (modal) modal.style.display = 'none';
            activeModalId = null;
        }

        // View Modal Edit Handler
        function editCurrentModalProfile() {
            if (!activeModalId) return;
            const id = activeModalId;
            closeModal();
            loadForEdit(id);
        }

        // Load profile back into registration form for editing
        function loadForEdit(id) {
            const p = rawProfilesData[id];
            if (!p) return;

            const editIdEl = document.getElementById('edit_varan_id');
            if (editIdEl) editIdEl.value = p.id;
            pickGender(p.varan_type || p.gender || 'penn');

            const regNoEl = document.getElementById('reg_no');
            if (regNoEl) regNoEl.value = p.reg_no || ('SAM-2026-' + String(p.id).padStart(4, '0'));
            const regDateEl = document.getElementById('reg_date');
            if (regDateEl) regDateEl.value = p.reg_date ? p.reg_date.substring(0, 10) : (p.created_at ? p.created_at.substring(0, 10) : '');

            // Real Photo Preview in Edit Mode
            const frame = document.getElementById('photoPreviewFrame');
            if (frame) {
                let photoSrc = p.photo_url || (p.photo_path ? (p.photo_path.startsWith('http') ? p.photo_path : ('/' + p.photo_path.replace(/^\/+/, ''))) : null);
                if (photoSrc) {
                    frame.innerHTML = `<img src="${photoSrc}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">`;
                } else {
                    frame.innerHTML = `<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>`;
                }
            }
            const hidEditB64 = document.getElementById('photo_base64');
            if (hidEditB64) hidEditB64.value = '';

            const setVal = (fieldId, val) => {
                const el = document.getElementById(fieldId);
                if (el) el.value = (val !== undefined && val !== null) ? val : '';
            };

            setVal('name', p.name);
            setVal('community', p.community);
            syncCommunityDropdown(p.community);

            if (p.dob) setVal('dob', p.dob.substring(0, 10));
            setVal('birth_time', p.birth_time);
            setVal('birth_place', p.birth_place || p.native_place || '');

            setVal('education', p.education);
            syncEducationDropdown(p.education);
            
            setVal('job_title', p.job_title);
            syncJobDropdown(p.job_title);

            setVal('company_details', p.company_details);
            setVal('monthly_income', p.monthly_income);
            setVal('height', p.height);
            setVal('weight', p.weight);

            const cmpx = matchComplexion(p.complexion) || p.complexion || 'சிவப்பு';
            setVal('complexion', cmpx);
            const cmpxSel = document.getElementById('complexion');
            if (cmpxSel && cmpxSel.selectedIndex <= 0 && cmpx) {
                cmpxSel.add(new Option(cmpx, cmpx, true, true));
                cmpxSel.value = cmpx;
            }

            setVal('kuladeivam', p.kuladeivam);
            setVal('gothram', p.gothram);
            setVal('kootam', p.kootam);
            setVal('father_name', p.father_name);
            setVal('father_mobile', p.father_mobile);
            setVal('father_job', p.father_job || p.father_occupation || '');
            setVal('father_native', p.father_native || '');
            setVal('mother_name', p.mother_name);
            setVal('mother_mobile', p.mother_mobile);
            setVal('mother_job', p.mother_job || p.mother_occupation || '');
            setVal('mother_native', p.mother_native || '');
            setVal('family_wealth', p.family_wealth);
            setVal('siblings_details', p.siblings_details);
            setVal('brothers', p.brothers || '');
            setVal('sisters', p.sisters || '');

            // Fallback: If brothers & sisters are empty, extract from siblings_details so form fields are NEVER empty
            if ((!p.brothers || !p.brothers.trim()) && (!p.sisters || !p.sisters.trim()) && p.siblings_details && p.siblings_details.trim()) {
                const sText = p.siblings_details.trim();
                const brm = sText.match(/(?:சகோதரர்கள்|தம்பி|அண்ணன்|brothers?|younger\s*brother|elder\s*brother)\s*[:=–\-]?\s*([^,\;]+)/i);
                const srm = sText.match(/(?:சகோதரிகள்|அக்கா|தங்கை|sisters?|younger\s*sister|elder\s*sister)\s*[:=–\-]?\s*([^,\;]+)/i);
                if (brm) setVal('brothers', brm[1].trim());
                if (srm) setVal('sisters', srm[1].trim());
                if (!brm && !srm) {
                    const parts = sText.split(/[,;]|\s+மற்றும்\s+/i);
                    let broParts = [];
                    let sisParts = [];
                    parts.forEach(pt => {
                        const tr = pt.trim();
                        if (!tr) return;
                        if (/(?:தம்பி|அண்ணன்|brother)/i.test(tr)) broParts.push(tr);
                        else if (/(?:அக்கா|தங்கை|sister)/i.test(tr)) sisParts.push(tr);
                        else broParts.push(tr);
                    });
                    if (broParts.length) setVal('brothers', broParts.join(', '));
                    if (sisParts.length) setVal('sisters', sisParts.join(', '));
                }
            }

            setVal('address', p.address);

            // Astrology: STRICTLY TAMIL!
            syncRasiDropdown(p.rasi);
            if (typeof filterStarsByRasi === 'function') filterStarsByRasi(p.rasi, p.natchathiram);
            syncStarDropdown(p.natchathiram);
            syncLagnamDropdown(p.lagnam);
            syncDoshamDropdown(p.dosham);
            setVal('thisai_iruppu', p.thisai_iruppu);

            if (p.tamil_year) {
                const ySel = document.getElementById('tamil_year');
                if (ySel) {
                    const yVal = matchTamilYear(p.tamil_year);
                    if (yVal) {
                        ySel.value = yVal;
                    } else {
                        let cleanYear = String(p.tamil_year).replace(/\s+/g, '').toLowerCase();
                        let found = false;
                        for (let opt of ySel.options) {
                            if (opt.value && (opt.value === cleanYear || opt.text.includes(cleanYear) || cleanYear.includes(opt.value))) {
                                ySel.value = opt.value;
                                found = true;
                                break;
                            }
                        }
                        if (!found && p.tamil_year.trim()) {
                            ySel.add(new Option(p.tamil_year.trim(), p.tamil_year.trim(), true, true));
                            ySel.value = p.tamil_year.trim();
                        }
                    }
                }
            } else {
                setVal('tamil_year', '');
            }

            if (p.tamil_month) {
                const tm = matchTamilMonth(p.tamil_month);
                const mSel = document.getElementById('tamil_month_name');
                if (mSel) {
                    if (tm.month) {
                        mSel.value = tm.month;
                    }
                    if (mSel.selectedIndex <= 0 && p.tamil_month.trim()) {
                        let cleanM = p.tamil_month.replace(/[0-9\s]/g, '').trim();
                        for (let opt of mSel.options) {
                            if (opt.value && (opt.value.includes(cleanM) || cleanM.includes(opt.value))) {
                                mSel.value = opt.value;
                                break;
                            }
                        }
                    }
                }
                setVal('tamil_month_date', tm.date || '');
                setVal('tamil_month', p.tamil_month);
                if (typeof syncTamilMonthValue === 'function') syncTamilMonthValue();
            } else {
                setVal('tamil_month_name', '');
                setVal('tamil_month_date', '');
                setVal('tamil_month', '');
            }

            syncMarriageTypeDropdown(p.marriage_type);

            if (p.blood_group) {
                const bgSel = document.getElementById('blood_group');
                if (bgSel) {
                    bgSel.value = p.blood_group;
                    if (bgSel.selectedIndex <= 0) {
                        const cleanBg = p.blood_group.replace(/\s+/g, '').toLowerCase();
                        for (let opt of bgSel.options) {
                            if (opt.value && opt.value.replace(/\s+/g, '').toLowerCase() === cleanBg) {
                                bgSel.value = opt.value;
                                break;
                            }
                        }
                        if (bgSel.selectedIndex <= 0 && p.blood_group.trim()) {
                            bgSel.add(new Option(p.blood_group.trim(), p.blood_group.trim(), true, true));
                            bgSel.value = p.blood_group.trim();
                        }
                    }
                }
            } else {
                setVal('blood_group', '');
            }

            setVal('email', p.email);
            setVal('expectations', p.expectations);

            // Load 12-kattam rasi & navamsam charts safely
            let rChart = p.rasi_chart;
            if (typeof rChart === 'string') {
                try { rChart = JSON.parse(rChart); } catch(e) {}
            }
            let nChart = p.navamsam_chart;
            if (typeof nChart === 'string') {
                try { nChart = JSON.parse(nChart); } catch(e) {}
            }

            for (let k = 1; k <= 12; k++) {
                const el = document.getElementById('r_cell_' + k);
                if (el) {
                    if (rChart && rChart[k]) {
                        el.value = Array.isArray(rChart[k]) ? rChart[k].filter(Boolean).join(' ') : (rChart[k] || '');
                    } else {
                        el.value = '';
                    }
                    if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(el);
                }
            }
            for (let k = 1; k <= 12; k++) {
                const el = document.getElementById('n_cell_' + k);
                if (el) {
                    if (nChart && nChart[k]) {
                        el.value = Array.isArray(nChart[k]) ? nChart[k].filter(Boolean).join(' ') : (nChart[k] || '');
                    } else {
                        el.value = '';
                    }
                    if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(el);
                }
            }

            selectTab(1);
            window.scrollTo({ top: 120, behavior: 'smooth' });
        }

        // Direct PDF Generation & Download Helper (Candidate Table & Form Actions)
        window.downloadCandidateDirectPdf = async function(id, name, varanType, marriageType) {
            if (!id) return;
            const cleanName = (name && name.trim()) ? name.trim().replace(/[\/\\?%*:|"<>]/g, '_') : 'Candidate';
            const showPhotoPref = localStorage.getItem('matrimony_admin_show_photo') || '1';
            const printUrl = `/varans/${id}/print?lang=${appLang}&show_photo=${showPhotoPref}`;

            const toast = document.createElement('div');
            toast.id = 'pdfGenToast';
            toast.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#0f172a;color:#ffffff;padding:14px 22px;border-radius:12px;box-shadow:0 12px 30px rgba(0,0,0,0.4);z-index:999999;font-weight:700;display:flex;align-items:center;gap:12px;font-family:sans-serif;font-size:14px;border:1px solid #334155;';
            toast.innerHTML = `<span style="font-size:18px;">⏳</span> <span>${appLang === 'ta' ? 'PDF தயாராகிறது...' : 'Generating PDF...'} (${cleanName})</span>`;
            document.body.appendChild(toast);

            let iframe = null;
            try {
                iframe = document.createElement('iframe');
                iframe.style.position = 'fixed';
                iframe.style.left = '0';
                iframe.style.top = '0';
                iframe.style.width = '794px';
                iframe.style.height = '1123px';
                iframe.style.opacity = '0';
                iframe.style.pointerEvents = 'none';
                iframe.style.zIndex = '-9999';
                document.body.appendChild(iframe);

                iframe.src = printUrl;

                await new Promise((resolve, reject) => {
                    iframe.onload = resolve;
                    iframe.onerror = reject;
                    setTimeout(resolve, 6000);
                });

                await new Promise(r => setTimeout(r, 400));

                const iframeWin = iframe.contentWindow;
                if (iframeWin && typeof iframeWin.exportPageAsPdf === 'function') {
                    await iframeWin.exportPageAsPdf();
                    toast.style.background = '#059669';
                    toast.innerHTML = `<span>✓</span> <span>${appLang === 'ta' ? 'PDF வெற்றிகரமாக பதிவிறக்கப்பட்டது!' : 'PDF downloaded successfully!'} (${cleanName})</span>`;
                } else {
                    const iframeDoc = iframe.contentDocument || (iframeWin ? iframeWin.document : null);
                    const page = iframeDoc ? (iframeDoc.querySelector('#printSheetPage1') || iframeDoc.querySelector('.a4-page') || iframeDoc.body) : null;
                    if (page && typeof html2canvas !== 'undefined' && (window.jspdf || window.jsPDF)) {
                        const canvas = await html2canvas(page, {
                            scale: 2.2,
                            useCORS: true,
                            allowTaint: true,
                            backgroundColor: '#fffdf0',
                            scrollX: 0,
                            scrollY: 0,
                            windowWidth: 794
                        });
                        const jspdfModule = window.jspdf || window;
                        const jsPDF = jspdfModule.jsPDF || jspdfModule;
                        const pdf = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4', compress: true });
                        const isMaru = (marriageType === 'marumanam');
                        const typeTag = isMaru ? 'REMARRIAGE' : (varanType === 'penn' ? 'BRIDE' : 'GROOM');
                        const fileTitle = (cleanName ? cleanName + ' - ' : '') + typeTag + ' - Master Matrimony';
                        const payloadEl = iframeDoc ? (iframeDoc.querySelector('#hiddenDigitalPayload') || iframeDoc.getElementById('hiddenDigitalPayload')) : null;
                        const payloadText = payloadEl ? (payloadEl.textContent || payloadEl.innerText || '').trim() : '';
                        pdf.setProperties({ title: fileTitle, subject: payloadText || 'Master Matrimony Biodata', keywords: payloadText, author: 'Master Matrimony' });
                        const imgData = canvas.toDataURL('image/jpeg', 0.94);
                        pdf.addImage(imgData, 'JPEG', 0, 0, 210, 297, undefined, 'FAST');
                        if (payloadText) {
                            const chunks = payloadText.match(/.{1,70}/g) || [payloadText];
                            pdf.setFontSize(2);
                            if (pdf.internal && typeof pdf.internal.write === 'function') {
                                pdf.internal.write('/Tr 3 Tr\n');
                            }
                            pdf.setTextColor(255, 255, 255);
                            pdf.text(chunks, -500, -500);
                            if (pdf.internal && typeof pdf.internal.write === 'function') {
                                pdf.internal.write('/Tr 0 Tr\n');
                            }
                        }
                        const blob = pdf.output('blob');
                        const blobUrl = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = blobUrl;
                        a.download = fileTitle.replace(/[\/\\?%*:|"<>]/g, '_') + '.pdf';
                        document.body.appendChild(a);
                        a.click();
                        setTimeout(() => { if (a.parentNode) document.body.removeChild(a); URL.revokeObjectURL(blobUrl); }, 3000);
                        toast.style.background = '#059669';
                        toast.innerHTML = `<span>✓</span> <span>${appLang === 'ta' ? 'PDF வெற்றிகரமாக பதிவிறக்கப்பட்டது!' : 'PDF downloaded successfully!'} (${cleanName})</span>`;
                    } else {
                        window.open(printUrl, '_blank');
                        toast.style.background = '#d97706';
                        toast.innerHTML = `<span>🖨</span> <span>${appLang === 'ta' ? 'அச்சுப் பக்கம் திறக்கப்பட்டது' : 'Print window opened'}</span>`;
                    }
                }
            } catch (err) {
                console.error('Direct PDF error:', err);
                window.open(printUrl, '_blank');
                toast.style.background = '#dc2626';
                toast.innerHTML = `<span>⚠</span> <span>${appLang === 'ta' ? 'அச்சுப் பக்கம் திறக்கப்பட்டது' : 'Opening print window'}</span>`;
            } finally {
                setTimeout(() => {
                    if (iframe && iframe.parentNode) iframe.parentNode.removeChild(iframe);
                }, 1500);
                setTimeout(() => {
                    if (toast && toast.parentNode) toast.parentNode.removeChild(toast);
                }, 4000);
            }
        };

        window.handleSaveAndDownloadPdf = async function() {
            const form = document.getElementById('profileForm') || document.getElementById('varanForm') || document.querySelector('form');
            if (!form) {
                alert('Profile form not found');
                return;
            }

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Sync and validate custom inputs
            if (typeof validateDobInput === 'function' && !validateDobInput()) {
                const dobEl = document.getElementById('dob');
                if (dobEl) { dobEl.focus(); dobEl.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
                alert(appLang === 'ta' ? 'பிறந்த தேதியை சரியாக உள்ளிடவும்!' : 'Please enter a valid Date of Birth!');
                return;
            }
            if (typeof validateBirthTimeInput === 'function' && !validateBirthTimeInput()) {
                const btEl = document.getElementById('birth_time');
                if (btEl) { btEl.focus(); btEl.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
                alert(appLang === 'ta' ? 'பிறந்த நேரத்தை சரியாக உள்ளிடவும் (AM / PM)!' : 'Please enter valid Birth Time (AM / PM)!');
                return;
            }
            if (typeof validateBirthPlaceInput === 'function' && !validateBirthPlaceInput()) {
                const bpEl = document.getElementById('birth_place');
                if (bpEl) { bpEl.focus(); bpEl.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
                alert(appLang === 'ta' ? 'பிறந்த ஊரில் எண்கள் (Numbers) இருக்கக்கூடாது! ஊர் பெயரை மட்டும் உள்ளிடவும்.' : 'Numbers are not allowed in Birth Place!');
                return;
            }

            if (typeof syncTamilMonthValue === 'function') {
                syncTamilMonthValue();
            }
            const jobInput = document.getElementById('job_title');
            const jobSelect = document.getElementById('job_select');
            if (jobInput && (!jobInput.value || !jobInput.value.trim()) && jobSelect && jobSelect.value) {
                jobInput.value = jobSelect.value;
            }
            const commInput = document.getElementById('community');
            const commSelect = document.getElementById('community_select');
            if (commInput && (!commInput.value || !commInput.value.trim()) && commSelect && commSelect.value) {
                commInput.value = commSelect.value;
            }
            const fLang = document.getElementById('form_lang_input');
            if (fLang) fLang.value = appLang || 'ta';

            const btn = document.getElementById('btnSaveAsPdfForm');
            const origHtml = btn ? btn.innerHTML : '';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<span style="font-size:16px;">⏳</span> <span>${appLang === 'ta' ? 'சேமித்து PDF உருவாக்கப்படுகிறது...' : 'Saving & Generating PDF...'}</span>`;
            }

            try {
                const formData = new FormData(form);
                formData.append('ajax_save', '1');

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errData = await response.json().catch(() => ({}));
                    let errMsg = errData.message || (appLang === 'ta' ? 'பதிவு செய்வதில் பிழை ஏற்பட்டது!' : 'Error saving profile.');
                    if (errData.errors) {
                        errMsg += '\n' + Object.values(errData.errors).flat().join('\n');
                    }
                    alert(errMsg);
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = origHtml;
                    }
                    return;
                }

                const data = await response.json();
                if (data && data.success && data.id) {
                    const cName = data.name || (form.name ? form.name.value : '');
                    const vType = (form.varan_type ? form.varan_type.value : 'aan');
                    const mType = (form.marriage_type ? form.marriage_type.value : 'mudhal_manama');
                    await window.downloadCandidateDirectPdf(data.id, cName, vType, mType);
                    setTimeout(() => {
                        window.location.reload();
                    }, 3500);
                } else {
                    alert((data && data.message) ? data.message : 'Error saving profile.');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = origHtml;
                    }
                }
            } catch (err) {
                console.error('Save as PDF error:', err);
                alert(appLang === 'ta' ? 'சுயவிவரத்தைச் சேமிப்பதில் பிழை ஏற்பட்டது. தயவுசெய்து படிவ விவரங்களை சரிபார்த்து மீண்டும் முயற்சிக்கவும்.' : 'Error saving profile. Please check form fields and try again.');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = origHtml;
                }
            }
        };

        // Canonical Astrological & Profile Matchers (Resilient to intra-word spaces & bilingual formats)
        const TAMIL_MONTHS_LIST = [
            { ta: 'சித்திரை', en: 'chithirai' },
            { ta: 'வைகாசி', en: 'vaikasi' },
            { ta: 'ஆனி', en: 'aani' },
            { ta: 'ஆடி', en: 'aadi' },
            { ta: 'ஆவணி', en: 'avani' },
            { ta: 'புரட்டாசி', en: 'purattasi' },
            { ta: 'ஐப்பசி', en: 'aippasi' },
            { ta: 'கார்த்திகை', en: 'karthigai' },
            { ta: 'மார்கழி', en: 'margazhi' },
            { ta: 'தை', en: 'thai' },
            { ta: 'மாசி', en: 'masi' },
            { ta: 'பங்குனி', en: 'panguni' }
        ];

        const TAMIL_YEARS_LIST = [
            'பிரபவ', 'விபவ', 'சுக்கில', 'பிரமோதூத', 'பிரஜோற்பத்தி', 'ஆங்கீரச', 'ஸ்ரீமுக', 'பவ', 'யுவ', 'தாது',
            'ஈஸ்வர', 'வெகுதானிய', 'பிரமாதி', 'விக்ரம', 'விஷு', 'சித்திரபானு', 'சுபானு', 'தாரண', 'பார்த்திப', 'விய',
            'சர்வஜித்', 'சர்வதாரி', 'விரோதி', 'விக்ருதி', 'கர', 'நந்தன', 'விஜய', 'ஜய', 'மன்மத', 'துன்முகி',
            'ஹேவிளம்பி', 'விளம்பி', 'விகாரி', 'சார்வரி', 'பிலவ', 'சுபகிருது', 'சோபகிருது', 'குரோதி', 'விசுவாசுவ', 'பராபவ',
            'பிலவங்க', 'கீலக', 'சௌமிய', 'சாதாரண', 'விரோதிகிருது', 'பரிதாபி', 'பிரமாதீச', 'ஆனந்த', 'ராட்சச', 'நள',
            'பிங்கள', 'காளயுக்தி', 'சித்தார்த்தி', 'ரௌத்திரி', 'துன்மதி', 'துந்துபி', 'ருத்ரோத்காரி', 'ரக்தாட்சி', 'குரோதன', 'அட்சய'
        ];

        const TAMIL_YEARS_EN_MAP = {
            'prabhava': 'பிரபவ', 'vibhava': 'விபவ', 'sukla': 'சுக்கில', 'pramodhootha': 'பிரமோதூத',
            'prajopathi': 'பிரஜோற்பத்தி', 'angirasa': 'ஆங்கீரச', 'srimukha': 'ஸ்ரீமுக', 'bhava': 'பவ',
            'yuva': 'யுவ', 'dhadhu': 'தாது', 'eswara': 'ஈஸ்வர', 'vehudhanya': 'வெகுதானிய',
            'pramathi': 'பிரமாதி', 'vikrama': 'விக்ரம', 'vrusha': 'விஷு', 'vishu': 'விஷு',
            'chitrabhanu': 'சித்திரபானு', 'subhanu': 'சுபானு', 'tharana': 'தாரண', 'parthiba': 'பார்த்திப',
            'viya': 'விய', 'sarvajith': 'சர்வஜித்', 'sarvadhari': 'சர்வதாரி', 'virodhi': 'விரோதி',
            'vikruthi': 'விக்ருதி', 'kara': 'கர', 'nandhana': 'நந்தன', 'vijaya': 'விஜய',
            'jaya': 'ஜய', 'manmatha': 'மன்மத', 'dunmukhi': 'துன்முகி', 'hevilambi': 'ஹேவிளம்பி',
            'vilambi': 'விளம்பி', 'vikari': 'விகாரி', 'sarvari': 'சார்வரி', 'plava': 'பிலவ',
            'subhakrithu': 'சுபகிருது', 'sobhakrithu': 'சோபகிருது', 'krodhi': 'குரோதி', 'viswavasu': 'விசுவாசுவ',
            'parabhava': 'பராபவ', 'plavanga': 'பிலவங்க', 'keelaka': 'கீலக', 'saumya': 'சௌமிய',
            'sadharana': 'சாதாரண', 'virodhakrithu': 'விரோதிகிருது', 'paridhabhi': 'பரிதாபி', 'pramadheesa': 'பிரமாதீச',
            'anandha': 'ஆனந்த', 'rakshasa': 'ராட்சச', 'nala': 'நள', 'pingala': 'பிங்கள',
            'kalayukthi': 'காளயுக்தி', 'siddharthi': 'சித்தார்த்தி', 'raudhri': 'ரௌத்திரி', 'dunmathi': 'துன்மதி',
            'dhundhubhi': 'துந்துபி', 'rudhrodhkari': 'ருத்ரோத்காரி', 'raktakshi': 'ரக்தாட்சி', 'krodhana': 'குரோதன',
            'akshaya': 'அட்சய'
        };

        const RASIS_CANONICAL = [
            { ta: 'மேஷம்', base: 'மேஷ', en: ['mesham', 'aries'] },
            { ta: 'ரிஷபம்', base: 'ரிஷப', en: ['rishabam', 'taurus'] },
            { ta: 'மிதுனம்', base: 'மிதுன', en: ['mithunam', 'gemini'] },
            { ta: 'கடகம்', base: 'கடக', en: ['kadagam', 'cancer'] },
            { ta: 'சிம்மம்', base: 'சிம்ம', en: ['simmam', 'leo'] },
            { ta: 'கன்னி', base: 'கன்னி', en: ['kanni', 'virgo'] },
            { ta: 'துலாம்', base: 'துலா', en: ['thulam', 'libra', 'துல'] },
            { ta: 'விருச்சிகம்', base: 'விருச்சிக', en: ['viruchigam', 'scorpio', 'விருச்சி'] },
            { ta: 'தனுசு', base: 'தனு', en: ['dhanusu', 'sagittarius'] },
            { ta: 'மகரம்', base: 'மகர', en: ['magaram', 'capricorn'] },
            { ta: 'கும்பம்', base: 'கும்ப', en: ['kumbam', 'aquarius'] },
            { ta: 'மீனம்', base: 'மீன', en: ['meenam', 'pisces'] }
        ];

        function matchRasi(rawVal) {
            if (!rawVal) return '';
            const clean = String(rawVal).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            for (const r of RASIS_CANONICAL) {
                if (clean.includes(r.ta.replace(/\s+/g, ''))) return r.ta;
                if (r.base && clean.includes(r.base.replace(/\s+/g, ''))) return r.ta;
                for (const e of r.en) {
                    if (clean.includes(e)) return r.ta;
                }
            }
            return '';
        }

        function matchTamilMonth(rawVal) {
            if (!rawVal) return { month: '', date: '' };
            const clean = String(rawVal).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            let month = '';
            for (const m of TAMIL_MONTHS_LIST) {
                if (clean.includes(m.ta.replace(/\s+/g, '')) || clean.includes(m.en)) {
                    month = m.ta;
                    break;
                }
            }
            const dMatch = String(rawVal).match(/\b([0-9]{1,4})\b/);
            let date = '';
            if (dMatch) {
                let n = parseInt(dMatch[1], 10);
                if (n > 31) n = 31;
                if (n < 1) n = 1;
                date = String(n);
            }
            return { month, date };
        }

        function matchTamilYear(rawVal) {
            if (!rawVal) return '';
            const clean = String(rawVal).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            for (const y of TAMIL_YEARS_LIST) {
                if (clean.includes(y.replace(/\s+/g, ''))) return y;
            }
            for (const [enKey, taVal] of Object.entries(TAMIL_YEARS_EN_MAP)) {
                if (clean.includes(enKey)) return taVal;
            }
            return '';
        }

        function matchComplexion(rawVal) {
            if (!rawVal) return '';
            const clean = String(rawVal).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            if (clean.includes('veryfair') || clean.includes('அடர்சிவப்பு') || clean.includes('அடர்')) return 'அடர் சிவப்பு';
            if (clean.includes('fair') || clean.includes('சிவப்பு')) return 'சிவப்பு';
            if (clean.includes('wheatish') || clean.includes('medium') || clean.includes('மாநிறம்') || clean.includes('மாநிற')) return 'மாநிறம்';
            if (clean.includes('dark') || clean.includes('கருப்பு') || clean.includes('கறுப்பு') || clean.includes('கருமை') || clean.includes('கறுத்த')) return 'கருப்பு';
            return '';
        }

        window.isAutofilling = false;

        function cleanTamilAstrologyText(str) {
            if (!str || typeof str !== 'string') return '';
            let s = str.trim();

            // Fix spaced planet names
            s = s.replace(/சுக்\s*கி\s*ர\s*ன்|சு\s*க்\s*கி\s*ர\s*ன்/g, 'சுக்கிரன்');
            s = s.replace(/சூ\s*ரி\s*ய\s*ன்/g, 'சூரியன்');
            s = s.replace(/ச\s*ந்\s*தி\s*ர\s*ன்|சந்\s*தி\s*ர\s*ன்/g, 'சந்திரன்');
            s = s.replace(/செ\s*வ்\s*வா\s*ய்|செவ்\s*வா\s*ய்/g, 'செவ்வாய்');
            s = s.replace(/பு\s*த\s*ன்/g, 'புதன்');
            s = s.replace(/கு\s*ரு/g, 'குரு');
            s = s.replace(/ச\s*னி/g, 'சனி');
            s = s.replace(/ரா\s*கு/g, 'ராகு');
            s = s.replace(/கே\s*து/g, 'கேது');

            // Fix spaced duration words
            s = s.replace(/தி\s*[\u0BC8\u0BC6\u0BC7]?\s*ச[\u0BC8\u0BC6\u0BC7]?|தி\s*ை\s*ச|தி\s*சா|தி\s*சை/g, 'திசை');
            s = s.replace(/வ\s*ரு\s*ட\s*ம்|வ\s*ரு\s*டம்/g, 'வருடம்');
            s = s.replace(/மா\s*த\s*ம்|மா\s*தம்/g, 'மாதம்');
            s = s.replace(/நா\s*ட்\s*க\s*ள்|நா\s*ட்கள்/g, 'நாட்கள்');
            s = s.replace(/இ\s*ரு\s*ப்\s*பு|இ\s*ருப்பு/g, 'இருப்பு');
            s = s.replace(/ம\s*கா\s*தி\s*சை/g, 'மகாதிசை');

            // Normalize spaces around punctuation and numbers
            s = s.replace(/\s*,\s*/g, ', ');
            s = s.replace(/(\d+)\s*வருடம்/g, function(m, p1) { return p1 + ' வருடம்'; });
            s = s.replace(/(\d+)\s*மாதம்/g, function(m, p1) { return p1 + ' மாதம்'; });
            s = s.replace(/(\d+)\s*நாட்கள்/g, function(m, p1) { return p1 + ' நாட்கள்'; });
            s = s.replace(/\s{2,}/g, ' ');

            // Strip leading label prefixes like "திசை இருப்பு:"
            s = s.replace(/^(?:திசை\s*இருப்பு|Dasa\s*Balance)\s*[:=–\-]?\s*/ui, '');

            // Strip trailing dosham, checkboxes, and adjacent notes
            s = s.replace(/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/ui, '');
            s = s.replace(/(?:எதிர்[ப்]*பார்ப்பு(?:கள்)?|Expectations|இதர\s*குறிப்புகள்).*$/ui, '');

            return s.trim();
        }

        // Dropdown Synchronization Helpers for Reliable Autofill & Editing
        function syncRasiDropdown(val) {
            if (!val) return;
            const el = document.getElementById('rasi');
            if (!el) return;
            const matched = (typeof matchRasi === 'function' ? matchRasi(val) : null) || val;
            const clean = String(matched).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            for (let i = 0; i < el.options.length; i++) {
                const opt = el.options[i];
                if (!opt.value) continue;
                const optClean = opt.value.replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
                const optTxt = opt.text.replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
                if (optClean === clean || optTxt === clean || optClean.includes(clean) || clean.includes(optClean)) {
                    el.selectedIndex = i;
                    el.value = opt.value;
                    el.dispatchEvent(new Event('input', { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                    if (!window.isAutofilling && typeof filterStarsByRasi === 'function') filterStarsByRasi(el.value);
                    return;
                }
            }
        }

        const STARS_CANONICAL = [
            { ta: 'அஸ்வினி', en: ['ashwini', 'aswini', 'aswathi'] },
            { ta: 'பரணி', en: ['bharani', 'barani'] },
            { ta: 'கார்த்திகை', en: ['krittika', 'krithika', 'karthigai', 'karthika'] },
            { ta: 'ரோகிணி', en: ['rohini'] },
            { ta: 'மிருகசீரிடம்', en: ['mrigashira', 'mrigasira', 'mirugaseeridam', 'mirugasirisham'] },
            { ta: 'திருவாதிரை', en: ['ardra', 'arudra', 'thiruvathirai', 'thiruvathira'] },
            { ta: 'புனர்பூசம்', en: ['punarvasu', 'punarpoosam'] },
            { ta: 'பூசம்', en: ['pushya', 'poosam'] },
            { ta: 'ஆயில்யம்', en: ['ashlesha', 'aslesha', 'ayilyam', 'aayilyam'] },
            { ta: 'மகம்', en: ['magha', 'makha', 'magam'] },
            { ta: 'பூரம்', en: ['purva phalguni', 'pooram', 'purvaphalguni'] },
            { ta: 'உத்திரம்', en: ['uttara phalguni', 'uthiram', 'uttaraphalguni'] },
            { ta: 'அஸ்தம்', en: ['hastha', 'hastham', 'astham'] },
            { ta: 'சித்திரை', en: ['chitra', 'chithirai'] },
            { ta: 'சுவாதி', en: ['swathi', 'swati'] },
            { ta: 'விசாகம்', en: ['vishakha', 'visakam', 'visakha'] },
            { ta: 'அனுஷம்', en: ['anuradha', 'anusham'] },
            { ta: 'கேட்டை', en: ['jyeshtha', 'jyeshta', 'kettai'] },
            { ta: 'மூலம்', en: ['moola', 'moolam'] },
            { ta: 'பூராடம்', en: ['purvashadha', 'pooradam', 'purvaashadha'] },
            { ta: 'உத்திராடம்', en: ['uttarashadha', 'uthiradam', 'uttaraashadha'] },
            { ta: 'திருவோணம்', en: ['shravana', 'sravana', 'thiruvonam', 'thiruonam'] },
            { ta: 'அவிட்டம்', en: ['dhanishta', 'avittam'] },
            { ta: 'சதயம்', en: ['shatabhisha', 'satabhisha', 'sadhayam', 'sathayam'] },
            { ta: 'பூரட்டாதி', en: ['purva bhadrapada', 'poorattathi', 'purvabhadra'] },
            { ta: 'உத்திரட்டாதி', en: ['uttara bhadrapada', 'uthirattathi', 'uttarabhadra'] },
            { ta: 'ரேவதி', en: ['revathi', 'revati'] }
        ];

        function matchStar(rawVal) {
            if (!rawVal) return '';
            let norm = (typeof normalizeTamilVisualOrder === 'function') ? normalizeTamilVisualOrder(String(rawVal)) : String(rawVal);
            const clean = norm.replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();
            if (!clean) return '';
            // Sort by ta length descending so compound star names (e.g. பூரட்டாதி, பூராடம்) match before short roots (e.g. பூரம்)
            const sortedStars = [...STARS_CANONICAL].sort((a, b) => b.ta.length - a.ta.length);
            for (const s of sortedStars) {
                const taClean = s.ta.replace(/\s+/g, '').toLowerCase();
                if (clean.includes(taClean) || taClean.includes(clean)) return s.ta;
                // Prefix match with minimum 4 chars to handle OCR vowel variations (e.g. பூரட்டாத -> பூரட்டாதி)
                if (clean.length >= 4 && (taClean.startsWith(clean.slice(0, 4)) || clean.startsWith(taClean.slice(0, 4)))) return s.ta;
                for (const e of s.en) {
                    const eClean = e.replace(/\s+/g, '').toLowerCase();
                    if (clean.includes(eClean) || eClean.includes(clean)) return s.ta;
                }
            }
            return '';
        }

        function matchDosham(rawVal) {
            if (!rawVal) return '';
            let norm = (typeof normalizeTamilVisualOrder === 'function') ? normalizeTamilVisualOrder(String(rawVal)) : String(rawVal);
            const clean = norm.replace(/[\s\._\-\–\(\)]+/g, '').toLowerCase();
            if (!clean || clean === '-') return '';
            if (clean.includes('நிவர்த்தி') || clean.includes('nivarthi')) {
                return 'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி';
            }
            if (clean.includes('செவ்வாய்') || clean.includes('chevvai') || clean.includes('sevva') || clean.includes('mars')) {
                return 'செவ்வாய் தோஷம்';
            }
            if (clean.includes('ராகு') || clean.includes('கேது') || clean.includes('rahu') || clean.includes('ketu')) {
                return 'ராகு கேது தோஷம்';
            }
            if (clean.includes('சுத்தம்') || clean.includes('இல்லை') || clean.includes('clean') || clean.includes('clear') || clean.includes('no') || clean.includes('nil') || clean.includes('none')) {
                return 'சுத்தம்';
            }
            return '';
        }

        function syncStarDropdown(val) {
            if (!val) return;
            const el = document.getElementById('natchathiram');
            if (!el) return;
            const star = matchStar(val) || val;
            const clean = star.replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();

            // Direct value assignment first
            el.value = star;
            if (el.selectedIndex > 0) {
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
                return;
            }

            for (let i = 0; i < el.options.length; i++) {
                const opt = el.options[i];
                if (!opt.value) continue;
                const optClean = opt.value.replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();
                const txtClean = (opt.text || opt.innerText || '').replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();
                if (optClean === clean || optClean.includes(clean) || clean.includes(optClean) || txtClean === clean || txtClean.includes(clean) || clean.includes(txtClean)) {
                    el.selectedIndex = i;
                    el.dispatchEvent(new Event('input', { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                    return;
                }
            }
        }

        function syncLagnamDropdown(val) {
            if (!val) return;
            const el = document.getElementById('lagnam');
            if (!el) return;
            const matched = matchRasi(val) || val;
            const clean = String(matched).replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
            for (let i = 0; i < el.options.length; i++) {
                const opt = el.options[i];
                if (!opt.value) continue;
                const optClean = opt.value.replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
                const optTxt = opt.text.replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1').replace(/\s+/g, '').toLowerCase();
                if (optClean === clean || optTxt === clean || optClean.includes(clean) || clean.includes(optClean)) {
                    el.selectedIndex = i;
                    el.dispatchEvent(new Event('input', { bubbles: true }));
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                    return;
                }
            }
        }

        function syncDoshamDropdown(val) {
            if (!val) return;
            const el = document.getElementById('dosham');
            if (!el) return;
            const matched = matchDosham(val);
            if (matched) {
                el.value = matched;
            }
            if (el.selectedIndex <= 0) {
                const clean = String(val).replace(/\s+/g, '').toLowerCase();
                for (let i = 0; i < el.options.length; i++) {
                    const opt = el.options[i];
                    if (!opt.value) continue;
                    const optClean = opt.value.replace(/\s+/g, '').toLowerCase();
                    const optTxt = (opt.text || opt.innerText || '').replace(/\s+/g, '').toLowerCase();
                    if (optClean === clean || optClean.includes(clean) || clean.includes(optClean) || optTxt === clean || optTxt.includes(clean) || clean.includes(optTxt)) {
                        el.selectedIndex = i;
                        break;
                    }
                }
            }
            if (el.value) {
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }

        function syncMarriageTypeDropdown(val) {
            if (!val) return;
            const el = document.getElementById('marriage_type');
            if (!el) return;
            const lower = val.toLowerCase().trim();
            if (lower === 'mudhal_manama' || lower.includes('mudhal') || lower.includes('1st') || lower.includes('முதல்') || lower.includes('first')) {
                el.value = 'mudhal_manama';
            } else if (lower.includes('maru') || lower.includes('re') || lower.includes('second') || lower.includes('2') || lower.includes('மறு')) {
                el.value = 'marumanama';
            } else {
                el.value = 'mudhal_manama';
            }
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Dropdown Click Handlers
        function pickCommunityOption(val) {
            const inp = document.getElementById('community');
            const sel = document.getElementById('community_select');
            if (inp && val !== '') {
                const chosen = (appLang === 'en' && sel && sel.selectedIndex >= 0) ? sel.options[sel.selectedIndex].text : val;
                inp.value = chosen;
                inp.dispatchEvent(new Event('input', { bubbles: true }));
                inp.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }

        function pickJobOption(val) {
            const inp = document.getElementById('job_title');
            if (inp && val !== '') {
                inp.value = val;
                inp.dispatchEvent(new Event('input', { bubbles: true }));
                inp.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }

        // Robust Dropdown Matchers (Bidirectional - Tamil value matches English options & vice versa)
        function syncCommunityDropdown(val) {
            const sel = document.getElementById('community_select');
            const inp = document.getElementById('community');
            if (!sel) return;
            if (!val || !val.toString().trim()) {
                sel.selectedIndex = 0;
                return;
            }
            const clean = val.toString().trim();
            const lower = clean.toLowerCase();

            let matchedIdx = -1;
            // Pass 1: exact match on value or text
            for (let i = 1; i < sel.options.length; i++) {
                const optVal = sel.options[i].value.toLowerCase();
                const optTxt = sel.options[i].text.toLowerCase();
                if (optVal === lower || optTxt === lower) {
                    matchedIdx = i;
                    break;
                }
            }

            // Pass 2: keyword-based cross-language matching
            if (matchedIdx === -1) {
                const commKeywords = [
                    { keys: ['கைக்கோள', 'kaikol', 'kaikkol'], match: ['கைக்கோளர்', 'kaikolar', 'kaikkolar'] },
                    { keys: ['செங்குந்த', 'sengunth'], match: ['செங்குந்தர்', 'sengunthar'] },
                    { keys: ['செங்குந்த', 'sengunth'], match: ['செங்குந்தர்', 'sengunthar'] },
                    { keys: ['நாடார்', 'nadar'], match: ['நாடார்', 'nadar'] },
                    { keys: ['கவுண்ட', 'gound', 'gounder'], match: ['கவுண்டர்', 'gounder'] },
                    { keys: ['செட்டியா', 'chett'], match: ['செட்டியார்', 'chettiar'] },
                    { keys: ['நாயுடு', 'naidu'], match: ['நாயுடு', 'naidu'] },
                    { keys: ['முதலியா', 'mudali'], match: ['முதலியார்', 'mudaliar'] }
                ];
                for (const item of commKeywords) {
                    if (item.keys.some(k => lower.includes(k))) {
                        for (let i = 1; i < sel.options.length; i++) {
                            const oVal = sel.options[i].value.toLowerCase();
                            const oTxt = sel.options[i].text.toLowerCase();
                            if (item.match.some(m => oVal.includes(m) || oTxt.includes(m))) {
                                matchedIdx = i;
                                break;
                            }
                        }
                        if (matchedIdx !== -1) break;
                    }
                }
            }

            if (matchedIdx !== -1) {
                sel.selectedIndex = matchedIdx;
                if (inp) {
                    const chosenText = sel.options[matchedIdx].text;
                    const chosenVal = sel.options[matchedIdx].value;
                    const targetVal = (appLang === 'en') ? (chosenText || chosenVal) : chosenVal;
                    inp.value = targetVal;
                    inp.dispatchEvent(new Event('input', { bubbles: true }));
                    inp.dispatchEvent(new Event('change', { bubbles: true }));
                }
            } else if (clean) {
                const opt = new Option(clean, clean, true, true);
                sel.add(opt);
                sel.value = clean;
                if (inp) inp.value = clean;
            }
        }

        function syncJobDropdown(val) {
            const sel = document.getElementById('job_select');
            if (!sel) return;
            if (!val || !val.toString().trim()) {
                sel.selectedIndex = 0;
                return;
            }
            const clean = val.toString().trim();
            const lower = clean.toLowerCase();

            let matchedIdx = -1;
            // Pass 1: exact or substring match
            for (let i = 1; i < sel.options.length; i++) {
                const optVal = sel.options[i].value.toLowerCase();
                const optTxt = sel.options[i].text.toLowerCase();
                if (optVal === lower || optTxt === lower || (optVal.length > 3 && lower.includes(optVal)) || (optTxt.length > 3 && lower.includes(optTxt))) {
                    matchedIdx = i;
                    break;
                }
            }

            // Pass 2: keyword-based cross-language matching
            if (matchedIdx === -1) {
                const jobKeywords = [
                    { keys: ['civil engineer', 'architect', 'பொறியாளர்', 'civil', 'mechanical', 'கட்டுமானம்'], match: ['civil', 'பொறியாளர்'] },
                    { keys: ['மென்பொருள்', 'software', 'it ', 'developer', 'programmer'], match: ['மென்பொருள்', 'software'] },
                    { keys: ['அரசு', 'govt', 'government'], match: ['அரசு', 'government'] },
                    { keys: ['மருத்துவர்', 'doctor', 'medical', 'mbbs'], match: ['மருத்துவர்', 'doctor'] },
                    { keys: ['வணிகம்', 'சொந்த தொழில்', 'business', 'commerce', 'textile', 'ஜவுளி', 'enterprise'], match: ['வணிகம்', 'business', 'enterprise'] },
                    { keys: ['வங்கி', 'bank'], match: ['வங்கி', 'bank'] },
                    { keys: ['தனியார்', 'private company', 'pvt', 'private employee'], match: ['தனியார்', 'private'] },
                    { keys: ['ஆசிரியர்', 'பேராசிரியர்', 'teacher', 'professor', 'school'], match: ['ஆசிரியர்', 'teacher'] },
                    { keys: ['காவல்', 'ராணுவம்', 'police', 'defense', 'army', 'armed'], match: ['காவல்', 'police', 'armed'] },
                    { keys: ['வழக்கறிஞர்', 'lawyer', 'advocate'], match: ['வழக்கறிஞர்', 'lawyer'] },

                    { keys: ['விவசாயம்', 'agri', 'farm'], match: ['விவசாயம்', 'agri'] },
                    { keys: ['சுயதொழில்', 'self employed', 'freelanc'], match: ['சுயதொழில்', 'self'] }
                ];
                for (const item of jobKeywords) {
                    if (item.keys.some(k => lower.includes(k))) {
                        for (let i = 1; i < sel.options.length; i++) {
                            const oVal = sel.options[i].value.toLowerCase();
                            const oTxt = sel.options[i].text.toLowerCase();
                            if (item.match.some(m => oVal.includes(m) || oTxt.includes(m))) {
                                matchedIdx = i;
                                break;
                            }
                        }
                        if (matchedIdx !== -1) break;
                    }
                }
            }

            if (matchedIdx !== -1) {
                sel.selectedIndex = matchedIdx;
            } else if (clean) {
                const opt = new Option(clean, clean, true, true);
                sel.add(opt);
                sel.value = clean;
            }
        }

        function syncEducationDropdown(val) {
            const sel = document.getElementById('education');
            if (!sel) return;
            if (!val || !val.toString().trim()) {
                sel.selectedIndex = 0;
                return;
            }
            const clean = val.toString().trim();
            const lower = clean.toLowerCase();

            let matchedIdx = -1;
            // Pass 1: exact or substring match
            for (let i = 1; i < sel.options.length; i++) {
                const optVal = sel.options[i].value.toLowerCase();
                const optTxt = sel.options[i].text.toLowerCase();
                if (optVal === lower || optTxt === lower ||
                    (optVal.length > 3 && lower.includes(optVal)) ||
                    (optTxt.length > 3 && lower.includes(optTxt))) {
                    matchedIdx = i;
                    break;
                }
            }

            if (matchedIdx === -1) {
                const eduKeywords = [
                    { keys: ['b.e', 'btech', 'b.tech', 'பொறியியல் பட்டம்', 'engineering'], match: ['பொறியியல் பட்டம்', 'b.e', 'engineering'] },
                    { keys: ['m.e', 'mtech', 'm.tech', 'முதுகலை பொறியியல்'], match: ['முதுகலை பொறியியல்', 'm.e'] },
                    { keys: ['mbbs', 'மருத்துவ படிப்பு', 'doctor'], match: ['மருத்துவ படிப்பு', 'mbbs'] },
                    { keys: ['md', 'ms', 'முதுகலை மருத்துவம்'], match: ['முதுகலை மருத்துவம்', 'md'] },
                    { keys: ['bds', 'பல் மருத்துவம்', 'dental'], match: ['பல் மருத்துவம்', 'bds'] },
                    { keys: ['pharm', 'மருந்தியல்'], match: ['மருந்தியல்', 'pharm'] },
                    { keys: ['b.sc computer', 'bsc computer', 'கணினி அறிவியல்'], match: ['கணினி அறிவியல்', 'b.sc computer'] },
                    { keys: ['b.sc', 'bsc', 'அறிவியல் பட்டம்'], match: ['அறிவியல் பட்டம்', 'b.sc science'] },
                    { keys: ['b.com', 'bcom', 'வணிகவியல் பட்டம்'], match: ['வணிகவியல் பட்டம்', 'b.com'] },
                    { keys: ['bba', 'வணிக மேலாண்மை'], match: ['வணிக மேலாண்மை', 'bba'] },
                    { keys: ['bca', 'கணினி பயன்பாட்டியல்'], match: ['கணினி பயன்பாட்டியல்', 'bca'] },
                    { keys: ['mca', 'முதுகலை கணினி'], match: ['முதுகலை கணினி', 'mca'] },
                    { keys: ['mba', 'முதுகலை வணிகம்'], match: ['முதுகலை வணிகம்', 'mba'] },
                    { keys: ['chartered', 'ca', 'பட்டய கணக்காளர்'], match: ['பட்டய கணக்காளர்', 'chartered'] },
                    { keys: ['law', 'சட்ட படிப்பு', 'llb'], match: ['சட்ட படிப்பு', 'law'] },
                    { keys: ['diploma', 'டிப்ளமோ'], match: ['டிப்ளமோ', 'diploma'] },
                    { keys: ['12', 'higher secondary', '+2', 'மேல்நிலை'], match: ['மேல்நிலை', 'higher secondary'] },
                    { keys: ['10', 'sslc', 'secondary', 'பத்தாம்'], match: ['பத்தாம்', 'secondary'] },
                    { keys: ['phd', 'doctorate', 'முனைவர்'], match: ['முனைவர்', 'phd'] }
                ];
                for (const item of eduKeywords) {
                    if (item.keys.some(k => lower.includes(k))) {
                        for (let i = 1; i < sel.options.length; i++) {
                            const oVal = sel.options[i].value.toLowerCase();
                            const oTxt = sel.options[i].text.toLowerCase();
                            if (item.match.some(m => oVal.includes(m) || oTxt.includes(m))) {
                                matchedIdx = i;
                                break;
                            }
                        }
                        if (matchedIdx !== -1) break;
                    }
                }
            }

            if (matchedIdx !== -1) {
                sel.selectedIndex = matchedIdx;
            } else if (clean) {
                const opt = new Option(clean, clean, true, true);
                sel.add(opt);
                sel.value = clean;
            }
        }

        const MATRIMONY_MASTER_LISTS = {
            community: {
                ta: ['கைக்கோளர்', 'செங்குந்தர்'],
                en: ['Kaikolar', 'Sengunthar']
            },
            education: {
                ta: [
                    { val: 'பொறியியல் பட்டம்', label: 'பொறியியல் பட்டம் (B.E / B.Tech)' },
                    { val: 'முதுகலை பொறியியல்', label: 'முதுகலை பொறியியல் (M.E / M.Tech)' },
                    { val: 'மருத்துவ படிப்பு', label: 'மருத்துவ படிப்பு (MBBS)' },
                    { val: 'முதுகலை மருத்துவம்', label: 'முதுகலை மருத்துவம் (MD/MS)' },
                    { val: 'பல் மருத்துவம்', label: 'பல் மருத்துவம் (BDS)' },
                    { val: 'மருந்தியல் படிப்பு', label: 'மருந்தியல் படிப்பு (B.Pharm)' },
                    { val: 'கணினி அறிவியல்', label: 'கணினி அறிவியல் (B.Sc CS)' },
                    { val: 'அறிவியல் பட்டம்', label: 'அறிவியல் பட்டம் (B.Sc)' },
                    { val: 'வணிகவியல் பட்டம்', label: 'வணிகவியல் பட்டம் (B.Com)' },
                    { val: 'வணிக மேலாண்மை', label: 'வணிக மேலாண்மை (BBA)' },
                    { val: 'கணினி பயன்பாட்டியல்', label: 'கணினி பயன்பாட்டியல் (BCA)' },
                    { val: 'முதுகலை கணினி', label: 'முதுகலை கணினி (MCA)' },
                    { val: 'முதுகலை வணிகம்', label: 'முதுகலை வணிகம் (MBA)' },
                    { val: 'பட்டய கணக்காளர்', label: 'பட்டய கணக்காளர் (CA)' },
                    { val: 'சட்ட படிப்பு', label: 'சட்ட படிப்பு (BL/LLB)' },
                    { val: 'டிப்ளமோ', label: 'டிப்ளமோ (Diploma)' },
                    { val: 'மேல்நிலை கல்வி', label: 'மேல்நிலை கல்வி (12th)' },
                    { val: 'பத்தாம் வகுப்பு', label: 'பத்தாம் வகுப்பு (10th)' },
                    { val: 'முனைவர் பட்டம்', label: 'முனைவர் பட்டம் (PhD)' },
                    { val: 'இதர கல்வி', label: 'இதர கல்வி' }
                ],
                en: [
                    { val: 'B.E / B.Tech', label: 'B.E / B.Tech (Engineering)' },
                    { val: 'M.E / M.Tech', label: 'M.E / M.Tech (Master of Engg)' },
                    { val: 'MBBS / Doctor', label: 'MBBS / Doctor' },
                    { val: 'MD / MS', label: 'MD / MS (Master of Medicine)' },
                    { val: 'BDS Dental', label: 'BDS Dental' },
                    { val: 'B.Pharm / M.Pharm', label: 'B.Pharm / M.Pharm' },
                    { val: 'B.Sc Computer Science', label: 'B.Sc Computer Science' },
                    { val: 'B.Sc Science', label: 'Bachelor of Science (B.Sc)' },
                    { val: 'B.Com', label: 'Bachelor of Commerce (B.Com)' },
                    { val: 'BBA', label: 'Bachelor of Business Admin (BBA)' },
                    { val: 'BCA', label: 'Bachelor of Computer App (BCA)' },
                    { val: 'MCA', label: 'Master of Computer App (MCA)' },
                    { val: 'MBA', label: 'Master of Business Admin (MBA)' },
                    { val: 'Chartered Accountant', label: 'Chartered Accountant (CA)' },
                    { val: 'Law Degree', label: 'Law Degree (LLB)' },
                    { val: 'Diploma', label: 'Polytechnic Diploma' },
                    { val: 'Higher Secondary', label: 'Higher Secondary (12th)' },
                    { val: 'Secondary School', label: 'Secondary School (10th)' },
                    { val: 'PhD Doctorate', label: 'Doctorate (PhD)' },
                    { val: 'Others', label: 'Other Qualifications' }
                ]
            },
            job: {
                ta: [
                    { val: 'மென்பொருள் பொறியாளர்', label: 'மென்பொருள் பொறியாளர் (IT)' },
                    { val: 'அரசு பணி', label: 'அரசு பணி (Government Job)' },
                    { val: 'மருத்துவர்', label: 'மருத்துவர் (Doctor)' },
                    { val: 'வணிகம் / சொந்த தொழில்', label: 'வணிகம் / சொந்த தொழில் (Business)' },
                    { val: 'வங்கி பணி', label: 'வங்கி பணி (Banking)' },
                    { val: 'தனியார் நிறுவனம்', label: 'தனியார் நிறுவன பணி (Private Company)' },
                    { val: 'ஆசிரியர் / பேராசிரியர்', label: 'ஆசிரியர் / பேராசிரியர் (Teacher)' },
                    { val: 'காவல்துறை / ராணுவம்', label: 'காவல்துறை / ராணுவம் (Police/Defense)' },
                    { val: 'வழக்கறிஞர்', label: 'வழக்கறிஞர் (Lawyer)' },
                    { val: 'பொறியாளர்', label: 'பொறியாளர் (Civil / Mechanical)' },
                    { val: 'விவசாயம்', label: 'விவசாயம் (Agriculture)' },
                    { val: 'சுயதொழில்', label: 'சுயதொழில் (Self Employed)' },
                    { val: 'இதர பணிகள்', label: 'இதர பணிகள் (Others)' }
                ],
                en: [
                    { val: 'Software Engineer (IT)', label: 'Software Engineer (IT)' },
                    { val: 'Government Job', label: 'Government Job' },
                    { val: 'Doctor / Medical', label: 'Doctor / Medical' },
                    { val: 'Business / Commerce', label: 'Business / Commerce' },
                    { val: 'Banking & Finance', label: 'Banking & Finance' },
                    { val: 'Private Company', label: 'Private Company Employee' },
                    { val: 'Teacher / Professor', label: 'Teacher / Professor' },
                    { val: 'Police / Defense', label: 'Police / Armed Forces' },
                    { val: 'Lawyer / Advocate', label: 'Lawyer / Advocate' },
                    { val: 'Civil Engineer', label: 'Civil Engineer / Architect' },
                    { val: 'Agriculture', label: 'Agriculture / Farming' },
                    { val: 'Self Employed', label: 'Self Employed' },
                    { val: 'Others', label: 'Other Professions' }
                ]
            }
        };

        function syncAllDropdowns(lang) {
            const isTa = (lang === 'ta');
            const defaultText = isTa ? '-- தேர்ந்தெடுக்கவும் --' : '-- Select an option --';

            const cSel = document.getElementById('community_select');
            if (cSel) {
                let html = `<option value="">${defaultText}</option>`;
                const cList = MATRIMONY_MASTER_LISTS.community[lang] || MATRIMONY_MASTER_LISTS.community.ta;
                cList.forEach(item => {
                    html += `<option value="${item}">${item}</option>`;
                });
                cSel.innerHTML = html;
                syncCommunityDropdown(document.getElementById('community')?.value);
            }

            const eSel = document.getElementById('education');
            if (eSel) {
                const curVal = eSel.value;
                let html = `<option value="">${defaultText}</option>`;
                const eList = MATRIMONY_MASTER_LISTS.education[lang] || MATRIMONY_MASTER_LISTS.education.ta;
                eList.forEach(item => {
                    html += `<option value="${item.val}">${item.label}</option>`;
                });
                eSel.innerHTML = html;
                syncEducationDropdown(curVal);
            }

            const jSel = document.getElementById('job_select');
            if (jSel) {
                let html = `<option value="">${defaultText}</option>`;
                const jList = MATRIMONY_MASTER_LISTS.job[lang] || MATRIMONY_MASTER_LISTS.job.ta;
                jList.forEach(item => {
                    html += `<option value="${item.val}">${item.label}</option>`;
                });
                jSel.innerHTML = html;
                syncJobDropdown(document.getElementById('job_title')?.value);
            }
        }

        // Comprehensive Bidirectional Translation Dictionary
        const MATRIMONY_TRANSLATIONS = [
            // Exact full sample mappings
            { ta: 'அமிர்தவடிவு நா', en: 'AMIRTHAVADIVU N' },
            { ta: 'அமிர்தவடிவு', en: 'Amirthavadivu' },
            { ta: 'நந்தகுமார் எஸ்', en: 'Nandhakumar S' },
            { ta: 'நந்தகுமார்', en: 'Nandhakumar' },
            { ta: 'உஷா நா', en: 'Usha N' },
            { ta: 'உஷா', en: 'Usha' },
            { ta: 'சரவணகுமார் மா', en: 'SARAVANAKUMAR M' },
            { ta: 'சரவணகுமார்', en: 'Saravanakumar' },
            { ta: 'முத்துசாமி கே', en: 'Muthusamy K' },
            { ta: 'முத்துசாமி', en: 'Muthusamy' },
            { ta: 'லட்சுமி மா', en: 'Lakshmi M' },
            { ta: 'லட்சுமி', en: 'Lakshmi' },

            // Communities
            { ta: 'செங்குந்தர்', en: 'Sengunthar' },
            { ta: 'கைக்கோளர்', en: 'Kaikolar' },
            { ta: 'செங்குந்த முதலியார்', en: 'Senguntha Mudaliar' },
            { ta: 'முதலியார்', en: 'Mudaliar' },
            { ta: 'நாடார்', en: 'Nadar' },
            { ta: 'கவுண்டர்', en: 'Gounder' },
            { ta: 'செட்டியார்', en: 'Chettiar' },
            { ta: 'நாயுடு', en: 'Naidu' },
            { ta: 'இதர பிரிவுகள்', en: 'Others' },

            // Places
            { ta: 'ஈரோடு', en: 'Erode' },
            { ta: 'சென்னை', en: 'Chennai' },
            { ta: 'கோயம்புத்தூர்', en: 'Coimbatore' },
            { ta: 'கோவை', en: 'Coimbatore' },
            { ta: 'சேலம்', en: 'Salem' },
            { ta: 'திருப்பூர்', en: 'Tirupur' },
            { ta: 'திருச்சி', en: 'Trichy' },
            { ta: 'மதுரை', en: 'Madurai' },
            { ta: 'கரூர்', en: 'Karur' },
            { ta: 'நாமக்கல்', en: 'Namakkal' },
            { ta: 'திண்டுக்கல்', en: 'Dindigul' },
            { ta: 'பெங்களூரு', en: 'Bangalore' },
            { ta: 'பெங்களூர்', en: 'Bangalore' },
            { ta: 'அந்தியூர்', en: 'Anthiyur' },
            { ta: 'பெருந்துறை', en: 'Perundurai' },
            { ta: 'பவானி', en: 'Bhavani' },
            { ta: 'கோபிசெட்டிபாளையம்', en: 'Gobichettipalayam' },
            { ta: 'கோபி', en: 'Gobi' },
            { ta: 'சத்தியமங்கலம்', en: 'Sathyamangalam' },
            { ta: 'கீரனூர்', en: 'Keeranur' },

            // Jobs
            { ta: 'மென்பொருள் பொறியாளர் (IT)', en: 'Software Engineer (IT)' },
            { ta: 'மென்பொருள் பொறியாளர்', en: 'Software Engineer (IT)' },
            { ta: 'மென்பொருள் வடிவமைப்பாளர் (Software Architect)', en: 'Software Architect' },
            { ta: 'மென்பொருள் வடிவமைப்பாளர்', en: 'Software Architect' },
            { ta: 'ஆசிரியர் (அரசு பள்ளி)', en: 'Teacher (Govt School)' },
            { ta: 'ஆசிரியர் / பேராசிரியர் (Teacher)', en: 'Teacher / Professor' },
            { ta: 'ஆசிரியர் / பேராசிரியர்', en: 'Teacher / Professor' },
            { ta: 'ஆசிரியர்', en: 'Teacher' },
            { ta: 'இல்லத்தரசி (Home Maker)', en: 'Home Maker' },
            { ta: 'இல்லத்தரசி', en: 'Home Maker' },
            { ta: 'தொழில் / ஜவுளி தொழில்', en: 'Business / Textile Business' },
            { ta: 'ஜவுளி தொழில்', en: 'Textile Business' },
            { ta: 'வணிகம் / சொந்த தொழில் (Business)', en: 'Business / Commerce' },
            { ta: 'வணிகம் / சொந்த தொழில்', en: 'Business / Commerce' },
            { ta: 'வணிகம்', en: 'Business' },
            { ta: 'சொந்த தொழில்', en: 'Business' },
            { ta: 'அரசு பணி (Government Job)', en: 'Government Job' },
            { ta: 'அரசு பணி', en: 'Government Job' },
            { ta: 'மருத்துவர் (Doctor)', en: 'Doctor / Medical' },
            { ta: 'மருத்துவர்', en: 'Doctor / Medical' },
            { ta: 'வங்கி பணி (Banking)', en: 'Banking & Finance' },
            { ta: 'வங்கி பணி', en: 'Banking & Finance' },
            { ta: 'தனியார் நிறுவன பணி (Private Company)', en: 'Private Company Employee' },
            { ta: 'தனியார் நிறுவனம்', en: 'Private Company Employee' },
            { ta: 'காவல்துறை / ராணுவம் (Police/Defense)', en: 'Police / Armed Forces' },
            { ta: 'காவல்துறை / ராணுவம்', en: 'Police / Armed Forces' },
            { ta: 'வழக்கறிஞர் (Lawyer)', en: 'Lawyer / Advocate' },
            { ta: 'வழக்கறிஞர்', en: 'Lawyer / Advocate' },
            { ta: 'பொறியாளர் (Civil / Mechanical)', en: 'Civil Engineer / Architect' },
            { ta: 'பொறியாளர்', en: 'Civil Engineer / Architect' },
            { ta: 'விவசாயம் (Agriculture)', en: 'Agriculture / Farming' },
            { ta: 'விவசாயம்', en: 'Agriculture / Farming' },
            { ta: 'சுயதொழில் (Self Employed)', en: 'Self Employed' },
            { ta: 'சுயதொழில்', en: 'Self Employed' },
            { ta: 'இதர பணிகள் (Others)', en: 'Other Professions' },
            { ta: 'இதர பணிகள்', en: 'Other Professions' },

            // Education
            { ta: 'பொறியியல் பட்டம் (B.E / B.Tech)', en: 'B.E / B.Tech (Engineering)' },
            { ta: 'பொறியியல் பட்டம்', en: 'B.E / B.Tech (Engineering)' },
            { ta: 'முதுகலை பொறியியல் (M.E / M.Tech)', en: 'M.E / M.Tech (Master of Engg)' },
            { ta: 'முதுகலை பொறியியல்', en: 'M.E / M.Tech (Master of Engg)' },
            { ta: 'மருத்துவ படிப்பு (MBBS)', en: 'MBBS / Doctor' },
            { ta: 'மருத்துவ படிப்பு', en: 'MBBS / Doctor' },
            { ta: 'முதுகலை மருத்துவம் (MD/MS)', en: 'MD / MS' },
            { ta: 'முதுகலை மருத்துவம்', en: 'MD / MS' },
            { ta: 'பல் மருத்துவம் (BDS)', en: 'BDS Dental' },
            { ta: 'பல் மருத்துவம்', en: 'BDS Dental' },
            { ta: 'மருந்தியல் படிப்பு (B.Pharm)', en: 'B.Pharm / M.Pharm' },
            { ta: 'மருந்தியல் படிப்பு', en: 'B.Pharm / M.Pharm' },
            { ta: 'கணினி அறிவியல் (B.Sc CS)', en: 'B.Sc Computer Science' },
            { ta: 'கணினி அறிவியல்', en: 'B.Sc Computer Science' },
            { ta: 'அறிவியல் பட்டம் (B.Sc)', en: 'Bachelor of Science (B.Sc)' },
            { ta: 'அறிவியல் பட்டம்', en: 'Bachelor of Science (B.Sc)' },
            { ta: 'வணிகவியல் பட்டம் (B.Com)', en: 'Bachelor of Commerce (B.Com)' },
            { ta: 'வணிகவியல் பட்டம்', en: 'Bachelor of Commerce (B.Com)' },
            { ta: 'வணிக மேலாண்மை (BBA)', en: 'Bachelor of Business Admin (BBA)' },
            { ta: 'வணிக மேலாண்மை', en: 'Bachelor of Business Admin (BBA)' },
            { ta: 'கணினி பயன்பாட்டியல் (BCA)', en: 'Bachelor of Computer App (BCA)' },
            { ta: 'கணினி பயன்பாட்டியல்', en: 'Bachelor of Computer App (BCA)' },
            { ta: 'முதுகலை கணினி (MCA)', en: 'Master of Computer App (MCA)' },
            { ta: 'முதுகலை கணினி', en: 'Master of Computer App (MCA)' },
            { ta: 'முதுகலை வணிகம் (MBA)', en: 'Master of Business Admin (MBA)' },
            { ta: 'முதுகலை வணிகம்', en: 'Master of Business Admin (MBA)' },
            { ta: 'பட்டய கணக்காளர் (CA)', en: 'Chartered Accountant (CA)' },
            { ta: 'பட்டய கணக்காளர்', en: 'Chartered Accountant (CA)' },
            { ta: 'சட்ட படிப்பு (BL/LLB)', en: 'Law Degree (LLB)' },
            { ta: 'சட்ட படிப்பு', en: 'Law Degree (LLB)' },
            { ta: 'டிப்ளமோ (Diploma)', en: 'Polytechnic Diploma' },
            { ta: 'டிப்ளமோ', en: 'Polytechnic Diploma' },
            { ta: 'மேல்நிலை கல்வி (12th)', en: 'Higher Secondary (12th)' },
            { ta: 'மேல்நிலை கல்வி', en: 'Higher Secondary (12th)' },
            { ta: 'பத்தாம் வகுப்பு (10th)', en: 'Secondary School (10th)' },
            { ta: 'பத்தாம் வகுப்பு', en: 'Secondary School (10th)' },
            { ta: 'முனைவர் பட்டம் (PhD)', en: 'Doctorate (PhD)' },
            { ta: 'முனைவர் பட்டம்', en: 'Doctorate (PhD)' },
            { ta: 'இதர கல்வி', en: 'Other Qualifications' },

            // Companies
            { ta: 'இன்போசிஸ், பெங்களூரு', en: 'Infosys, Bangalore' },
            { ta: 'இன்போசிஸ்', en: 'Infosys' },
            { ta: 'டிசிஎஸ், சென்னை', en: 'TCS, Chennai' },
            { ta: 'டிசிஎஸ்', en: 'TCS' },
            { ta: 'விப்ரோ', en: 'Wipro' },
            { ta: 'காக்னிசன்ட்', en: 'Cognizant' },

            // Complexion
            { ta: 'சிவப்பு', en: 'Fair' },
            { ta: 'மாநிறம்', en: 'Wheatish' },
            { ta: 'அடர் சிவப்பு', en: 'Very Fair' },
            { ta: 'கருப்பு', en: 'Dark' },

            // Deities & Clans
            { ta: 'ஸ்ரீ மீனாட்சி அம்மன், மதுரை', en: 'Sri Meenakshi Amman, Madurai' },
            { ta: 'ஸ்ரீ முருகன் கோவில், பழனி', en: 'Sri Murugan Temple, Palani' },
            { ta: 'சிவ கோத்திரம்', en: 'Siva Gothram' },
            { ta: 'விஷ்ணு கோத்திரம்', en: 'Vishnu Gothram' },
            { ta: 'காடை கூட்டம்', en: 'Kadai Kootam' },
            { ta: 'முத்துராசர் கூட்டம்', en: 'Muthurasar Kootam' },

            // Wealth & Siblings
            { ta: 'சொந்த வீடு, 5 ஏக்கர் விவசாய நிலம்', en: 'Own House, 5 Acres Agriculture Land' },
            { ta: 'சொந்த வீடு மற்றும் தோட்டம்', en: 'Own House and Farm Garden' },
            { ta: 'சொந்த வீடு', en: 'Own House' },
            { ta: '1 தம்பி - B.Tech படித்து வருகிறார்', en: '1 Younger Brother - Studying B.Tech' },
            { ta: '1 தம்பி, B.E முடித்து பணியில் உள்ளார்', en: '1 Younger Brother, completed B.E and employed' },
            { ta: '1 அண்ணன்', en: '1 Elder Brother' },
            { ta: '1 தம்பி', en: '1 Younger Brother' },
            { ta: '1 அக்கா', en: '1 Elder Sister' },
            { ta: '1 தங்கை', en: '1 Younger Sister' },
            { ta: 'இல்லை', en: 'None' },
            { ta: 'திருமணமானவர்', en: 'Married' },

            // Addresses
            { ta: '45, கே.கே. நகர், மதுரை', en: '45, K.K. Nagar, Madurai' },
            { ta: '12, அண்ணா நகர், சென்னை', en: '12, Anna Nagar, Chennai' },
            { ta: 'ரோடு', en: 'Road' },
            { ta: 'தெரு', en: 'Street' },
            { ta: 'நகர்', en: 'Nagar' },

            // Expectations
            { ta: 'நன்கு படித்த, நல்ல குணமுள்ள, IT அல்லது பிற துறையில் பணிபுரியும் மணமகன்', en: 'Well-educated, well-behaved groom working in IT or other reputed fields' },
            { ta: 'பட்டதாரி, குடும்ப பாங்கான மணமகள் தேவை', en: 'Graduate, homely bride required' },
            { ta: 'குடும்ப பாங்கான மணமகள் தேவை', en: 'Homely bride required' },
            { ta: 'குடும்ப பாங்கான', en: 'Homely' },
            { ta: 'மணமகள் தேவை', en: 'Bride required' },
            { ta: 'மணமகன் தேவை', en: 'Groom required' }
        ];

        function translateMatrimonyText(val, targetLang, fieldName) {
            if (!val || typeof val !== 'string') return val;
            const trimmed = val.trim();
            if (!trimmed) return val;

            // Astrology fields are strictly exempt from translation!
            const exemptFields = ['rasi', 'natchathiram', 'lagnam', 'dosham', 'thisai_iruppu', 'rdoAan', 'rdoPenn', 'email'];
            if (exemptFields.includes(fieldName)) return (fieldName === 'email') ? String(val).toLowerCase().replace(/\s+/g, '') : val;

            const isToEn = (targetLang === 'en');
            const searchKey = isToEn ? 'ta' : 'en';
            const targetKey = isToEn ? 'en' : 'ta';

            // 1. Direct exact match
            for (const item of MATRIMONY_TRANSLATIONS) {
                if (item[searchKey].toLowerCase() === trimmed.toLowerCase()) {
                    return item[targetKey];
                }
            }

            // 2. Sample profiles field-level direct match
            if (isToEn) {
                if (sampleBrideData.ta[fieldName] && sampleBrideData.ta[fieldName].toLowerCase() === trimmed.toLowerCase()) {
                    return sampleBrideData.en[fieldName] || trimmed;
                }
                if (sampleGroomData.ta[fieldName] && sampleGroomData.ta[fieldName].toLowerCase() === trimmed.toLowerCase()) {
                    return sampleGroomData.en[fieldName] || trimmed;
                }
            } else {
                if (sampleBrideData.en[fieldName] && sampleBrideData.en[fieldName].toLowerCase() === trimmed.toLowerCase()) {
                    return sampleBrideData.ta[fieldName] || trimmed;
                }
                if (sampleGroomData.en[fieldName] && sampleGroomData.en[fieldName].toLowerCase() === trimmed.toLowerCase()) {
                    return sampleGroomData.ta[fieldName] || trimmed;
                }
            }

            // 3. Substring phrase replacements
            let result = trimmed;
            for (const item of MATRIMONY_TRANSLATIONS) {
                const src = item[searchKey];
                const dst = item[targetKey];
                if (src && src.length > 2 && result.includes(src)) {
                    result = result.split(src).join(dst);
                }
            }

            return result;
        }

        function convertFormFieldsToLanguage(targetLang) {
            const fieldsToConvert = [
                'name', 'community', 'birth_place', 'job_title', 'company_details',
                'monthly_income', 'height', 'weight', 'kuladeivam',
                'gothram', 'kootam', 'father_name', 'father_job', 'father_native',
                'mother_name', 'mother_job', 'mother_native', 'family_wealth',
                'siblings_details', 'brothers', 'sisters', 'address', 'expectations'
            ];

            fieldsToConvert.forEach(fId => {
                const el = document.getElementById(fId);
                if (el && el.value && el.value.trim()) {
                    const converted = translateMatrimonyText(el.value, targetLang, fId);
                    if (converted && converted !== el.value) {
                        el.value = converted;
                        el.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                }
            });

            // Re-sync dropdown selects
            const commVal = document.getElementById('community')?.value;
            if (commVal) syncCommunityDropdown(commVal);

            const jobVal = document.getElementById('job_title')?.value;
            if (jobVal) syncJobDropdown(jobVal);

            const eduVal = document.getElementById('education')?.value;
            if (eduVal) syncEducationDropdown(eduVal);
        }

        // ==========================================
        // DYNAMIC BILINGUAL LANGUAGE PACK (Strict No-Mix)
        // Astrology is STRICTLY preserved in TAMIL in both modes!
        // ==========================================
        const langPack = {
            ta: {
                brandTitle: 'மாஸ்டர் மணமாலை',
                brandSub: 'திருமண தகவல் மையம் | அலைபேசி: +91 90000 00000',
                btnAdminPanelText: 'அட்மின் பேனல்',
                btnLogoutText: 'வெளியேறு',
                stat_total_label: 'மொத்த வரன்கள்',
                stat_female_label: '👰 பெண் வரன்கள்',
                stat_male_label: '🤵 ஆண் வரன்கள்',
                tab1Title: 'புதிய வரன் பதிவு',
                tab2Title: 'பதிவான வரன்கள் பட்டியல்',
                t_bride: '👰 பெண் வரன்',
                t_bride_sub: 'மணமகள் விபரங்கள் பதிவு',
                t_groom: '🤵 ஆண் வரன்',
                t_groom_sub: 'மணமகன் விபரங்கள் பதிவு',
                txt_smart_title: '📄 ஸ்மார்ட் பயோடேட்டா அப்லோடு & ஆட்டோபில் (Smart Auto-Fill)',
                txt_smart_sub: 'வாடிக்கையாளர் அனுப்பிய பூர்த்தி செய்த பயோடேட்டா / ஜாதகப் படம் (Photo) அல்லது PDF அப்லோடு செய்தால், அனைத்து விபரங்களும் உடனே தானாக நிரப்பப்படும்!',
                txt_dropzone_main: '📂 பயோடேட்டா போட்டோ (JPG/PNG) அல்லது PDF கோப்பை இங்கே தேர்ந்தெடுக்கவும்',
                txt_dropzone_sub: 'கணினியிலிருந்து இழுத்துப் போடவும் அல்லது கிளிக் செய்யவும் (Images: PNG, JPG | PDF | Text)',
                txt_test_sample_label: '🎯 மாதிரி கோப்புடன் சோதிக்க (Test Demo Sample):',
                txt_test_bride_btn: 'மாதிரி பெண் வரன் (Divya S)',
                txt_test_groom_btn: 'மாதிரி ஆண் வரன் (Karthik R)',
                txt_download_sample_btn: 'மாதிரி படத்தை பதிவிறக்குக (Download Image)',
                txt_success_sub: '💡 பச்சை நிறத்தில் ஒளிரும் பெட்டிகளை சரிபார்க்கவும். ஏதேனும் விபரம் மாற்ற விரும்பினால் தட்டச்சு செய்யலாம் அல்லது 🎙️ Mic பட்டனை அழுத்தி பேசி திருத்தலாம்!',
                txt_btn_ok: 'சரி (Done)',
                h_basic: 'அடிப்படை விபரங்கள்',
                l_reg_no: 'பதிவு எண் (Auto / Manual)',
                l_reg_date: 'பதிவு தேதி',
                l_name: 'வரன் பெயர் *',
                l_community: 'இனம் / சமூகம்',
                l_photo: 'வரன் புகைப்படம்',
                l_photo_help: 'பாஸ்போர்ட் சைஸ் போட்டோ பதிவேற்றவும்',
                l_admin_photo_note: 'அச்சுத்தாள் படம் காட்டும் அமைப்பு அட்மின் பேனல் மூலம் பொதுவானதாக நிர்வகிக்கப்படுகிறது.',
                h_birth: 'பிறப்பு விபரங்கள்',
                l_dob: 'பிறந்த தேதி',
                l_time: 'பிறந்த நேரம்',
                l_place: 'பிறந்த ஊர்',
                h_career: 'கல்வி & பணி விபரம்',
                l_edu: 'வரனின் படிப்பு',
                l_job: 'வேலை / தொழில்',
                l_company: 'நிறுவனம் பெயர் & ஊர்',
                l_income: 'மாத வருமானம்',
                h_physical: 'தோற்றம், குலதெய்வம் & கூட்டம்',
                l_height: 'உயரம்',
                l_weight: 'எடை',
                l_color: 'நிறம்',
                l_temple: 'குலதெய்வம், ஊர்',
                l_gothram: 'கோத்திரம்',
                l_kootam: 'கூட்டம்',
                h_family: 'பெற்றோர் & குடும்ப விபரம்',
                l_fname: 'தந்தை பெயர்',
                l_fphone: 'தந்தை அலைபேசி',
                l_fjob: 'தந்தையின் பணி',
                l_fnative: 'தந்தை பூர்வீகம்',
                l_mname: 'தாய் பெயர்',
                l_mphone: 'தாய் அலைபேசி',
                l_mjob: 'தாயின் பணி',
                l_mnative: 'தாய் பூர்வீகம்',
                l_wealth: 'குடும்ப வருமானம் / வசதிகள்',
                l_siblings: 'உடன் பிறந்தோர், உறவினர் விபரம்',
                l_brothers: 'சகோதரர்கள்',
                l_sisters: 'சகோதரிகள்',
                l_address: 'முழு முகவரி',

                // ASTROLOGY (STRICTLY TAMIL WITH BILINGUAL TITLES!)
                h_astrology: 'ஜோதிட விபரம் / Astrological Particulars',
                l_rasi: 'ராசி',
                l_star: 'நட்சத்திரம்',
                l_lagnam: 'லக்னம்',
                l_dosham: 'தோஷ விபரம்',
                l_thisai: 'திசை இருப்பு',
                l_kattam_header: '12 கட்ட ஜாதகம் (ராசி & நவாம்சம்) / 12-House Horoscope Grid (Rasi & Navamsam):',
                l_planets_label: 'கிரகங்கள்:',
                t_chart_rasi: 'ராசி கட்டம்',
                t_chart_nav: 'நவாம்சம் கட்டம்',
                hub_rasi: 'ராசி',
                hub_nav: 'நவாம்சம்',
                btn_clear_cell: '❌ அழிக்க (Clear)',

                h_expectations: 'எதிர்பார்ப்புகள் & இதர விபரம்',
                l_mtype: 'திருமண வகை',
                l_blood: 'ரத்த வகை',
                l_email: 'மின்னஞ்சல்',
                l_expect: 'எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்',
                l_expectations: 'எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்',
                btnSubmitText: '💾 வரன் விபரங்களை சேமிக்கவும்',
                btnResetText: '🔄 படிவத்தை அழிக்கவும்',

                h_directory_title: 'பதிவு செய்யப்பட்ட அனைத்து வரன்கள்',
                h_directory_sub: 'விபரங்களை பார்க்க அல்லது அச்சிட வரிசையை கிளிக் செய்யவும்',
                th_no: 'வ.எண்',
                th_pic: 'புகைப்படம்',
                th_photo: 'புகைப்படம்',
                th_reg: 'பதிவு எண் & தேதி',
                th_name: 'வரன் பெயர்',
                th_type: 'பிரிவு',
                th_caste: 'பிரிவு',
                th_rasi: 'ராசி / நட்சத்திரம்',
                th_star: 'ராசி / நட்சத்திரம்',
                th_job: 'படிப்பு / பணி',
                th_edu: 'படிப்பு / பணி',
                th_phone: 'அலைபேசி',
                th_action: 'செயல்கள்',
                th_actions: 'செயல்கள்',
                btnBulkDelete: 'தேர்ந்தெடுத்தவற்றை நீக்கு',
                searchPh: 'பெயர், படிப்பு, போன் மூலம் தேடுக...',

                btnTxtView: 'பார்வை',
                btnTxtEdit: 'திருத்து',
                btnTxtPrint: 'அச்சு',
                btnTxtPdf: 'PDF',
                btnSaveAsPdfText: '📄 PDF-ஆக சேமிக்க',
                modalEdit: 'படிவத்தில் திருத்து',
                modalClose: 'மூடுக',
                modalPrint: 'மஞ்சள் அட்டை அச்சு',

                optSelEdu: '-- தேர்ந்தெடுக்கவும் --',
                optCDefault: '-- தேர்ந்தெடுக்கவும் --',
                optJobDefault: '-- தேர்ந்தெடுக்கவும் --',
                optSelBlood: '-- தேர்ந்தெடுக்கவும் --',
                optSelCol: '-- தேர்ந்தெடுக்கவும் --',
                optSelMtype: '-- தேர்ந்தெடுக்கவும் --',
                optM1: 'முதல் மணம்',
                optM2: 'மறு மணம்',
                optCol1: 'சிவப்பு',
                optCol2: 'மாநிறம்',
                optCol3: 'அடர் சிவப்பு',
                optCol4: 'கருப்பு',

                // Astrology Dropdown options ALWAYS IN TAMIL!
                optSelRasi: '-- தேர்ந்தெடுக்கவும் --',
                optSelStar: '-- தேர்ந்தெடுக்கவும் --',
                optSelLag: '-- தேர்ந்தெடுக்கவும் --',
                optSelDosham: '-- தேர்ந்தெடுக்கவும் --',
                optD1: 'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி',
                optD2: 'சுத்தம்',
                optD3: 'செவ்வாய் தோஷம்',
                optD4: 'ராகு கேது தோஷம்',
            },
            en: {
                brandTitle: 'Master Matrimony',
                brandSub: 'Matrimonial Information Centre | Phone: +91 90000 00000',
                btnAdminPanelText: 'Admin Panel',
                btnLogoutText: 'Sign Out',
                stat_total_label: 'Total Profiles',
                stat_female_label: '👰 Bride Profiles',
                stat_male_label: '🤵 Groom Profiles',
                tab1Title: 'New Registration',
                tab2Title: 'Registered Profiles Directory',
                t_bride: '👰 Bride Profile',
                t_bride_sub: 'Female Candidate Entry',
                t_groom: '🤵 Groom Profile',
                t_groom_sub: 'Male Candidate Entry',
                txt_smart_title: '📄 Smart Biodata Upload & Auto-Fill',
                txt_smart_sub: 'Upload biodata / horoscope photo or PDF to automatically extract and populate all registration fields!',
                txt_dropzone_main: '📂 Choose or drag biodata photo (JPG/PNG) or PDF here',
                txt_dropzone_sub: 'Drop file here or click to browse (Images: PNG, JPG | PDF | Text)',
                txt_test_sample_label: '🎯 Test with HR Sample File:',
                txt_test_bride_btn: 'HR Sample Bride (Amirthavadivu N)',
                txt_test_groom_btn: 'HR Sample Groom (Saravanakumar M)',
                txt_download_sample_btn: 'Download Sample Image',
                txt_success_sub: '💡 Check fields highlighted in green. Edit manually or click 🎙️ Mic to dictate corrections!',
                txt_btn_ok: 'Done',
                h_basic: 'Basic Particulars',
                l_reg_no: 'Reg No (Auto / Manual)',
                l_reg_date: 'Registration Date',
                l_name: 'Candidate Full Name *',
                l_community: 'Community / Caste',
                l_photo: 'Candidate Photograph',
                l_photo_help: 'Upload passport size photograph',
                l_admin_photo_note: 'Print photo display is centrally managed in Admin Panel settings.',
                h_birth: 'Birth Information',
                l_dob: 'Date of Birth',
                l_time: 'Birth Time',
                l_place: 'Birth Place',
                h_career: 'Education & Career',
                l_edu: 'Candidate Education',
                l_job: 'Job / Profession',
                l_company: 'Company Name & Location',
                l_income: 'Monthly Income',
                h_physical: 'Physical & Ancestry Details',
                l_height: 'Height',
                l_weight: 'Weight',
                l_color: 'Complexion',
                l_temple: 'Family Deity & Place',
                l_gothram: 'Gothram',
                l_kootam: 'Clan / Kootam',
                h_family: 'Parents & Family Background',
                l_fname: "Father's Name",
                l_fphone: "Father's Mobile",
                l_fjob: "Father's Profession",
                l_fnative: "Father's Native Place",
                l_mname: "Mother's Name",
                l_mphone: "Mother's Mobile",
                l_mjob: "Mother's Profession",
                l_mnative: "Mother's Native Place",
                l_wealth: 'Family Income & Assets',
                l_siblings: 'Siblings & Relatives Information',
                l_brothers: 'Brothers',
                l_sisters: 'Sisters',
                l_address: 'Complete Residential Address',

                // ASTROLOGY (STRICTLY TAMIL IN BOTH MODES WITH BILINGUAL TITLES!)
                h_astrology: 'ஜோதிட விபரம் / Astrological Particulars',
                l_rasi: 'ராசி',
                l_star: 'நட்சத்திரம்',
                l_lagnam: 'லக்னம்',
                l_dosham: 'தோஷ விபரம்',
                l_thisai: 'திசை இருப்பு',
                l_kattam_header: '12 கட்ட ஜாதகம் (ராசி & நவாம்சம்) / 12-House Horoscope Grid (Rasi & Navamsam):',
                l_planets_label: 'கிரகங்கள்:',
                t_chart_rasi: 'ராசி கட்டம்',
                t_chart_nav: 'நவாம்சம் கட்டம்',
                hub_rasi: 'ராசி',
                hub_nav: 'நவாம்சம்',
                btn_clear_cell: '❌ அழிக்க (Clear)',

                h_expectations: 'Expectations & Other Notes',
                l_mtype: 'Marriage Type',
                l_blood: 'Blood Group',
                l_email: 'Email Address',
                l_expect: 'Expectations & Other Notes',
                l_expectations: 'Expectations & Other Notes',
                btnSubmitText: '💾 Save Profile Particulars',
                btnResetText: '🔄 Reset Form Fields',

                h_directory_title: 'Registered Profiles Directory',
                h_directory_sub: 'Click on any row to view, edit or print yellow card',
                th_no: 'S.No',
                th_pic: 'Photo',
                th_photo: 'Photo',
                th_reg: 'Reg No / Date',
                th_name: 'Candidate Name',
                th_type: 'Category',
                th_caste: 'Category',
                th_rasi: 'ராசி / நட்சத்திரம்',
                th_star: 'ராசி / நட்சத்திரம்',
                th_job: 'Education / Job',
                th_edu: 'Education / Job',
                th_phone: 'Mobile',
                th_action: 'Actions',
                th_actions: 'Actions',
                btnBulkDelete: 'Delete Selected',
                searchPh: 'Search by Name, Education, Phone...',

                btnTxtView: 'View',
                btnTxtEdit: 'Edit',
                btnTxtPrint: 'Print',
                btnTxtPdf: 'PDF',
                btnSaveAsPdfText: '📄 Save as PDF',
                modalEdit: 'Edit Profile in Form',
                modalClose: 'Close',
                modalPrint: 'Print Yellow Card',

                optSelEdu: '-- Select an option --',
                optCDefault: '-- Select an option --',
                optJobDefault: '-- Select an option --',
                optSelBlood: '-- Select an option --',
                optSelCol: '-- Select an option --',
                optSelMtype: '-- Select an option --',
                optM1: 'First Marriage',
                optM2: 'Remarriage',
                optCol1: 'Fair',
                optCol2: 'Wheatish',
                optCol3: 'Very Fair',
                optCol4: 'Dark',

                // Astrology Dropdown options ALWAYS IN TAMIL!
                optSelRasi: '-- தேர்ந்தெடுக்கவும் --',
                optSelStar: '-- தேர்ந்தெடுக்கவும் --',
                optSelLag: '-- தேர்ந்தெடுக்கவும் --',
                optSelDosham: '-- தேர்ந்தெடுக்கவும் --',
                optD1: 'சுத்தம்/ராகுகேது/செவ்வாய் நிவர்த்தி',
                optD2: 'சுத்தம்',
                optD3: 'செவ்வாய் தோஷம்',
                optD4: 'ராகு கேது தோஷம்',
            }
        };

        function setAppLanguage(lang) {
            appLang = lang;
            try {
                localStorage.setItem('matrimony_lang', lang);
            } catch (e) {}

            const langTaBtn = document.getElementById('btnTa');
            const langEnBtn = document.getElementById('btnEn');
            if (langTaBtn && langEnBtn) {
                if (lang === 'ta') {
                    langTaBtn.classList.add('active');
                    langEnBtn.classList.remove('active');
                } else {
                    langEnBtn.classList.add('active');
                    langTaBtn.classList.remove('active');
                }
            }

            const fLang = document.getElementById('form_lang_input');
            if (fLang) fLang.value = lang;

            const p = langPack[lang];
            if (!p) return;

            // Safe text replacement across all registered IDs
            Object.keys(p).forEach(k => {
                const el = document.getElementById(k);
                if (el) el.innerText = p[k];
            });

            if (typeof renderDirectoryPagination === 'function') renderDirectoryPagination();

            // Action button texts in table
            document.querySelectorAll('.btn-action-txt-view').forEach(e => e.innerText = p.btnTxtView);
            document.querySelectorAll('.btn-action-txt-edit').forEach(e => e.innerText = p.btnTxtEdit);
            document.querySelectorAll('.btn-action-txt-print').forEach(e => e.innerText = p.btnTxtPrint);
            document.querySelectorAll('.btn-action-txt-pdf').forEach(e => e.innerText = p.btnTxtPdf || 'PDF');
            const bsp = document.getElementById('btnSaveAsPdfText');
            if (bsp) bsp.innerText = p.btnSaveAsPdfText || '📄 Save as PDF';

            // Translate directory table badges (Groom / Bride)
            document.querySelectorAll('.badge-varan-type').forEach(b => {
                const type = b.getAttribute('data-type');
                if (lang === 'en') {
                    b.innerText = (type === 'aan') ? '🤵 Groom' : '👰 Bride';
                } else {
                    b.innerText = (type === 'aan') ? '🤵 ஆண் வரன்' : '👰 பெண் வரன்';
                }
            });

            // Search input placeholder
            const tSearch = document.getElementById('tableSearch');
            if (tSearch) {
                tSearch.placeholder = p.searchPh || ((lang === 'en') ? 'Search by Name, Education, Phone...' : 'பெயர், படிப்பு, போன் மூலம் தேடுக...');
            }

            // Brother & Sister placeholders
            const brInput = document.getElementById('brothers');
            if (brInput) {
                brInput.placeholder = (lang === 'en') ? 'e.g: 1 Elder brother / None' : 'எ.கா: அண்ணன் 1 / இல்லை';
            }
            const sisInput = document.getElementById('sisters');
            if (sisInput) {
                sisInput.placeholder = (lang === 'en') ? 'e.g: 1 Elder sister (Married) / None' : 'எ.கா: அக்கா 1 திருமணமானவர் / இல்லை';
            }

            // Modal action buttons
            const mEdit = document.getElementById('modalBtnEdit');
            if (mEdit) mEdit.innerText = p.modalEdit;
            const mClose = document.getElementById('modalBtnClose');
            if (mClose) mClose.innerText = p.modalClose;
            const mPrint = document.getElementById('modalPrintLink');
            if (mPrint) mPrint.innerText = p.modalPrint;

            // Dynamic Select Option Texts (Strict No-Mix)
            const setOptionText = (id, text) => {
                const el = document.getElementById(id);
                if (el) el.innerText = text;
            };

            setOptionText('opt_sel_edu', p.optSelEdu);
            setOptionText('opt_c_default', p.optCDefault);
            setOptionText('opt_job_default', p.optJobDefault);
            setOptionText('opt_sel_blood', p.optSelBlood);
            setOptionText('opt_sel_col', p.optSelCol);
            setOptionText('opt_sel_mtype', p.optSelMtype);
            setOptionText('opt_m1', p.optM1);
            setOptionText('opt_m2', p.optM2);
            setOptionText('opt_col1', p.optCol1);
            setOptionText('opt_col2', p.optCol2);
            setOptionText('opt_col3', p.optCol3);
            setOptionText('opt_col4', p.optCol4);

            // ASTROLOGY OPTIONS: ALWAYS TAMIL!
            setOptionText('opt_sel_rasi', p.optSelRasi);
            setOptionText('opt_sel_star', p.optSelStar);
            setOptionText('opt_sel_lag', p.optSelLag);
            setOptionText('opt_sel_dosham', p.optSelDosham);
            setOptionText('opt_d1', p.optD1);
            setOptionText('opt_d2', p.optD2);
            setOptionText('opt_d3', p.optD3);
            setOptionText('opt_d4', p.optD4);

            // Ensure 12-House Kundali Box Names are ALWAYS IN TAMIL!
            const rasiBoxNames = ['1 மேஷம்', '2 ரிஷபம்', '3 மிதுனம்', '4 கடகம்', '5 சிம்மம்', '6 கன்னி', '7 துலாம்', '8 விருச்சி', '9 தனுசு', '10 மகரம்', '11 கும்பம்', '12 மீனம்'];
            for (let i = 1; i <= 12; i++) {
                setOptionText('c_r_' + i, rasiBoxNames[i - 1]);
                setOptionText('c_n_' + i, rasiBoxNames[i - 1]);
            }

            // Blank Forms Bar
            setOptionText('lbl_blank_sec_title', (lang === 'en') ? 'Download / Print Blank Biodata Forms:' : 'வெற்றிட அச்சுப் படிவங்கள் (Download / Print Blank Forms):');
            setOptionText('lbl_blank_sec_badge', (lang === 'en') ? 'Direct Print / PDF Download' : 'நேரடி அச்சு / PDF பதிவிறக்கம்');
            setOptionText('lbl_blank_cat', (lang === 'en') ? 'Biodata Category:' : 'வரன் பிரிவு:');
            setOptionText('lbl_blank_lang', (lang === 'en') ? 'Form Language:' : 'படிவ மொழி:');
            setOptionText('btn_print_blank_txt', (lang === 'en') ? 'Print / Download Blank Form' : 'படிவத்தை அச்சிடுக / PDF');
            setOptionText('opt_blank_cat_aan', (lang === 'en') ? '🤵 Male Biodata (Groom)' : '🤵 ஆண் வரன்');
            setOptionText('opt_blank_cat_penn', (lang === 'en') ? '👰 Female Biodata (Bride)' : '👰 பெண் வரன்');
            setOptionText('opt_blank_cat_maru_aan', (lang === 'en') ? '💍 Male Remarriage (Groom)' : '💍 ஆண் மறுமணம்');
            setOptionText('opt_blank_cat_maru_penn', (lang === 'en') ? '💍 Female Remarriage (Bride)' : '💍 பெண் மறுமணம்');

            // Placeholders
            const searchInput = document.getElementById('tableSearch') || document.getElementById('searchDirectory');
            if (searchInput) searchInput.placeholder = p.searchPh;

            const placeholders = {
                ta: {
                    name: 'முழு பெயர் உள்ளிடவும்',
                    community: 'சமூகம் / உட்பிரிவு உள்ளிடவும்',
                    birth_time: 'எ.கா: 10:30 AM',
                    birth_place: 'பிறந்த ஊர்',
                    job_title: 'பணி விபரம்',
                    company_details: 'நிறுவனம் பெயர் & ஊர்',
                    monthly_income: 'மாத வருமானம் (எ.கா: 50,000)',
                    height: 'உயரம் (எ.கா: 165 cm)',
                    weight: 'எடை (எ.கா: 55 kg)',
                    kuladeivam: 'குலதெய்வம், ஊர்',
                    gothram: 'கோத்திரம்',
                    kootam: 'கூட்டம்',
                    father_name: 'தந்தை பெயர்',
                    father_mobile: '10 இலக்க அலைபேசி எண்',
                    father_job: 'தந்தையின் பணி',
                    father_native: 'தந்தை பூர்வீகம்',
                    mother_name: 'தாய் பெயர்',
                    mother_mobile: '10 இலக்க அலைபேசி எண்',
                    mother_job: 'தாயின் பணி',
                    mother_native: 'தாய் பூர்வீகம்',
                    family_wealth: 'குடும்ப சொத்து விபரம்',
                    siblings_details: 'உடன் பிறந்தோர் விபரம்',
                    address: 'முழு முகவரி',
                    thisai_iruppu: 'திசை இருப்பு (எ.கா: சுக்கிரன் திசை)',
                    email: 'example@gmail.com',
                    expectations: 'எதிர்பார்ப்புகள் மற்றும் இதர குறிப்புகள்'
                },
                en: {
                    name: 'Enter candidate full name',
                    community: 'Enter community / subcaste',
                    birth_time: 'e.g.: 10:30 AM',
                    birth_place: 'Enter birth place',
                    job_title: 'Enter job / profession details',
                    company_details: 'Company name and location',
                    monthly_income: 'Monthly income (e.g.: 50,000)',
                    height: 'Height (e.g.: 165 cm)',
                    weight: 'Weight (e.g.: 55 kg)',
                    kuladeivam: 'Family deity and place',
                    gothram: 'Gothram',
                    kootam: 'Clan / Kootam',
                    father_name: "Father's name",
                    father_mobile: '10-digit mobile number',
                    father_job: "Father's profession",
                    father_native: "Father's native place",
                    mother_name: "Mother's name",
                    mother_mobile: '10-digit mobile number',
                    mother_job: "Mother's profession",
                    mother_native: "Mother's native place",
                    family_wealth: 'Family income and assets',
                    siblings_details: 'Siblings and relatives information',
                    address: 'Complete residential address',
                    thisai_iruppu: 'திசை இருப்பு (எ.கா: சுக்கிரன் திசை)',
                    email: 'example@gmail.com',
                    expectations: 'Candidate expectations & preferences'
                }
            };

            const phs = placeholders[lang];
            if (phs) {
                Object.keys(phs).forEach(id => {
                    const inputEl = document.getElementById(id);
                    if (inputEl) inputEl.placeholder = phs[id];
                });
            }

            // 1. First translate form field VALUES to target language
            if (typeof convertFormFieldsToLanguage === 'function') {
                convertFormFieldsToLanguage(lang);
            }

            // 2. THEN rebuild dropdown options in new language (values already translated above)
            if (typeof syncAllDropdowns === 'function') {
                syncAllDropdowns(lang);
            }

            // 3. Dynamically refresh DB dropdown options in the selected language!
            if (typeof refreshFormSelect === 'function') {
                refreshFormSelect('community');
                refreshFormSelect('education');
                refreshFormSelect('job');
            }

            // If profile modal is open, re-render it in new language
            if (typeof activeModalId !== 'undefined' && activeModalId) {
                showProfileModal(activeModalId);
            }
        }
        // Form submission sync
        const formEl = document.getElementById('profileForm');
        if (formEl) {
            formEl.addEventListener('submit', function(e) {
                if (typeof validateDobInput === 'function' && !validateDobInput()) {
                    e.preventDefault();
                    const dobEl = document.getElementById('dob');
                    if (dobEl) {
                        dobEl.focus();
                        dobEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    alert(appLang === 'ta' ? 'பிறந்த தேதியை சரியாக உள்ளிடவும்!' : 'Please enter a valid Date of Birth!');
                    return false;
                }
                if (typeof validateBirthTimeInput === 'function' && !validateBirthTimeInput()) {
                    e.preventDefault();
                    const btEl = document.getElementById('birth_time');
                    if (btEl) {
                        btEl.focus();
                        btEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    alert(appLang === 'ta' ? 'பிறந்த நேரத்தை சரியாக உள்ளிடவும் (AM / PM)!' : 'Please enter valid Birth Time (AM / PM)!');
                    return false;
                }
                if (typeof validateBirthPlaceInput === 'function' && !validateBirthPlaceInput()) {
                    e.preventDefault();
                    const bpEl = document.getElementById('birth_place');
                    if (bpEl) {
                        bpEl.focus();
                        bpEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    alert(appLang === 'ta' ? 'பிறந்த ஊரில் எண்கள் (Numbers) இருக்கக்கூடாது! ஊர் பெயரை மட்டும் உள்ளிடவும்.' : 'Numbers are not allowed in Birth Place!');
                    return false;
                }
                const fMob = document.getElementById('father_mobile');
                if (fMob && fMob.value && typeof validateMobileField === 'function' && !validateMobileField(fMob, true)) {
                    e.preventDefault();
                    fMob.focus();
                    fMob.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    alert(appLang === 'ta' ? 'தந்தை அலைபேசி எண்ணை சரியாக உள்ளிடவும் (10 இலக்கம்)!' : 'Please enter valid Father 10-digit Mobile number!');
                    return false;
                }
                const mMob = document.getElementById('mother_mobile');
                if (mMob && mMob.value && typeof validateMobileField === 'function' && !validateMobileField(mMob, true)) {
                    e.preventDefault();
                    mMob.focus();
                    mMob.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    alert(appLang === 'ta' ? 'தாய் அலைபேசி எண்ணை சரியாக உள்ளிடவும் (10 இலக்கம்)!' : 'Please enter valid Mother 10-digit Mobile number!');
                    return false;
                }
                if (typeof syncTamilMonthValue === 'function') {
                    syncTamilMonthValue();
                }
                const jobInput = document.getElementById('job_title');
                const jobSelect = document.getElementById('job_select');
                if (jobInput && (!jobInput.value || !jobInput.value.trim()) && jobSelect && jobSelect.value) {
                    jobInput.value = jobSelect.value;
                }
                const commInput = document.getElementById('community');
                const commSelect = document.getElementById('community_select');
                if (commInput && (!commInput.value || !commInput.value.trim()) && commSelect && commSelect.value) {
                    commInput.value = commSelect.value;
                }
                const fLang = document.getElementById('form_lang_input');
                if (fLang) fLang.value = appLang || 'ta';
            });
        }

        // ==========================================
        // SMART BIODATA UPLOAD & AUTO-FILL ENGINE
        // ==========================================
        let lastAutofillCount = 0;

        // Drag & drop handlers for dropzone
        const dropzone = document.getElementById('biodataDropzone');
        if (dropzone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('dragover');
                }, false);
            });
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('dragover');
                }, false);
            });
            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                if (dt && dt.files && dt.files.length) {
                    handleBiodataFileUpload(dt.files);
                }
            });
        }

        function updateScanProgress(pct, msg) {
            const box = document.getElementById('uploadProgressBox');
            const fill = document.getElementById('scanProgressBar');
            const pctText = document.getElementById('scanPercentText');
            const statusText = document.getElementById('scanStatusText');

            if (box) box.style.display = 'block';
            if (fill) fill.style.width = pct + '%';
            if (pctText) pctText.innerText = pct + '%';
            if (statusText && msg) statusText.innerText = msg;
        }

        function hideScanProgress() {
            const box = document.getElementById('uploadProgressBox');
            if (box) box.style.display = 'none';
        }

        function clearAutofillNotification() {
            const banner = document.getElementById('uploadSuccessBanner');
            if (banner) banner.style.display = 'none';
        }

        const sampleBrideData = {
            ta: {
                varan_type: 'penn',
                name: 'திவ்யா எஸ்',
                dob: '1999-07-15',
                birth_time: '10:30 AM',
                birth_place: 'மதுரை',
                community: 'முதலியார்',
                education: 'பொறியியல் பட்டம்',
                job_title: 'மென்பொருள் பொறியாளர்',
                company_details: 'இன்போசிஸ், பெங்களூரு',
                monthly_income: '85,000',
                height: '162 cm',
                weight: '54 kg',
                complexion: 'சிவப்பு',
                kuladeivam: 'ஸ்ரீ மீனாட்சி அம்மன், மதுரை',
                gothram: 'சிவ கோத்திரம்',
                kootam: 'காடை கூட்டம்',
                father_name: 'சுந்தரம் எஸ்',
                father_job: 'ஆசிரியர் (அரசு பள்ளி)',
                father_mobile: '9000000003',
                father_native: 'மதுரை',
                mother_name: 'கவிதா எஸ்',
                mother_job: 'இல்லத்தரசி (Home Maker)',
                mother_mobile: '9000000004',
                mother_native: 'மதுரை',
                address: '45, கே.கே. நகர், மதுரை',
                family_wealth: 'சொந்த வீடு, 5 ஏக்கர் விவசாய நிலம்',
                siblings_details: '1 தம்பி - B.Tech படித்து வருகிறார்',
                brothers: '1 தம்பி (B.Tech படித்து வருகிறார்)',
                sisters: 'இல்லை',
                tamil_month: 'ஆனி 30',
                tamil_year: 'பிரமாதி',
                rasi: 'சிம்மம்',
                natchathiram: 'மகம்',
                lagnam: 'கன்னி',
                dosham: 'சுத்தம்',
                thisai_iruppu: 'சுக்கிரன் திசை 4 வருடம், 2 மாதம்',
                expectations: 'நன்கு படித்த, நல்ல குணமுள்ள, IT அல்லது பிற துறையில் பணிபுரியும் மணமகன்',
                marriage_type: 'mudhal_manama',
                blood_group: 'A1B+',
                email: 'divya.demo@mastermatrimony.example',
                rasi_chart: {
                    '5': ['குரு'],
                    '8': ['லக்', 'சூரி', 'சந்', 'செவ்', 'புத', 'குரு', 'சுக்', 'சனி', 'ராகு']
                },
                navamsam_chart: {
                    '12': ['சனி', 'கேது']
                }
            },
            en: {
                varan_type: 'penn',
                name: 'DIVYA S',
                dob: '1999-07-15',
                birth_time: '10:30 AM',
                birth_place: 'Madurai',
                community: 'Mudaliar',
                education: 'B.E / B.Tech (Engineering)',
                job_title: 'Software Engineer (IT)',
                company_details: 'Infosys, Bangalore',
                monthly_income: 'Rs. 85,000 / Month',
                height: '5 ft 4 in (162 cm)',
                weight: '54 kg',
                complexion: 'Fair',
                kuladeivam: 'Sri Meenakshi Amman, Madurai',
                gothram: 'Siva Gothram',
                kootam: 'Kadai Kootam',
                father_name: 'Sundaram S',
                father_job: 'Teacher (Govt School)',
                father_mobile: '9000000003',
                father_native: 'Madurai',
                mother_name: 'Kavitha S',
                mother_job: 'Home Maker',
                mother_mobile: '9000000004',
                mother_native: 'Madurai',
                address: '45, K.K. Nagar, Madurai',
                family_wealth: 'Own House, 5 Acres Agriculture Land',
                siblings_details: '1 Younger Brother - Studying B.Tech',
                brothers: '1 Younger Brother (Studying B.Tech)',
                sisters: 'None',
                tamil_month: 'ஆனி 30',
                tamil_year: 'பிரமாதி',
                rasi: 'சிம்மம்',
                natchathiram: 'மகம்',
                lagnam: 'கன்னி',
                dosham: 'சுத்தம்',
                thisai_iruppu: 'சுக்கிரன் திசை 4 வருடம், 2 மாதம்',
                expectations: 'Well-educated, well-behaved groom working in IT or other reputed fields',
                marriage_type: 'mudhal_manama',
                blood_group: 'A1B+',
                email: 'divya.demo@mastermatrimony.example',
                rasi_chart: {
                    '5': ['குரு'],
                    '8': ['லக்', 'சூரி', 'சந்', 'செவ்', 'புத', 'குரு', 'சுக்', 'சனி', 'ராகு']
                },
                navamsam_chart: {
                    '12': ['சனி', 'கேது']
                }
            }
        };

        const sampleGroomData = {
            ta: {
                varan_type: 'aan',
                name: 'கார்த்திக் ரா',
                dob: '1998-05-20',
                birth_time: '07:15 AM',
                birth_place: 'சென்னை',
                community: 'முதலியார்',
                education: 'முதுகலை பொறியியல்',
                job_title: 'மென்பொருள் வடிவமைப்பாளர் (Software Architect)',
                company_details: 'டிசிஎஸ், சென்னை',
                monthly_income: '1,25,000',
                height: '175 cm',
                weight: '68 kg',
                complexion: 'மாநிறம்',
                kuladeivam: 'ஸ்ரீ முருகன் கோவில், பழனி',
                gothram: 'சிவ கோத்திரம்',
                kootam: 'முத்துராசர் கூட்டம்',
                father_name: 'ராஜேந்திரன் க',
                father_job: 'தொழில் / ஜவுளி தொழில்',
                father_mobile: '9000000001',
                father_native: 'சென்னை',
                mother_name: 'லட்சுமி ரா',
                mother_job: 'இல்லத்தரசி (Home Maker)',
                mother_mobile: '9000000002',
                mother_native: 'சென்னை',
                address: '12, அண்ணா நகர், சென்னை',
                family_wealth: 'சொந்த வீடு மற்றும் தோட்டம்',
                siblings_details: '1 தம்பி, B.E முடித்து பணியில் உள்ளார்',
                brothers: '1 தம்பி (B.E முடித்து பணியில் உள்ளார்)',
                sisters: 'இல்லை',
                tamil_month: 'வைகாசி 6',
                tamil_year: 'வெகுதானிய',
                rasi: 'மேஷம்',
                natchathiram: 'அஸ்வினி',
                lagnam: 'ரிஷபம்',
                dosham: 'சுத்தம்',
                thisai_iruppu: 'கேது திசை 2 வருடம்',
                expectations: 'பட்டதாரி, குடும்ப பாங்கான மணமகள் தேவை',
                marriage_type: 'mudhal_manama',
                blood_group: 'O+',
                email: 'karthik.demo@mastermatrimony.example',
                rasi_chart: {
                    '1': ['சூரி', 'புத'],
                    '2': ['சுக்'],
                    '11': ['குரு']
                },
                navamsam_chart: {
                    '4': ['சந்'],
                    '9': ['செவ்']
                }
            },
            en: {
                varan_type: 'aan',
                name: 'KARTHIK R',
                dob: '1998-05-20',
                birth_time: '07:15 AM',
                birth_place: 'Chennai',
                community: 'Mudaliar',
                education: 'M.E / M.Tech (Master of Engg)',
                job_title: 'Software Architect',
                company_details: 'TCS, Chennai',
                monthly_income: 'Rs. 1,25,000 / Month',
                height: '5 ft 9 in (175 cm)',
                weight: '68 kg',
                complexion: 'Wheatish',
                kuladeivam: 'Sri Murugan Temple, Palani',
                gothram: 'Siva Gothram',
                kootam: 'Muthurasar Kootam',
                father_name: 'Rajendran K',
                father_job: 'Business',
                father_mobile: '9000000001',
                father_native: 'Chennai',
                mother_name: 'Lakshmi R',
                mother_job: 'Home Maker',
                mother_mobile: '9000000002',
                mother_native: 'Chennai',
                address: '12, Anna Nagar, Chennai',
                family_wealth: 'Own House and Farm Garden',
                siblings_details: '1 Younger Brother, completed B.E and employed',
                brothers: '1 Younger Brother (completed B.E)',
                sisters: 'None',
                tamil_month: 'வைகாசி 6',
                tamil_year: 'வெகுதானிய',
                rasi: 'மேஷம்',
                natchathiram: 'அஸ்வினி',
                lagnam: 'ரிஷபம்',
                dosham: 'சுத்தம்',
                thisai_iruppu: 'கேது திசை 2 வருடம்',
                expectations: 'Graduate, homely bride required',
                marriage_type: 'mudhal_manama',
                blood_group: 'O+',
                email: 'saravanakumar.m@gmail.com',
                rasi_chart: {
                    '1': ['சூரி', 'புத'],
                    '2': ['சுக்'],
                    '11': ['குரு']
                },
                navamsam_chart: {
                    '4': ['சந்'],
                    '9': ['செவ்']
                }
            }
        };

        const embeddedBrideSample = sampleBrideData.ta;
        const embeddedGroomSample = sampleGroomData.ta;

        // Test with HR Sample (Instant 1-Click Verification in Active Language)
        async function testHrSample(type) {
            clearAutofillNotification();
            const isGroom = (type === 'aan' || type === 'groom');
            const statusMsg = appLang === 'ta' ? 'HR மாதிரி கோப்பு படிக்கப்படுகிறது...' : 'Loading HR Sample Biodata...';
            updateScanProgress(40, statusMsg);
            
            const localData = isGroom ? (sampleGroomData[appLang] || sampleGroomData.ta) : (sampleBrideData[appLang] || sampleBrideData.ta);

            setTimeout(() => {
                updateScanProgress(100, appLang === 'ta' ? 'விபரங்கள் பிரித்தெடுக்கப்பட்டன!' : 'Fields extracted!');
                setTimeout(() => {
                    hideScanProgress();
                    populateFormWithData(localData);
                }, 180);
            }, 250);
        }

        // Main File Upload Handler (Images / PDF / TXT)
        async function handleBiodataFileUpload(files) {
            if (!files || !files.length) return;
            const file = files[0];
            const fileName = file.name.toLowerCase();

            clearAutofillNotification();
            updateScanProgress(15, appLang === 'ta' ? 'கோப்பு திறக்கப்படுகிறது...' : 'Opening document...');

            // Reset all 12-kattam chart cells cleanly before new file extraction
            for (let k = 1; k <= 12; k++) {
                const rEl = document.getElementById('r_cell_' + k);
                if (rEl) { rEl.value = ''; if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(rEl); }
                const nEl = document.getElementById('n_cell_' + k);
                if (nEl) { nEl.value = ''; if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(nEl); }
            }

            // Reset candidate photo preview and file inputs before extraction
            const curPhotoFrame = document.getElementById('photoPreviewFrame');
            if (curPhotoFrame) curPhotoFrame.innerHTML = '';
            const curHidB64 = document.getElementById('photo_base64');
            if (curHidB64) curHidB64.value = '';
            const curPhotoInput = document.getElementById('photo');
            if (curPhotoInput) curPhotoInput.value = '';

            // If PDF Document - Check for digital project payload first (0.05s Instant 100% Restore - ZERO OCR)
            if (file.type === 'application/pdf' || fileName.endsWith('.pdf')) {
                try {
                    const rawBuffer = await file.slice(0, Math.min(file.size, 15000000)).arrayBuffer();
                    const rawText = new TextDecoder('latin1').decode(new Uint8Array(rawBuffer));
                    if (rawText.includes('###VARAN_EMBED_START###')) {
                        const m = rawText.match(/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/);
                        if (m && m[1]) {
                            const cleanB64 = m[1].replace(/\s+/g, '');
                            const bin = atob(cleanB64);
                            const bytes = Uint8Array.from(bin, c => c.charCodeAt(0));
                            const jsonStr = new TextDecoder('utf-8').decode(bytes);
                            const embedData = JSON.parse(jsonStr);
                            if (embedData && typeof embedData === 'object') {
                                updateScanProgress(100, appLang === 'ta' ? 'திட்ட ஆவணம் உடனடியாக மீட்டெடுக்கப்பட்டது!' : 'Profile restored instantly from project PDF!');
                                setTimeout(hideScanProgress, 400);
                                populateFormWithData(embedData);
                                return;
                            }
                        }
                    }
                } catch (quickErr) {
                    console.warn('Instant digital payload check note:', quickErr);
                }

                extractTextFromPdf(file);
                return;
            }

            // If TXT file
            if (file.type === 'text/plain' || fileName.endsWith('.txt')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    hideScanProgress();
                    parseAndFillText(e.target.result);
                };
                reader.readAsText(file);
                return;
            }           if (file.type.startsWith('image/')) {
                // If Tesseract is loaded in browser, run client-side OCR
                if (typeof Tesseract !== 'undefined') {
                    updateScanProgress(30, appLang === 'ta' ? 'படத்திலிருந்து எழுத்துக்கள் ஸ்கேன் செய்யப்படுகின்றன (OCR)...' : 'Scanning text from image (OCR)...');
                    try {
                        const { data: { text } } = await Tesseract.recognize(file, 'tam+eng', {
                            logger: m => {
                                if (m.status === 'recognizing text') {
                                    const p = Math.round((m.progress || 0) * 80) + 15;
                                    updateScanProgress(p, `${appLang === 'ta' ? 'எழுத்துக்கள் ஸ்கேன் ஆகிறது' : 'Recognizing text'} (${p}%)...`);
                                }
                            }
                        });
                        hideScanProgress();
                        if (text && text.trim().length > 10) {
                            parseAndFillText(text);
                            return;
                        }
                    } catch (ocrErr) {
                        console.warn('OCR notice, trying backend parse:', ocrErr);
                    }
                }

                // Backend fallback
                extractTextFromPdf(file);
            }
        }

        // Normalize Tamil text: Reorder visual vowels and collapse intra-word glyph spaces safely
        function normalizeTamilVisualOrder(str) {
            if (!str) return '';
            let text = str;
            // Map null bytes following Tamil consonants to vowel sign "i" (\u0BBF), strip stray nulls & broken marks
            text = text.replace(/([\u0B85-\u0BB9])\u0000+/gu, '$1\u0BBF').replace(/\u0000/g, '');
            text = text.replace(/(^|[\s\t])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1');
            text = text.replace(/[\u25CC\u200B-\u200D\uFEFF]/g, '');

            // 1. Two-part vowels in visual order (at start of syllable):
            text = text.replace(/(^|[ \t])\u0BC6[ \t]*([\u0B95-\u0BB9])[ \t]*\u0BBE/gu, '$1$2\u0BCA');
            text = text.replace(/(^|[ \t])\u0BC7[ \t]*([\u0B95-\u0BB9])[ \t]*\u0BBE/gu, '$1$2\u0BCB');
            text = text.replace(/(^|[ \t])\u0BC6[ \t]*([\u0B95-\u0BB9])[ \t]*\u0BD7/gu, '$1$2\u0BCC');

            // 2. Single pre-vowels: space/start + ெ, ே, ை before consonant
            text = text.replace(/(^|[ \t])([\u0BC6\u0BC7\u0BC8])[ \t]*([\u0B95-\u0BB9])/gu, '$1$3$2');

            // 3. Remove horizontal space between consonant and pulli/vowel-sign
            text = text.replace(/([\u0B95-\u0BB9])[ \t]+([\u0BBE-\u0BCD\u0BD7])/gu, '$1$2');

            // 4. Safely collapse single spaced letters/glyphs ONLY when individual letters are spaced out (e.g. "ப ர ணி" -> "பரணி", "வ ங் கி" -> "வங்கி", "தி சை" -> "திசை")
            // Never blindly merge distinct words like "பயன்பாட்டியல் வேலை" or "மாணிக்கம் அலைபேசி"
            const astrologyPhrases = [
                ['தி\\s*ை?\\s*ச\\s*இ\\s*ரு\\s*ப்\\s*பு', 'திசை இருப்பு'],
                ['சு\\s*க்\\s*கி\\s*ர\\s*ன்', 'சுக்கிரன்'],
                ['சூ\\s*ரி\\s*ய\\s*ன்', 'சூரியன்'],
                ['ச\\s*ந்\\s*தி\\s*ர\\s*ன்', 'சந்திரன்'],
                ['செ\\s*வ்\\s*வா\\s*ய்', 'செவ்வாய்'],
                ['பு\\s*த\\s*ன்', 'புதன்'],
                ['கு\\s*ரு', 'குரு'],
                ['ச\\s*னி', 'சனி'],
                ['ரா\\s*கு', 'ராகு'],
                ['கே\\s*து', 'கேது'],
                ['மா\\s*ந்\\s*தி', 'மாந்தி'],
                ['மா\\s*ந்', 'மாந்'],
                ['ல\\s*க்\\s*ன\\s*ம்', 'லக்னம்'],
                ['ல\\s*க்', 'லக்'],
                ['ந\\s*ட்\\s*ச\\s*த்\\s*தி\\s*ர\\s*ம்', 'நட்சத்திரம்'],
                ['சு\\s*த்\\s*த\\s*ம்', 'சுத்தம்'],
                ['வ\\s*ரு\\s*ட\\s*ம்', 'வருடம்'],
                ['மா\\s*த\\s*ம்', 'மாதம்'],
                ['வ\\s*ங்\\s*கி', 'வங்கி'],
                ['ப\\s*ணி', 'பணி']
            ];
            for (const [pattern, repl] of astrologyPhrases) {
                text = text.replace(new RegExp(pattern, 'gui'), repl);
            }

            // Collapse sequences where single/double isolated Tamil glyphs are spaced out (e.g., "ப ர ணி" -> "பரணி")
            text = text.replace(/(?:^|[\r\n\s])([\u0B80-\u0BFF]{1,2}(?:\s+[\u0B80-\u0BFF]{1,2}){2,})(?=[\r\n\s]|$)/gu, function(m, p1) {
                return m.replace(p1, p1.replace(/\s+/g, ''));
            });

            // Ensure multi-column field labels have newlines so horizontal columns never bleed together (Tamil + English)
            const multiColLabels = 'Job|Occupation|Company\\s*Name\\s*&\\s*Location|Company\\s*&\\s*Town|Company\\s*Name|Company|Monthly\\s*Income|Income|Salary|Education|Height|Weight|Complexion|DOB|Place|Native|Gothram|Kootam|வேலை|பணி|தொழில்|அலைபேசி|கைபேசி|பூர்வீகம்|முகவரி|மாத\\s*வருமானம்|நிறுவனம்\\s*பெயர்\\s*&\\s*ஊர்|நிறுவனம்|எடை|நிறம்|கோத்திரம்|கூட்டம்|குலதெய்வம்|வசதிகள்|சொத்து|உடன்பிறந்தோர்|சகோதரர்கள்|சகோதரிகள்|லக்னம்|திசை\\s*இருப்பு|தோஷம்|ராசி|நட்சத்திரம்|கல்வி|படிப்பு|பெயர்|பிறந்த\\s*தேதி';
            text = text.replace(new RegExp('([^\\r\\n:\\/–\\-&=,])\\s*(' + multiColLabels + ')[\\s]*[:=–\\-]', 'gui'), '$1\n$2:');
            const separateWords = [
                'தமிழ்', 'மாதம்', 'வருடம்', 'குரு', 'சுக்கிரன்', 'சூரியன்', 'சந்திரன்', 'செவ்வாய்', 'புதன்', 'சனி', 'ராகு', 'கேது',
                'விபர', 'குறிப்பு', 'தந்தை', 'தாயார்', 'பெயர்', 'வேலை', 'அரசாங்க', 'சொந்த', 'வீடு', 'ஸ்ரீ'
            ];
            if (false) { // Disabled aggressive word merger
                text = text.replace(/([\u0B80-\u0BFF]{1,3})[ \t]{1,2}([\u0B80-\u0BFF]{1,3})/gu, function(match, p1, p2) {
                    if (separateWords.includes(p1) || separateWords.includes(p2)) {
                        return p1 + ' ' + p2;
                    }
                    return p1 + p2;
                });
            }

            return text;
        }

        // Normalize Tamil OCR text: collapse broken vowels, intra-word spaces, and OCR noise
        function normalizeTamilOcrText(text) {
            if (!text || typeof text !== 'string') return '';
            let s = text.replace(/[\x00\x0B\r\uFFFD]/g, '');

            // Collapse broken Tamil vowels and diacritics attached with spaces (3 passes)
            for (let k = 0; k < 3; k++) {
                s = s.replace(/([\u0B85-\u0BB9])\s+([\u0BBE-\u0BCD\u0BD7])/gu, '$1$2');
                s = s.replace(/([\u0BBE-\u0BCD\u0BD7])\s+([\u0BCD])/gu, '$1$2');
            }

            const knownWords = [
                [/மீ\s*ன\s*ம்/gu, 'மீனம்'],
                [/மே\s*ஷ\s*ம்/gu, 'மேஷம்'],
                [/ரி\s*ஷ\s*ப\s*ம்/gu, 'ரிஷபம்'],
                [/மி\s*து\s*ன\s*ம்/gu, 'மிதுனம்'],
                [/க\s*ட\s*க\s*ம்/gu, 'கடகம்'],
                [/சி\s*ம்\s*ம\s*ம்/gu, 'சிம்மம்'],
                [/க\s*ன்\s*னி/gu, 'கன்னி'],
                [/து\s*லா\s*ம்/gu, 'துலாம்'],
                [/வி\s*ரு\s*ச்\s*சி\s*க\s*ம்/gu, 'விருச்சிகம்'],
                [/த\s*னு\s*சு/gu, 'தனுசு'],
                [/ம\s*க\s*ர\s*ம்/gu, 'மகரம்'],
                [/கு\s*ம்\s*ப\s*ம்/gu, 'கும்பம்'],
                [/ரா\s*சி/gu, 'ராசி'],
                [/ந\s*வா\s*ம்\s*ச\s*ம்/gu, 'நவாம்சம்'],
                [/ந\s*வா\s*ம்\s*சம்/gu, 'நவாம்சம்'],
                [/ந\s*வா\s*ம்/gu, 'நவாம்சம்'],
                [/ல\s*க்\s*ன\s*ம்/gu, 'லக்னம்'],
                [/ல\s*க்/gu, 'லக்'],
                [/சூ\s*ரி\s*ய\s*ன்/gu, 'சூரியன்'],
                [/சூ\s*ரி/gu, 'சூரி'],
                [/ச\s*ந்\s*தி\s*ர\s*ன்/gu, 'சந்திரன்'],
                [/ச\s*ந்/gu, 'சந்'],
                [/செ\s*வ்\s*வா\s*ய்/gu, 'செவ்வாய்'],
                [/செ\s*வ்/gu, 'செவ்'],
                [/பு\s*த\s*ன்/gu, 'புதன்'],
                [/பு\s*த/gu, 'புத'],
                [/கு\s*ரு/gu, 'குரு'],
                [/சு\s*க்\s*கி\s*ர\s*ன்/gu, 'சுக்கிரன்'],
                [/சு\s*க்/gu, 'சுக்'],
                [/ச\s*னீ\s*ஸ்\s*வ\s*ர\s*ன்/gu, 'சனீஸ்வரன்'],
                [/ச\s*னி/gu, 'சனி'],
                [/ரா\s*கு/gu, 'ராகு'],
                [/கே\s*து/gu, 'கேது'],
                [/மா\s*ந்\s*தி/gu, 'மாந்தி'],
                [/மா\s*ந்/gu, 'மாந்'],
                [/வ\s*ர\s*ன்\s*பெ\s*ய\s*ர்/gu, 'வரன் பெயர்'],
                [/பெ\s*ய\s*ர்/gu, 'பெயர்'],
                [/பி\s*ற\s*ந்\s*த\s*தே\s*தி/gu, 'பிறந்த தேதி'],
                [/தே\s*தி/gu, 'தேதி'],
                [/நே\s*ர\s*ம்/gu, 'நேரம்'],
                [/பி\s*ற\s*ந்\s*த\s*ஊ\s*ர்/gu, 'பிறந்த ஊர்'],
                [/ப\s*டி\s*ப்\s*பு/gu, 'படிப்பு'],
                [/வே\s*லை/gu, 'வேலை'],
                [/தொ\s*ழி\s*ல்/gu, 'தொழில்'],
                [/ப\s*ணி/gu, 'பணி'],
                [/நி\s*று\s*வ\s*ன\s*ம்/gu, 'நிறுவனம்'],
                [/வ\s*ரு\s*மா\s*ன\s*ம்/gu, 'வருமானம்'],
                [/உ\s*ய\s*ர\s*ம்/gu, 'உயரம்'],
                [/எ\s*டை/gu, 'எடை'],
                [/நி\s*ற\s*ம்/gu, 'நிறம்'],
                [/கு\s*ல\s*தெ\s*ய்\s*வ\s*ம்/gu, 'குலதெய்வம்'],
                [/கோ\s*த்\s*தி\s*ர\s*ம்/gu, 'கோத்திரம்'],
                [/கூ\s*ட்\s*ட\s*ம்/gu, 'கூட்டம்'],
                [/த\s*ந்\s*தை\s*பெ\s*ய\s*ர்/gu, 'தந்தை பெயர்'],
                [/த\s*ந்\s*தை/gu, 'தந்தை'],
                [/தா\s*ய்\s*பெ\s*ய\s*ர்/gu, 'தாய் பெயர்'],
                [/தா\s*யா\s*ர்\s*பெ\s*ய\s*ர்/gu, 'தாயார் பெயர்'],
                [/தா\s*ய்/gu, 'தாய்'],
                [/கை\s*பே\s*சி/gu, 'கைபேசி'],
                [/தொ\s*லை\s*பே\s*சி/gu, 'தொலைபேசி'],
                [/அ\s*லை\s*பே\s*சி/gu, 'அலைபேசி'],
                [/பூ\s*ர்\s*வீ\s*க\s*ம்/gu, 'பூர்வீகம்'],
                [/மு\s*க\s*வ\s*ரி/gu, 'முகவரி'],
                [/ந\s*ட்\s*ச\s*த்\s*தி\s*ர\s*ம்/gu, 'நட்சத்திரம்'],
                [/தோ\s*ஷ\s*ம்/gu, 'தோஷம்'],
                [/தி\s*சை\s*இ\s*ரு\s*ப்\s*பு/gu, 'திசை இருப்பு'],
                [/தி\s*சா\s*இ\s*ரு\s*ப்\s*பு/gu, 'திசா இருப்பு'],
                [/எ\s*தி\s*ர்\s*பா\s*ர்\s*ப்\s*பு/gu, 'எதிர்பார்ப்பு'],
                [/செ\s*ங்\s*கு\s*ந்\s*த\s*ர்/gu, 'செங்குந்தர்'],
                [/கை\s*க்\s*கோ\s*ள\s*ர்/gu, 'கைக்கோளர்'],
                [/சி\s*வ\s*ப்\s*பு/gu, 'சிவப்பு'],
                [/மா\s*நி\s*ற\s*ம்/gu, 'மாநிறம்'],
                [/க\s*ரு\s*ப்\s*பு/gu, 'கருப்பு'],
                [/அ\s*ட\s*ர்/gu, 'அடர்'],
                [/மு\s*த\s*ல்\s*ம\s*ண\s*ம்/gu, 'முதல் மணம்'],
                [/ம\s*று\s*ம\s*ண\s*ம்/gu, 'மறுமணம்'],
                [/சு\s*த்\s*த\s*ம்/gu, 'சுத்தம்']
            ];

            for (const [pat, rep] of knownWords) {
                s = s.replace(pat, rep);
            }
            return s;
        }

        function parseHoroscopeFromFullText(fullText) {
            const PLANETS_CONFIG = [
                { key: 'லக்', aliases: ['லக்னம்', 'லக்', 'ல.', 'Lagnam', 'Lagna', 'Asc', 'Ascendant', 'Lag'] },
                { key: 'சூரி', aliases: ['சூரியன்', 'சூரி', 'சூ.', 'Sun', 'Surya', 'Suriya'] },
                { key: 'சந்', aliases: ['சந்திரன்', 'சந்', 'ச.', 'Moon', 'Chandra', 'Chandran'] },
                { key: 'செவ்', aliases: ['செவ்வாய்', 'செவ்', 'செவ', 'செ.', 'செ', 'Mars', 'Sevvai', 'Chev', 'குஜன்', 'குஜ', 'Kuja'] },
                { key: 'புத', aliases: ['புதன்', 'புத', 'பு.', 'Mercury', 'Budha', 'Budhan', 'Merc', 'Mer'] },
                { key: 'குரு', aliases: ['குரு', 'வியாழன்', 'கு.', 'Jupiter', 'Guru', 'Jup'] },
                { key: 'சுக்', aliases: ['சுக்கிரன்', 'சுக்கி', 'சுக்', 'சு.', 'Venus', 'Sukra', 'Sukran', 'Ven'] },
                { key: 'சனி', aliases: ['சனி', 'சனீஸ்வரன்', 'மந்தன்', 'Saturn', 'Sani', 'Shani', 'Sat'] },
                { key: 'ராகு', aliases: ['ராகு', 'ரா.', 'Rahu', 'Raghu'] },
                { key: 'கேது', aliases: ['கேது', 'கெது', 'கே.', 'கே', 'Ketu', 'Kethu', 'Ket'] },
                { key: 'மாந்', aliases: ['மாந்தி', 'மாந்', 'மா.', 'Gulika', 'Mand', 'Mandi'] }
            ];

            const HOUSE_NAMES_MAP = {
                'மேஷம்': 1, 'ரிஷபம்': 2, 'மிதுனம்': 3, 'கடகம்': 4,
                'சிம்மம்': 5, 'கன்னி': 6, 'துலாம்': 7, 'விருச்சிகம்': 8,
                'தனுசு': 9, 'மகரம்': 10, 'கும்பம்': 11, 'மீனம்': 12,
                'Aries': 1, 'Taurus': 2, 'Gemini': 3, 'Cancer': 4,
                'Leo': 5, 'Virgo': 6, 'Libra': 7, 'Scorpio': 8,
                'Sagittarius': 9, 'Capricorn': 10, 'Aquarius': 11, 'Pisces': 12
            };

            const rasiChart = { '1':[], '2':[], '3':[], '4':[], '5':[], '6':[], '7':[], '8':[], '9':[], '10':[], '11':[], '12':[] };
            const navChart  = { '1':[], '2':[], '3':[], '4':[], '5':[], '6':[], '7':[], '8':[], '9':[], '10':[], '11':[], '12':[] };

            if (!fullText) return { rasi_chart: rasiChart, navamsam_chart: navChart };

            // 1. Check for Embedded Varan JSON Payload (Instant 1-Click Restore)
            if (fullText.includes('###VARAN_EMBED_START###')) {
                const m = fullText.match(/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/);
                if (m && m[1]) {
                    try {
                        const cleanB64 = m[1].replace(/\s+/g, '');
                        const bin = atob(cleanB64);
                        const bytes = Uint8Array.from(bin, c => c.charCodeAt(0));
                        const dec = new TextDecoder('utf-8');
                        const jsonStr = dec.decode(bytes);
                        const embedData = JSON.parse(jsonStr);
                        if (embedData.rasi_chart) Object.assign(rasiChart, embedData.rasi_chart);
                        if (embedData.navamsam_chart) Object.assign(navChart, embedData.navamsam_chart);
                        return { rasi_chart: rasiChart, navamsam_chart: navChart };
                    } catch (e) {
                        console.warn('Embedded JSON horoscope decode error:', e);
                    }
                }
            }

            const normText = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(fullText) : fullText;

            const extractTokens = (str) => {
                if (!str) return [];
                const res = [];
                const strLower = str.toLowerCase();
                for (const p of PLANETS_CONFIG) {
                    for (const a of p.aliases) {
                        if (str.includes(a) || strLower.includes(a.toLowerCase())) {
                            if (!res.includes(p.key)) res.push(p.key);
                            break;
                        }
                    }
                }
                return res;
            };

            const parseSegmentHouses = (seg, targetChart) => {
                if (!seg) return;
                const matches = [];
                for (const [hn, hIdx] of Object.entries(HOUSE_NAMES_MAP)) {
                    let idx = 0;
                    const lLower = seg.toLowerCase();
                    const hnLower = hn.toLowerCase();
                    while ((idx = lLower.indexOf(hnLower, idx)) !== -1) {
                        matches.push({ hIdx, start: idx, end: idx + hn.length });
                        idx += hn.length;
                    }
                }
                const numRegex = /\b([1-9]|1[0-2])(?:\s*[:=\-–\.]|\s+(?=[^\d]))/g;
                let m;
                while ((m = numRegex.exec(seg)) !== null) {
                    matches.push({ hIdx: parseInt(m[1], 10), start: m.index, end: m.index + m[0].length });
                }

                if (matches.length === 0) return;
                matches.sort((a, b) => a.start - b.start);

                const cleanMatches = [];
                let lastStart = -999;
                for (const item of matches) {
                    if (item.start - lastStart > 4) {
                        cleanMatches.push(item);
                        lastStart = item.start;
                    }
                }

                for (let i = 0; i < cleanMatches.length; i++) {
                    const curr = cleanMatches[i];
                    const nextStart = (i + 1 < cleanMatches.length) ? cleanMatches[i + 1].start : seg.length;
                    const chunk = seg.substring(curr.end, nextStart);
                    const tokens = extractTokens(chunk);
                    tokens.forEach(p => {
                        if (!targetChart[String(curr.hIdx)].includes(p)) {
                            targetChart[String(curr.hIdx)].push(p);
                        }
                    });
                }
            };

            const splitDualChartLine = (line) => {
                const t = line.trim();
                // Check if line explicitly has நவாம்சம் / Navamsam
                if (/(?:நவாம்சம்|Navamsam|நவாம்ச)/i.test(t)) {
                    const nm = t.match(/(?:நவாம்சம்|Navamsam|நவாம்ச)/i);
                    return [t.substring(0, nm.index).trim(), t.substring(nm.index).trim()];
                }
                // Check if any left-side house (12, 11, 10, 9) appears twice
                const leftHouses = [{ num: 12, name: 'மீனம்' }, { num: 11, name: 'கும்பம்' }, { num: 10, name: 'மகரம்' }, { num: 9, name: 'தனுசு' }];
                for (const lh of leftHouses) {
                    const pos1 = t.indexOf(lh.name);
                    if (pos1 !== -1) {
                        const pos2 = t.indexOf(lh.name, pos1 + lh.name.length);
                        if (pos2 !== -1) {
                            let cut = pos2;
                            const prefix = t.substring(0, pos2);
                            const numM = prefix.match(new RegExp('\\b(?:' + lh.num + ')\\s*$', 'u'));
                            if (numM) cut -= numM[0].length;
                            return [t.substring(0, cut).trim(), t.substring(cut).trim()];
                        }
                    }
                }
                // Fallback: look for 4+ spaces or tab/pipe
                const sp = t.split(/\s{4,}|\t|\s*\|\s*/);
                if (sp.length >= 2) {
                    return [sp[0].trim(), sp.slice(1).join(' ').trim()];
                }
                return [t, ''];
            };

            const cleanText = normText.replace(/\r/g, '');
            const lines = cleanText.split('\n');

            for (const l of lines) {
                const t = l.trim();
                if (!t) continue;
                if (/^(?:ராசி|Rasi)\s*[:=–\-]/i.test(t)) continue;

                let hasHouse = false;
                for (const hn of Object.keys(HOUSE_NAMES_MAP)) {
                    if (t.includes(hn)) { hasHouse = true; break; }
                }
                if (!hasHouse && !/\b(?:12|11|10|[1-9])\s*[:=\-–\.]/i.test(t)) continue;

                const [rPart, nPart] = splitDualChartLine(t);
                parseSegmentHouses(rPart, rasiChart);
                if (nPart) {
                    parseSegmentHouses(nPart, navChart);
                }
            }

            // Deduplicate per chart
            const dedup = (ch) => {
                const seen = new Set();
                for (let h = 1; h <= 12; h++) {
                    const k = String(h);
                    ch[k] = (ch[k] || []).filter(p => {
                        if (seen.has(p)) return false;
                        seen.add(p);
                        return true;
                    });
                }
            };
            dedup(rasiChart);
            dedup(navChart);

            return { rasi_chart: rasiChart, navamsam_chart: navChart };
        }

        // Convert Sri Angalamman Bamini / TAB ASCII font encoded text to Unicode Tamil
        function convertBaminiToUnicode(text) {
            if (!text || typeof text !== 'string') return '';
            let s = text.replace(/[\x00\x0B\r]/g, '');
            const chars = 'µ°©ÍªÆ¯¤Ç¿¨ŠŸ²È®¾‰Ž•ÁËÂ…š£À‡†›´³±Ê¸';
            for (let k = 0; k < 4; k++) {
                s = s.replace(new RegExp('([' + chars + ']) ([' + chars + '])', 'gu'), '$1$2');
            }
            s = s.replace(/([0-9]) ([0-9])/g, '$1$2');

            const baminiMap = [
                [/ªª£Í\s*µ°©Í/gu, 'பெண் வரன்'],
                [/†£Í\s*µ°©Í/gu, 'ஆண் வரன்'],
                [/µ°©Í\s*ªÆ¯°Í/gu, 'வரன் பெயர்'],
                [/µ°©¿©Í\s*ªŸ¿ªÍªÁ/gu, 'வரனின் படிப்பு'],
                [/ª¿±¨Í¤\s*¤Ç¤¿/gu, 'பிறந்த தேதி'],
                [/¨Ç°®Í/gu, 'நேரம்'],
                [/ª¿±¨Í¤\s*Š°Í/gu, 'பிறந்த ஊர்'],
                [/¨¿±Áµ©®Í\s*ªÆ¯°Í\s*&\s*Š°Í/gu, 'நிறுவனம் பெயர் & ஊர்'],
                [/®¾¤\s*µ°Á®¾©®Í/gu, 'மாத வருமானம்'],
                [/µÇÈ²/gu, 'வேலை'],
                [/Š¯°®Í/gu, 'உயரம்'],
                [/±¿±®Í/gu, 'நிறம்'],
                [/±ÈªŸ/gu, 'எடை'],
                [/•Á²ª¤¯Íµ®Í,\s*Š°Í/gu, 'குலதெய்வம், ஊர்'],
                [/•Á²ª¤¯Íµ®Í/gu, 'குலதெய்வம்'],
                [/•Ç¤Í¤¿°®Í/gu, 'கோத்திரம்'],
                [/ÜŸÍŸ®Í/gu, 'கூட்டம்'],
                [/¤¨Í¤È¯¿©Í\s*ªÆ¯°Í/gu, 'தந்தையின் பெயர்'],
                [/¤¨Í¤È\s*ªÆ¯°Í/gu, 'தந்தை பெயர்'],
                [/¤¨Í¤È¯¿©Í\s*ª£¿/gu, 'தந்தையின் பணி'],
                [/¤¨Í¤È\s*ª£¿/gu, 'தந்தை பணி'],
                [/¤¨Í¤È\s*Š°Í/gu, 'தந்தை ஊர்'],
                [/¤¾¯Í\s*ªÆ¯°Í/gu, 'தாய் பெயர்'],
                [/¤¾¯¾°Í\s*ªÆ¯°Í/gu, 'தாயார் பெயர்'],
                [/¤¾¯Í\s*ª£¿/gu, 'தாய் பணி'],
                [/¤¾¯¾°Í\s*ª£¿/gu, 'தாயார் பணி'],
                [/¤¾¯Í\s*Š°Í/gu, 'தாய் ஊர்'],
                [/Š²µ¿°®Í/gu, 'உறவினர்'],
                [/•ÁÎ®Íª\s*µ°Á®¾©®Í/gu, 'குடும்ப வருமானம்'],
                [/®Á•µ°¿/gu, 'முகவரி'],
                [/‰²•Í•¿/gu, 'லக்னம்'],
                [/ˆ°ËŸÁ/gu, 'ராசி'],
                [/¨ŸÍš¤Í¤¿°®Í/gu, 'நட்சத்திரம்'],
                [/12\s*®À©®Í/gu, '12 மீனம்'],
                [/1\s*®®Ÿ®Í/gu, '1 மேஷம்'],
                [/2\s*¿¿Ÿª®Í/gu, '2 ரிஷபம்'],
                [/3\s*®¿¤Á©®Í/gu, '3 மிதுனம்'],
                [/4\s*•Ÿ•®Í/gu, '4 கடகம்'],
                [/5\s*š¿®Í®®Í/gu, '5 சிம்மம்'],
                [/6\s*•©Í©¿/gu, '6 கன்னி'],
                [/7\s*¤Á²¾®Í/gu, '7 துலாம்'],
                [/8\s*µ¿°ÁšÍš¿•®Í/gu, '8 விருச்சிகம்'],
                [/9\s*¤©ÁšÁ/gu, '9 தனுசு'],
                [/10\s*®•°®Í/gu, '10 மகரம்'],
                [/11\s*•Á®Íª®Í/gu, '11 கும்பம்'],
                [/®À©®Í/gu, 'மீனம்'],
                [/®®Ÿ®Í/gu, 'மேஷம்'],
                [/¿¿Ÿª®Í/gu, 'ரிஷபம்'],
                [/®¿¤Á©®Í/gu, 'மிதுனம்'],
                [/•Ÿ•®Í/gu, 'கடகம்'],
                [/š¿®Í®®Í/gu, 'சிம்மம்'],
                [/•©Í©¿/gu, 'கன்னி'],
                [/¤Á²¾®Í/gu, 'துலாம்'],
                [/µ¿°ÁšÍš¿•®Í/gu, 'விருச்சிகம்'],
                [/¤©ÁšÁ/gu, 'தனுசு'],
                [/®•°®Í/gu, 'மகரம்'],
                [/•Á®Íª®Í/gu, 'கும்பம்'],
                [/²•Í/gu, 'லக்'],
                [/Ý¿¿/gu, 'சூரி'],
                [/š¨Í/gu, 'சந்'],
                [/ªšµÍ/gu, 'செவ்'],
                [/ªÁ¤/gu, 'புத'],
                [/•ÁÁ/gu, 'குரு'],
                [/Ý•Í/gu, 'சுக்'],
                [/š©¿/gu, 'சனி'],
                [/°¾•Á/gu, 'ராகு'],
                [/®•¤Á/gu, 'கேது'],
                [/®¾¨Í/gu, 'மாந்']
            ];

            for (const [pattern, repl] of baminiMap) {
                s = s.replace(pattern, repl);
            }
            return s;
        }

        // Extract text, candidate photo, and 12-kattam horoscope charts from PDF using PDF.js with line coordinates preservation
        async function extractTextFromPdf(file) {
            updateScanProgress(35, appLang === 'ta' ? 'PDF பக்கங்கள் படிக்கப்படுகின்றன...' : 'Extracting text from PDF...');
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                let fullText = '';
                let clientDetectedGender = null;

                // Read PDF metadata and filename for gender & embedded payload
                try {
                    const meta = await pdf.getMetadata();
                    if (meta && meta.info) {
                        const title = (meta.info.Title || '') + ' ' + (meta.info.Subject || '');
                        if (/BRIDE|Bride|Penn|மணமகள்|பெண்/i.test(title)) clientDetectedGender = 'penn';
                        else if (/GROOM|Groom|Aan|மணமகன்|ஆண்/i.test(title)) clientDetectedGender = 'aan';
                        if ((meta.info.Keywords || '').includes('###VARAN_EMBED_START###')) fullText += '\n' + meta.info.Keywords + '\n';
                        if ((meta.info.Subject || '').includes('###VARAN_EMBED_START###')) fullText += '\n' + meta.info.Subject + '\n';
                    }
                } catch (metaErr) {
                    console.warn('PDF metadata notice:', metaErr);
                }
                if (!clientDetectedGender && file && file.name) {
                    if (/BRIDE|Bride|Penn|மணமகள்|பெண்/i.test(file.name)) clientDetectedGender = 'penn';
                    else if (/GROOM|Groom|Aan|மணமகன்|ஆண்/i.test(file.name)) clientDetectedGender = 'aan';
                }

                // If embedded payload found in metadata, immediately restore or stage for photo sync
                let embeddedVaranJson = null;
                if (fullText.includes('###VARAN_EMBED_START###')) {
                    const m = fullText.match(/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/);
                    if (m && m[1]) {
                        try {
                            const cleanB64 = m[1].replace(/\s+/g, '');
                            const bin = atob(cleanB64);
                            const bytes = Uint8Array.from(bin, c => c.charCodeAt(0));
                            const decodedJson = JSON.parse(new TextDecoder('utf-8').decode(bytes));
                            if (decodedJson && typeof decodedJson === 'object') {
                                if (decodedJson.photo_base64) {
                                    updateScanProgress(100, appLang === 'ta' ? 'திட்ட ஆவணம் உடனடியாக மீட்டெடுக்கப்பட்டது!' : 'Profile restored instantly from project PDF!');
                                    setTimeout(hideScanProgress, 400);
                                    populateFormWithData(decodedJson);
                                    return;
                                } else {
                                    embeddedVaranJson = decodedJson;
                                }
                            }
                        } catch (err) {
                            console.warn('Metadata embed decode note:', err);
                        }
                    }
                }

                const PLANETS_CONFIG = [
                    { key: 'லக்', aliases: ['லக்', 'லக்னம்', 'Asc', 'Ascendant', 'Lagna', 'Lag', 'Lagnam'] },
                    { key: 'சூரி', aliases: ['சூரி', 'சூரியன்', 'Sun', 'Surya', 'Suriya'] },
                    { key: 'சந்', aliases: ['சந்', 'சந்திரன்', 'Moon', 'Chandra', 'Chandran'] },
                    { key: 'செவ்', aliases: ['செவ்', 'செவ்வாய்', 'செவ', 'செ.', 'செ', 'Mars', 'Sevvai', 'Chev', 'குஜ', 'குஜன்', 'Kuja'] },
                    { key: 'புத', aliases: ['புத', 'புதன்', 'Merc', 'Mer', 'Mercury', 'Budha', 'Budhan'] },
                    { key: 'குரு', aliases: ['குரு', 'வியாழன்', 'Jup', 'Jupiter', 'Guru'] },
                    { key: 'சுக்', aliases: ['சுக்', 'சுக்கிரன்', 'Ven', 'Venus', 'Sukra', 'Sukran'] },
                    { key: 'சனி', aliases: ['சனி', 'சனீஸ்வரன்', 'மந்தன்', 'Sat', 'Saturn', 'Sani', 'Shani'] },
                    { key: 'ராகு', aliases: ['ராகு', 'ரா', 'Rahu', 'Raghu'] },
                    { key: 'கேது', aliases: ['கேது', 'கெது', 'கே.', 'கே', 'Ketu', 'Kethu', 'Ket'] },
                    { key: 'மாந்', aliases: ['மாந்', 'மாந்தி', 'Gulika', 'Mand', 'Mandi'] }
                ];
                const GRID_MAP = [
                    [12, 1, 2, 3],
                    [11, null, null, 4],
                    [10, null, null, 5],
                    [9, 8, 7, 6]
                ];
                const rasiChartData = { '1':[], '2':[], '3':[], '4':[], '5':[], '6':[], '7':[], '8':[], '9':[], '10':[], '11':[], '12':[] };
                const navamsamChartData = { '1':[], '2':[], '3':[], '4':[], '5':[], '6':[], '7':[], '8':[], '9':[], '10':[], '11':[], '12':[] };
                const rasiCellTexts = { '1':'', '2':'', '3':'', '4':'', '5':'', '6':'', '7':'', '8':'', '9':'', '10':'', '11':'', '12':'' };
                const navamsamCellTexts = { '1':'', '2':'', '3':'', '4':'', '5':'', '6':'', '7':'', '8':'', '9':'', '10':'', '11':'', '12':'' };
                let hasChartPlanets = false;
                let clientPhotoDataUrl = null;
                let canvas = null;

                // 1. Process First Page for Candidate Photo Extraction
                const firstPage = await pdf.getPage(1);
                const viewport = firstPage.getViewport({ scale: 1.5 });
                const pageW = viewport.width / 1.5;
                const pageH = viewport.height / 1.5;

                // Inspect page 1 text items to find exact dynamic row baselines
                const p1TextContent = await firstPage.getTextContent();

                // Check if page 1 text contains embedded Varan JSON payload (100% Instant Digital Restore from Chrome Print)
                const p1AllText = (p1TextContent.items || []).map(it => it.str).join('');
                if (!embeddedVaranJson && (p1AllText.includes('###VARAN_EMBED_START###') || p1AllText.includes('VARAN_EMBED_START'))) {
                    const m = p1AllText.match(/(?:###|___)?\s*VARAN_EMBED_START\s*###?\s*([A-Za-z0-9+/=\s]{20,}?)\s*###?\s*VARAN_EMBED_END/);
                    if (m && m[1]) {
                        try {
                            const cleanB64 = m[1].replace(/[\s\r\n]+/g, '');
                            const bin = atob(cleanB64);
                            const bytes = Uint8Array.from(bin, c => c.charCodeAt(0));
                            const decodedJson = JSON.parse(new TextDecoder('utf-8').decode(bytes));
                            if (decodedJson && typeof decodedJson === 'object') {
                                if (decodedJson.photo_base64) {
                                    updateScanProgress(100, appLang === 'ta' ? 'திட்ட ஆவணம் உடனடியாக மீட்டெடுக்கப்பட்டது!' : 'Profile restored instantly from project PDF!');
                                    setTimeout(hideScanProgress, 400);
                                    populateFormWithData(decodedJson);
                                    return;
                                } else {
                                    embeddedVaranJson = decodedJson;
                                }
                            }
                        } catch (err) {
                            console.warn('Page 1 embed decode note:', err);
                        }
                    }
                }

                const lineMap = {};
                for (const it of (p1TextContent.items || [])) {
                    if (!it || !it.str || !it.transform || it.transform.length < 6) continue;
                    const y = Math.round(pageH - it.transform[5]);
                    let foundKey = Object.keys(lineMap).find(k => Math.abs(k - y) <= 4);
                    if (!foundKey) {
                        foundKey = y;
                        lineMap[foundKey] = [];
                    }
                    lineMap[foundKey].push({ str: it.str, x: it.transform[4] });
                }

                // Scan page 1 items for explicit house labels (Row 0: 12, 1, 2, 3; Row 3: 9, 8, 7, 6)
                const r0Ys = [];
                const r3Ys = [];
                const hubYs = [];
                for (const it of (p1TextContent.items || [])) {
                    if (!it || !it.str || !it.transform || it.transform.length < 6) continue;
                    const y = pageH - it.transform[5];
                    const s = it.str.trim();
                    if (!s) continue;
                    if (/(?:(?:12\b|1\b|2\b|3\b)?\s*(?:மீனம்|மேஷம்|ரிஷபம்|மிதுனம்|Pisces|Aries|Taurus|Gemini))/i.test(s) || /^(?:மீனம்|மேஷம்|ரிஷபம்|மிதுனம்)$/i.test(s)) {
                        r0Ys.push(y);
                    }
                    if (/(?:(?:9\b|8\b|7\b|6\b)?\s*(?:தனுசு|விருச்சிகம்|துலாம்|கன்னி|Sagittarius|Scorpio|Libra|Virgo))/i.test(s) || /^(?:தனுசு|விருச்சிகம்|துலாம்|கன்னி)$/i.test(s)) {
                        r3Ys.push(y);
                    }
                    if (/^(?:ராசி|Rasi|நவாம்சம்|Navamsam)$/i.test(s)) {
                        hubYs.push(y);
                    }
                }
                // Also scan lineMap full lines for 100% guarantee across split font runs
                for (const [yStr, items] of Object.entries(lineMap)) {
                    const y = parseFloat(yStr);
                    const lineJoined = items.sort((a,b)=>a.x-b.x).map(i=>i.str).join('');
                    const compact = lineJoined.replace(/[\s\u200B-\u200D\uFEFF]+/g, '');
                    if ((compact.includes('மீனம்') || compact.toLowerCase().includes('pisces')) && 
                        (compact.includes('மேஷம்') || compact.includes('ரிஷபம்') || compact.includes('மிதுனம்') || compact.toLowerCase().includes('aries'))) {
                        r0Ys.push(y);
                    }
                    if ((compact.includes('தனுசு') || compact.toLowerCase().includes('sagittarius')) && 
                        (compact.includes('விருச்சிகம்') || compact.includes('விருச்சி') || compact.includes('துலாம்') || compact.includes('கன்னி') || compact.toLowerCase().includes('scorpio'))) {
                        r3Ys.push(y);
                    }
                }

                let summaryLineY = null;
                let bottomLineY = null;
                for (const [yStr, items] of Object.entries(lineMap)) {
                    const y = parseFloat(yStr);
                    items.sort((a, b) => a.x - b.x);
                    let rawLine = items.map(i => i.str).join('');
                    let line = rawLine.replace(/([\u0B85-\u0BB9])\u0000/gu, '\u0BBF').replace(/\u0000/g, '').replace(/\s+/g, '');
                    // Summary line strictly requires colons e.g. "ராசி : கும்பம்" so it NEVER matches the center hub "ராசி"
                    if (/(?:ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam)\s*[:=–\-]/i.test(line) && (y >= pageH * 0.30 && y <= pageH * 0.65)) {
                        if (!summaryLineY || y < summaryLineY) summaryLineY = y;
                    }
                    // Bottom boundary line below charts (STRICTLY Dasa Balance line only at >= 70% height)
                    if (/(?:திசை\s*இருப்பு|Dasa\s*Balance)/i.test(line) && (y >= pageH * 0.70 && y <= pageH * 0.92)) {
                        if (!bottomLineY || y < bottomLineY) bottomLineY = y;
                    }
                }

                let chartStartFromTop = null;
                let chartEndFromTop = null;
                let rowHeight = null;

                if (r0Ys.length > 0 && r3Ys.length > 0) {
                    const median = arr => { const s = [...arr].sort((a,b) => a - b); return s[Math.floor(s.length / 2)]; };
                    const r0 = median(r0Ys);
                    const r3 = median(r3Ys);
                    rowHeight = (r3 - r0) / 3;
                    chartStartFromTop = r0 - (rowHeight * 0.5);
                    chartEndFromTop = r3 + (rowHeight * 0.5);
                } else {
                    chartStartFromTop = summaryLineY ? (summaryLineY + 22) : (pageH * 0.568);
                    chartEndFromTop = bottomLineY ? (bottomLineY - 4) : (pageH * 0.725);
                    const chartTotalHeightFallback = Math.max(120, chartEndFromTop - chartStartFromTop);
                    rowHeight = chartTotalHeightFallback / 4;
                    // Cross-calibrate with center hub if present
                    if (hubYs.length > 0) {
                        const hubMedian = [...hubYs].sort((a,b)=>a-b)[Math.floor(hubYs.length/2)];
                        const expectedHub = chartStartFromTop + (rowHeight * 2);
                        if (Math.abs(hubMedian - expectedHub) > 10) {
                            chartStartFromTop = hubMedian - (rowHeight * 2);
                            chartEndFromTop = chartStartFromTop + (rowHeight * 4);
                        }
                    }
                }
                if (bottomLineY && chartEndFromTop > (bottomLineY - 4)) {
                    chartEndFromTop = bottomLineY - 4;
                }
                if (summaryLineY && chartStartFromTop < (summaryLineY + 12)) {
                    chartStartFromTop = summaryLineY + 12;
                }
                const chartTotalHeight = Math.max(120, chartEndFromTop - chartStartFromTop);
                let isThreeColLayout = true;
                for (const it of (p1TextContent.items || [])) {
                    if (!it || !it.str || !it.transform || it.transform.length < 6) continue;
                    const y = pageH - it.transform[5];
                    const x = it.transform[4];
                    if (y >= chartStartFromTop && y <= chartEndFromTop) {
                        if (x < (pageW * 0.20) && /(?:12\s*மீனம்|1\s*மே|11\s*கும்பம்|10\s*மகரம்|9\s*தனுசு|ராசி|Rasi)/i.test(it.str)) {
                            isThreeColLayout = false;
                            break;
                        }
                    }
                }

                // 100% Reliable Candidate Gender Detection from Page 1 Text
                const p1RawText = (p1TextContent.items || []).map(it => it.str).join(' ');
                const p1Decoded = convertBaminiToUnicode(p1RawText);
                if (!clientDetectedGender) {
                    if (/(?:பெண்\s*வரன்|பெண்\s*மறுமணம்|Bride\s*Biodata|Bride\s*Remarriage|\bBride\b|\bD\/o\b)/i.test(p1Decoded)) {
                        clientDetectedGender = 'penn';
                    } else if (/(?:ஆண்\s*வரன்|ஆண்\s*மறுமணம்|Groom\s*Biodata|Groom\s*Remarriage|\bGroom\b|\bS\/o\b)/i.test(p1Decoded)) {
                        clientDetectedGender = 'aan';
                    } else if (/(?:மணமகன்\s*எதிர்பார்ப்பு|மணமகன்\s*தேவை|Groom\s*Wanted)/i.test(p1Decoded)) {
                        clientDetectedGender = 'penn';
                    } else if (/(?:மணமகள்\s*எதிர்பார்ப்பு|மணமகள்\s*தேவை|Bride\s*Wanted)/i.test(p1Decoded)) {
                        clientDetectedGender = 'aan';
                    }
                }

                try {
                    canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    const ctx = canvas.getContext('2d');
                    await firstPage.render({ canvasContext: ctx, viewport: viewport }).promise;

                    // Candidate Photo Crop Box (Row 16, Left of Rasi kattam)
                    // Photo frame precisely starts at 3.8% width to 20.6% width of page
                    const photoMinX = pageW * 0.038;
                    const photoMaxX = pageW * 0.206;
                    const cropX = Math.round(photoMinX * 1.5);
                    const cropW = Math.round((photoMaxX - photoMinX) * 1.5);
                    
                    // The photo frame top strictly matches the top of Rasi Kattam (chartStartFromTop)
                    // chartStartFromTop is already calculated as r0 - rowHeight*0.5 (the top of House 12 / Row 0)
                    const photoTop = (chartStartFromTop !== null) ? (chartStartFromTop + 2) : (summaryLineY ? (summaryLineY + 14) : (pageH * 0.572));
                    const photoH = (chartTotalHeight !== null && chartTotalHeight > 100) ? Math.max(120, chartTotalHeight - 4) : (pageH * 0.174);
                    const cropY = Math.round(photoTop * 1.5);
                    const cropH = Math.round(photoH * 1.5);

                    if (cropW > 40 && cropH > 40) {
                        const photoCanvas = document.createElement('canvas');
                        photoCanvas.width = cropW;
                        photoCanvas.height = cropH;
                        const photoCtx = photoCanvas.getContext('2d');
                        photoCtx.drawImage(canvas, cropX, cropY, cropW, cropH, 0, 0, cropW, cropH);

                        // Smart Top Border Trimmer: only trims thin leaked outer border line (max 6px), NEVER person's hair/face
                        let topTrimY = 0;
                        const checkRows = Math.min(6, Math.round(cropH * 0.05));
                        const topData = photoCtx.getImageData(0, 0, cropW, checkRows).data;
                        for (let row = 0; row < checkRows; row++) {
                            let borderPixels = 0;
                            for (let col = 0; col < cropW; col++) {
                                const idx = (row * cropW + col) * 4;
                                const r = topData[idx], g = topData[idx+1], b = topData[idx+2];
                                // Strict yellow banner (#ffe600: r>210, g>180, b<70) or deep red border line (r>160, g<60, b<60)
                                if ((r > 210 && g > 180 && b < 70) || (r > 160 && g < 60 && b < 60)) {
                                    borderPixels++;
                                }
                            }
                            if (borderPixels / cropW > 0.65) {
                                topTrimY = row + 1;
                            } else if (topTrimY > 0) {
                                break;
                            }
                        }

                        let finalCanvas = photoCanvas;
                        if (topTrimY > 0 && (cropH - topTrimY) > 40) {
                            finalCanvas = document.createElement('canvas');
                            finalCanvas.width = cropW;
                            finalCanvas.height = cropH - topTrimY;
                            const fCtx = finalCanvas.getContext('2d');
                            fCtx.drawImage(photoCanvas, 0, topTrimY, cropW, cropH - topTrimY, 0, 0, cropW, cropH - topTrimY);
                        }

                        // Analyze inner 70% to detect empty placeholder frame
                        const fCtx = finalCanvas.getContext('2d');
                        const innerX = Math.round(finalCanvas.width * 0.15);
                        const innerY = Math.round(finalCanvas.height * 0.15);
                        const innerW = Math.round(finalCanvas.width * 0.70);
                        const innerH = Math.round(finalCanvas.height * 0.70);
                        const innerImgData = fCtx.getImageData(innerX, innerY, innerW, innerH).data;

                        let totalPixels = 0;
                        let lightPaperPixels = 0;
                        let pureWhitePixels = 0;
                        let skinPixels = 0;
                        let darkPixels = 0;

                        for (let k = 0; k < innerImgData.length; k += 4) {
                            const r = innerImgData[k];
                            const g = innerImgData[k + 1];
                            const b = innerImgData[k + 2];
                            totalPixels++;

                            if (r > 225 && g > 225 && b > 220) {
                                pureWhitePixels++;
                            }
                            if (r > 215 && g > 215 && b > 205) {
                                lightPaperPixels++;
                            }
                            if ((r + g + b) / 3 < 100) {
                                darkPixels++;
                            }
                            if (r > 95 && g > 40 && b > 20 && (r - Math.min(g, b)) > 15 && r > g && g > (b - 10) && (r + g + b) / 3 > 70 && (r + g + b) / 3 < 225) {
                                skinPixels++;
                            }
                        }

                        let chromaPixels = 0;
                        for (let k = 0; k < innerImgData.length; k += 4) {
                            const r = innerImgData[k], g = innerImgData[k+1], b = innerImgData[k+2];
                            if (Math.max(r, g, b) - Math.min(r, g, b) > 18) chromaPixels++;
                        }
                        const whiteRatio = pureWhitePixels / totalPixels;
                        const lightRatio = lightPaperPixels / totalPixels;
                        const skinRatio = skinPixels / totalPixels;
                        const darkRatio = darkPixels / totalPixels;
                        const chromaRatio = chromaPixels / totalPixels;

                        const placeholderRegex = /(?:வரன்\s*பு[ை\u0BC8]?\s*க[ை\u0BC8]?\s*ப்*படம்|Passport\s*Photo|NO\s*PHOTO|Candidate\s*Photo|Photo\s*Here)/i;
                        const hasBoxPlaceholderText = (p1TextContent.items || []).some(it => {
                            if (!it || !it.str || !it.transform || it.transform.length < 6) return false;
                            const itemY = pageH - it.transform[5];
                            const itemX = it.transform[4];
                            return (itemY >= (photoTop - 15) && itemY <= (photoTop + photoH + 15) && itemX < (pageW * 0.25)) && placeholderRegex.test(it.str);
                        });

                        // Flat empty placeholder box has >88% white or >80% light paper with no human skin and almost no dark features
                        const isFlatBlankPaper = (whiteRatio > 0.88 && skinRatio < 0.008) || (lightRatio > 0.82 && skinRatio < 0.008 && darkRatio < 0.025);
                        const hasRealPhotoFeatures = (skinRatio >= 0.010) || (darkRatio >= 0.035 && (chromaRatio >= 0.04 || skinRatio >= 0.006)) || (chromaRatio >= 0.08 && darkRatio >= 0.025);

                        const isRealPhoto = !hasBoxPlaceholderText && !isFlatBlankPaper && hasRealPhotoFeatures;
                        if (isRealPhoto) {
                            clientPhotoDataUrl = finalCanvas.toDataURL('image/jpeg', 0.95);
                        } else {
                            clientPhotoDataUrl = null;
                        }
                    }
                } catch (photoErr) {
                    console.warn('Notice: PDF photo crop error:', photoErr);
                }

                // If embedded Varan JSON payload was found (Metadata or Page 1 text), perform instant 100% digital restore now!
                if (embeddedVaranJson && typeof embeddedVaranJson === 'object') {
                    if (!embeddedVaranJson.photo_base64 && clientPhotoDataUrl) {
                        embeddedVaranJson.photo_base64 = clientPhotoDataUrl;
                    }
                    updateScanProgress(100, appLang === 'ta' ? 'திட்ட ஆவணம் உடனடியாக மீட்டெடுக்கப்பட்டது!' : 'Profile restored instantly from project PDF!');
                    setTimeout(hideScanProgress, 400);
                    populateFormWithData(embeddedVaranJson);
                    return;
                }

                // 2. Extract Text & Horoscope Grid from Pages
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = (i === 1) ? firstPage : await pdf.getPage(i);
                    const textContent = (i === 1) ? p1TextContent : await page.getTextContent();
                    let lastY = null;
                    let pageText = '';

                    const sortedItems = (textContent.items || []).filter(it => it && it.str).map(it => ({
                        str: it.str,
                        x: (it.transform && it.transform.length >= 6) ? it.transform[4] : 0,
                        y: (it.transform && it.transform.length >= 6) ? it.transform[5] : 0
                    }));
                    sortedItems.sort((a, b) => (Math.abs(b.y - a.y) > 7) ? (b.y - a.y) : (a.x - b.x));

                    for (const item of sortedItems) {
                        if (!item || !item.str) continue;
                        const currentY = item.y !== undefined ? item.y : null;
                        const currentX = item.x !== undefined ? item.x : null;

                        if (lastY !== null && currentY !== null && Math.abs(currentY - lastY) > 7) {
                            pageText += '\n';
                        } else if (pageText && !pageText.endsWith(' ') && !pageText.endsWith('\n')) {
                            pageText += ' ';
                        }
                        pageText += item.str;
                        if (currentY !== null) lastY = currentY;

                        // Accumulate 12-house Kundali grid cell texts by layout coordinates
                        if (currentY !== null && currentX !== null) {
                            const yFromTop = pageH - currentY;
                            const median = arr => { const s = [...arr].sort((a,b) => a - b); return s[Math.floor(s.length / 2)]; };
                            const r0 = (r0Ys.length > 0) ? median(r0Ys) : (chartStartFromTop ? chartStartFromTop + 20 : pageH * 0.58);
                            const r3 = (r3Ys.length > 0) ? median(r3Ys) : (chartEndFromTop ? chartEndFromTop - 20 : pageH * 0.70);
                            const rowH = Math.max(25, (r3 - r0) / 3);
                            const gridTop = r0 - (rowH * 0.35);
                            const gridBottom = r3 + (rowH * 1.15);

                            if (yFromTop >= gridTop && yFromTop <= gridBottom) {
                                const row = Math.min(3, Math.max(0, Math.floor((yFromTop - gridTop) / rowH)));
                                
                                const rasiMinX = isThreeColLayout ? (pageW * 0.238) : (pageW * 0.04);
                                const rasiMaxX = isThreeColLayout ? (pageW * 0.592) : (pageW * 0.50);
                                const rasiWidth = rasiMaxX - rasiMinX;
                                const rasiColW = rasiWidth / 4;

                                const navMinX = isThreeColLayout ? (pageW * 0.598) : (pageW * 0.51);
                                const navMaxX = isThreeColLayout ? (pageW * 0.952) : (pageW * 0.98);
                                const navWidth = navMaxX - navMinX;
                                const navColW = navWidth / 4;

                                const itemTextDecoded = (typeof convertBaminiToUnicode === 'function') ? convertBaminiToUnicode(item.str || '') : (item.str || '');
                                if (currentX >= rasiMinX && currentX <= rasiMaxX) {
                                    let col = Math.min(3, Math.max(0, Math.floor((currentX - rasiMinX) / rasiColW)));
                                    if ((row === 1 || row === 2) && (col === 1 || col === 2)) {
                                        // Center hub is null - skip center title/icon text
                                        continue;
                                    }
                                    const h = GRID_MAP[row][col];
                                    if (h) rasiCellTexts[String(h)] += itemTextDecoded + ' ';
                                } else if (currentX >= navMinX && currentX <= navMaxX) {
                                    let col = Math.min(3, Math.max(0, Math.floor((currentX - navMinX) / navColW)));
                                    if ((row === 1 || row === 2) && (col === 1 || col === 2)) {
                                        // Center hub is null - skip center title/icon text
                                        continue;
                                    }
                                    const h = GRID_MAP[row][col];
                                    if (h) navamsamCellTexts[String(h)] += itemTextDecoded + ' ';
                                }
                            }
                        }
                    }
                    fullText += pageText + '\n';
                    updateScanProgress(35 + Math.round((i / pdf.numPages) * 55), `Page ${i}/${pdf.numPages}...`);
                }

                // If extracted text from PDF is empty or very short (< 40 chars), fallback to client-side OCR on canvas
                if ((!fullText || fullText.trim().length < 40) && typeof Tesseract !== 'undefined') {
                    updateScanProgress(50, appLang === 'ta' ? 'PDF ஆவணத்தில் OCR ஸ்கேன் செய்யப்படுகிறது...' : 'Scanning PDF pages with OCR...');
                    try {
                        const { data: { text: ocrText } } = await Tesseract.recognize(canvas, 'tam+eng');
                        if (ocrText && ocrText.trim().length > 20) {
                            fullText = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(ocrText) : ocrText;
                            const ocrCharts = parseHoroscopeFromFullText(fullText);
                            if (ocrCharts && ocrCharts.rasi_chart) {
                                const rCount = Object.values(ocrCharts.rasi_chart).reduce((a, b) => a + b.length, 0);
                                if (rCount > 0) Object.assign(rasiChartData, ocrCharts.rasi_chart);
                            }
                            if (ocrCharts && ocrCharts.navamsam_chart) {
                                const nCount = Object.values(ocrCharts.navamsam_chart).reduce((a, b) => a + b.length, 0);
                                if (nCount > 0) Object.assign(navamsamChartData, ocrCharts.navamsam_chart);
                            }
                        }
                    } catch (ocrErr) {
                        console.warn('PDF canvas OCR notice:', ocrErr);
                    }
                }

                // Resolve all accumulated cell texts into planets (Case-insensitive matching for English & Tamil)
                for (let h = 1; h <= 12; h++) {
                    const hKey = String(h);
                    if (rasiCellTexts[hKey]) {
                        const norm = (typeof normalizeTamilVisualOrder === 'function') ? normalizeTamilVisualOrder(rasiCellTexts[hKey]) : rasiCellTexts[hKey];
                        const clean = norm.replace(/[\u200b-\u200d\ufeff\s\.]/g, '');
                        const cleanLower = clean.toLowerCase();
                        const cellPlanets = [];
                        for (const p of PLANETS_CONFIG) {
                            let bestIdx = -1;
                            for (const a of p.aliases) {
                                const idx = clean.includes(a) ? clean.indexOf(a) : cleanLower.indexOf(a.toLowerCase());
                                if (idx !== -1 && (bestIdx === -1 || idx < bestIdx)) bestIdx = idx;
                            }
                            if (bestIdx !== -1) cellPlanets.push({ key: p.key, idx: bestIdx });
                        }
                        cellPlanets.sort((a, b) => a.idx - b.idx);
                        cellPlanets.forEach(cp => {
                            if (!rasiChartData[hKey].includes(cp.key)) {
                                rasiChartData[hKey].push(cp.key);
                                hasChartPlanets = true;
                            }
                        });
                    }

                    if (navamsamCellTexts[hKey]) {
                        const norm = (typeof normalizeTamilVisualOrder === 'function') ? normalizeTamilVisualOrder(navamsamCellTexts[hKey]) : navamsamCellTexts[hKey];
                        const clean = norm.replace(/[\u200b-\u200d\ufeff\s\.]/g, '');
                        const cleanLower = clean.toLowerCase();
                        const cellPlanets = [];
                        for (const p of PLANETS_CONFIG) {
                            let bestIdx = -1;
                            for (const a of p.aliases) {
                                const idx = clean.includes(a) ? clean.indexOf(a) : cleanLower.indexOf(a.toLowerCase());
                                if (idx !== -1 && (bestIdx === -1 || idx < bestIdx)) bestIdx = idx;
                            }
                            if (bestIdx !== -1) cellPlanets.push({ key: p.key, idx: bestIdx });
                        }
                        cellPlanets.sort((a, b) => a.idx - b.idx);
                        cellPlanets.forEach(cp => {
                            if (!navamsamChartData[hKey].includes(cp.key)) {
                                navamsamChartData[hKey].push(cp.key);
                                hasChartPlanets = true;
                            }
                        });
                    }
                }

                // Text-based fallback and supplement for Kundali (Strictly requires house labels to match)
                if (fullText) {
                    const lines = fullText.split('\n');
                    let inRasi = false, inNav = false;
                    let rLines = [], nLines = [];
                    for (const l of lines) {
                        const t = l.trim();
                        if (/^(?:ராசி|Rasi)(?:\s*கட்டம்|\s*Chart)?$/i.test(t)) { inRasi = true; inNav = false; continue; }
                        if (/^(?:நவாம்சம்|Navamsam|நவாம்ச)(?:\s*கட்டம்|\s*Chart)?$/i.test(t)) { inRasi = false; inNav = true; continue; }
                        if (/^(?:திசை\s*இருப்பு|Dasa|இதர\s*குறிப்புகள்|Other\s*Notes|எதிர்பார்ப்பு)/i.test(t)) { inRasi = false; inNav = false; }
                        if (inRasi && t !== 'ராசி') rLines.push(t);
                        if (inNav && t !== 'நவா' && t !== 'நவாம்சம்') nLines.push(t);
                    }

                    const extractTokens = (str) => {
                        if (!str) return [];
                        const res = [];
                        const strLower = str.toLowerCase();
                        for (const p of PLANETS_CONFIG) {
                            for (const a of p.aliases) {
                                if (str.includes(a) || strLower.includes(a.toLowerCase())) {
                                    if (!res.includes(p.key)) res.push(p.key);
                                    break;
                                }
                            }
                        }
                        return res;
                    };

                    const fillGridFromLines = (chartObj, srcLines) => {
                        if (!srcLines || !srcLines.length) return;
                        const houseNamesMap = {
                            'மேஷம்': 1, 'ரிஷபம்': 2, 'மிதுனம்': 3, 'கடகம்': 4,
                            'சிம்மம்': 5, 'கன்னி': 6, 'துலாம்': 7, 'விருச்சிகம்': 8,
                            'தனுசு': 9, 'மகரம்': 10, 'கும்பம்': 11, 'மீனம்': 12,
                            'Aries': 1, 'Taurus': 2, 'Gemini': 3, 'Cancer': 4,
                            'Leo': 5, 'Virgo': 6, 'Libra': 7, 'Scorpio': 8,
                            'Sagittarius': 9, 'Capricorn': 10, 'Aquarius': 11, 'Pisces': 12
                        };
                        let matchedByHouseLabel = false;
                        for (const l of srcLines) {
                            // Find all house occurrences on this line and sort by start index
                            const matches = [];
                            for (const [hn, hIdx] of Object.entries(houseNamesMap)) {
                                let idx = 0;
                                const lLower = l.toLowerCase();
                                const hnLower = hn.toLowerCase();
                                while ((idx = lLower.indexOf(hnLower, idx)) !== -1) {
                                    matches.push({ hIdx, start: idx, end: idx + hn.length });
                                    idx += hn.length;
                                }
                            }
                            if (matches.length > 0) {
                                matches.sort((a, b) => a.start - b.start);
                                for (let i = 0; i < matches.length; i++) {
                                    const curr = matches[i];
                                    const nextStart = (i + 1 < matches.length) ? matches[i + 1].start : l.length;
                                    const segment = l.substring(curr.end, nextStart);
                                    const tokens = extractTokens(segment);
                                    tokens.forEach(p => {
                                        if (!chartObj[String(curr.hIdx)].includes(p)) {
                                            chartObj[String(curr.hIdx)].push(p);
                                            matchedByHouseLabel = true;
                                        }
                                    });
                                }
                            } else {
                                const numM = l.match(/\b([1-9]|1[0-2])\s*[:=\-–\.]\s*([^\r\n]+)/);
                                if (numM) {
                                    const hIdx = numM[1];
                                    const tokens = extractTokens(numM[2]);
                                    tokens.forEach(p => {
                                        if (!chartObj[String(hIdx)].includes(p)) {
                                            chartObj[String(hIdx)].push(p);
                                            matchedByHouseLabel = true;
                                        }
                                    });
                                }
                            }
                        }
                    };

                    // Supplement text lines if coordinate scanning extracted fewer than 7 planets
                    const rasiCount = Object.values(rasiChartData).reduce((acc, arr) => acc + arr.length, 0);
                    const navCount = Object.values(navamsamChartData).reduce((acc, arr) => acc + arr.length, 0);
                    if (rasiCount < 7) fillGridFromLines(rasiChartData, rLines);
                    if (navCount < 7) fillGridFromLines(navamsamChartData, nLines);

                    // Deduplicate planets across houses so no planet appears in more than 1 house per chart
                    const deduplicateChartHouses = (chart) => {
                        const seen = new Set();
                        for (let h = 1; h <= 12; h++) {
                            const k = String(h);
                            if (Array.isArray(chart[k])) {
                                chart[k] = chart[k].filter(p => {
                                    if (seen.has(p)) return false;
                                    seen.add(p);
                                    return true;
                                });
                            }
                        }
                    };
                    deduplicateChartHouses(rasiChartData);
                    deduplicateChartHouses(navamsamChartData);
                }

                // Supplement with fullText astrological parser
                if (fullText) {
                    try {
                        const parsedFromText = parseHoroscopeFromFullText(fullText);
                        const rCountText = Object.values(parsedFromText.rasi_chart).reduce((a, b) => a + b.length, 0);
                        const nCountText = Object.values(parsedFromText.navamsam_chart).reduce((a, b) => a + b.length, 0);
                        const rCountCoord = Object.values(rasiChartData).reduce((a, b) => a + b.length, 0);
                        const nCountCoord = Object.values(navamsamChartData).reduce((a, b) => a + b.length, 0);

                        if (rCountText >= rCountCoord && rCountText > 0) {
                            Object.assign(rasiChartData, parsedFromText.rasi_chart);
                        }
                        if (nCountText >= nCountCoord && nCountText > 0) {
                            Object.assign(navamsamChartData, parsedFromText.navamsam_chart);
                        }
                    } catch (txtChartErr) {
                        console.warn('Notice: Text horoscope extraction error:', txtChartErr);
                    }
                }

                // Auto-detect Lagnam from Rasi Chart
                const houseToRasiName = {
                    1: 'மேஷம்', 2: 'ரிஷபம்', 3: 'மிதுனம்', 4: 'கடகம்',
                    5: 'சிம்மம்', 6: 'கன்னி', 7: 'துலாம்', 8: 'விருச்சிகம்',
                    9: 'தனுசு', 10: 'மகரம்', 11: 'கும்பம்', 12: 'மீனம்'
                };
                let detectedLagnamFromChart = null;
                for (let h = 1; h <= 12; h++) {
                    if (rasiChartData[String(h)] && rasiChartData[String(h)].includes('லக்')) {
                        detectedLagnamFromChart = houseToRasiName[h];
                        break;
                    }
                }

                hideScanProgress();
                const extraData = { rasi_chart: rasiChartData, navamsam_chart: navamsamChartData };
                if (detectedLagnamFromChart) extraData.detected_lagnam = detectedLagnamFromChart;
                if (clientPhotoDataUrl) extraData.photo_base64 = clientPhotoDataUrl;
                if (clientDetectedGender) extraData.detected_gender = clientDetectedGender;

                // 1. Check for Embedded Varan JSON Payload (Instant 1-Click Restore)
                if (fullText.includes('###VARAN_EMBED_START###')) {
                    const m = fullText.match(/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/);
                    if (m && m[1]) {
                        try {
                            const cleanB64 = m[1].replace(/\s+/g, '');
                            const bin = atob(cleanB64);
                            const bytes = new Uint8Array(bin.length);
                            for (let i = 0; i < bin.length; i++) bytes[i] = bin.charCodeAt(i);
                            const decodedJson = JSON.parse(new TextDecoder().decode(bytes));
                            if (decodedJson && typeof decodedJson === 'object') {
                                populateFormWithData(decodedJson);
                                return;
                            }
                        } catch (err) {
                            console.warn('Payload decode fallback:', err);
                        }
                    }
                }

                // 2. High-Precision PyMuPDF & Smalot Server Engine
                sendToBackendParser(file, extraData, fullText, canvas);
            } catch (err) {
                console.warn('PDF.js fallback to backend:', err);
                sendToBackendParser(file, null, '', canvas);
            }
        }

        async function sendToBackendParser(file, extraData = null, fallbackText = '', renderCanvas = null) {
            updateScanProgress(70, appLang === 'ta' ? 'சேவையகத்தில் விபரங்கள் பகுப்பாய்வு செய்யப்படுகின்றன...' : 'Parsing document on server...');
            const fd = new FormData();
            if (file) fd.append('biodata_file', file);
            if (fallbackText) {
                const normText = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(fallbackText) : ((typeof normalizeTamilVisualOrder === 'function') ? normalizeTamilVisualOrder(fallbackText) : fallbackText);
                fd.append('biodata_text', normText);
            }
            if (extraData && extraData.detected_gender) {
                fd.append('client_gender', extraData.detected_gender);
            }
            fd.append('_token', '{{ csrf_token() }}');

            try {
                const parseUrl = '{{ route('varans.parseDocument', [], false) }}' || '/matrimony/parse-document';
                const res = await fetch(parseUrl, {
                    method: 'POST',
                    body: fd
                });
                let data = null;
                try {
                    const rawText = await res.text();
                    data = JSON.parse(rawText);
                } catch (jsonErr) {
                    console.warn('Backend parse non-JSON response:', jsonErr);
                }
                hideScanProgress();
                if (data && data.needs_ocr) {
                    if (typeof Tesseract !== 'undefined') {
                        updateScanProgress(45, appLang === 'ta' ? 'ஸ்கேன் செய்யப்பட்ட ஆவணம்: எழுத்துக்கள் கண்டறியப்படுகின்றன...' : 'Scanned document: Running OCR...');
                        try {
                            const ocrTarget = (file && (file.type === 'application/pdf' || (file.name && file.name.toLowerCase().endsWith('.pdf'))) && (renderCanvas || canvas)) ? (renderCanvas || canvas) : file;
                            const { data: { text: ocrText } } = await Tesseract.recognize(ocrTarget, 'tam+eng', {
                                logger: m => {
                                    if (m.status === 'recognizing text') {
                                        const p = Math.round((m.progress || 0) * 50) + 45;
                                        updateScanProgress(p, `${appLang === 'ta' ? 'எழுத்துக்கள் ஸ்கேன் ஆகிறது' : 'Recognizing text'} (${p}%)...`);
                                    }
                                }
                            });
                            hideScanProgress();
                            if (ocrText && ocrText.trim().length > 10) {
                                const normOcr = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(ocrText) : normalizeTamilVisualOrder(ocrText);
                                const ocrCharts = parseHoroscopeFromFullText(normOcr);
                                if (!extraData) extraData = {};
                                if (ocrCharts && ocrCharts.rasi_chart) {
                                    const rCount = Object.values(ocrCharts.rasi_chart).reduce((a, b) => a + b.length, 0);
                                    if (rCount > 0) extraData.rasi_chart = ocrCharts.rasi_chart;
                                }
                                if (ocrCharts && ocrCharts.navamsam_chart) {
                                    const nCount = Object.values(ocrCharts.navamsam_chart).reduce((a, b) => a + b.length, 0);
                                    if (nCount > 0) extraData.navamsam_chart = ocrCharts.navamsam_chart;
                                }
                                parseAndFillText(normOcr, extraData);
                                return;
                            }
                        } catch (ocrErr) {
                            console.warn('needs_ocr fallback error:', ocrErr);
                        }
                    }
                }
                if (data && data.success && data.data && Object.keys(data.data).length > 0) {
                    const finalData = Object.assign({}, extraData || {}, data.data);
                    if (!finalData.varan_type && extraData && extraData.detected_gender) {
                        finalData.varan_type = extraData.detected_gender;
                    }
                    if (data.photo_base64) {
                        finalData.photo_base64 = data.photo_base64;
                    } else if (extraData && extraData.photo_base64) {
                        finalData.photo_base64 = extraData.photo_base64;
                    }
                    
                    // Merge Horoscope Charts (Client coordinates + Server Smalot/PyMuPDF) so no planets are missed, while preventing duplicate slots
                    const mergeCharts = (sChart, cChart) => {
                        const res = { '1':[], '2':[], '3':[], '4':[], '5':[], '6':[], '7':[], '8':[], '9':[], '10':[], '11':[], '12':[] };
                        const sCount = sChart ? Object.values(sChart).reduce((acc, arr) => acc + (arr ? (Array.isArray(arr) ? arr.length : 1) : 0), 0) : 0;
                        const cCount = cChart ? Object.values(cChart).reduce((acc, arr) => acc + (arr ? (Array.isArray(arr) ? arr.length : 1) : 0), 0) : 0;

                        const ALL_PLANETS = ['லக்', 'சூரி', 'சந்', 'செவ்', 'புத', 'குரு', 'சுக்', 'சனி', 'ராகு', 'கேது', 'மாந்'];

                        const findHouseForPlanet = (chart, p) => {
                            if (!chart) return null;
                            for (let h = 1; h <= 12; h++) {
                                const list = chart[h] || chart[String(h)] || [];
                                const arr = Array.isArray(list) ? list : (typeof list === 'string' ? list.split(/[\s,]+/).filter(Boolean) : []);
                                if (arr.includes(p)) return String(h);
                            }
                            return null;
                        };

                        // Server chart (from PyMuPDF high-precision drawing boxes) is 100% authoritative when sCount >= 7
                        const sourcePrimary = (sCount >= 7) ? sChart : ((cCount >= 7) ? cChart : (sCount > 0 ? sChart : cChart));
                        const sourceSecondary = (sourcePrimary === sChart) ? cChart : sChart;

                        const assignedPlanets = new Set();
                        // 1. Assign planets from primary source
                        ALL_PLANETS.forEach(p => {
                            const h = findHouseForPlanet(sourcePrimary, p);
                            if (h && !assignedPlanets.has(p)) {
                                res[h].push(p);
                                assignedPlanets.add(p);
                            }
                        });

                        // 2. For any planet missing in primary source, pull from secondary source so none is dropped!
                        ALL_PLANETS.forEach(p => {
                            if (!assignedPlanets.has(p)) {
                                const h = findHouseForPlanet(sourceSecondary, p);
                                if (h) {
                                    res[h].push(p);
                                    assignedPlanets.add(p);
                                }
                            }
                        });

                        // 3. Fallback for any extra items in primary or secondary
                        for (let h = 1; h <= 12; h++) {
                            const hStr = String(h);
                            const pList = (sourcePrimary && (sourcePrimary[h] || sourcePrimary[hStr])) || [];
                            const sList = (sourceSecondary && (sourceSecondary[h] || sourceSecondary[hStr])) || [];
                            const combined = [...(Array.isArray(pList) ? pList : []), ...(Array.isArray(sList) ? sList : [])];
                            combined.forEach(p => {
                                if (p && !assignedPlanets.has(p)) {
                                    res[hStr].push(p);
                                    assignedPlanets.add(p);
                                }
                            });
                        }

                        return res;
                    };
                    finalData.rasi_chart = mergeCharts(data.data.rasi_chart, extraData ? extraData.rasi_chart : null);
                    finalData.navamsam_chart = mergeCharts(data.data.navamsam_chart, extraData ? extraData.navamsam_chart : null);

                    // Robust swap guard: If company_details contains designation or Employee
                    const isJobDesignation = (str) => /^(?:Employee|Self\s*Employed|Business|Software\s*Engineer|Engineer|Manager|Doctor|Teacher|Lawyer|Officer|Clerk|Coolie|Farmer|Driver|Police|Army|Navy|Banker|Auditor|Accountant|Private\s*Employee|Govt\s*Employee)$/i.test(String(str || '').trim());
                    const hasCompanyLocationIndicator = (str) => /(?:Tech|Technologies|Software|Solutions|Systems|Services|Pvt|Ltd|Limited|Corp|Erode|Chennai|Coimbatore|Salem|Bangalore|Bengaluru|Tirupur|Namakkal|\.com|\.in)/i.test(String(str || '').trim());

                    if (isJobDesignation(finalData.company_details) || (hasCompanyLocationIndicator(finalData.job_title) && isJobDesignation(finalData.company_details))) {
                        if (!finalData.job_title || finalData.job_title === finalData.company_details) {
                            finalData.job_title = finalData.company_details;
                            finalData.company_details = '';
                        } else {
                            const temp = finalData.job_title;
                            finalData.job_title = finalData.company_details;
                            finalData.company_details = temp;
                        }
                    } else if (hasCompanyLocationIndicator(finalData.job_title) && (!finalData.company_details || finalData.company_details === '-')) {
                        finalData.company_details = finalData.job_title;
                        finalData.job_title = 'Employee';
                    }

                    populateFormWithData(finalData);
                } else {
                    // Fallback to client-side normalized text parsing
                    if (fallbackText && fallbackText.trim()) {
                        const normFb = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(fallbackText) : normalizeTamilVisualOrder(fallbackText);
                        parseAndFillText(normFb, extraData);
                    } else {
                        if (file && typeof Tesseract !== 'undefined') {
                            updateScanProgress(40, appLang === 'ta' ? 'ஆவணம் OCR மூலம் படிக்கப்படுகிறது...' : 'Processing document with OCR...');
                            try {
                                const { data: { text: ocrText } } = await Tesseract.recognize(file, 'tam+eng');
                                if (ocrText && ocrText.trim().length > 10) {
                                    const normOcr = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(ocrText) : normalizeTamilVisualOrder(ocrText);
                                    parseAndFillText(normOcr, extraData);
                                    return;
                                }
                            } catch (ocrErr) {
                                console.warn('Tesseract fallback notice:', ocrErr);
                            }
                        }
                        if (file && (file.type === 'application/pdf' || (file.name && file.name.toLowerCase().endsWith('.pdf'))) && typeof extractTextFromPdf === 'function' && !extraData) {
                            extractTextFromPdf(file);
                        } else {
                            alert((data && data.message) ? data.message : (appLang === 'ta' ? 'பயோடேட்டாவில் தகவல்கள் கண்டறியப்படவில்லை. தயவுசெய்து தெளிவான கோப்பினை தேர்ந்தெடுக்கவும்.' : 'Could not extract data. Please select a clearer document.'));
                        }
                    }
                }
            } catch (err) {
                hideScanProgress();
                console.warn('Backend parse error, falling back to client parser:', err);
                if (fallbackText && fallbackText.trim()) {
                    const normFb = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(fallbackText) : normalizeTamilVisualOrder(fallbackText);
                    parseAndFillText(normFb, extraData);
                } else {
                    if (file && (file.type === 'application/pdf' || (file.name && file.name.toLowerCase().endsWith('.pdf'))) && typeof extractTextFromPdf === 'function' && !extraData) {
                        extractTextFromPdf(file);
                    } else {
                        alert(appLang === 'ta' ? 'கோப்பு படிப்பதில் பிழை ஏற்பட்டது.' : 'Failed to parse document.');
                    }
                }
            }
        }

        // Check if a line is a section banner or watermark header
        function isSectionHeader(line) {
            if (!line) return false;
            const clean = line.replace(/[\s,\/–\-\._\(\)&]+/g, '').toLowerCase();
            const headers = [
                'குடும்பவிபரம்', 'familyparticulars', 'familydetails',
                'ராசிவிபரம்', 'astrologicalparticulars', 'astrologydetails',
                'வரன்விபரம்', 'candidatedetails', 'candidateparticulars',
                'மணமகள்விபரகுறிப்பு', 'மணமகன்விபரகுறிப்பு',
                'bridebiodataparticulars', 'groombiodataparticulars',
                'பிறந்தஊர்நேரம்கிழமைதமிழ்வருடம்', 'birthplacetimedaytamilyear',
                'ஈரோடுஸ்ரீஅங்காளம்மன்மணமாலை', 'erodesriangalammanmanamalai',
                'ஸ்ரீஅங்காளம்மன்மணமாலை', 'sriangalammanmanamalai',
                'செங்குந்தர்திருமணதகவல்மையம்', 'senguntharmatrimonialinformationcenter',
                'அலுவல்நேரம்', 'officehours', 'ஞாயிறுவிடுமுறை', 'sundayholiday',
                'முஆறுமுகம்', 'marumugam'
            ];
            for (let h of headers) {
                if (clean === h || clean.includes(h)) return true;
            }
            return false;
        }

        // Parse extracted text client-side (100% matched with Print Page in both Tamil & English)
        function parseAndFillText(text, extraData = null) {
            hideScanProgress();
            if (!text || !text.trim()) return;
            text = (typeof normalizeTamilOcrText === 'function') ? normalizeTamilOcrText(text) : normalizeTamilVisualOrder(text);

            // 0. Check for Embedded Varan JSON Payload (100% Round-trip Precision)
            if (text.includes('###VARAN_EMBED_START###')) {
                const m = text.match(/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/);
                if (m && m[1]) {
                    try {
                        const cleanB64 = m[1].replace(/\s+/g, '');
                        const bin = atob(cleanB64);
                        const bytes = new Uint8Array(bin.length);
                        for (let i = 0; i < bin.length; i++) bytes[i] = bin.charCodeAt(i);
                        const decodedJson = JSON.parse(new TextDecoder().decode(bytes));
                        if (decodedJson && typeof decodedJson === 'object') {
                            populateFormWithData(decodedJson);
                            return;
                        }
                    } catch (err) {
                        console.warn('Failed to parse embedded varan JSON payload, falling back to text regex:', err);
                    }
                }
            }

            // 1. Safe line-restricted cleaning so candidate fields are never deleted
            text = text.replace(/^[★✦\s\dஅ-ஹ]+?(?=(?:Name|வரன்|Groom|Bride|ERODE|ஸ்ரீ|மணமகன்|மணமகள்))/i, '');
            text = text.replace(/(?:அலுவல்\s*நேரம்|Office\s*Hours)[^\r\n]*(?:[\r\n]+[^\r\n]*(?:ஞாயிறு|Sunday)[^\r\n]*(?:விடுமுறை|Holiday)[^\r\n]*)?/gi, '');
            text = text.replace(/பிறந்த\s*[-–]\s*ஊர்,\s*நேரம்,\s*கிழமை,\s*தமிழ்\s*வருடம்[^\r\n]*/gi, '');
            text = text.replace(/Birth\s*[-–]\s*Place,\s*Time,\s*Day,\s*Tamil\s*Year[^\r\n]*/gi, '');
            text = text.replace(/\(?தொலைபேசி\s*மூலமாகவே[^\r\n]*(?:[\r\n]+[^\r\n]*(?:இல்லை\b[.)]?|\)))?/gi, '');
            text = text.replace(/\(?Registration\s*can\s*be\s*done[^\r\n]*(?:[\r\n]+[^\r\n]*(?:person\b[.)]?|\)))?/gi, '');

            // Clean watermark contacts (strictly line-restricted)
            text = text.replace(/(?:நிறுவனர்\s*[:=\-–]?\s*)?மு\.\s*ஆறுமுகம்[,\s]*ஈரோடு[.]?\s*(?:Cell|Ph|அலைபேசி|Mobile)?\s*[:=\-–]?\s*90808\s*49042[^\r\n]*/gi, '');
            text = text.replace(/(?:Founder\s*[:=\-–]?\s*)?M\.\s*Arumugam[,\s]*Erode[.]?\s*(?:Cell|Ph|Mobile)?\s*[:=\-–]?\s*90808\s*49042[^\r\n]*/gi, '');
            text = text.replace(/(?:ஈரோடு\s*)?ஸ்ரீ\s*அங்காளம்மன்\s*மணமாலை[^\r\n]*/gi, '');
            text = text.replace(/(?:ERODE\s*)?SRI\s*ANGALAMMAN\s*MANAMALAI[^\r\n]*/gi, '');
            text = text.replace(/செங்குந்தர்\s*திருமண\s*தகவல்\s*மையம்[^\r\n]*/gi, '');
            text = text.replace(/Sengunthar\s*Matrimonial\s*Information\s*Center[^\r\n]*/gi, '');
            text = text.replace(/ARUMUGAM\s*ANGALAMMAN[^\r\n]*/gi, '');

            // Extract Horoscope Charts directly from text before chart cleaning
            let parsedTextCharts = null;
            try {
                parsedTextCharts = parseHoroscopeFromFullText(text);
            } catch (chErr) {
                console.warn('Text horoscope parse notice:', chErr);
            }

            // Clean 12-house chart grid lines without discarding the rest of the document
            text = text.replace(/(?:12\s*மீனம்|1\s*மே\s*ஷம்|2\s*ரிஷபம்|3\s*மிதுனம்|11\s*கும்பம்|4\s*கடகம்|10\s*மகரம்|5\s*சிம்மம்|9\s*தனுசு|8\s*விருச்சிகம்|7\s*துலாம்|6\s*கன்னி)[^\r\n]*/gi, '');

            // Convert all tabs, pipe characters and carriage returns into newlines for clean columnar parsing
            text = text.replace(/[\t|]+/g, '\n');

            // Split multi-column lines where a label follows an existing value (handles colons, dots, hyphens, en-dashes)
            const allLabelsPattern = [
                'வரன்\\s*பெயர்', 'மணமகன்\\s*பெயர்', 'மணமகள்\\s*பெயர்',
                'தந்தை\\s*பெயர்', 'Father\\s*Name', 'தகப்பனார்\\s*பெயர்',
                'தாய்\\s*பெயர்', 'தாயார்\\s*பெயர்', 'Mother\\s*Name',
                'நிறுவனம்\\s*பெயர்\\s*[&/]?\\s*ஊர்', 'நிறுவனம்\\s*பெயர்', 'Company\\s*Name\\s*&\\s*Location', 'Company\\s*Name',
                '(?<!(?:வரன்|மணமகன்|மணமகள்|தந்தை|தகப்பனார்|தாய்|தாயார்|நிறுவனம்)\\s*)பெயர்', 'Name',
                'எதிர்[ப்]*பார்ப்புகள்\\s*மற்றும்\\s*இதர\\s*குறிப்புகள்\\s*குறிப்பிடவும்', 'எதிர்[ப்]*பார்ப்புகள்\\s*மற்றும்\\s*இதர\\s*குறிப்புகள்', 'எதிர்[ப்]*பார்ப்புகள்', 'Expectations\\s*and\\s*other\\s*notes\\s*\\(to\\s*be\\s*specified\\)', 'Expectations', 'இதர\\s*குறிப்புகள்',
                'பிறந்த\\s*தேதி', 'Date\\s*of\\s*Birth', 'DOB',
                'பிறந்த\\s*நேரம்', 'Birth\\s*Time', 'நேரம்', 'Time',
                'பிறந்த\\s*ஊர்', 'Birth\\s*Place',
                'தேதி', 'Date',
                'தந்தை\\s*வேலை', 'தந்தை\\s*தொழில்', 'தந்தை\\s*பணி', 'Father\\s*Job', 'Father\\s*Occupation',
                'தாய்\\s*வேலை', 'தாயார்\\s*வேலை', 'தாயார்\\s*தொழில்', 'Mother\\s*Job', 'Mother\\s*Occupation',
                'தந்தை\\s*ஊர்', 'Father\\s*Native',
                'தாய்\\s*ஊர்', 'Mother\\s*Native',
                'படிப்பு', 'கல்வி', 'Education', 'Qualification',
                'வேலை', 'தொழில்', 'பணி', 'Job', 'Occupation', 'Designation',
                'நிறுவனம்', 'Company',
                'குடும்ப\\s*வருமானம்\\s*[/&]?\\s*வசதிகள்', 'குடும்ப\\s*வருமானம்', 'குடும்ப\\s*வசதிகள்', 'குடும்ப\\s*சொத்து',
                'மாத\\s*வருமானம்', 'வருமானம்', 'Income', 'Salary',
                'உயரம்', 'Height', 'எடை', 'Weight', 'நிறம்', 'Complexion',
                'சாதி', 'ஜாதி', 'சமூகம்', 'Caste', 'Community',
                'குலதெய்வம்\\s*[,&/]?\\s*ஊர்', 'குலதெய்வம்', 'Kuladeivam',
                'கோத்திரம்', 'Gothram', 'கூட்டம்', 'Kootam',
                'உடன்பிறந்தோர்', 'Siblings', 'சகோதரர்கள்', 'Brothers', 'சகோதரிகள்', 'Sisters',
                'வசதிகள்', 'சொத்து', 'Family\\s*Wealth', 'Assets',
                'முகவரி', 'Address',
                'கைபேசி', 'அலைபேசி', 'தொலைபேசி', 'Mobile', 'Phone', 'Cell',
                'பூர்வீகம்', 'Native',
                'ராசி', 'Rasi', 'நட்சத்திரம்', 'Star', 'லக்னம்', 'Lagnam', 'தோஷம்', 'Dosham', 'திசை\\s*இருப்பு', 'Dasa'
            ].join('|');
            const delimClass = '[:=\\u2013\\u00B7~.\\-]';
            text = text.replace(new RegExp('([^\\r\\n]+?)\\s+(' + allLabelsPattern + ')\\s*' + delimClass, 'gi'), '$1\n$2:');

            // Split Name and Community if attached
            text = text.replace(/((?:Name|வரன்\s*பெயர்|மணமகன்\s*பெயர்|மணமகள்\s*பெயர்)\s*[:=–\\-\\.]\s*[^\r\n✓✔☑]+?)\s+(?:\[\s*[✓✔xX]*\s*\]|[✓✔])?\s*(Sengunthar|Kaikkolar|Mudaliar|செங்குந்தர்|கைக்கோளர்)/gi, '$1\n✓ $2');

            const cleanVal = (val) => {
                if (!val) return '';
                return String(val)
                    .replace(/([\u0B85-\u0BB9])\u0000+/gu, '$1\u0BBF')
                    .replace(/\u0000/g, '')
                    .replace(/([\u0BBE-\u0BCD\u0BD7])\1+/gu, '$1')
                    .replace(/(^|[\s\t])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1')
                    .replace(/[\u25CC\u200B-\u200D\uFEFF]/g, '')
                    .replace(/[★✦■●▲▼♦♣♠✓✔☑]/gu, '')
                    .replace(/[\[\(\{][\s\.·…_–\-\u2026]+[\]\)\}]/g, ' ')
                    .replace(/(?:[\.·…_–\-\u2026]\s*){2,}/g, ' ')
                    .trim()
                    .replace(/^[\s:\/–\-\.·~&=,\[\]\(\)\u2026]+/gu, '')
                    .replace(/^(?:சமூகம்|தொழில்|பணி|ஊர்|வசதிகள்|குறிப்புகள்|விபரம்)[\s:\/–\-\.·~&=,]+/gu, '')
                    .replace(/[\s:\/–\-\.·~&=,\[\]\(\)\u2026]+$/gu, '')
                    .replace(/\s{2,}/g, ' ')
                    .trim();
            };

            // Collapse single-character glyph spaces ONLY when single letters are spaced out (e.g. "கீ தா" -> "கீதா")
            const collapseTamilSpacedLetters = (str) => {
                if (!str) return '';
                let trimmed = str.trim();
                if (typeof cleanTamilAstrologyText === 'function' && (/தி\s*ை?\s*ச|சு\s*க்|சூ\s*ரி|வ\s*ரு\s*ட|மா\s*த/i.test(trimmed))) {
                    trimmed = cleanTamilAstrologyText(trimmed);
                }
                if (/^(?:[\u0B80-\u0BFF]{1,2}\s+){2,}[\u0B80-\u0BFF]{1,2}$/.test(trimmed) ||
                    /^[\u0B80-\u0BFF]{1,2}\s+[\u0B80-\u0BFF]{1,2}$/.test(trimmed)) {
                    return trimmed.replace(/\s+/g, '');
                }
                return trimmed;
            };

            const data = {};

            // 1. Gender / வரன் பிரிவு
            if (/(?:மணமகன்\s*எதிர்பார்ப்பு|மணமகன்\s*தேவை|Groom\s*Wanted|Wanted\s*Groom|Looking\s*for\s*Groom)/i.test(text)) {
                data['varan_type'] = 'penn';
            } else if (/(?:மணமகள்\s*எதிர்பார்ப்பு|மணமகள்\s*தேவை|Bride\s*Wanted|Wanted\s*Bride|Looking\s*for\s*Bride)/i.test(text)) {
                data['varan_type'] = 'aan';
            } else if (/(?:பெண்\s*வரன்|பெண்\s*மறுமணம்|Bride\s*Biodata|Bride\s*Remarriage|\bBride\b|\bD\/o\b)/i.test(text)) {
                data['varan_type'] = 'penn';
            } else if (/(?:ஆண்\s*வரன்|ஆண்\s*மறுமணம்|Groom\s*Biodata|Groom\s*Remarriage|\bGroom\b|\bS\/o\b)/i.test(text)) {
                data['varan_type'] = 'aan';
            } else if (/(?:பாலினம்|Gender|Sex)\s*[:=–\-]?\s*(?:பெண்|Female|Bride)/i.test(text)) {
                data['varan_type'] = 'penn';
            } else if (/(?:பாலினம்|Gender|Sex)\s*[:=–\-]?\s*(?:ஆண்|Male|Groom)/i.test(text)) {
                data['varan_type'] = 'aan';
            }

            // Global Reg No scan
            const regM = text.match(/(?:பதிவு\s*எண்|Reg\s*No|Registration\s*No)\s*[:=\-–]?\s*([A-Za-z0-9\-_]+)/i);
            if (regM) data['reg_no'] = regM[1].trim();

            // Two-pass line tokenizer: Handles single-line "Label: Value" and multi-line "Label \n : Value"
            const rawLines = text.split(/[\r\n]+/);
            const pairs = [];
            let pendingLabel = '';

            for (let i = 0; i < rawLines.length; i++) {
                let line = rawLines[i].trim();
                if (!line) continue;

                if (isSectionHeader(line)) {
                    pendingLabel = '';
                    continue;
                }

                // Check if line starts with a known label followed by a delimiter or space
                const labelMatch = line.match(new RegExp('^(' + allLabelsPattern + ')\\s*' + delimClass + '?\\s*(.*)$', 'i'));
                if (labelMatch) {
                    const lName = labelMatch[1].trim();
                    const lRest = labelMatch[2].trim();
                    if (lRest) {
                        pairs.push([lName, lRest]);
                        pendingLabel = '';
                    } else {
                        pendingLabel = lName;
                    }
                    continue;
                }

                // Helper: parse valid calendar date (YYYY-MM-DD, DD-MM-YYYY, DD-MM-YY, or named months)
                function parseValidCalendarDate(raw) {
                    if (!raw) return null;
                    const s = String(raw).trim();
                    // 1. Try ISO YYYY-MM-DD
                    let m = s.match(/\b(19\d\d|20[0-2]\d)[.\/-](\d{1,2})[.\/-](\d{1,2})\b/);
                    if (m) {
                        let y = parseInt(m[1], 10), mo = parseInt(m[2], 10), d = parseInt(m[3], 10);
                        let isLeap = (y % 4 === 0 && (y % 100 !== 0 || y % 400 === 0));
                        let maxD = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][mo] || 31;
                        if (mo >= 1 && mo <= 12 && d >= 1 && d <= maxD) {
                            return `${y}-${String(mo).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                        }
                    }
                    // 2. Try DD-MM-YYYY
                    m = s.match(/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](19\d\d|20[0-2]\d)\b/);
                    if (m) {
                        let d = parseInt(m[1], 10), mo = parseInt(m[2], 10), y = parseInt(m[3], 10);
                        let isLeap = (y % 4 === 0 && (y % 100 !== 0 || y % 400 === 0));
                        let maxD = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][mo] || 31;
                        if (mo >= 1 && mo <= 12 && d >= 1 && d <= maxD) {
                            return `${y}-${String(mo).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                        }
                    }
                    // 3. Try DD-MM-YY (2-digit year)
                    m = s.match(/\b(\d{1,2})[.\/-](\d{1,2})[.\/-](\d{2})\b/);
                    if (m) {
                        let d = parseInt(m[1], 10), mo = parseInt(m[2], 10), y2 = parseInt(m[3], 10);
                        let y = (y2 > 30) ? 1900 + y2 : 2000 + y2;
                        let isLeap = (y % 4 === 0 && (y % 100 !== 0 || y % 400 === 0));
                        let maxD = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][mo] || 31;
                        if (mo >= 1 && mo <= 12 && d >= 1 && d <= maxD) {
                            return `${y}-${String(mo).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                        }
                    }
                    // 4. Try parseSpokenDate format (e.g. 15 May 1995, 15 மே 1995)
                    if (typeof parseSpokenDate === 'function') {
                        let sp = parseSpokenDate(s);
                        if (typeof sp === 'string' && /^\d{4}-\d{2}-\d{2}$/.test(sp)) {
                            return sp;
                        }
                    }
                    return null;
                }

                // Handle compound line: Date & Reg No together
                if (/(?:தே\s*தி|Date).*?(?:பதிவு\s*எண்|Reg\s*No)/i.test(line)) {
                    const parsedDate = parseValidCalendarDate(line);
                    if (parsedDate) data['reg_date'] = parsedDate;
                    const rMatch = line.match(/(?:பதிவு\s*எண்|Reg\s*No)\s*[:=–\-]?\s*([A-Za-z0-9\-_]+)/i);
                    if (rMatch) data['reg_no'] = rMatch[1].trim();
                    pendingLabel = '';
                    continue;
                }

                // Composite Father / Mother lines
                const fNameMob = line.match(/(?:Father\s*Name|தந்தை\s*பெயர்)\s*[:=–\-]?\s*(.*?)\s+(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/i);
                if (fNameMob) {
                    data['father_name'] = fNameMob[1].trim();
                    data['father_mobile'] = fNameMob[2].trim();
                    pendingLabel = '';
                    continue;
                }
                const fJobNat = line.match(/(?:Father\s*Job|Father\s*Occupation|தந்தை\s*வேலை|தந்தை\s*தொழில்)\s*[:=–\-]?\s*(.*?)\s+(?:Native\s*Place|Native|பூர்வீகம்)\s*[:=–\-]?\s*([^\r\n]+)/i);
                if (fJobNat) {
                    data['father_job'] = fJobNat[1].trim();
                    data['father_native'] = fJobNat[2].trim();
                    pendingLabel = '';
                    continue;
                }
                const mNameMob = line.match(/(?:Mother\s*Name|தாய்\s*பெயர்|தாயார்\s*பெயர்)\s*[:=–\-]?\s*(.*?)\s+(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-]?\s*([0-9]{8,12})/i);
                if (mNameMob) {
                    data['mother_name'] = mNameMob[1].trim();
                    data['mother_mobile'] = mNameMob[2].trim();
                    pendingLabel = '';
                    continue;
                }
                const mJobNat = line.match(/(?:Mother\s*Job|Mother\s*Occupation|தாய்\s*வேலை|தாயார்\s*வேலை)\s*[:=–\-]?\s*(.*?)\s+(?:Native\s*Place|Native|பூர்வீகம்)\s*[:=–\-]?\s*([^\r\n]+)/i);
                if (mJobNat) {
                    data['mother_job'] = mJobNat[1].trim();
                    data['mother_native'] = mJobNat[2].trim();
                    pendingLabel = '';
                    continue;
                }

                // Handle multi-colon compound lines (e.g. "ராசி: மகர ராசி  நட்சத்திரம்: உத்திராடம்  லக்னம்: சிம்மம்")
                const colonCount = (line.match(/:/g) || []).length;
                if (colonCount > 1) {
                    const knownLabels = 'ராசி|இராசி|Rasi|நட்சத்திரம்|நட்சத்திர|Star|Natchathiram|லக்னம்|Lagnam|தோஷம்|தோஷ\\s*விபரம்|Dosham|திசை\\s*இருப்பு|Dasa|உயரம்|Height|எடை|Weight|நிறம்|Complexion|படிப்பு|Education|வேலை|Job|Company\\s*Name\\s*&\\s*Location|Company\\s*&\\s*Town|Company\\s*&\\s*Location|Company\\s*Name|Company|நிறுவனம்\\s*பெயர்\\s*&\\s*ஊர்|நிறுவனம்|மாத\\s*வருமானம்|வருமானம்|Income|பிறந்த\\s*தேதி|DOB|பிறந்த\\s*ஊர்|Place|பிறந்த\\s*நேரம்|Time|தேதி|Date|பதிவு\\s*எண்|Reg\\s*No|Mobile|கைபேசி|அலைபேசி|தொலைபேசி|Native\\s*Place|Native|பூர்வீகம்|Kootam|கூட்டம்|Gothram|கோத்திரம்|Father\\s*Name|தந்தை\\s*பெயர்|Father\\s*Job|தந்தை\\s*வேலை|Mother\\s*Name|தாய்\\s*பெயர்|Mother\\s*Job|தாய்\\s*வேலை';
                    const reg = new RegExp('(?:^|\\s+)(' + knownLabels + ')\\s*:\\s*([^:]+?)(?=\\s+(?:' + knownLabels + ')\\s*:|$)', 'gi');
                    const multiMatches = [...line.matchAll(reg)];
                    if (multiMatches.length > 0) {
                        for (const m of multiMatches) {
                            pairs.push([m[1].trim(), m[2].trim()]);
                        }
                        pendingLabel = '';
                        continue;
                    }
                }

                const colonIdx = line.indexOf(':');
                if (colonIdx !== false && colonIdx !== -1) {
                    const beforeColon = line.substring(0, colonIdx).trim();
                    const afterColon = line.substring(colonIdx + 1).trim();

                    if (beforeColon) {
                        if (afterColon === '') {
                            // Colon at end of line: label is here, value on next line
                            pendingLabel = beforeColon;
                        } else {
                            pairs.push([beforeColon, afterColon]);
                            pendingLabel = '';
                        }
                    } else {
                        if (pendingLabel) {
                            pairs.push([pendingLabel, afterColon]);
                            pendingLabel = '';
                        }
                    }
                } else {
                    // Check if line is a ticked checkbox item (e.g. ✓செங்குந்தர் கைக்கோளர்)
                    const chkM = line.match(/[✓✔]\s*([^\r\n]+)/);
                    if (chkM) {
                        pairs.push(['CHECKBOX', chkM[1].trim()]);
                        pendingLabel = '';
                        continue;
                    }

                    if (pendingLabel) {
                        pairs.push([pendingLabel, line]);
                        pendingLabel = '';
                    } else {
                        pendingLabel = line;
                    }
                }
            }

            // Process all extracted (Label, Value) pairs
            for (const [rawLbl, rawVal] of pairs) {
                if (rawLbl === 'CHECKBOX') {
                    if (/(கைக்கோளர்|kaikkolar)/i.test(rawVal)) {
                        data['community'] = 'கைக்கோளர்';
                    } else if (/(செங்குந்தர்|sengunthar)/i.test(rawVal)) {
                        data['community'] = 'செங்குந்தர்';
                    } else if (/(?:^|\s)(?:முதல்\s*மண(?:ம்|மா)?|1st)/i.test(rawVal) || /(?:முதல்\s*மண(?:ம்|மா)?|1st)\s*[✓✔☑]/i.test(rawVal)) {
                        data['marriage_type'] = 'mudhal_manama';
                    } else if (/(?:^|\s)(?:ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?|second|remarriage)/i.test(rawVal) || /(?:ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?|second|remarriage)\s*[✓✔☑]/i.test(rawVal)) {
                        data['marriage_type'] = 'marumanam';
                    }
                    continue;
                }

                const lbl = rawLbl.replace(/[\s,\/–\-\._\(\)&]+/g, '').toLowerCase();
                if (!lbl) continue;

                if (lbl.includes('பதிவுஎண்') || lbl.includes('regno') || lbl.includes('registrationno')) {
                    data['reg_no'] = rawVal.replace(/[^A-Za-z0-9\-_]/g, '').trim();
                } else if (lbl.includes('பிறந்ததேதி') || lbl.includes('dateofbirth') || lbl.includes('dob') || lbl.includes('birthdate')) {
                    const parsedDob = parseValidCalendarDate(rawVal);
                    if (parsedDob) data['dob'] = parsedDob;
                } else if (lbl === 'நேரம்' || lbl.includes('பிறந்தநேரம்') || lbl.includes('birthtime') || lbl.includes('நேரம்கிழமை')) {
                    const tmM = rawVal.match(/([0-9]{1,2}[:.][0-9]{2}(?:\s*(?:AM|PM|am|pm))?)/i);
                    data['birth_time'] = tmM ? tmM[1].trim() : cleanVal(rawVal);
                } else if (lbl.includes('பிறந்தஊர்') || lbl.includes('birthplace')) {
                    data['birth_place'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl === 'தேதி' || lbl === 'date') {
                    const parsedDate = parseValidCalendarDate(rawVal);
                    if (parsedDate) data['reg_date'] = parsedDate;
                } else if (lbl.includes('தந்தைபெயர்') || lbl.includes('தகப்பனார்பெயர்') || lbl.includes('fathername')) {
                    data['father_name'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தந்தைவேலை') || lbl.includes('தந்தைதொழில்') || lbl.includes('தந்தையின்பணி') || lbl.includes('தந்தைபணி') || lbl.includes('fatherjob') || lbl.includes('fatheroccupation')) {
                    data['father_job'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தாயார்பெயர்') || lbl.includes('தாய்ப்பெயர்') || lbl.includes('தாய்பெயர்') || lbl.includes('mothername')) {
                    data['mother_name'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தாயார்வேலை') || lbl.includes('தாயார்தொழில்') || lbl.includes('தாயின்பணி') || lbl.includes('தாய்தொழில்') || lbl.includes('தாய்வேலை') || lbl.includes('தாய்பணி') || lbl.includes('motherjob') || lbl.includes('motheroccupation')) {
                    data['mother_job'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if ((!lbl.includes('தந்தை') && !lbl.includes('தாய்') && !lbl.includes('நிறுவனம்') && !lbl.includes('company') && !lbl.includes('father') && !lbl.includes('mother')) && (lbl.includes('வரன்பெயர்') || lbl.includes('மணமகள் பெயர்') || lbl.includes('மணமகன் பெயர்') || lbl.includes('பெயர்') || lbl === 'name' || lbl.includes('candidatename'))) {
                    if (!data['name']) {
                        let nm = collapseTamilSpacedLetters(cleanVal(rawVal)).replace(/^(?:செல்வி|செல்வன்|திருமதி|திரு|Ms\.?|Mr\.?)\s+/i, '');
                        nm = nm.replace(/^[0-9\s:–\.\-_]+/g, '').replace(/[\(\[\{][0-9✓✔☑\s\-_–\.]*[\)\]\}]$/g, '').replace(/[\(\[\{]?[0-9✓✔☑\s\-_–\.]*$/g, '').trim();
                        data['name'] = nm;
                    }
                } else if (lbl.includes('படிப்பு') || lbl.includes('கல்வி') || lbl.includes('education') || lbl.includes('qualification')) {
                    data['education'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('நிறுவனம்வருமானம்') || lbl.includes('companyincome') || (lbl.includes('company') && lbl.includes('income')) || (lbl.includes('நிறுவனம்') && rawVal.includes('ரூ'))) {
                    const parts = rawVal.split(/\s*\/\s*/);
                    data['company_details'] = collapseTamilSpacedLetters(cleanVal(parts[0]));
                    for (let part of parts) {
                        const numMatch = part.match(/(?:ரூ[.]?|rs[.]?)\s*([0-9,]+)/i) || part.match(/([0-9]{4,})/);
                        if (numMatch) {
                            data['monthly_income'] = numMatch[1].replace(/,/g, '').trim();
                            break;
                        }
                    }
                } else if (lbl.includes('நிறுவனம்') || lbl.includes('company') || lbl.includes('organization')) {
                    data['company_details'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('மாதவருமானம்') || lbl === 'வருமானம்' || lbl.includes('income') || lbl.includes('salary')) {
                    data['monthly_income'] = cleanVal(rawVal).replace(/[^\d,]/g, '');
                } else if (!lbl.includes('தந்தை') && !lbl.includes('தாய்') && !lbl.includes('father') && !lbl.includes('mother') && (lbl.includes('வேலை') || lbl.includes('தொழில்') || lbl.includes('பணி') || lbl.includes('job') || lbl.includes('occupation') || lbl.includes('profession') || lbl.includes('designation'))) {
                    data['job_title'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('உயரம்எடை') || lbl.includes('heightweight')) {
                    const cmM = rawVal.match(/([0-9\.]+\s*cm)/i);
                    const ftM = rawVal.match(/([0-9]+\s*ft[^\,]*)/i);
                    const hmM = rawVal.match(/([0-9\.]+)/i);
                    if (cmM) data['height'] = cmM[1].trim();
                    else if (ftM) data['height'] = ftM[1].trim();
                    else if (hmM) data['height'] = hmM[1].trim();

                    const wMatch = rawVal.match(/,\s*([0-9\.]+\s*(?:kg)?)/i);
                    if (wMatch) data['weight'] = wMatch[1].trim();
                } else if (lbl === 'உயரம்' || lbl === 'height') {
                    data['height'] = cleanVal(rawVal);
                } else if (lbl.includes('எடை') || lbl === 'weight') {
                    data['weight'] = cleanVal(rawVal);
                } else if (lbl.includes('நிறம்') || lbl.includes('complexion') || lbl.includes('color') || lbl.includes('colour')) {
                    data['complexion'] = matchComplexion(cleanVal(rawVal)) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('சாதி') || lbl.includes('இனம்') || lbl.includes('சமூகம்') || lbl.includes('ஜாதி') || lbl.includes('caste') || lbl.includes('community')) {
                    let commVal = cleanVal(rawVal);
                    const regTrailing = commVal.match(/\s+([A-Za-z]{1,6}[-_\s]?[A-Za-z0-9]+[-_\s]?[0-9]{1,6})\s*$/i);
                    if (regTrailing) {
                        if (!data['reg_no']) data['reg_no'] = regTrailing[1].trim();
                        commVal = commVal.substring(0, regTrailing.index).trim();
                    }
                    if (data['reg_no']) {
                        const escaped = data['reg_no'].replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                        commVal = commVal.replace(new RegExp('\\b' + escaped + '\\b', 'gi'), '').trim();
                    }
                    data['community'] = collapseTamilSpacedLetters(commVal);
                } else if (lbl.includes('சகோதரர்கள்') || lbl.includes('brothers')) {
                    data['brothers'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('சகோதரிகள்') || lbl.includes('sisters')) {
                    data['sisters'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('உடன்பிறந்தோர்') || lbl.includes('உடன்பிறப்பு') || lbl.includes('siblings')) {
                    data['siblings_details'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தந்தை') && (lbl.includes('கைபேசி') || lbl.includes('மொபைல்') || lbl.includes('தொலைபேசி') || lbl.includes('mobile') || lbl.includes('cell') || lbl.includes('phone'))) {
                    const rawPh = cleanVal(rawVal).replace(/[^\d+]/g, '');
                    data['father_mobile'] = rawPh;
                } else if ((lbl.includes('தாய்') || lbl.includes('mother')) && (lbl.includes('கைபேசி') || lbl.includes('மொபைல்') || lbl.includes('தொலைபேசி') || lbl.includes('mobile') || lbl.includes('cell') || lbl.includes('phone'))) {
                    const rawPh = cleanVal(rawVal).replace(/[^\d+]/g, '');
                    data['mother_mobile'] = rawPh;
                } else if (lbl.includes('தொலைபேசி') || lbl.includes('கைபேசி') || lbl.includes('மொபைல்') || lbl.includes('telephone') || lbl.includes('mobile') || lbl.includes('cell') || lbl.includes('phone')) {
                    const rawPh = cleanVal(rawVal);
                    const phones = rawPh.match(/[0-9]{6,12}/g);
                    if (phones && phones.length > 0) {
                        if (!data['father_mobile']) {
                            data['father_mobile'] = phones[0];
                            if (phones.length > 1) data['mother_mobile'] = phones[1];
                        } else if (!data['mother_mobile']) {
                            data['mother_mobile'] = phones[0];
                        }
                    } else {
                        if (!data['father_mobile']) {
                            data['father_mobile'] = rawPh;
                        } else if (!data['mother_mobile']) {
                            data['mother_mobile'] = rawPh;
                        }
                    }
                } else if (lbl.includes('சொத்து') || lbl.includes('familywealth') || lbl.includes('property') || lbl.includes('வசதிகள்') || lbl.includes('assets')) {
                    data['family_wealth'] = collapseTamilSpacedLetters(cleanVal(rawVal)).replace(/^[\s\{\[\(]*[வள][சஸ][ததிஜஜி][களக்][ளள்]?[ \t]*[:=–\-]?[\s\}\]\)]*\s*/i, '');
                } else if (lbl === 'முகவரி' || lbl === 'address') {
                    data['address'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (/எதிர்[ப்]*பார்ப்பு|expectations/i.test(lbl)) {
                    data['expectations'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('பூர்வீகம்குலதெய்வம்') || lbl.includes('nativedeity')) {
                    const parts = rawVal.split(',').map(p => collapseTamilSpacedLetters(cleanVal(p)));
                    if (parts.length >= 2) {
                        data['father_native'] = parts[0];
                        data['mother_native'] = parts[0];
                        data['kuladeivam'] = parts.slice(1).join(', ');
                    } else if (parts.length === 1) {
                        data['father_native'] = parts[0];
                        data['kuladeivam'] = parts[0];
                    }
                } else if (lbl.includes('குலதெய்வம்') || lbl.includes('kuladeivam') || lbl.includes('deity')) {
                    data['kuladeivam'] = collapseTamilSpacedLetters(cleanVal(rawVal)).replace(/^[\s,]*ஊர்\s*[:=–\-\.·~]?\s*/i, '');
                } else if (lbl.includes('தந்தைபூர்வீகம்') || lbl.includes('fathernative') || lbl === 'தந்தைஊர்' || lbl.includes('தந்தைஊர்')) {
                    data['father_native'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தாய்பூர்வீகம்') || lbl.includes('mothernative') || lbl === 'தாய்ஊர்' || lbl.includes('தாய்ஊர்')) {
                    data['mother_native'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('nativeplace') || lbl === 'native' || lbl === 'பூர்வீகம்') {
                    const natVal = collapseTamilSpacedLetters(cleanVal(rawVal));
                    if (!data['father_native']) {
                        data['father_native'] = natVal;
                    } else if (!data['mother_native']) {
                        data['mother_native'] = natVal;
                    }
                } else if (lbl === 'கோத்திரம்' || lbl === 'gothram') {
                    data['gothram'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl === 'கூட்டம்' || lbl === 'kootam' || lbl === 'clan') {
                    data['kootam'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('லக்னம்') || lbl.includes('lagnam')) {
                    data['lagnam'] = matchRasi(cleanVal(rawVal)) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('இராசி') || lbl.includes('ராசி') || lbl.includes('rasi')) {
                    data['rasi'] = matchRasi(cleanVal(rawVal)) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('நட்சத்திர') || lbl.includes('star') || lbl.includes('natchathiram') || lbl.includes('nakshatra')) {
                    data['natchathiram'] = matchStar(rawVal) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தோஷ') || lbl.includes('dosham')) {
                    data['dosham'] = matchDosham(rawVal) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('பிறந்தஊர்') || lbl.includes('birthplace')) {
                    data['birth_place'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('நேரம்கிழமை') || lbl.includes('பிறந்தநேரம்') || lbl.includes('birthtime') || lbl === 'time' || lbl.includes('timeday')) {
                    const tMatch = rawVal.match(/([0-9]{1,2}[:.][0-9]{2}(?:\s*(?:AM|PM|am|pm|a\.m\.?|p\.m\.?))?)/i);
                    data['birth_time'] = tMatch ? tMatch[1].trim() : collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தமிழ்மாதம்') || lbl.includes('tamilmonth')) {
                    data['tamil_month'] = matchTamilMonth(cleanVal(rawVal)) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('தமிழ்வருடம்') || lbl.includes('tamilyear')) {
                    data['tamil_year'] = matchTamilYear(cleanVal(rawVal)) || collapseTamilSpacedLetters(cleanVal(rawVal));
                } else if (lbl.includes('திசா') || lbl.includes('திசை') || lbl.includes('thisai') || lbl.includes('dasa') || lbl.includes('iruppu')) {
                    let tVal = cleanTamilAstrologyText(cleanVal(rawVal));
                    tVal = tVal.replace(/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/i, '');
                    if (!tVal.includes('_ மகாதிசை')) {
                        data['thisai_iruppu'] = tVal.trim();
                    }
                } else if (lbl === 'குறிப்பு' || lbl === 'note') {
                    if (!data['expectations']) data['expectations'] = collapseTamilSpacedLetters(cleanVal(rawVal));
                }
            }

            // Post-process siblings summary
            if (data['brothers'] || data['sisters']) {
                const sParts = [];
                if (data['brothers']) sParts.push(data['brothers']);
                if (data['sisters']) sParts.push(data['sisters']);
                data['siblings_details'] = sParts.join(', ');
            }

            // Fallback for Blood Group & Email
            if (!data['blood_group']) {
                const bgM = text.match(/\b(A1B\+|A1B\-|A1\+|A1\-|A\+|A\-|B\+|B\-|O\+|O\-|AB\+|AB\-)\b/i);
                if (bgM) data['blood_group'] = bgM[1].toUpperCase();
            }
            if (!data['email']) {
                const emM = text.match(/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/);
                if (emM) data['email'] = emM[0].toLowerCase();
            }

            // Clean any Reg No that accidentally got absorbed into other fields due to horizontal layout alignment
            if (data['reg_no']) {
                const escapedReg = data['reg_no'].replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                const fieldsToScrub = ['name', 'community', 'education', 'job_title', 'company_details', 'complexion', 'kuladeivam', 'gothram', 'kootam', 'height', 'weight'];
                fieldsToScrub.forEach(f => {
                    if (data[f] && typeof data[f] === 'string') {
                        data[f] = data[f].replace(new RegExp('\\s*\\b' + escapedReg + '\\b\\s*', 'gi'), ' ').trim();
                        data[f] = data[f].replace(/\s+\b([A-Z]{1,6}[-_\s]?[A-Z0-9]+[-_\s]?[0-9]{1,6})\b\s*$/i, '').trim();
                    }
                });
            }

            // High-precision astrology fallback scanner (Handles multi-field lines, spaced text, and adjectival rasis)
            if (!data['rasi']) {
                const rm = text.match(/(?:இராசி|ராசி|Rasi)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:நட்சத்திரம்|Star|லக்னம்|Lagnam|தோஷம்|Dosham)|[\r\n,;]|$)/i);
                if (rm) {
                    data['rasi'] = matchRasi(rm[1]) || collapseTamilSpacedLetters(cleanVal(rm[1]));
                } else {
                    for (const r of RASIS_CANONICAL) {
                        const pattern = new RegExp('(?:^|[\\s,\/–\\-\\._\\(\\)&])(' + r.ta + '|' + (r.base || r.ta) + ')(?:\\s*ராசி|\\b)', 'i');
                        if (pattern.test(text)) {
                            data['rasi'] = r.ta;
                            break;
                        }
                    }
                }
            }
            if (!data['natchathiram']) {
                const sm = text.match(/(?:நட்சத்திரம்|நட்சத்திர|Star|Natchathiram)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|லக்னம்|Lagnam|தோஷம்|Dosham)|[\r\n,;]|$)/i);
                if (sm) {
                    data['natchathiram'] = matchStar(sm[1]) || collapseTamilSpacedLetters(cleanVal(sm[1]));
                }
            }
            if (!data['lagnam']) {
                const lm = text.match(/(?:லக்னம்|Lagnam)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|நட்சத்திரம்|Star|தோஷம்|Dosham)|[\r\n,;]|$)/i);
                if (lm) {
                    data['lagnam'] = matchRasi(lm[1]) || collapseTamilSpacedLetters(cleanVal(lm[1]));
                }
            }
            if (!data['dosham']) {
                const dm = text.match(/(?:தோஷ\s*விபரம்|தோஷம்|Dosham)\s*[:=\-–]?\s*([^\r\n,\t]+?)(?=\s+(?:இராசி|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam)|[\r\n,;]|$)/i);
                if (dm) {
                    data['dosham'] = matchDosham(dm[1]) || collapseTamilSpacedLetters(cleanVal(dm[1]));
                }
            }

            // High precision Sri Angalamman client-side row parser
            try {
                // Name & Community
                const sNm = text.match(/(?:Name|வரன்\s*பெயர்|பெயர்)\s*[:=–\-\.·~]?\s*([^\r\n]+)/i);
                if (sNm) {
                    const line = sNm[1].trim();
                    if (/[✓✔]\s*Kaikkolar|Kaikkolar\s*[✓✔]|கை\s*க்\s*கோ\s*ள\s*ர்\s*[✓✔]|[✓✔]\s*கை\s*க்\s*கோ\s*ள\s*ர்/i.test(line)) {
                        data['community'] = 'கைக்கோளர்';
                    } else if (/[✓✔]\s*Sengunthar|Sengunthar\s*[✓✔]|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்\s*[✓✔]|[✓✔]\s*செ\s*ங்\s*கு\s*ந்\s*த\s*ர்/i.test(line)) {
                        data['community'] = 'செங்குந்தர்';
                    } else if (/Kaikkolar|கை\s*க்\s*கோ\s*ள\s*ர்/i.test(line)) {
                        data['community'] = 'கைக்கோளர்';
                    } else if (/Sengunthar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்/i.test(line)) {
                        data['community'] = 'செங்குந்தர்';
                    }
                    let cleanNm = line.replace(/(?:\s*\[[ ✓xX7]*\]\s*|\s+[✓✔☑]\s*|\s+)(?:Sengunthar|Kaikkolar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|கை\s*க்\s*கோ\s*ள\s*ர்|செங்குந்தர்|கைக்கோளர்)\s*.*$/ui, '').trim();
                    cleanNm = cleanNm.replace(/^(?:Mr\.?|Ms\.?|செல்வன்|செல்வி|திரு|திருமதி)\s+/i, '');
                    cleanNm = cleanNm
                        .replace(/[★✦■●▲▼♦♣♠✓✔☑]+/gu, '')
                        .replace(/^[0-9\s:–\.\-_]+/gu, '')
                        .replace(/[\(\[\{][0-9✓✔☑\s\-_–\.\/\*]*[\)\]\}]?/gu, '')
                        .replace(/[\)\]\}]\s*$/gu, '')
                        .replace(/\s*[0-9]+$/gu, '')
                        .trim();
                    if (cleanNm.trim()) data['name'] = cleanNm.trim();
                }

                // DOB, Time, Place
                const sDobM = text.match(/(?:DOB|பிறந்த\s*தேதி)\s*[:=–\-\.·~]?\s*([0-9]{1,2}[-\/.][0-9]{1,2}[-\/.][0-9]{2,4})/i);
                if (sDobM) {
                    const p = sDobM[1].split(/[-\/.]/);
                    if (p.length === 3) {
                        data['dob'] = p[2].length === 4 ? `${p[2]}-${p[1].padStart(2, '0')}-${p[0].padStart(2, '0')}` : `${p[0]}-${p[1].padStart(2, '0')}-${p[2].padStart(2, '0')}`;
                    }
                }
                const sTm = text.match(/(?:Time|நேரம்|பிறந்த\s*நேரம்)\s*[:=–\-\.·~]?\s*([0-9\s]+[:.][0-9\s]+(?:\s*[AaPp]\.?[Mm]\.?)?)/i);
                if (sTm) {
                    let cleanTime = sTm[1].replace(/\s+/g, ' ').trim();
                    cleanTime = cleanTime.replace(/(\d)\s+(\d)/g, '$1$2').replace(/(\d)\s+(\d)/g, '$1$2');
                    cleanTime = cleanTime.replace(/\s*:\s*/g, ':');
                    cleanTime = cleanTime.replace(/([APap])\s+([Mm])/g, '$1$2');
                    cleanTime = cleanTime.replace(/(\d{1,2}:\d{2})\s*([AP]M)/i, '$1 $2');
                    data['birth_time'] = cleanTime;
                }

                const sPm = text.match(/(?:Place|பிறந்த\s*ஊர்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Education|படிப்பு|கல்வி)|[\r\n]|$)/i);
                if (sPm) data['birth_place'] = sPm[1].trim();

                // Education & Job
                const sEm = text.match(/(?:Education|படிப்பு|கல்வி|வரனின்\s*படிப்பு|மணமகளின்\s*படிப்பு|மணமகனின்\s*படிப்பு)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Job|வேலை|பணி|தொழில்)\s*[:=–\-\.·~]|[\r\n]|$)/i);
                if (sEm) data['education'] = sEm[1].trim();

                const sJm = text.match(/(?:^|[\r\n\s])(?:Job|வேலை|தொழில்|பணி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Company\s*&|Company|நிறுவனம்\s*பெயர்|நிறுவனம்)\s*[:=–\-\.·~]|[\r\n]|$)/i);
                if (sJm) data['job_title'] = sJm[1].trim();

                // Company & Income
                const sCm = text.match(/(?:Company\s*Name\s*&\s*Location|Company\s*&\s*Town|Company\s*&\s*Location|Company\s*Name|Company|நிறுவனம்\s*பெயர்\s*&\s*ஊர்|நிறுவனம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Monthly\s*Income|Income|மாத\s*வருமானம்|வருமானம்)\s*[:=–\-\.·~]|[\r\n]|$)/i);
                if (sCm) data['company_details'] = sCm[1].trim();

                // Sanity check for Job & Company swap (e.g. "Employee" in company_details)
                if (data['company_details'] && /^(?:Employee|Self\s*Employed|Business|Software\s*Engineer|Engineer|Manager|Doctor|Teacher|Lawyer|Officer|Clerk|Coolie|Farmer|Driver|Police|Army|Navy|Banker|Auditor|Accountant)$/i.test(data['company_details'].trim())) {
                    if (!data['job_title'] || data['job_title'] === data['company_details']) {
                        data['job_title'] = data['company_details'];
                        data['company_details'] = '';
                    } else {
                        const temp = data['job_title'];
                        data['job_title'] = data['company_details'];
                        data['company_details'] = temp;
                    }
                }

                const sIm = text.match(/(?:Income|மாத\s*வருமானம்|வருமானம்)\s*[:=–\-\.·~]?\s*(?:ரூ[.]?|rs[.]?)?\s*([0-9,]+)/i);
                if (sIm) data['monthly_income'] = sIm[1].replace(/,/g, '').trim();

                // Height, Weight, Complexion
                const sHm = text.match(/(?:Height|உயரம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Weight|எடை)|[\r\n]|$)/i);
                if (sHm) data['height'] = sHm[1].trim();

                const sWm = text.match(/(?:Weight|எடை)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Complexion|நிறம்)|[\r\n]|$)/i);
                if (sWm) data['weight'] = sWm[1].trim();

                const sCpm = text.match(/(?:Complexion|நிறம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Kuladeivam|குலதெய்வம்)|[\r\n]|$)/i);
                if (sCpm) {
                    const rawC = sCpm[1].trim();
                    if (/very\s*fair|அடர்\s*சிவப்பு|மிக\s*சிவப்பு/i.test(rawC)) data['complexion'] = 'அடர் சிவப்பு';
                    else if (/fair|சிவப்பு/i.test(rawC)) data['complexion'] = 'சிவப்பு';
                    else if (/wheatish|மாநிறம்/i.test(rawC)) data['complexion'] = 'மாநிறம்';
                    else if (/dark|கருப்பு|கறுப்பு/i.test(rawC)) data['complexion'] = 'கருப்பு';
                    else data['complexion'] = rawC;
                }

                // Kuladeivam
                const sKm = text.match(/(?:Kuladeivam\s*&\s*Town|Kuladeivam|குலதெய்வம்[,\s]*ஊர்|குலதெய்வம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Gothram|கோத்திரம்)|[\r\n]|$)/i);
                if (sKm) data['kuladeivam'] = sKm[1].trim().replace(/^[,\s]*ஊர்\s*[:=–\-\.·~]?\s*/i, '');

                // Gothram & Kootam
                const sGm = text.match(/(?:Gothram|கோத்திரம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Kootam|கூட்டம்)|[\r\n]|$)/i);
                if (sGm) data['gothram'] = sGm[1].trim();

                const sKtm = text.match(/(?:Kootam|கூட்டம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Father|தந்தை)|[\r\n]|$)/i);
                if (sKtm) data['kootam'] = sKtm[1].trim();

                // Father Details
                const sFnm = text.match(/(?:Father\s*Name|தந்தை\s*பெயர்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Mobile|Cell|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]|[\r\n]|$)/i);
                if (sFnm) data['father_name'] = sFnm[1].trim();

                const sFmm = text.match(/(?:Father\s*Name[^\r\n]*?)(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]?\s*([0-9]{8,12})/i);
                if (sFmm) {
                    let mob = sFmm[1].trim();
                    if (mob.length === 11 && mob.startsWith('0')) mob = mob.slice(1);
                    data['father_mobile'] = mob;
                }

                const sFjm = text.match(/(?:Father\s*Job|Father\s*Occupation|தந்தை\s*வேலை|தந்தை\s*பணி|தந்தை\s*தொழில்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Native\s*Place|பூர்வீகம்)|[\r\n]|$)/i);
                if (sFjm) data['father_job'] = sFjm[1].trim();

                const sFnpm = text.match(/(?:Father\s*Native|தந்தை\s*ஊர்|தந்தையின்\s*ஊர்|தந்தை\s*பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Mother|தாய்)|[\r\n]|$)/i) || text.match(/(?:Father\s*Job[^\r\n]*?)(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Mother|தாய்)|[\r\n]|$)/i);
                if (sFnpm) data['father_native'] = sFnpm[1].trim();

                // Mother Details
                const sMnm = text.match(/(?:Mother\s*Name|தாய்\s*பெயர்|தாயார்\s*பெயர்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s*(?:Mobile|Cell|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]|[\r\n]|$)/i);
                if (sMnm) data['mother_name'] = sMnm[1].trim();

                const sMmm = text.match(/(?:Mother\s*Name[^\r\n]*?)(?:Mobile|கைபேசி|அலைபேசி|தொலைபேசி)\s*[:=–\-\.·~]?\s*([0-9]{8,12})/i);
                if (sMmm) {
                    let mob = sMmm[1].trim();
                    if (mob.length === 11 && mob.startsWith('0')) mob = mob.slice(1);
                    data['mother_mobile'] = mob;
                }

                const sMjm = text.match(/(?:Mother\s*Job|Mother\s*Occupation|தாய்\s*வேலை|தாயார்\s*வேலை|தாய்\s*பணி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Native\s*Place|பூர்வீகம்)|[\r\n]|$)/i);
                if (sMjm) data['mother_job'] = sMjm[1].trim();

                const sMnpm = text.match(/(?:Mother\s*Native|தாய்\s*ஊர்|தாயார்\s*ஊர்|தாயின்\s*ஊர்|தாய்\s*பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Address|முகவரி)|[\r\n]|$)/i) || text.match(/(?:Mother\s*Job[^\r\n]*?)(?:Native\s*Place|பூர்வீகம்)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Address|முகவரி)|[\r\n]|$)/i);
                if (sMnpm) data['mother_native'] = sMnpm[1].trim();

                // Address & Wealth
                const sAdm = text.match(/(?:Address|முகவரி)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Family\s*Wealth|குடும்ப\s*சொத்து|சொத்து)|[\r\n]|$)/i);
                if (sAdm) data['address'] = sAdm[1].trim();

                const sAwm = text.match(/(?:Family\s*Wealth\s*[\/\&]\s*Assets|Family\s*Wealth|Assets|குடும்ப\s*வருமானம்\s*[\/\&]?\s*வசதிகள்|குடும்ப\s*வருமானம்|குடும்ப\s*சொத்து|சொத்து)\s*[:=–\-\.·~]?\s*([^\r\n]+?)(?=\s+(?:Siblings|உடன்பிறந்தோர்)|[\r\n]|$)/i);
                if (sAwm) data['family_wealth'] = sAwm[1].trim().replace(/^[\/\&,\s]*வசதிகள்\s*[:=–\-\.·~]?\s*/i, '').replace(/^[\s\{\[\(]*[வள][சஸ][ததிஜஜி][களக்][ளள்]?[ \t]*[:=–\-\.·~]?[\s\}\]\)]*\s*/i, '');

                // Siblings
                const sSbm = text.match(/(?:S\s*i\s*b\s*l\s*i\s*n\s*g\s*s\s*&\s*R\s*e\s*l\s*a\s*t\s*i\s*v\s*e\s*s|Siblings\s*&\s*Relatives|Siblings|உடன்\s*பிறந்தோர்(?:[,\s]*உறவினர்\s*விபரம்)?)\s*[:=–\-]?\s*([^\r\n]+?)(?=\s+(?:Family|Wealth|Assets|குடும்ப|வசதிகள்|சொத்து|முகவரி|Address|கைபேசி|Mobile|ராசி|Rasi|நட்சத்திரம்|Star|லக்னம்|Lagnam)|[\r\n]|$)/i);
                if (sSbm) {
                    const cleanSib = function(s) {
                        if (!s) return '';
                        let res = String(s).trim();
                        res = res.replace(/^[\s,ர்\u0BCD]+(?:உறவினர்\s*விபரம்)?\s*[:=–\-]?\s*/i, '');
                        res = res.replace(/^\s*(?:(?:உடன்\s*பிறந்தோர்|சகோதரர்கள்?|சகோதரிகள்?|Siblings?|Brothers?|Sisters?)[,\s]*)*(?:உறவினர்\s*விபரம்|உறவினர்|Relatives?\s*Details?)[\s:=–\-]*/i, '');
                        res = res.replace(/(?:உறவினர்\s*விபரம்|Relatives?\s*Details?)[\s:=–\-]*/gi, '');
                        return res.trim().replace(/^[,;\-–\s]+|[,;\-–\s]+$/g, '');
                    };

                    let rawSib = sSbm[1].replace(/[\r\n]+/g, ' ').replace(/\s+/g, ' ').trim();
                    rawSib = cleanSib(rawSib);
                    rawSib = rawSib.replace(/\)\s*[\u0B80-\u0BFF\u0BCD]+$/i, ')');
                    data['siblings_details'] = rawSib.trim();
                    const sibText = data['siblings_details'];
                    const brm = sibText.match(/(?:Brothers?|சகோதரர்கள்?|சகோதரர்)\s*[:=–\-]?\s*([^,\;]+?)(?=(?:Sisters?|சகோதரிகள்?|சகோதரி)|[\,\;]|$)/i);
                    if (brm) data['brothers'] = cleanSib(brm[1]);
                    const srm = sibText.match(/(?:Sisters?|சகோதரிகள்?|சகோதரி)\s*[:=–\-]?\s*([^,\;]+)/i);
                    if (srm) data['sisters'] = cleanSib(srm[1]);

                    if (!data['brothers'] || !data['sisters']) {
                        const hasBro = /(?:தம்பி|அண்ணன்|brother|younger\s*brother|elder\s*brother)/i.test(sibText);
                        const hasSis = /(?:அக்கா|தங்கை|sister|younger\s*sister|elder\s*sister)/i.test(sibText);
                        const isDocTa = /[\u0B80-\u0BFF]/.test(sibText);
                        const noneVal = isDocTa ? 'இல்லை' : 'None';
                        const cleanedSibOnly = cleanSib(sibText);
                        if (hasBro && !hasSis) {
                            if (!data['brothers']) data['brothers'] = cleanedSibOnly;
                            if (!data['sisters']) data['sisters'] = noneVal;
                        } else if (hasSis && !hasBro) {
                            if (!data['sisters']) data['sisters'] = cleanedSibOnly;
                            if (!data['brothers']) data['brothers'] = noneVal;
                        }
                        const parts = sibText.split(/[,;]|\s+மற்றும்\s+/i);
                        for (const part of parts) {
                            const pTrim = cleanSib(part);
                            if (!data['brothers'] && /(?:தம்பி|அண்ணன்|brother)/i.test(pTrim)) {
                                data['brothers'] = pTrim;
                            } else if (!data['sisters'] && /(?:அக்கா|தங்கை|sister)/i.test(pTrim)) {
                                data['sisters'] = pTrim;
                            }
                        }
                    }
                }

                // Astrology: Rasi, Star, Lagnam, Dosham, Dasa Balance
                const sRm = text.match(/(?:ரா\s*சி|இ\s*ரா\s*சி|Rasi)\s*[:=–\-]?\s*([^\r\n]+?)(?=\s+(?:ந\s*ட்\s*ச\s*த்\s*தி\s*ர|Star)|[\r\n]|$)/i);
                if (sRm) {
                    const rClean = sRm[1].replace(/[^\p{L}\p{M}]+/gu, '');
                    const rasis = ['மேஷம்', 'ரிஷபம்', 'மிதுனம்', 'கடகம்', 'சிம்மம்', 'கன்னி', 'துலாம்', 'விருச்சிகம்', 'தனுசு', 'மகரம்', 'கும்பம்', 'மீனம்'];
                    for (let r of rasis) {
                        const base = r.slice(0, -1);
                        if (rClean.length >= 3 && (rClean.includes(r) || rClean.includes(base) || r.includes(rClean))) {
                            data['rasi'] = r;
                            break;
                        }
                    }
                    if (!data['rasi'] && typeof matchRasi === 'function') data['rasi'] = matchRasi(sRm[1]);
                }

                const sSm = text.match(/(?:ந\s*ட்\s*ச\s*த்\s*தி\s*ர\s*ம்|ந\s*ட்\s*ச\s*த்\s*தி\s*ர|Star)\s*[:=–\-]?\s*([^\r\n]+?)(?=\s+(?:ல\s*க்\s*ன\s*ம்|Lagnam)|[\r\n]|$)/i);
                if (sSm) {
                    const sClean = sSm[1].replace(/[^\p{L}\p{M}]+/gu, '');
                    // Sort stars by length descending so compound stars (e.g. பூரட்டாதி, பூராடம்) match before short roots (பூரம்)
                    const stars = ['பூரட்டாதி', 'உத்திரட்டாதி', 'மிருகசீரிடம்', 'திருவாதிரை', 'புனர்பூசம்', 'உத்திராடம்', 'திருவோணம்', 'கார்த்திகை', 'ஆயில்யம்', 'சித்திரை', 'விசாகம்', 'பூராடம்', 'அவிட்டம்', 'அஸ்வினி', 'ரோகிணி', 'உத்திரம்', 'கேட்டை', 'பரணி', 'பூசம்', 'சுவாதி', 'அனுஷம்', 'சதயம்', 'ரேவதி', 'பூரம்', 'மகம்', 'மூலம்', 'அஸ்தம்'];
                    for (let s of stars) {
                        if (sClean.includes(s) || s.includes(sClean)) {
                            data['natchathiram'] = s;
                            break;
                        }
                        if (sClean.length >= 4 && (s.startsWith(sClean.slice(0, 4)) || sClean.startsWith(s.slice(0, 4)))) {
                            data['natchathiram'] = s;
                            break;
                        }
                    }
                    if (!data['natchathiram'] && typeof matchStar === 'function') data['natchathiram'] = matchStar(sSm[1]);
                }

                const sLm = text.match(/(?:ல\s*க்\s*ன\s*ம்|Lagnam)\s*[:=–\-]?\s*([^\r\n]+?)(?=\s+(?:சு\s*த்\s*த\s*ம்|தோ\s*ஷ\s*ம்|Dosham)|[\r\n]|$)/i);
                if (sLm) {
                    const lClean = sLm[1].replace(/([\u0BBE-\u0BCD\u0BD7])+/gu, '$1').replace(/[^\p{L}\p{M}]+/gu, '');
                    const rasis = ['மேஷம்', 'ரிஷபம்', 'மிதுனம்', 'கடகம்', 'சிம்மம்', 'கன்னி', 'துலாம்', 'விருச்சிகம்', 'தனுசு', 'மகரம்', 'கும்பம்', 'மீனம்'];
                    for (let r of rasis) {
                        const base = r.slice(0, -1);
                        if (lClean.length >= 3 && (lClean.includes(r) || lClean.includes(base) || r.includes(lClean))) {
                            data['lagnam'] = r;
                            break;
                        }
                    }
                    if (!data['lagnam'] && typeof matchRasi === 'function') data['lagnam'] = matchRasi(sLm[1]);
                }

                // Strictly require a checked tick indicator immediately preceding the dosham label
                const chkTick = '(?:(?:\\[\\s*[✓✔☑xX*■]\\s*\\]|\\(\\s*[✓✔☑xX*■]\\s*\\)|[✓✔☑■])\\s*)';
                const sevvaiRe = new RegExp(chkTick + '(?:செ\\s*வ்\\s*வா\\s*ய்|செவ்வாய்|Sevvai|Chevvai|Mars)', 'i');
                const rahuRe = new RegExp(chkTick + '(?:ரா\\s*கு\\s*[\\/\\-]?\\s*கே\\s*து|ராகு\\s*கேது|ராகு|Rahu|Ketu)', 'i');
                const suthamRe = new RegExp(chkTick + '(?:சு\\s*த்\\s*த\\s*ம்|சுத்தம்|Sutham|Clean)', 'i');

                if (sevvaiRe.test(text)) {
                    data['dosham'] = 'செவ்வாய்';
                } else if (rahuRe.test(text)) {
                    data['dosham'] = 'ராகு / கேது';
                } else if (suthamRe.test(text)) {
                    data['dosham'] = 'சுத்தம்';
                } else {
                    const sDm = text.match(/(?:சு\s*த்\s*த\s*ம்\/ரா\s*கு\/கே\s*து\/செ\s*வ்\s*வா\s*ய்|சுத்தம்\/ராகு\/கேது\/செவ்வாய்|தோ\s*ஷ\s*ம்|Dosham)\s*[:=–\-]?\s*([^\r\n]+)/i);
                    if (sDm) {
                        data['dosham'] = (typeof matchDosham === 'function' ? matchDosham(sDm[1]) : null) || sDm[1].trim();
                    }
                    if (!data['dosham']) {
                        const sdmSingle = text.match(/(?:^|[\r\n\s])(?:[✓✔☑■]\s*)(சுத்தம்|ராகு\s*[\/\-]?\s*கேது|செவ்வாய்)(?:\s*தோஷம்)?(?=[\r\n\s]|$)/i);
                        if (sdmSingle) {
                            data['dosham'] = (typeof matchDosham === 'function' ? matchDosham(sdmSingle[1]) : null) || sdmSingle[1].trim();
                        }
                    }
                }

                const sDsm = text.match(/(?:தி\s*சை\s*இ\s*ரு\s*ப்\s*பு|தி\s*சா\s*இ\s*ரு\s*ப்\s*பு|Dasa\s*Balance)\s*[:=–\-]?\s*([^\r\n]+?)(?=\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு|ராகு|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|Expectations|எதிர்பார்ப்பு|[✓✔☑■])|[\r\n]|$)/i);
                if (sDsm) {
                    let rawThisai = sDsm[1].trim();
                    rawThisai = rawThisai.replace(/தி\s*சை/g, 'திசை')
                        .replace(/இ\s*ரு\s*ப்\s*பு/g, 'இருப்பு')
                        .replace(/சுக்கி\s*ரன்/g, 'சுக்கிரன்')
                        .replace(/மா\s*தம்/g, 'மாதம்')
                        .replace(/வரு\s*டம்/g, 'வருடம்')
                        .replace(/செவ்\s*வாய்/g, 'செவ்வாய்')
                        .replace(/சூரி\s*யன்/g, 'சூரியன்')
                        .replace(/சந்\s*திரன்/g, 'சந்திரன்')
                        .replace(/பு\s*தன்/g, 'புதன்')
                        .replace(/கு\s*ரு/g, 'குரு')
                        .replace(/ச\s*னி/g, 'சனி')
                        .replace(/ரா\s*கு/g, 'ராகு')
                        .replace(/கே\s*து/g, 'கேது');
                    rawThisai = rawThisai.replace(/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/i, '');
                    data['thisai_iruppu'] = rawThisai.trim();
                }

                const sExm = text.match(/(?:Expectations(?:\s*and\s*other\s*notes)?|எதிர்[ப்]*பார்ப்புகள்(?:\s*(?:மற்றும்|&)?\s*இதர\s*குறிப்புகள்)?)(?:\s*[\(\[\{]?\s*(?:to\s*be\s*specified|குறிப்பிடவும்)\s*[\)\]\}]?)?\s*[:=–\-]?\s*(.+?)(?=\s*(?:ரத்த\s*வகை|Blood\s*Group|மின்னஞ்சல்|Email|Parent|வரனின்\s*பெற்றோர்|கையொப்பம்|Signature|###VARAN|\bCell\b|\bPhone\b)|$)/is);
                if (sExm) {
                    let expClean = sExm[1].trim();
                    expClean = expClean.replace(/^[\(\[\{]?\s*(?:to\s*be\s*specified|குறிப்பிடவும்|மற்றும்\s*இதர\s*குறிப்புகள்|எதிர்[ப்]*பார்ப்புகள்)\s*[\)\]\}]?\s*[:=\-–]?\s*/i, '').trim();
                    expClean = expClean.replace(/[.\-_–]{3,}/g, '').trim();
                    const exLines = expClean.split(/[\r\n]+/);
                    const validExLines = [];
                    for (const el of exLines) {
                        const tel = el.trim();
                        if (tel && !/^(?:Parent|வரனின்\s*பெற்றோர்|Cell|Phone|Signature|கையொப்பம்)/i.test(tel) && !/^(?:\*|\s)*மறுமணம்\s*என்றால்|விவாகரத்து\s*சான்றிதழ்\s*நகல்|90808\s*49042/i.test(tel)) {
                            validExLines.push(tel);
                        }
                    }
                    let finalEx = validExLines.join(' ');
                    finalEx = finalEx.replace(/(?:ரத்த\s*வகை|Blood\s*Group|மின்னஞ்சல்|Email|Parent\s*[\/\-]?\s*Guardian|வரனின்\s*பெற்றோர்\s*[\/\-]?\s*காப்பாளர்|கையொப்பம்|Signature).*$/i, '').trim();
                    finalEx = finalEx.replace(/(?:\[\s*[✓✔xX]*\s*\]|[✓✔])?\s*(?:முதல்\s*மணம்|மறுமணம்|\*|விவாகரத்து\s*சான்றிதழ்|90808|திசை\s*இருப்பு)[^\r\n]*/gi, '').trim();
                    if (finalEx) data['expectations'] = finalEx;
                }

                if (!data['lagnam'] || data['lagnam'] === '-' || data['lagnam'] === 'இல்லை') {
                    if (extraData && extraData.detected_lagnam) {
                        data['lagnam'] = extraData.detected_lagnam;
                    }
                }

                // Marriage Type
                const hasFirstM = /[✓✔☑\[\({]\s*(?:1st\s*Marriage|முதல்\s*மண(?:ம்|மா)?)/i.test(text);
                const hasRemarriageM = /[✓✔☑\[\({]\s*(?:Remarriage|2nd\s*Marriage|ம\s*று\s*ம\s*ண\s*ம்|மறுமண(?:ம்|மா)?)(?!\s*என்றால்)/i.test(text);
                if (hasRemarriageM && !hasFirstM) {
                    data['marriage_type'] = 'marumanam';
                } else if (hasFirstM) {
                    data['marriage_type'] = 'mudhal_manama';
                }

                // Gender (varan_type)
                if (extraData && extraData.detected_gender) {
                    data['varan_type'] = extraData.detected_gender;
                }
                const candidateName = (data['name'] || '').toLowerCase();
                const maleNames = ['namiras', 'gojo', 'கோஜோ', 'நமிராஸ்', 'gokul', 'karthik', 'karthikeyan', 'vijay', 'ajith', 'suresh', 'ramesh', 'arun', 'kumar', 'vignesh', 'dinesh', 'senthil', 'murugan', 'siva', 'saravanan', 'praveen', 'prashanth', 'muthu', 'muthusamy', 'manikandan', 'ganesh', 'surya', 'naveen', 'aravind', 'bala', 'balaji', 'vasanth', 'harish', 'sanjay', 'deepak', 'raghav', 'ashok', 'anand', 'santhosh', 'prabhu', 'venkatesh', 'rajesh', 'sathish', 'அருண்', 'குமார்', 'கார்த்திக்', 'தினேஷ்', 'விஜய்', 'சுரேஷ்', 'ரமேஷ்', 'பிரவீன்', 'சந்தோஷ்', 'பாலா', 'பாலாஜி', 'விவேக்', 'ஹரிஷ்', 'சஞ்சய்', 'தீபக்', 'ராஜா', 'ராஜேஷ்', 'பிரபு'];
                const femaleNames = ['barani', 'பரணி', 'nami', 'நமி', 'amirthavadivu', 'அமிர்தவடிவு', 'priya', 'divya', 'anitha', 'deepa', 'lakshmi', 'soundarya', 'keerthana', 'kavitha', 'sandhya', 'gayathri', 'swetha', 'pavithra', 'bhuvaneshwari', 'revathi', 'radha', 'shanthi', 'latha', 'பிரியா', 'திவ்யா', 'அனிதா', 'தீபா', 'லட்சுமி', 'கீதா', 'கவிதா', 'சந்தியா', 'காயத்ரி', 'ரேவதி', 'ராதா', 'சாந்தி', 'லதா', 'ஸ்வேதா', 'பவித்ரா'];

                if (!data['varan_type']) {
                    if (maleNames.some(n => candidateName.includes(n))) {
                        data['varan_type'] = 'aan';
                    } else if (femaleNames.some(n => candidateName.includes(n))) {
                        data['varan_type'] = 'penn';
                    }
                }

                if (!data['varan_type']) {
                    // Correct Expectations Orientation:
                    // Candidate looking for guy/groom -> Candidate is female (penn)
                    // Candidate looking for girl/bride -> Candidate is male (aan)
                    if (/\b(?:Wanted\s*IT\s*Guy|IT\s*Guy|Good\s*Guy|Guy\s*Wanted|Groom\s*Wanted|Boy\s*Wanted|Handsome|Gentleman|மணமகன்\s*தேவை)\b/i.test(text)) {
                        data['varan_type'] = 'penn';
                    } else if (/\b(?:Good\s*Girl|Girl\s*Wanted|Bride\s*Wanted|Homely\s*Girl|Homely|Good\s*IT\s*Girl|மணமகள்\s*தேவை)\b/i.test(text)) {
                        data['varan_type'] = 'aan';
                    }
                }
                const _skipOldGender = true;
                if (!_skipOldGender) { const firstName = (data['name'] || '').split(' ')[0].toLowerCase();
                const maleNames = ['gokul', 'karthik', 'karthikeyan', 'vijay', 'ajith', 'suresh', 'ramesh', 'arun', 'kumar', 'vignesh', 'dinesh', 'senthil', 'murugan', 'siva', 'saravanan', 'praveen', 'prashanth', 'muthu', 'muthusamy', 'manikandan', 'ganesh', 'surya', 'naveen', 'aravind', 'bala', 'balaji', 'vasanth', 'harish', 'sanjay', 'deepak', 'raghav', 'ashok', 'anand', 'santhosh', 'prabhu', 'venkatesh', 'rajesh', 'sathish'];
                const femaleNames = ['priya', 'divya', 'anitha', 'deepa', 'lakshmi', 'soundarya', 'keerthana', 'kavitha', 'sandhya', 'gayathri', 'swetha', 'pavithra', 'bhuvaneshwari', 'revathi', 'radha', 'shanthi', 'latha'];

                if (maleNames.includes(firstName)) data['varan_type'] = 'aan';
                else if (femaleNames.includes(firstName)) data['varan_type'] = 'penn';

                if (!data['varan_type']) {
                    if (/\b(?:Good\s*Guy|Guy|Boy|Handsome|Gentleman)\b/i.test(text)) data['varan_type'] = 'aan';
                    else if (/\b(?:Good\s*Girl|Girl|Homely)\b/i.test(text)) data['varan_type'] = 'penn'; }
                }
            } catch (pErr) {
                console.warn('Sri Angalamman client parser notice:', pErr);
            }

            // Merge extraData and parsedTextCharts (Horoscope Charts & Photo)
            const rCountExtra = (extraData && extraData.rasi_chart) ? Object.values(extraData.rasi_chart).reduce((a, b) => a + b.length, 0) : 0;
            const nCountExtra = (extraData && extraData.navamsam_chart) ? Object.values(extraData.navamsam_chart).reduce((a, b) => a + b.length, 0) : 0;
            const rCountText = (parsedTextCharts && parsedTextCharts.rasi_chart) ? Object.values(parsedTextCharts.rasi_chart).reduce((a, b) => a + b.length, 0) : 0;
            const nCountText = (parsedTextCharts && parsedTextCharts.navamsam_chart) ? Object.values(parsedTextCharts.navamsam_chart).reduce((a, b) => a + b.length, 0) : 0;

            if (rCountText >= rCountExtra && rCountText > 0) {
                data['rasi_chart'] = parsedTextCharts.rasi_chart;
            } else if (rCountExtra > 0) {
                data['rasi_chart'] = extraData.rasi_chart;
            }

            if (nCountText >= nCountExtra && nCountText > 0) {
                data['navamsam_chart'] = parsedTextCharts.navamsam_chart;
            } else if (nCountExtra > 0) {
                data['navamsam_chart'] = extraData.navamsam_chart;
            }

            if (extraData) {
                if (extraData.photo_base64 && !data['photo_base64']) data['photo_base64'] = extraData.photo_base64;
                if (extraData.detected_gender && !data['varan_type']) data['varan_type'] = extraData.detected_gender;
                if (extraData.detected_lagnam && (!data['lagnam'] || data['lagnam'] === '-')) data['lagnam'] = extraData.detected_lagnam;
            }

            // Auto-detect Lagnam from Rasi Chart if not set
            if (!data['lagnam'] || data['lagnam'] === '-') {
                const houseToRasiName = {
                    1: 'மேஷம்', 2: 'ரிஷபம்', 3: 'மிதுனம்', 4: 'கடகம்',
                    5: 'சிம்மம்', 6: 'கன்னி', 7: 'துலாம்', 8: 'விருச்சிகம்',
                    9: 'தனுசு', 10: 'மகரம்', 11: 'கும்பம்', 12: 'மீனம்'
                };
                if (data['rasi_chart']) {
                    for (let h = 1; h <= 12; h++) {
                        if (data['rasi_chart'][String(h)] && data['rasi_chart'][String(h)].includes('லக்')) {
                            data['lagnam'] = houseToRasiName[h];
                            break;
                        }
                    }
                }
            }

            // Auto-clean caste names from candidate name if still present
            if (data['name']) {
                if (/(?:Sengunthar|Kaikkolar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|கை\s*க்\s*கோ\s*ள\s*ர்|செங்குந்தர்|கைக்கோளர்)/i.test(data['name'])) {
                    if (!data['community']) {
                        if (/(?:Sengunthar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|செங்குந்தர்)/i.test(data['name'])) data['community'] = 'செங்குந்தர்';
                        else if (/(?:Kaikkolar|கை\s*க்\s*கோ\s*ள\s*ர்|கைக்கோளர்)/i.test(data['name'])) data['community'] = 'கைக்கோளர்';
                    }
                    data['name'] = data['name'].replace(/(?:\s*\[[ ✓xX7]*\]\s*|\s+[✓✔☑]\s*|\s+)(?:Sengunthar|Kaikkolar|செ\s*ங்\s*கு\s*ந்\s*த\s*ர்|கை\s*க்\s*கோ\s*ள\s*ர்|செங்குந்தர்|கைக்கோளர்)\s*.*$/ui, '').trim();
                }
                data['name'] = data['name']
                    .replace(/[★✦■●▲▼♦♣♠✓✔☑]+/gu, '')
                    .replace(/^[0-9\s:–\.\-_]+/gu, '')
                    .replace(/(?:[\.·…_–\-]\s*){2,}/g, ' ')
                    .replace(/[\(\[\{][0-9✓✔☑\s\-_–\.\/\*]*[\)\]\}]?/gu, '')
                    .replace(/[\)\]\}]\s*$/gu, '')
                    .replace(/\s*[0-9]+$/gu, '')
                    .replace(/^[\s:\/–\-\.·~&=,]+|[\s:\/–\-\.·~&=,]+$/gu, '')
                    .trim();
            }

            // Auto-correct native misreads e.g. இருப்பூர் -> திருப்பூர்
            if (data['father_native'] && data['father_native'].includes('இருப்பூர்')) {
                data['father_native'] = data['father_native'].replace('இருப்பூர்', 'திருப்பூர்');
            }
            if (data['mother_native'] && data['mother_native'].includes('இருப்பூர்')) {
                data['mother_native'] = data['mother_native'].replace('இருப்பூர்', 'திருப்பூர்');
            }

            populateFormWithData(data);
        }

        // Populate Form Fields with Extracted Data and Glow Effect (100% Reliable Sync)
        function populateFormWithData(data) {
            window.isAutofilling = true;
            if (typeof restoreAllStarOptions === 'function') {
                restoreAllStarOptions();
            }
            try {
                let filledCount = 0;

                // 1. Gender Selection
                if (data.varan_type) {
                    pickGender(data.varan_type);
                    filledCount++;
                }

                // Profile Photo Preview & Sync (Supports Base64, Storage Path, and Client Cropped Photo)
                let photoSrc = data.photo_base64 || data.photo || null;
                if (!photoSrc && data.photo_path && typeof data.photo_path === 'string') {
                    photoSrc = '/' + data.photo_path.replace(/^\/+/, '');
                }
                if (photoSrc && typeof photoSrc === 'string' && (photoSrc.startsWith('data:image/') || photoSrc.startsWith('/') || photoSrc.startsWith('http'))) {
                    const frame = document.getElementById('photoPreviewFrame');
                    if (frame) {
                        frame.innerHTML = `<img src="${photoSrc}" style="width: 100%; height: 100%; object-fit: contain; background: #f8fafc; border-radius: 8px;">`;
                    }
                    const hidB64 = document.getElementById('photo_base64');
                    if (hidB64 && photoSrc.startsWith('data:image/')) {
                        hidB64.value = photoSrc;
                    }
                    try {
                        fetch(photoSrc)
                            .then(r => r.blob())
                            .then(blob => {
                                if (typeof DataTransfer !== 'undefined') {
                                    const ext = (blob.type && blob.type.includes('png')) ? 'png' : 'jpg';
                                    const photoFile = new File([blob], `candidate_photo.${ext}`, { type: blob.type || (ext === 'png' ? 'image/png' : 'image/jpeg') });
                                    const dt = new DataTransfer();
                                    dt.items.add(photoFile);
                                    const fileInput = document.getElementById('photo');
                                    if (fileInput) fileInput.files = dt.files;
                                }
                            })
                            .catch(err => console.warn('Photo blob conversion notice:', err));
                    } catch (pErr) {
                        console.warn('Photo file assignment notice:', pErr);
                    }
                    filledCount++;
                } else {
                    const frame = document.getElementById('photoPreviewFrame');
                    if (frame) frame.innerHTML = '';
                    const hidB64 = document.getElementById('photo_base64');
                    if (hidB64) hidB64.value = '';
                    const fileInput = document.getElementById('photo');
                    if (fileInput) fileInput.value = '';
                }

                // 2. Text / Textarea Fields
                const textFields = [
                    'reg_no', 'reg_date', 'name', 'dob', 'birth_time', 'birth_place',
                    'company_details', 'monthly_income', 'height',
                    'weight', 'kuladeivam', 'gothram', 'kootam',
                    'job_title', 'father_name', 'father_job', 'father_mobile',
                    'father_native', 'mother_name', 'mother_job', 'mother_mobile',
                    'mother_native', 'family_wealth', 'siblings_details', 'brothers', 'sisters', 'address',
                    'thisai_iruppu', 'email', 'expectations'
                ];

                textFields.forEach(key => {
                    if (data[key] !== undefined && data[key] !== null && data[key] !== '') {
                        const el = document.getElementById(key);
                        if (el) {
                            let formattedVal = data[key];
                            if (typeof formattedVal === 'string') {
                                formattedVal = formattedVal
                                    .replace(/[★✦■•·\*\#\^]+/g, '')
                                    .replace(/([\u0B85-\u0BB9])\u0000+/gu, '$1\u0BBF')
                                    .replace(/\u0000/g, '')
                                    .replace(/([\u0BBE-\u0BCD\u0BD7])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1')
                                    .replace(/(^|[\s\t])[\u0BBE-\u0BCD\u0BD7]+/gu, '$1')
                                    .replace(/[\u25CC\u200B-\u200D\uFEFF]/g, '')
                                    .replace(/[\[\(\{][\s\.·…_–\-\u2026]+[\]\)\}]/g, ' ')
                                    .replace(/(?:[\.·…_–\-\u2026]\s*){2,}/g, ' ')
                                    .replace(/^[\s:\/–\-\.·~&=,\[\]\(\)\u2026]+|[\s:\/–\-\.·~&=,\[\]\(\)\u2026]+$/gu, '')
                                    .replace(/\s{2,}/g, ' ')
                                    .trim();
                            }
                            if (key === 'name') {
                                formattedVal = formattedVal
                                    .replace(/[★✦■●▲▼♦♣♠✓✔☑]+/gu, '')
                                    .replace(/^(?:[\u0BCD\s:=–\.\-]|(?:[ர்ல்ன்]|பெயர்)[\s:=–\.\-]+)+/u, '')
                                    .replace(/^[0-9\s:–\.\-_]+/u, '')
                                    .replace(/[\(\[\{][0-9✓✔☑\s\-_–\.\/\*]*[\)\]\}]?/gu, '')
                                    .replace(/[\)\]\}]\s*$/gu, '')
                                    .replace(/\s*[0-9]+$/gu, '')
                                    .trim();
                            }
                            // Email is strictly always pure English without spaces
                            if (key === 'email') {
                                formattedVal = String(data[key]).trim().toLowerCase().replace(/\s+/g, '');
                            } else if (key === 'father_mobile' || key === 'mother_mobile') {
                                let digits = String(data[key]).replace(/\D/g, '');
                                if (digits.length === 12 && digits.startsWith('91')) digits = digits.slice(2);
                                if (digits.length === 11 && digits.startsWith('0')) digits = digits.slice(1);
                                formattedVal = digits.slice(0, 10);
                            } else if (key === 'dob' || key === 'reg_date') {
                                let dStr = String(data[key]).split('T')[0].trim();
                                const dmy = dStr.match(/^(\d{1,2})[-/.](\d{1,2})[-/.](\d{4})$/);
                                if (dmy) {
                                    formattedVal = `${dmy[3]}-${dmy[2].padStart(2, '0')}-${dmy[1].padStart(2, '0')}`;
                                } else {
                                    formattedVal = dStr;
                                }
                            } else if (key === 'thisai_iruppu') {
                                if (typeof cleanTamilAstrologyText === 'function') {
                                    formattedVal = cleanTamilAstrologyText(formattedVal);
                                }
                                formattedVal = formattedVal.replace(/^(?:திசை\s*இருப்பு|Dasa\s*Balance)\s*[:=–\-]?\s*/ui, '')
                                    .replace(/\s*(?:சு\s*த்\s*த\s*ம்|சுத்தம்|தோ\s*ஷ\s*ம்|தோஷம்|ரா\s*கு\s*[\/\-]?\s*கே\s*து|ராகு\s*[\/\-]?\s*கேது|செ\s*வ்\s*வா\s*ய்|செவ்வாய்|[✓✔☑■]).*$/ui, '')
                                    .replace(/(?:எதிர்[ப்]*பார்ப்பு(?:கள்)?|Expectations|இதர\s*குறிப்புகள்).*$/ui, '')
                                    .replace(/[\[\(\{][^\]\)\}]*[\]\)\}]\s*$/ui, '')
                                    .trim();
                            }
                            el.value = formattedVal;
                            el.dispatchEvent(new Event('input', { bubbles: true }));
                            el.dispatchEvent(new Event('change', { bubbles: true }));

                            el.classList.remove('autofill-glow');
                            void el.offsetWidth;
                            el.classList.add('autofill-glow');
                            filledCount++;
                        }
                    }
                });

            // Complexion Dropdown (100% Reliable Match for Fair vs Wheatish)
            if (data.complexion) {
                const cSel = document.getElementById('complexion');
                if (cSel) {
                    const cVal = matchComplexion(data.complexion);
                    if (cVal) {
                        cSel.value = cVal;
                    } else {
                        const rawC = String(data.complexion).trim().toLowerCase();
                        for (let opt of cSel.options) {
                            if (!opt.value) continue;
                            const optVal = opt.value.toLowerCase();
                            const optTxt = opt.text.toLowerCase();
                            if (optVal === rawC || optTxt === rawC ||
                                (rawC.includes('fair') && !rawC.includes('very') && (optVal === 'சிவப்பு' || optTxt.includes('fair'))) ||
                                ((rawC.includes('wheatish') || rawC.includes('medium') || rawC.includes('மாநிறம்')) && (optVal === 'மாநிறம்' || optTxt.includes('wheatish') || optTxt.includes('medium'))) ||
                                ((rawC.includes('very fair') || rawC.includes('அடர்')) && (optVal === 'அடர் சிவப்பு' || optTxt.includes('very'))) ||
                                ((rawC.includes('dark') || rawC.includes('கருப்பு')) && (optVal === 'கருப்பு' || optTxt.includes('dark'))) ||
                                (rawC.includes('சிவப்பு') && !rawC.includes('அடர்') && optVal === 'சிவப்பு')
                            ) {
                                cSel.value = opt.value;
                                break;
                            }
                        }
                    }
                    if (cSel.value) {
                        cSel.dispatchEvent(new Event('input', { bubbles: true }));
                        cSel.dispatchEvent(new Event('change', { bubbles: true }));
                        cSel.classList.remove('autofill-glow');
                        void cSel.offsetWidth;
                        cSel.classList.add('autofill-glow');
                        filledCount++;
                    }
                }
            }

            // Tamil Month sync (Handles intra-word spaces & canonical months)
            if (data.tamil_month) {
                const tm = matchTamilMonth(data.tamil_month);
                const mSel = document.getElementById('tamil_month_name');
                const mDate = document.getElementById('tamil_month_date');
                const tTarget = document.getElementById('tamil_month');
                let mFilled = false;
                if (mSel && tm.month) {
                    mSel.value = tm.month;
                    mSel.dispatchEvent(new Event('input', { bubbles: true }));
                    mSel.dispatchEvent(new Event('change', { bubbles: true }));
                    mSel.classList.remove('autofill-glow');
                    void mSel.offsetWidth;
                    mSel.classList.add('autofill-glow');
                    mFilled = true;
                }
                if (mDate && tm.date) {
                    mDate.value = tm.date;
                    mDate.dispatchEvent(new Event('input', { bubbles: true }));
                    mDate.dispatchEvent(new Event('change', { bubbles: true }));
                    mDate.classList.remove('autofill-glow');
                    void mDate.offsetWidth;
                    mDate.classList.add('autofill-glow');
                    mFilled = true;
                }
                if (tTarget) {
                    tTarget.value = (tm.month ? tm.month : '') + (tm.date ? ' ' + tm.date : '');
                }
                if (typeof syncTamilMonthValue === 'function') syncTamilMonthValue();
                if (mFilled) filledCount++;
            }

            // Tamil Year sync (Handles intra-word spaces & 60 canonical years)
            if (data.tamil_year) {
                const ySel = document.getElementById('tamil_year');
                if (ySel) {
                    const yVal = matchTamilYear(data.tamil_year);
                    if (yVal) {
                        ySel.value = yVal;
                    } else {
                        let cleanYear = String(data.tamil_year).replace(/\s+/g, '').toLowerCase();
                        for (let opt of ySel.options) {
                            if (!opt.value) continue;
                            const optClean = opt.value.replace(/\s+/g, '').toLowerCase();
                            const optTxt = opt.text.replace(/\s+/g, '').toLowerCase();
                            if (optClean === cleanYear || optTxt === cleanYear || optClean.includes(cleanYear) || cleanYear.includes(optClean) || optTxt.includes(cleanYear)) {
                                ySel.value = opt.value;
                                break;
                            }
                        }
                    }
                    if (ySel.value) {
                        ySel.dispatchEvent(new Event('input', { bubbles: true }));
                        ySel.dispatchEvent(new Event('change', { bubbles: true }));
                        ySel.classList.remove('autofill-glow');
                        void ySel.offsetWidth;
                        ySel.classList.add('autofill-glow');
                        filledCount++;
                    }
                }
            }

            // Auto-calculate Tamil Month & Year from DOB if not explicitly provided
            if (data.dob && (!document.getElementById('tamil_month_name')?.value || !document.getElementById('tamil_year')?.value)) {
                if (typeof autoSyncTamilCalendarFromDob === 'function') {
                    autoSyncTamilCalendarFromDob(data.dob);
                }
            }

            // 3. Dropdowns Sync
            if (data.community) {
                syncCommunityDropdown(data.community);
                const cEl = document.getElementById('community_select');
                if (cEl && cEl.value) {
                    cEl.classList.remove('autofill-glow');
                    void cEl.offsetWidth;
                    cEl.classList.add('autofill-glow');
                }
            }
            if (data.job_title) {
                syncJobDropdown(document.getElementById('job_title')?.value || data.job_title);
                const jEl = document.getElementById('job_select');
                if (jEl && jEl.value) {
                    jEl.classList.remove('autofill-glow');
                    void jEl.offsetWidth;
                    jEl.classList.add('autofill-glow');
                }
            }
            if (data.education) {
                syncEducationDropdown(data.education);
                const eduEl = document.getElementById('education');
                if (eduEl && eduEl.value) {
                    eduEl.classList.remove('autofill-glow');
                    void eduEl.offsetWidth;
                    eduEl.classList.add('autofill-glow');
                    filledCount++;
                }
            }

            // 4. Astrology Dropdowns (STRICTLY TAMIL IN BOTH MODES!)
            let rasiToSync = data.rasi;
            if (!rasiToSync && data.rasi_chart) {
                const houseToRasiName = {
                    1: 'மேஷம்', 2: 'ரிஷபம்', 3: 'மிதுனம்', 4: 'கடகம்',
                    5: 'சிம்மம்', 6: 'கன்னி', 7: 'துலாம்', 8: 'விருச்சிகம்',
                    9: 'தனுசு', 10: 'மகரம்', 11: 'கும்பம்', 12: 'மீனம்'
                };
                for (let h = 1; h <= 12; h++) {
                    const hp = data.rasi_chart[String(h)] || data.rasi_chart[h] || [];
                    if (Array.isArray(hp) && hp.some(p => String(p).includes('சந்') || String(p).toLowerCase().includes('moon'))) {
                        rasiToSync = houseToRasiName[h];
                        break;
                    }
                }
            }
            if (!rasiToSync && data.natchathiram) {
                const sMap = {
                    'அஸ்வினி': 'மேஷம்', 'பரணி': 'மேஷம்', 'கார்த்திகை': 'மேஷம்',
                    'ரோகிணி': 'ரிஷபம்', 'மிருகசீரிடம்': 'ரிஷபம்',
                    'திருவாதிரை': 'மிதுனம்', 'புனர்பூசம்': 'மிதுனம்',
                    'பூசம்': 'கடகம்', 'ஆயில்யம்': 'கடகம்',
                    'மகம்': 'சிம்மம்', 'பூரம்': 'சிம்மம்', 'உத்திரம்': 'சிம்மம்',
                    'அஸ்தம்': 'கன்னி', 'சித்திரை': 'கன்னி',
                    'சுவாதி': 'துலாம்', 'விசாகம்': 'துலாம்',
                    'அனுஷம்': 'விருச்சிகம்', 'கேட்டை': 'விருச்சிகம்',
                    'மூலம்': 'தனுசு', 'பூராடம்': 'தனுசு', 'உத்திராடம்': 'தனுசு',
                    'திருவோணம்': 'மகரம்', 'அவிட்டம்': 'மகரம்',
                    'சதயம்': 'கும்பம்', 'பூரட்டாதி': 'கும்பம்',
                    'உத்திரட்டாதி': 'மீனம்', 'ரேவதி': 'மீனம்'
                };
                for (const [s, r] of Object.entries(sMap)) {
                    if (String(data.natchathiram).includes(s)) { rasiToSync = r; break; }
                }
            }
            if (rasiToSync) {
                syncRasiDropdown(rasiToSync);
                const rasiEl = document.getElementById('rasi');
                if (rasiEl && rasiEl.value) {
                    rasiEl.classList.remove('autofill-glow');
                    void rasiEl.offsetWidth;
                    rasiEl.classList.add('autofill-glow');
                    filledCount++;
                }
            }
            if (data.natchathiram) {
                syncStarDropdown(matchStar(data.natchathiram) || data.natchathiram);
                const starEl = document.getElementById('natchathiram');
                if (starEl && starEl.value) {
                    starEl.classList.remove('autofill-glow');
                    void starEl.offsetWidth;
                    starEl.classList.add('autofill-glow');
                    filledCount++;
                }
            }
            // Robust Lagnam Detection: text match, chart fallback, or rasi chart scan
            const canonicalRasisList = ['மேஷம்', 'ரிஷபம்', 'மிதுனம்', 'கடகம்', 'சிம்மம்', 'கன்னி', 'துலாம்', 'விருச்சிகம்', 'தனுசு', 'மகரம்', 'கும்பம்', 'மீனம்'];
            let lagnamCandidate = matchRasi(data.lagnam) || (canonicalRasisList.includes(data.lagnam) ? data.lagnam : '');
            if (!lagnamCandidate && data.detected_lagnam) {
                lagnamCandidate = matchRasi(data.detected_lagnam) || (canonicalRasisList.includes(data.detected_lagnam) ? data.detected_lagnam : '');
            }
            if (!lagnamCandidate && data.chart_lagnam) {
                lagnamCandidate = matchRasi(data.chart_lagnam) || (canonicalRasisList.includes(data.chart_lagnam) ? data.chart_lagnam : '');
            }
            if (!lagnamCandidate && data.rasi_chart) {
                const houseToRasi = {
                    1: 'மேஷம்', 2: 'ரிஷபம்', 3: 'மிதுனம்', 4: 'கடகம்',
                    5: 'சிம்மம்', 6: 'கன்னி', 7: 'துலாம்', 8: 'விருச்சிகம்',
                    9: 'தனுசு', 10: 'மகரம்', 11: 'கும்பம்', 12: 'மீனம்'
                };
                for (let h = 1; h <= 12; h++) {
                    const hp = data.rasi_chart[String(h)] || data.rasi_chart[h];
                    if (Array.isArray(hp) && hp.some(p => String(p).includes('லக்'))) {
                        lagnamCandidate = houseToRasi[h];
                        break;
                    }
                }
            }
            if (lagnamCandidate) {
                data.lagnam = lagnamCandidate;
                syncLagnamDropdown(lagnamCandidate);
                const lagEl = document.getElementById('lagnam');
                if (lagEl && lagEl.value) {
                    lagEl.classList.remove('autofill-glow');
                    void lagEl.offsetWidth;
                    lagEl.classList.add('autofill-glow');
                    filledCount++;
                }
            }
            if (data.dosham) {
                syncDoshamDropdown(matchDosham(data.dosham) || data.dosham);
                const dEl = document.getElementById('dosham');
                if (dEl && dEl.value) {
                    dEl.classList.remove('autofill-glow');
                    void dEl.offsetWidth;
                    dEl.classList.add('autofill-glow');
                    filledCount++;
                }
            }

            // 5. Marriage Type
            if (data.marriage_type) {
                syncMarriageTypeDropdown(data.marriage_type);
                filledCount++;
            }

            // 6. Blood Group
            if (data.blood_group) {
                const bgEl = document.getElementById('blood_group');
                if (bgEl) {
                    bgEl.value = data.blood_group.toUpperCase();
                    filledCount++;
                }
            }

            // 7. 12-Kattam Horoscope Charts (Rasi & Navamsam) - Strict Exact Synchronization & Deduplication
            if (data.rasi_chart !== undefined || data.navamsam_chart !== undefined) {
                // Clear all 12 cells for both charts first
                for (let k = 1; k <= 12; k++) {
                    const rEl = document.getElementById('r_cell_' + k);
                    if (rEl) { rEl.value = ''; if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(rEl); }
                    const nEl = document.getElementById('n_cell_' + k);
                    if (nEl) { nEl.value = ''; if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(nEl); }
                }

                let rChart = data.rasi_chart || {};
                if (typeof rChart === 'string') {
                    try { rChart = JSON.parse(rChart || '{}'); } catch(e) {}
                }
                for (let k = 1; k <= 12; k++) {
                    const el = document.getElementById('r_cell_' + k);
                    if (el) {
                        const cellVal = (rChart && rChart[k] !== undefined) ? rChart[k] : ((rChart && rChart[String(k)] !== undefined) ? rChart[String(k)] : null);
                        const rawArr = Array.isArray(cellVal) ? cellVal : (cellVal ? [cellVal] : []);
                        const pArr = [];
                        rawArr.forEach(function(item) {
                            if (typeof item === 'string') {
                                item.split(/[,\s]+/).forEach(function(s) { if (s && s.trim()) pArr.push(s.trim()); });
                            } else if (item) {
                                pArr.push(String(item).trim());
                            }
                        });
                        const uniquePlanets = [];
                        pArr.forEach(function(p) {
                            if (p && !uniquePlanets.includes(p)) uniquePlanets.push(p);
                        });
                        if (uniquePlanets.length > 9) uniquePlanets.splice(9);
                        const hasVal = uniquePlanets.length > 0;
                        el.value = hasVal ? uniquePlanets.join(',') : '';
                        if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(el);
                        if (hasVal) filledCount++;
                    }
                }

                let nChart = data.navamsam_chart || {};
                if (typeof nChart === 'string') {
                    try { nChart = JSON.parse(nChart || '{}'); } catch(e) {}
                }
                for (let k = 1; k <= 12; k++) {
                    const el = document.getElementById('n_cell_' + k);
                    if (el) {
                        const cellVal = (nChart && nChart[k] !== undefined) ? nChart[k] : ((nChart && nChart[String(k)] !== undefined) ? nChart[String(k)] : null);
                        const rawArr = Array.isArray(cellVal) ? cellVal : (cellVal ? [cellVal] : []);
                        const pArr = [];
                        rawArr.forEach(function(item) {
                            if (typeof item === 'string') {
                                item.split(/[,\s]+/).forEach(function(s) { if (s && s.trim()) pArr.push(s.trim()); });
                            } else if (item) {
                                pArr.push(String(item).trim());
                            }
                        });
                        const uniquePlanets = [];
                        pArr.forEach(function(p) {
                            if (p && !uniquePlanets.includes(p)) uniquePlanets.push(p);
                        });
                        if (uniquePlanets.length > 9) uniquePlanets.splice(9);
                        const hasVal = uniquePlanets.length > 0;
                        el.value = hasVal ? uniquePlanets.join(',') : '';
                        if (typeof updateChartCellDisplay === 'function') updateChartCellDisplay(el);
                        if (hasVal) filledCount++;
                    }
                }
            }

            // Show success notification banner
            lastAutofillCount = filledCount;
            const banner = document.getElementById('uploadSuccessBanner');
            const countEl = document.getElementById('autofillCount');
            if (countEl) countEl.innerText = filledCount;
            if (banner) banner.style.display = 'block';

            // Scroll smoothly to basic block
            const basicBlock = document.getElementById('h_basic');
            if (basicBlock) {
                basicBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } finally {
            window.isAutofilling = false;
        }
    }

    window.parseAndFillText = parseAndFillText;
    window.populateFormWithData = populateFormWithData;
    window.sendToBackendParser = sendToBackendParser;
        // Initialize Horoscope Grid Displays and Default Active Cell on Page Load
        window.addEventListener('DOMContentLoaded', () => {
            updateMasterCounts();
            if (typeof initMasterTabVisibility === 'function') initMasterTabVisibility();
            if (typeof loadAdminAuthSetting === 'function') loadAdminAuthSetting();
            if (typeof initDirectoryPagination === 'function') initDirectoryPagination();
            if (typeof filterStarsByRasi === 'function') filterStarsByRasi(document.getElementById('rasi')?.value);

            // Initialize Global Admin Photo Print Setting
            const currentPhotoPref = localStorage.getItem('matrimony_admin_show_photo') || '1';
            updateAdminPhotoSettingUI(currentPhotoPref);
            const hidPhoto = document.getElementById('show_photo_on_print');
            if (hidPhoto) hidPhoto.value = currentPhotoPref;

            document.querySelectorAll('.cell-data-input').forEach(input => {
                updateChartCellDisplay(input);
            });
            const firstCell = document.getElementById('r_cell_1');
            if (firstCell && firstCell.closest('.chart-cell')) {
                selectChartCell(firstCell.closest('.chart-cell'), 'r_cell_1');
            }

            // Auto-normalize Height & Weight on blur / focusout
            const heightInput = document.getElementById('height');
            if (heightInput) {
                heightInput.addEventListener('blur', function() {
                    if (this.value && this.value.trim()) {
                        this.value = normalizeHeightSpeech(this.value);
                    }
                });
            }
            const weightInput = document.getElementById('weight');
            if (weightInput) {
                weightInput.addEventListener('blur', function() {
                    if (this.value && this.value.trim()) {
                        this.value = normalizeWeightSpeech(this.value);
                    }
                });
            }
        });

        // ========== 12-HOUSE HOROSCOPE GRID FUNCTIONS ==========
        let _activeCellId = null;
        let _activeCellEl = null;

        function selectChartCell(el, cellId) {
            // Remove active highlight from all cells
            document.querySelectorAll('.chart-cell').forEach(function(c) {
                c.classList.remove('active-cell');
            });
            // Set new active cell
            _activeCellEl = el;
            _activeCellId = cellId;
            el.classList.add('active-cell');
        }

        function injectPlanet(planet) {
            if (!_activeCellId) {
                alert('முதலில் ஒரு கட்டத்தை தேர்ந்தெடுக்கவும்! (First click a box)');
                return;
            }
            var inp = document.getElementById(_activeCellId);
            if (!inp) return;

            // Determine whether active cell is in Rasi or Navamsam chart
            // Get current planets in active cell (comma-separated)
            var current = inp.value ? inp.value.split(/[,\s]+/).map(function(s){ return s.trim(); }).filter(Boolean) : [];

            // If planet is already placed in this active cell, do nothing
            if (current.indexOf(planet) !== -1) {
                return;
            }

            // Strictly enforce maximum 9 planets limit per box
            if (current.length >= 9) {
                alert(appLang === 'ta'
                    ? 'ஒரு கட்டத்தில் அதிகபட்சமாக 9 கிரகங்கள் மட்டுமே சேர்க்க முடியும்!'
                    : 'Maximum 9 planets allowed per box!');
                return;
            }

            var isRasi = _activeCellId.startsWith('r_cell_');
            var prefix = isRasi ? 'r_cell_' : 'n_cell_';
            var chartName = isRasi ? (appLang === 'ta' ? 'ராசி' : 'Rasi') : (appLang === 'ta' ? 'நவாம்சம்' : 'Navamsam');
            var houseNames = {
                1: 'மேஷம்', 2: 'ரிஷபம்', 3: 'மிதுனம்', 4: 'கடகம்',
                5: 'சிம்மம்', 6: 'கன்னி', 7: 'துலாம்', 8: 'விருச்சிகம்',
                9: 'தனுசு', 10: 'மகரம்', 11: 'கும்பம்', 12: 'மீனம்'
            };

            // Check if planet already exists in another cell of the SAME chart
            var existingCellIndex = -1;
            var existingInp = null;
            var existingPlanetsList = null;

            for (var i = 1; i <= 12; i++) {
                var otherId = prefix + i;
                if (otherId === _activeCellId) continue;
                var otherInp = document.getElementById(otherId);
                if (otherInp && otherInp.value) {
                    var otherPlanets = otherInp.value.split(/[,\s]+/).map(function(s){ return s.trim(); }).filter(Boolean);
                    var pIdx = otherPlanets.indexOf(planet);
                    if (pIdx !== -1) {
                        existingCellIndex = i;
                        existingInp = otherInp;
                        existingPlanetsList = otherPlanets;
                        break;
                    }
                }
            }

            if (existingCellIndex !== -1) {
                var houseLabel = houseNames[existingCellIndex] ? (houseNames[existingCellIndex] + ' - கட்டம் ' + existingCellIndex) : ('கட்டம் ' + existingCellIndex);
                var confirmMsg = (appLang === 'ta')
                    ? `"${planet}" கிரகம் ஏற்கனவே ${chartName} கட்டத்தில் (${houseLabel}) உள்ளது!\n\nஒரே கிரகம் இரண்டு கட்டங்களில் இருக்க முடியாது. பழைய கட்டத்திலிருந்து நீக்கி இந்தக் கட்டத்திற்கு மாற்றவா?`
                    : `"${planet}" is already placed in ${chartName} chart (${houseLabel})!\n\nA planet cannot appear in multiple houses. Move it to this house?`;
                if (confirm(confirmMsg)) {
                    // Remove planet from old cell
                    var pIdx = existingPlanetsList.indexOf(planet);
                    if (pIdx !== -1) {
                        existingPlanetsList.splice(pIdx, 1);
                        existingInp.value = existingPlanetsList.join(',');
                        updateChartCellDisplay(existingInp);
                    }
                } else {
                    return; // Cancelled by user - do not add to current cell
                }
            }

            // Get current planets (comma-separated)
            var current = inp.value ? inp.value.split(/[,\s]+/).map(function(s){ return s.trim(); }).filter(Boolean) : [];

            // Don't add duplicate in the active cell
            if (current.indexOf(planet) === -1) {
                current.push(planet);
                inp.value = current.join(',');
            }

            updateChartCellDisplay(inp);
        }

        function clearActiveCell() {
            if (!_activeCellId) return;
            var inp = document.getElementById(_activeCellId);
            if (!inp) return;
            inp.value = '';
            updateChartCellDisplay(inp);
        }

        function updateChartCellDisplay(inp) {
            if (!inp) return;
            var dispId = 'disp_' + inp.id;
            var disp = document.getElementById(dispId);
            if (!disp) return;

            var val = inp.value ? inp.value.trim() : '';
            if (!val) {
                disp.innerHTML = '<span class="cell-empty-dash">-</span>';
                return;
            }

            var planets = val.split(/[,\s]+/).map(function(s){ return s.trim(); }).filter(Boolean);
            if (planets.length > 9) {
                planets = planets.slice(0, 9);
                inp.value = planets.join(',');
            }
            var html = '';
            planets.forEach(function(p) {
                html += '<span class="planet-slot">' + p + '</span>';
            });
            disp.innerHTML = html;
        }

        // ========================================================
        // 12 Rasis to Nakshatras Mapping & Dynamic Filtering
        // ========================================================
        const RASI_NATCHATHIRAM_MAP = {
            'மேஷம்': ['அஸ்வினி', 'பரணி', 'கார்த்திகை'],
            'Mesham': ['Ashwini', 'Bharani', 'Krittika', 'அஸ்வினி', 'பரணி', 'கார்த்திகை'],
            'Aries': ['Ashwini', 'Bharani', 'Krittika', 'அஸ்வினி', 'பரணி', 'கார்த்திகை'],

            'ரிஷபம்': ['கார்த்திகை', 'ரோகிணி', 'மிருகசீரிடம்'],
            'Rishabam': ['Krittika', 'Rohini', 'Mrigashira', 'கார்த்திகை', 'ரோகிணி', 'மிருகசீரிடம்'],
            'Taurus': ['Krittika', 'Rohini', 'Mrigashira', 'கார்த்திகை', 'ரோகிணி', 'மிருகசீரிடம்'],

            'மிதுனம்': ['மிருகசீரிடம்', 'திருவாதிரை', 'புனர்பூசம்'],
            'Mithunam': ['Mrigashira', 'Ardra', 'Punarvasu', 'மிருகசீரிடம்', 'திருவாதிரை', 'புனர்பூசம்'],
            'Gemini': ['Mrigashira', 'Ardra', 'Punarvasu', 'மிருகசீரிடம்', 'திருவாதிரை', 'புனர்பூசம்'],

            'கடகம்': ['புனர்பூசம்', 'பூசம்', 'ஆயில்யம்'],
            'Kadagam': ['Punarvasu', 'Pushya', 'Ashlesha', 'புனர்பூசம்', 'பூசம்', 'ஆயில்யம்'],
            'Cancer': ['Punarvasu', 'Pushya', 'Ashlesha', 'புனர்பூசம்', 'பூசம்', 'ஆயில்யம்'],

            'சிம்மம்': ['மகம்', 'பூரம்', 'உத்திரம்'],
            'Simmam': ['Magha', 'Purva Phalguni', 'Uttara Phalguni', 'மகம்', 'பூரம்', 'உத்திரம்'],
            'Leo': ['Magha', 'Purva Phalguni', 'Uttara Phalguni', 'மகம்', 'பூரம்', 'உத்திரம்'],

            'கன்னி': ['உத்திரம்', 'அஸ்தம்', 'சித்திரை'],
            'Kanni': ['Uttara Phalguni', 'Hastha', 'Chitra', 'உத்திரம்', 'அஸ்தம்', 'சித்திரை'],
            'Virgo': ['Uttara Phalguni', 'Hastha', 'Chitra', 'உத்திரம்', 'அஸ்தம்', 'சித்திரை'],

            'துலாம்': ['சித்திரை', 'சுவாதி', 'விசாகம்'],
            'Thulam': ['Chitra', 'Swathi', 'Vishakha', 'சித்திரை', 'சுவாதி', 'விசாகம்'],
            'Libra': ['Chitra', 'Swathi', 'Vishakha', 'சித்திரை', 'சுவாதி', 'விசாகம்'],

            'விருச்சிகம்': ['விசாகம்', 'அனுஷம்', 'கேட்டை'],
            'Viruchigam': ['Vishakha', 'Anuradha', 'Jyeshtha', 'விசாகம்', 'அனுஷம்', 'கேட்டை'],
            'Scorpio': ['Vishakha', 'Anuradha', 'Jyeshtha', 'விசாகம்', 'அனுஷம்', 'கேட்டை'],

            'தனுசு': ['மூலம்', 'பூராடம்', 'உத்திராடம்'],
            'Dhanusu': ['Moola', 'Purvashadha', 'Uttarashadha', 'மூலம்', 'பூராடம்', 'உத்திராடம்'],
            'Sagittarius': ['Moola', 'Purvashadha', 'Uttarashadha', 'மூலம்', 'பூராடம்', 'உத்திராடம்'],

            'மகரம்': ['உத்திராடம்', 'திருவோணம்', 'அவிட்டம்'],
            'Magaram': ['Uttarashadha', 'Shravana', 'Dhanishta', 'உத்திராடம்', 'திருவோணம்', 'அவிட்டம்'],
            'Capricorn': ['Uttarashadha', 'Shravana', 'Dhanishta', 'உத்திராடம்', 'திருவோணம்', 'அவிட்டம்'],

            'கும்பம்': ['அவிட்டம்', 'சதயம்', 'பூரட்டாதி'],
            'Kumbam': ['Dhanishta', 'Shatabhisha', 'Purva Bhadrapada', 'அவிட்டம்', 'சதயம்', 'பூரட்டாதி'],
            'Aquarius': ['Dhanishta', 'Shatabhisha', 'Purva Bhadrapada', 'அவிட்டம்', 'சதயம்', 'பூரட்டாதி'],

            'மீனம்': ['பூரட்டாதி', 'உத்திரட்டாதி', 'ரேவதி'],
            'Meenam': ['Purva Bhadrapada', 'Uttara Bhadrapada', 'Revathi', 'பூரட்டாதி', 'உத்திரட்டாதி', 'ரேவதி'],
            'Pisces': ['Purva Bhadrapada', 'Uttara Bhadrapada', 'Revathi', 'பூரட்டாதி', 'உத்திரட்டாதி', 'ரேவதி']
        };

        let _allNatchathiramOptions = null;

        function restoreAllStarOptions() {
            const starSel = document.getElementById('natchathiram');
            if (!starSel) return;
            if (!_allNatchathiramOptions) {
                _allNatchathiramOptions = Array.from(starSel.options).map(opt => ({
                    value: opt.value,
                    text: opt.text
                }));
                return;
            }
            const currentVal = starSel.value;
            starSel.innerHTML = '';
            _allNatchathiramOptions.forEach(optData => {
                const opt = document.createElement('option');
                opt.value = optData.value;
                opt.text = optData.text;
                if (optData.value === currentVal) opt.selected = true;
                starSel.appendChild(opt);
            });
        }

        function filterStarsByRasi(rasiVal, targetStar = null) {
            // STRICT SEPARATION: Autofill never filters stars! Only manual selection does.
            if (window.isAutofilling) return;

            const starSel = document.getElementById('natchathiram');
            if (!starSel) return;

            // Cache original options on first run
            if (!_allNatchathiramOptions) {
                _allNatchathiramOptions = Array.from(starSel.options).map(opt => ({
                    value: opt.value,
                    text: opt.text
                }));
            }

            const currentStar = targetStar || starSel.value;
            const rasiKey = rasiVal ? rasiVal.trim() : '';

            // Clean options
            starSel.innerHTML = '';

            // Add default select option
            const defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.id = 'opt_sel_star';
            defaultOpt.text = (appLang === 'ta') ? '-- தேர்ந்தெடுக்கவும் --' : '-- Select an option --';
            starSel.appendChild(defaultOpt);

            const allowedStars = RASI_NATCHATHIRAM_MAP[rasiKey] || null;

            _allNatchathiramOptions.forEach(optData => {
                if (!optData.value) return;
                let show = false;
                if (!allowedStars) {
                    show = true; // Show all if no rasi selected
                } else {
                    show = allowedStars.some(s => optData.value.includes(s) || optData.text.includes(s) || s.includes(optData.value));
                }

                if (show) {
                    const opt = document.createElement('option');
                    opt.value = optData.value;
                    opt.text = optData.text;
                    const matchedTarget = (typeof matchStar === 'function') ? matchStar(currentStar) : currentStar;
                    const cleanTarget = (matchedTarget || currentStar || '').replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();
                    const optClean = optData.value.replace(/[\s\._\-\–\d\(\)]+/g, '').toLowerCase();
                    if (optData.value === currentStar || optData.value === matchedTarget || (cleanTarget && (optClean === cleanTarget || optClean.includes(cleanTarget) || cleanTarget.includes(optClean)))) {
                        opt.selected = true;
                    }
                    starSel.appendChild(opt);
                }
            });
        }

        // ========================================================
        // Date of Birth & Birth Time Realtime Validators
        // ========================================================
        function validateDobInput() {
            const dobEl = document.getElementById('dob');
            const errEl = document.getElementById('dob_error_msg');
            if (!dobEl || !errEl) return true;

            // 1. Browser badInput flag (e.g. user typed 31/02/1995 or 32/01/1995 or 31/04/1995 directly into input)
            if (dobEl.validity && dobEl.validity.badInput) {
                errEl.innerText = (appLang === 'ta')
                    ? '⚠️ தவறான பிறந்த தேதி! காலண்டரில் இல்லாத தேதியை உள்ளிட முடியாது (எ.கா: பிப்ரவரி 30/31, ஏப்ரல் 31 கிடையாது).'
                    : '⚠️ Invalid Date of Birth! Please enter a valid calendar date.';
                errEl.style.display = 'block';
                dobEl.style.borderColor = '#dc2626';
                return false;
            }

            const val = dobEl.value;
            if (!val) {
                errEl.style.display = 'none';
                dobEl.style.borderColor = '';
                return true;
            }

            const parts = val.split('-');
            if (parts.length === 3) {
                const y = parseInt(parts[0], 10);
                const m = parseInt(parts[1], 10);
                const d = parseInt(parts[2], 10);

                const currentYear = new Date().getFullYear();
                if (isNaN(y) || isNaN(m) || isNaN(d) || y < 1920 || y > (currentYear + 1)) {
                    errEl.innerText = (appLang === 'ta')
                        ? `⚠️ தவறான பிறந்த வருடம் (${y})! சரியான வருடத்தை குறிப்பிடவும்.`
                        : `⚠️ Invalid Birth Year (${y})!`;
                    errEl.style.display = 'block';
                    dobEl.style.borderColor = '#dc2626';
                    return false;
                }

                // Check future date
                const today = new Date();
                today.setHours(23, 59, 59, 999);
                const selDate = new Date(y, m - 1, d);
                if (selDate > today) {
                    errEl.innerText = (appLang === 'ta')
                        ? '⚠️ தவறான பிறந்த தேதி! எதிர்கால தேதியை பிறந்த தேதியாக உள்ளிட முடியாது.'
                        : '⚠️ Date of Birth cannot be in the future.';
                    errEl.style.display = 'block';
                    dobEl.style.borderColor = '#dc2626';
                    return false;
                }

                const isLeap = (y % 4 === 0 && (y % 100 !== 0 || y % 400 === 0));
                const maxDaysInMonth = [0, 31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                if (m < 1 || m > 12 || d < 1 || d > maxDaysInMonth[m]) {
                    errEl.innerText = (appLang === 'ta')
                        ? `⚠️ தவறான பிறந்த தேதி! ${m}-வது மாதத்தில் ${d} தேதி கிடையாது (அதிகபட்சம் ${maxDaysInMonth[m] || 31} நாட்கள் மட்டுமே).`
                        : `⚠️ Invalid Date of Birth! Day ${d} does not exist in this month (max ${maxDaysInMonth[m] || 31} days).`;
                    errEl.style.display = 'block';
                    dobEl.style.borderColor = '#dc2626';
                    return false;
                }
            }

            errEl.style.display = 'none';
            dobEl.style.borderColor = '';
            autoSyncTamilCalendarFromDob(val);
            return true;
        }

        function autoSyncTamilCalendarFromDob(dobStr) {
            if (!dobStr) return;
            const parts = dobStr.split('-');
            if (parts.length !== 3) return;
            const y = parseInt(parts[0], 10);
            const m = parseInt(parts[1], 10);
            const d = parseInt(parts[2], 10);
            if (isNaN(y) || isNaN(m) || isNaN(d)) return;

            const TAMIL_YEARS = [
                "பிரபவ", "விபவ", "சுக்கில", "பிரமோதூத", "பிரஜோற்பத்தி", "ஆங்கீரச", "ஸ்ரீமுக", "பவ", "யுவ", "தாது",
                "ஈஸ்வர", "வெகுதானிய", "பிரமாதி", "விக்ரம", "விஷு", "சித்திரபானு", "சுபானு", "தாரண", "பார்த்திப", "விய",
                "சர்வசித்து", "சர்வதாரி", "விரோதி", "விக்ருதி", "கர", "நந்தன", "விஜய", "ஜய", "மன்மத", "துன்முகி",
                "ஹேவிளம்பி", "விளம்பி", "விகாரி", "சார்வரி", "பிலவ", "சுபகிருது", "சோபகிருது", "குரோதி", "விசுவாசுவ", "பராபவ",
                "பிலவங்க", "கீலக", "சௌமிய", "சாதாரண", "விரோதகிருது", "பரிதாபி", "பிரமாதீச", "ஆனந்த", "ராட்சச", "நள",
                "பிங்கள", "காளயுக்தி", "சித்தார்த்தி", "ரௌத்திரி", "துன்மதி", "துந்துபி", "ருத்ரோத்காரி", "ரக்தாட்சி", "குரோதன", "அட்சய"
            ];

            let tMonth = '';
            let isPrevTamilYear = false;
            if (m === 4) {
                if (d >= 14) { tMonth = 'சித்திரை'; }
                else { tMonth = 'பங்குனி'; isPrevTamilYear = true; }
            } else if (m === 5) {
                if (d >= 15) { tMonth = 'வைகாசி'; } else { tMonth = 'சித்திரை'; }
            } else if (m === 6) {
                if (d >= 15) { tMonth = 'ஆனி'; } else { tMonth = 'வைகாசி'; }
            } else if (m === 7) {
                if (d >= 16) { tMonth = 'ஆடி'; } else { tMonth = 'ஆனி'; }
            } else if (m === 8) {
                if (d >= 17) { tMonth = 'ஆவணி'; } else { tMonth = 'ஆடி'; }
            } else if (m === 9) {
                if (d >= 17) { tMonth = 'புரட்டாசி'; } else { tMonth = 'ஆவணி'; }
            } else if (m === 10) {
                if (d >= 18) { tMonth = 'ஐப்பசி'; } else { tMonth = 'புரட்டாசி'; }
            } else if (m === 11) {
                if (d >= 17) { tMonth = 'கார்த்திகை'; } else { tMonth = 'ஐப்பசி'; }
            } else if (m === 12) {
                if (d >= 16) { tMonth = 'மார்கழி'; } else { tMonth = 'கார்த்திகை'; }
            } else if (m === 1) {
                isPrevTamilYear = true;
                if (d >= 15) { tMonth = 'தை'; } else { tMonth = 'மார்கழி'; }
            } else if (m === 2) {
                isPrevTamilYear = true;
                if (d >= 14) { tMonth = 'மாசி'; } else { tMonth = 'தை'; }
            } else if (m === 3) {
                isPrevTamilYear = true;
                if (d >= 15) { tMonth = 'பங்குனி'; } else { tMonth = 'மாசி'; }
            }

            const effectiveYear = isPrevTamilYear ? y - 1 : y;
            let cycleIdx = (effectiveYear - 1987) % 60;
            if (cycleIdx < 0) cycleIdx += 60;
            const tYear = TAMIL_YEARS[cycleIdx];

            const mSel = document.getElementById('tamil_month_name');
            if (mSel && (!mSel.value || !mSel.value.trim()) && tMonth) {
                mSel.value = tMonth;
                mSel.dispatchEvent(new Event('change', { bubbles: true }));
                mSel.classList.add('autofill-glow');
            }

            const ySel = document.getElementById('tamil_year');
            if (ySel && (!ySel.value || !ySel.value.trim()) && tYear) {
                for (let opt of ySel.options) {
                    if (opt.value && (opt.value.includes(tYear) || tYear.includes(opt.value))) {
                        ySel.value = opt.value;
                        ySel.dispatchEvent(new Event('change', { bubbles: true }));
                        ySel.classList.add('autofill-glow');
                        break;
                    }
                }
            }
        }

        function validateBirthTimeInput() {
            const el = document.getElementById('birth_time');
            const errEl = document.getElementById('birth_time_error_msg');
            if (!el || !errEl) return true;
            let val = el.value ? el.value.trim() : '';
            if (!val) {
                errEl.style.display = 'none';
                el.style.borderColor = '';
                return true;
            }

            // Automatic normalization for spoken or typed words (e.g. "பதினோரு மணி ஏ எம்" or "11 am")
            const autoParsed = false; // Do not auto-normalize speech inside typed input to avoid premature completion
            if (autoParsed && /^\d{2}:\d{2}\s*(AM|PM)$/i.test(autoParsed)) {
                if (el.value !== autoParsed) el.value = autoParsed;
                errEl.style.display = 'none';
                el.style.borderColor = '';
                return true;
            }

            // Normalize Tamil spoken time words to AM/PM
            let normalized = val;
            if (/காலை|முற்பகல்/i.test(normalized)) {
                normalized = normalized.replace(/காலை|முற்பகல்/gi, '').trim() + ' AM';
            } else if (/மாலை|இரவு|பிற்பகல்/i.test(normalized)) {
                normalized = normalized.replace(/மாலை|இரவு|பிற்பகல்/gi, '').trim() + ' PM';
            }

            // Single number without colon/AM/PM e.g. "30"
            if (/^\d{1,2}$/.test(normalized)) {
                errEl.innerText = (appLang === 'ta')
                    ? '⚠️ பிறந்த நேரத்தில் மணி, நிமிடம் மற்றும் AM / PM உள்ளிடவும் (எ.கா: 10:30 AM)'
                    : '⚠️ Please enter valid hours, minutes and AM/PM (e.g. 10:30 AM)';
                errEl.style.display = 'block';
                el.style.borderColor = '#dc2626';
                return false;
            }

            // Time without AM/PM e.g. "10:30" or "10.30"
            const noAmPmMatch = normalized.match(/^(\d{1,2})[:.](\d{2})$/);
            if (noAmPmMatch) {
                const h = parseInt(noAmPmMatch[1], 10);
                const m = parseInt(noAmPmMatch[2], 10);
                if (h >= 13 && h <= 23 && m <= 59) {
                    const formatted = `${String(h - 12).padStart(2, '0')}:${String(m).padStart(2, '0')} PM`;
                    el.value = formatted;
                    errEl.style.display = 'none';
                    el.style.borderColor = '';
                    return true;
                } else if (h === 12 && m <= 59) {
                    const formatted = `12:${String(m).padStart(2, '0')} PM`;
                    el.value = formatted;
                    errEl.style.display = 'none';
                    el.style.borderColor = '';
                    return true;
                } else if (h === 0 && m <= 59) {
                    const formatted = `12:${String(m).padStart(2, '0')} AM`;
                    el.value = formatted;
                    errEl.style.display = 'none';
                    el.style.borderColor = '';
                    return true;
                } else if (h > 12 || m > 59) {
                    errEl.innerText = (appLang === 'ta')
                        ? '⚠️ தவறான பிறந்த நேரம்! (எ.கா: 10:30 AM அல்லது 06:15 PM)'
                        : '⚠️ Invalid Birth Time! (e.g. 10:30 AM or 06:15 PM)';
                } else {
                    errEl.innerText = (appLang === 'ta')
                        ? '⚠️ பிறந்த நேரத்தில் AM அல்லது PM குறிப்பிடவும் (எ.கா: 10:30 AM அல்லது 10:30 PM)'
                        : '⚠️ Please specify AM or PM (e.g. 10:30 AM or 10:30 PM)';
                }
                errEl.style.display = 'block';
                el.style.borderColor = '#dc2626';
                return false;
            }

            // Valid pattern e.g. "10:30 AM" or "10.30 PM"
            const fullMatch = normalized.match(/^(\d{1,2})[:.](\d{2})\s*(AM|PM|am|pm)$/i);
            if (fullMatch) {
                const h = parseInt(fullMatch[1], 10);
                const m = parseInt(fullMatch[2], 10);
                const mer = fullMatch[3].toUpperCase();
                if (h >= 1 && h <= 12 && m >= 0 && m <= 59) {
                    const formatted = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')} ${mer}`;
                    if (el.value !== formatted) el.value = formatted;
                    errEl.style.display = 'none';
                    el.style.borderColor = '';
                    return true;
                }
            }

            // Otherwise invalid format
            errEl.innerText = (appLang === 'ta')
                ? '⚠️ தவறான பிறந்த நேரம்! சரியான நேரத்தை உள்ளிடவும் (எ.கா: 10:30 AM)'
                : '⚠️ Invalid Birth Time format! (e.g. 10:30 AM)';
            errEl.style.display = 'block';
            el.style.borderColor = '#dc2626';
            return false;
        }

        // Phone Number Validation (Strict 10-digit Indian Mobile Numbers starting with 6,7,8,9)
        function validateMobileField(el, showError) {
            if (!el) return true;
            const errId = el.id + '_error_msg';
            const errEl = document.getElementById(errId);
            let val = el.value ? el.value.trim() : '';

            // Extract digits only
            const cleanDigits = val.replace(/\D/g, '').slice(0, 10);
            if (el.value !== cleanDigits) el.value = cleanDigits;

            if (!cleanDigits) {
                if (errEl) errEl.style.display = 'none';
                el.style.borderColor = '';
                return true;
            }

            if (cleanDigits.length < 10) {
                if (showError) {
                    if (errEl) {
                        errEl.innerText = (typeof appLang !== 'undefined' && appLang === 'ta')
                            ? '⚠️ அலைபேசி எண் 10 இலக்கங்களாக இருக்க வேண்டும் (எ.கா: 9080849042)'
                            : '⚠️ Mobile number must be 10 digits (e.g. 9080849042)';
                        errEl.style.display = 'block';
                    }
                    el.style.borderColor = '#dc2626';
                }
                return false;
            }

            if (!/^[6-9]\d{9}$/.test(cleanDigits)) {
                if (showError) {
                    if (errEl) {
                        errEl.innerText = (typeof appLang !== 'undefined' && appLang === 'ta')
                            ? '⚠️ சரியான இந்திய அலைபேசி எண் உள்ளிடவும் (6, 7, 8, 9-ல் தொடங்க வேண்டும்)'
                            : '⚠️ Must start with 6, 7, 8, or 9 (e.g. 9080849042)';
                        errEl.style.display = 'block';
                    }
                    el.style.borderColor = '#dc2626';
                }
                return false;
            }

            if (errEl) errEl.style.display = 'none';
            el.style.borderColor = '';
            return true;
        }

        function validateBirthPlaceInput() {
            const el = document.getElementById('birth_place');
            const errEl = document.getElementById('birth_place_error_msg');
            if (!el || !errEl) return true;
            const val = el.value ? el.value.trim() : '';
            if (!val) {
                errEl.style.display = 'none';
                el.style.borderColor = '';
                return true;
            }

            const hasDigits = /[0-9\u0BE6-\u0BEF]/.test(val);
            const hasTamilNumbers = /(?:ஒன்று|இரண்டு|மூன்று|நான்கு|ஐந்து|ஆறு|ஏழு|எட்டு|ஒன்பது|பத்து|இருபது|முப்பது|நாற்பது|ஐம்பது|அறுபது|எழுபது|எண்பது|தொண்ணூறு|நூறு)/.test(val);

            if (hasDigits || hasTamilNumbers) {
                errEl.innerText = (appLang === 'ta')
                    ? '⚠️ பிறந்த ஊரில் எண்கள் (Numbers) இருக்கக்கூடாது! ஊர் பெயரை மட்டும் உள்ளிடவும் (எ.கா: ஈரோடு, சென்னை, கோவை).'
                    : '⚠️ Numbers are not allowed in Birth Place! Please enter place name only (e.g. Erode, Chennai, Coimbatore).';
                errEl.style.display = 'block';
                el.style.borderColor = '#dc2626';
                return false;
            }

            errEl.style.display = 'none';
            el.style.borderColor = '';
            return true;
        }

        // ========================================================
        // Registered Profiles Directory Pagination
        // ========================================================
        // Registered Profiles Directory Pagination
        // ========================================================
        let directoryCurrentPage = 1;
        let directoryPerPage = 10;
        let matchingDirectoryRows = [];
        let directoryTotalPages = 1;
        window.directoryTotalPages = 1;

        function initDirectoryPagination() {
            const rows = document.querySelectorAll('#profilesTable tbody tr.profile-table-row');
            matchingDirectoryRows = Array.from(rows);
            directoryCurrentPage = 1;
            renderDirectoryPagination();
        }

        function changeDirectoryPerPage(val) {
            directoryPerPage = (val === 'all') ? 'all' : parseInt(val, 10);
            directoryCurrentPage = 1;
            renderDirectoryPagination();
        }

        function goToDirectoryPage(p) {
            const perPage = (directoryPerPage === 'all') ? (matchingDirectoryRows.length || 1) : directoryPerPage;
            const totalPages = Math.max(1, Math.ceil(matchingDirectoryRows.length / (perPage || 10)));
            directoryTotalPages = totalPages;
            window.directoryTotalPages = totalPages;

            if (p === 'last' || p === 'end' || p === undefined || p === null) {
                p = totalPages;
            } else if (p === 'first' || p === 'start') {
                p = 1;
            } else {
                p = parseInt(p, 10);
                if (isNaN(p)) p = totalPages;
            }

            if (p < 1) p = 1;
            if (p > totalPages) p = totalPages;
            directoryCurrentPage = p;
            renderDirectoryPagination();
        }

        function renderDirectoryPagination() {
            const total = matchingDirectoryRows.length;
            const perPage = (directoryPerPage === 'all') ? (total || 1) : directoryPerPage;
            const totalPages = Math.max(1, Math.ceil(total / perPage));
            directoryTotalPages = totalPages;
            window.directoryTotalPages = totalPages;

            if (directoryCurrentPage > totalPages) directoryCurrentPage = totalPages;
            if (directoryCurrentPage < 1) directoryCurrentPage = 1;

            const startIndex = (directoryCurrentPage - 1) * perPage;
            const endIndex = (directoryPerPage === 'all') ? total : Math.min(startIndex + perPage, total);

            // Hide all rows in table first
            const allRows = document.querySelectorAll('#profilesTable tbody tr.profile-table-row');
            allRows.forEach(r => r.style.display = 'none');

            // Show only matching rows for active page
            for (let i = startIndex; i < endIndex; i++) {
                if (matchingDirectoryRows[i]) {
                    matchingDirectoryRows[i].style.display = '';
                }
            }

            // Update Records Summary
            const summaryEl = document.getElementById('directoryRecordsSummary');
            if (summaryEl) {
                if (total === 0) {
                    summaryEl.innerText = (appLang === 'ta') ? 'வரன்கள் எதுவும் இல்லை' : 'No records found';
                } else {
                    const startDisp = startIndex + 1;
                    summaryEl.innerText = (appLang === 'ta')
                        ? `${startDisp} - ${endIndex} / மொத்தம் ${total} வரன்கள்`
                        : `Showing ${startDisp} - ${endIndex} of ${total} profiles`;
                }
            }

            // Update Pagination Buttons
            const btnFirst = document.getElementById('btnPageFirst');
            const btnPrev = document.getElementById('btnPagePrev');
            const btnNext = document.getElementById('btnPageNext');
            const btnLast = document.getElementById('btnPageLast');

            if (btnFirst) {
                btnFirst.disabled = (directoryCurrentPage <= 1);
                btnFirst.onclick = () => goToDirectoryPage(1);
            }
            if (btnPrev) {
                btnPrev.disabled = (directoryCurrentPage <= 1);
                btnPrev.onclick = () => goToDirectoryPage(directoryCurrentPage - 1);
            }
            if (btnNext) {
                btnNext.disabled = (directoryCurrentPage >= totalPages);
                btnNext.onclick = () => goToDirectoryPage(directoryCurrentPage + 1);
            }
            if (btnLast) {
                btnLast.disabled = (directoryCurrentPage >= totalPages);
                btnLast.onclick = () => goToDirectoryPage(totalPages);
            }

            const pageBtnsContainer = document.getElementById('directoryPageButtons');
            if (pageBtnsContainer) {
                pageBtnsContainer.innerHTML = '';
                let startP = Math.max(1, directoryCurrentPage - 2);
                let endP = Math.min(totalPages, startP + 4);
                if (endP - startP < 4) {
                    startP = Math.max(1, endP - 4);
                }

                for (let i = startP; i <= endP; i++) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn-action-icon' + (i === directoryCurrentPage ? ' active-page-btn' : '');
                    btn.style.height = '34px';
                    btn.style.minWidth = '34px';
                    btn.style.padding = '0 10px';
                    btn.style.fontWeight = '800';
                    btn.style.borderRadius = '6px';
                    if (i === directoryCurrentPage) {
                        btn.style.background = '#881337';
                        btn.style.color = '#ffffff';
                        btn.style.borderColor = '#881337';
                    } else {
                        btn.style.background = '#ffffff';
                        btn.style.color = '#1e293b';
                    }
                    btn.innerText = i;
                    btn.onclick = () => goToDirectoryPage(i);
                    pageBtnsContainer.appendChild(btn);
                }
            }
        }
        // ========================================================
    </script>
</body>
</html>
