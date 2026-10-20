<style>
/* ===== Care Hub (all rules scoped under .carehub) ===== */
body { background: #f1f5f9; }
.carehub [hidden] { display: none !important; }

.carehub { padding: 20px; max-width: 1280px; margin: 0 auto; color: #1e293b; }

/* Header */
.carehub .ch-header {
    display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;
    gap: 12px; margin-bottom: 8px;
}
.carehub .ch-title { font-size: 1.9rem; font-weight: 700; margin: 0; }
.carehub .ch-subtitle { color: #64748b; margin: 4px 0 0; font-size: 0.95rem; }
.carehub .btn-create {
    background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; padding: 10px 20px;
    border-radius: 10px; border: none; cursor: pointer; font-weight: 600; text-decoration: none;
}
.carehub .btn-create:hover { filter: brightness(1.08); }

/* Disclaimer */
.carehub .ch-disclaimer {
    display: flex; gap: 10px; align-items: flex-start; background: #fffbeb; border: 1px solid #fde68a;
    color: #92400e; padding: 10px 14px; border-radius: 10px; font-size: 0.85rem; margin: 14px 0 20px;
}

/* Toolbar */
.carehub .ch-toolbar { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 14px; }
.carehub .ch-search { position: relative; flex: 1 1 260px; }
.carehub .ch-search i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
.carehub .ch-search input {
    width: 100%; padding: 10px 14px 10px 36px; border-radius: 10px; border: 1px solid #e2e8f0; background: #fff;
}
.carehub .ch-select { padding: 10px 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #fff; }
.carehub .ch-count { color: #64748b; font-size: 0.85rem; margin-left: auto; }

/* Disease chips */
.carehub .filter-container { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
.carehub .filter-btn {
    padding: 7px 18px; border-radius: 25px; background: #fff; border: 1px solid #e2e8f0;
    color: #64748b; font-weight: 600; cursor: pointer; transition: 0.2s ease;
}
.carehub .filter-btn:hover { border-color: #667eea; color: #667eea; }
.carehub .filter-btn.active {
    background: #667eea; color: #fff; border-color: #667eea; box-shadow: 0 4px 12px rgba(102,126,234,0.3);
}

/* Sections */
.carehub .ch-section { padding: 20px; border-radius: 15px; margin-bottom: 28px; }
.carehub .emergency-section {
    background: linear-gradient(135deg, rgba(239,68,68,0.12), rgba(239,68,68,0.04)); border: 1px solid rgba(239,68,68,0.3);
}
.carehub .recommended-section {
    background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(102,126,234,0.04)); border: 1px solid rgba(102,126,234,0.3);
}
.carehub .ch-section-head { display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 14px; }
.carehub .ch-section-title { font-size: 1.3rem; font-weight: 700; margin: 0; }
.carehub .emergency-title { color: #dc2626; }
.carehub .recommended-title { color: #4f46e5; }
.carehub .ch-section-note { color: #64748b; font-size: 0.85rem; }

.carehub .ch-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }

/* Cards */
.carehub .ch-card {
    background: #fff; border-radius: 14px; padding: 18px; display: flex; flex-direction: column;
    box-shadow: 0 1px 3px rgba(15,23,42,0.08); transition: transform .2s, box-shadow .2s;
}
.carehub .ch-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(15,23,42,0.12); }
.carehub .emergency-card { border-left: 5px solid #ef4444; }
.carehub .recommended-card { border-left: 5px solid #667eea; }
.carehub .ch-card-top { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 10px; }
.carehub .ch-chip { padding: 4px 10px; background: #e0e7ff; color: #4338ca; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
.carehub .ch-card-title { font-size: 1.1rem; font-weight: 600; margin: 0 0 6px; }
.carehub .ch-disease { color: #64748b; font-size: 0.8rem; margin-bottom: 8px; }
.carehub .ch-card-desc {
    color: #475569; font-size: 0.9rem; line-height: 1.5; margin: 0 0 14px;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.carehub .ch-card-footer { margin-top: auto; display: flex; justify-content: flex-end; }
.carehub .ch-view-btn {
    background: none; border: none; color: #667eea; font-weight: 600; cursor: pointer; padding: 4px 0;
}
.carehub .ch-view-btn:hover { text-decoration: underline; }
.carehub .ch-view-btn:focus-visible, .carehub .filter-btn:focus-visible { outline: 3px solid #a5b4fc; outline-offset: 2px; }

/* Badges */
.carehub .ch-badge, .ch-modal .ch-badge { padding: 4px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
.level-high { background: #fee2e2; color: #dc2626; }
.level-mid { background: #fef3c7; color: #d97706; }
.level-easy { background: #dcfce7; color: #16a34a; }
.cat-emergency { background: #fee2e2; color: #dc2626; }
.cat-recommended { background: #dcfce7; color: #16a34a; }
.ch-badge.type { background: #e0e7ff; color: #4338ca; }

/* Show more */
.carehub .ch-toggle {
    display: block; margin: 14px 0 0 auto; background: none; border: none; cursor: pointer;
    color: #ef4444; font-weight: 600;
}
.carehub .recommended-section .ch-toggle { color: #4f46e5; }

/* Empty states */
.carehub .ch-empty { text-align: center; color: #94a3b8; padding: 40px 10px; }

/* Modal */
.ch-modal { display: none; position: fixed; z-index: 999; inset: 0; background: rgba(15,23,42,0.55); backdrop-filter: blur(4px); overflow-y: auto; }
.ch-modal.open { display: block; }
.ch-modal-content {
    background: #fff; margin: 5vh auto; padding: 28px; width: min(560px, 92vw); max-height: 88vh; overflow-y: auto;
    border-radius: 20px; position: relative; box-shadow: 0 25px 60px rgba(0,0,0,0.25);
}
.ch-close { position: absolute; right: 14px; top: 10px; font-size: 26px; cursor: pointer; background: none; border: none; color: #64748b; }
.ch-modal h2 { font-size: 1.4rem; font-weight: 700; margin: 0 28px 14px 0; }
.ch-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
.ch-modal-section { margin-bottom: 18px; }
.ch-modal-section h4 { font-size: 0.75rem; text-transform: uppercase; letter-spacing: .5px; color: #94a3b8; margin: 0 0 6px; }
.ch-modal-section p { font-size: 0.95rem; color: #334155; line-height: 1.6; margin: 0; white-space: pre-line; }
.ch-steps { background: #f8fafc; border-radius: 10px; padding: 12px 12px 12px 32px; margin: 0; color: #1e293b; font-size: 0.9rem; line-height: 1.6; }
.ch-steps li { margin-bottom: 4px; }
.ch-research { color: #667eea; font-weight: 600; text-decoration: none; }
.ch-research:hover { text-decoration: underline; }
.ch-back-btn { margin-top: 8px; width: 100%; padding: 12px; background: #667eea; color: #fff; border: none; border-radius: 12px; cursor: pointer; font-weight: 600; }

@media (max-width: 640px) {
    .carehub { padding: 12px; }
    .carehub .ch-count { margin-left: 0; width: 100%; }
}
</style>
