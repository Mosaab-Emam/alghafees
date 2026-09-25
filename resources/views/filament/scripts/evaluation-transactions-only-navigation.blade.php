@if (\App\Support\FilamentDashboardAccess::userIsEvaluationTransactionsOnly())
    <script>
        (function () {
            function restrictSidebarNavigation() {
                document
                    .querySelectorAll('aside.fi-sidebar a[href]')
                    .forEach((link) => {
                        const isEvaluationTransactionsLink = link.href.includes('/dashboard/evaluation-transactions');
                        const item = link.closest('li') || link;

                        if (!isEvaluationTransactionsLink) {
                            item.hidden = true;
                            item.style.display = 'none';
                        } else {
                            item.hidden = false;
                            item.style.display = '';
                        }
                    });

                document
                    .querySelectorAll('aside.fi-sidebar .fi-sidebar-group')
                    .forEach((group) => {
                        const hasVisibleItem = Array
                            .from(group.querySelectorAll('li'))
                            .some((item) => item.offsetParent !== null && item.style.display !== 'none' && !item.hidden);

                        if (!hasVisibleItem) {
                            group.hidden = true;
                            group.style.display = 'none';
                        }
                    });
            }

            restrictSidebarNavigation();
            document.addEventListener('livewire:navigated', restrictSidebarNavigation);
        })();
    </script>
@endif
