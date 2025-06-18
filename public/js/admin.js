document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const html = document.documentElement;

    // Initialize sidebar state
    function initSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        } else if (window.innerWidth <= 992) {
            sidebar.classList.add('collapsed');
        }
    }

    // Toggle sidebar
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
        document.body.classList.toggle('sidebar-open');
    }

    // Close sidebar
    function closeSidebar() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }

    // Event listeners
    sidebarToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleSidebar();
    });

    sidebarOverlay.addEventListener('click', closeSidebar);

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 &&
            !sidebar.contains(e.target) &&
            e.target !== sidebarToggle) {
            closeSidebar();
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        initSidebar();

        // If window is resized to larger than mobile, ensure sidebar is visible
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
    });

    // Initialize
    initSidebar();

    // Theme toggle functionality
    const themeToggle = document.createElement('button');
    themeToggle.className = 'theme-toggle';
    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    document.querySelector('.header-right').prepend(themeToggle);

    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        html.classList.add('dark-mode');
    }

    themeToggle.addEventListener('click', () => {
        html.classList.toggle('dark-mode');
        const isDark = html.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');

        const icon = themeToggle.querySelector('i');
        icon.classList.toggle('fa-moon');
        icon.classList.toggle('fa-sun');
    });

    if (html.classList.contains('dark-mode')) {
        const icon = themeToggle.querySelector('i');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }

    // Sortable table headers
    document.querySelectorAll('.sortable-table th').forEach(function(th) {
        th.addEventListener('click', function() {
            const url = new URL(window.location.href);
            const sort = this.dataset.sort;
            if (!sort) return;
            let direction = url.searchParams.get('direction') === 'asc' ? 'desc' : 'asc';
            url.searchParams.set('sort', sort);
            url.searchParams.set('direction', direction);
            window.location = url.toString();
        });
    });

    // Delete modal handling
    const deleteModal = document.getElementById('deletePropertyModal');
    const deleteTitle = document.getElementById('deletePropertyTitle');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const closeDeleteModal = document.getElementById('closeDeleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    let currentForm = null;

    document.querySelectorAll('.delete-property-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            currentForm = this.closest('form');
            deleteTitle.textContent = this.dataset.title;
            deleteModal.classList.add('show');
        });
    });

    function closeModal() {
        deleteModal.classList.remove('show');
        currentForm = null;
    }

    // Close modal handlers
    if (closeDeleteModal) {
        closeDeleteModal.addEventListener('click', closeModal);
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', closeModal);
    }

    // Confirm delete handler
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit();
            }
            closeModal();
        });
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeModal();
        }
    });
});
