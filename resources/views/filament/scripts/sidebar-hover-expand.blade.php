{{-- Desktop collapsible sidebar: hover expands after a short delay; leaving collapses unless pinned via the expand chevron. --}}
<script>
    (function () {
        const desktop = () => window.matchMedia('(min-width: 1024px)').matches;

        function bind() {
            const el = document.querySelector('aside.fi-sidebar.fi-main-sidebar');
            if (!el || el.dataset.hoverExpandBound === '1') {
                return;
            }
            el.dataset.hoverExpandBound = '1';

            let collapsedOnEnter = false;
            let pinnedOpen = false;
            let leaveTimer = null;
            let hoverOpenTimer = null;
            const closeDelayMs = 200;
            const hoverOpenDelayMs = 240;

            const store = () => window.Alpine?.store('sidebar');
            const isHeaderChromeButton = (btn) =>
                btn &&
                el.contains(btn) &&
                btn.closest('.fi-sidebar-header') &&
                !btn.closest('.fi-sidebar-group');

            el.addEventListener(
                'click',
                (e) => {
                    if (!desktop()) {
                        return;
                    }
                    const btn = e.target.closest('button');
                    if (!isHeaderChromeButton(btn)) {
                        return;
                    }
                    if (btn.classList.contains('mx-auto') && !btn.classList.contains('ms-auto')) {
                        if (hoverOpenTimer !== null) {
                            clearTimeout(hoverOpenTimer);
                            hoverOpenTimer = null;
                        }
                        pinnedOpen = true;
                    }
                    if (btn.classList.contains('ms-auto') && btn.classList.contains('hidden')) {
                        pinnedOpen = false;
                    }
                },
                true,
            );

            el.addEventListener('mouseenter', () => {
                if (leaveTimer !== null) {
                    clearTimeout(leaveTimer);
                    leaveTimer = null;
                }
                if (!desktop()) {
                    return;
                }
                const s = store();
                if (!s) {
                    return;
                }
                collapsedOnEnter = !s.isOpen;
                if (s.isOpen) {
                    return;
                }
                if (hoverOpenTimer !== null) {
                    clearTimeout(hoverOpenTimer);
                }
                hoverOpenTimer = window.setTimeout(() => {
                    hoverOpenTimer = null;
                    store()?.open();
                }, hoverOpenDelayMs);
            });

            el.addEventListener('mouseleave', () => {
                if (hoverOpenTimer !== null) {
                    clearTimeout(hoverOpenTimer);
                    hoverOpenTimer = null;
                }
                if (!desktop()) {
                    return;
                }
                if (leaveTimer !== null) {
                    clearTimeout(leaveTimer);
                }
                leaveTimer = window.setTimeout(() => {
                    leaveTimer = null;
                    const s = store();
                    if (!s || pinnedOpen || !collapsedOnEnter) {
                        return;
                    }
                    s.close();
                }, closeDelayMs);
            });
        }

        bind();
        document.addEventListener('livewire:navigated', bind);
    })();
</script>
